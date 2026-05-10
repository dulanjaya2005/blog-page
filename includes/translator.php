<?php
/**
 * Auto Content Translator — includes/translator.php
 * Translates post content, titles, excerpts using Google Translate API (free)
 */

// ── Cache folder (create: blog-system/cache/translations/)
define('TRANS_CACHE_DIR', __DIR__ . '/../cache/translations/');

/**
 * Translate text using Google Translate (free unofficial API)
 * No API key needed for basic use
 */
function translateText(string $text, string $targetLang, string $sourceLang = 'auto'): string {
    // Don't translate if already English or lang is English
    if ($targetLang === 'en' || empty(trim($text))) return $text;

    // Check cache first
    $cacheKey  = md5($text . $targetLang);
    $cacheFile = TRANS_CACHE_DIR . $cacheKey . '.txt';

    if (!is_dir(TRANS_CACHE_DIR)) {
        mkdir(TRANS_CACHE_DIR, 0755, true);
    }

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 86400 * 30) {
        return file_get_contents($cacheFile);
    }

    // Map lang codes to Google Translate codes
    $langMap = [
        'si' => 'si', 'ta' => 'ta', 'hi' => 'hi', 'zh' => 'zh-CN',
        'ja' => 'ja', 'ko' => 'ko', 'ar' => 'ar', 'fr' => 'fr',
        'de' => 'de', 'es' => 'es', 'pt' => 'pt', 'ru' => 'ru',
        'it' => 'it', 'tr' => 'tr', 'nl' => 'nl', 'pl' => 'pl',
        'vi' => 'vi', 'th' => 'th', 'id' => 'id', 'ms' => 'ms',
        'fa' => 'fa', 'ur' => 'ur', 'bn' => 'bn', 'sw' => 'sw',
    ];

    $googleLang = $langMap[$targetLang] ?? $targetLang;

    try {
        // Split long text into chunks (Google limit ~5000 chars)
        $chunks = splitTextChunks($text, 4500);
        $translated = '';

        foreach ($chunks as $chunk) {
            $result = callGoogleTranslate($chunk, $googleLang, $sourceLang);
            $translated .= $result;
        }

        // Cache the result
        file_put_contents($cacheFile, $translated);
        return $translated;

    } catch (Exception $e) {
        error_log("Translation error: " . $e->getMessage());
        return $text; // Return original if translation fails
    }
}

/**
 * Call Google Translate free API
 */
function callGoogleTranslate(string $text, string $targetLang, string $sourceLang = 'auto'): string {
    $url = 'https://translate.googleapis.com/translate_a/single'
         . '?client=gtx'
         . '&sl=' . urlencode($sourceLang)
         . '&tl=' . urlencode($targetLang)
         . '&dt=t'
         . '&q=' . urlencode($text);

    $context = stream_context_create([
        'http' => [
            'method'  => 'GET',
            'timeout' => 10,
            'header'  => [
                'User-Agent: Mozilla/5.0 (compatible; CharmVibe/1.0)',
            ],
        ],
        'ssl' => [
            'verify_peer'      => false,
            'verify_peer_name' => false,
        ],
    ]);

    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        throw new Exception("Could not connect to Google Translate");
    }

    $data = json_decode($response, true);

    if (!isset($data[0]) || !is_array($data[0])) {
        throw new Exception("Invalid response from Google Translate");
    }

    $translated = '';
    foreach ($data[0] as $part) {
        if (isset($part[0])) {
            $translated .= $part[0];
        }
    }

    return $translated;
}

/**
 * Translate HTML content (preserves HTML tags)
 */
function translateHTML(string $html, string $targetLang): string {
    if ($targetLang === 'en') return $html;

    // Extract text nodes, translate, re-insert
    // Simple approach: translate full HTML (Google handles tags well)
    return translateText($html, $targetLang);
}

/**
 * Split text into chunks without breaking words
 */
function splitTextChunks(string $text, int $maxLen): array {
    if (strlen($text) <= $maxLen) return [$text];

    $chunks = [];
    $sentences = preg_split('/(?<=[.!?])\s+/', $text);
    $current = '';

    foreach ($sentences as $sentence) {
        if (strlen($current) + strlen($sentence) > $maxLen) {
            if ($current) $chunks[] = $current;
            $current = $sentence . ' ';
        } else {
            $current .= $sentence . ' ';
        }
    }

    if ($current) $chunks[] = $current;
    return $chunks ?: [$text];
}

/**
 * Clear translation cache for a specific text
 */
function clearTranslationCache(string $text = ''): void {
    if (!is_dir(TRANS_CACHE_DIR)) return;

    if ($text) {
        // Clear specific cache entries
        foreach (['en','si','ta','hi','zh','ja','ko','ar','fr','de','es','pt','ru','it','tr','nl','pl','vi','th','id','ms','fa','ur','bn','sw'] as $lang) {
            $cacheFile = TRANS_CACHE_DIR . md5($text . $lang) . '.txt';
            if (file_exists($cacheFile)) unlink($cacheFile);
        }
    } else {
        // Clear all cache
        array_map('unlink', glob(TRANS_CACHE_DIR . '*.txt'));
    }
}
