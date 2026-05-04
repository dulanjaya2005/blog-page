<?php
/**
 * AJAX Search Endpoint — includes/search.php
 */
header('Content-Type: application/json');
require_once __DIR__ . '/functions.php';

$q = sanitize($_GET['q'] ?? '');
if (strlen($q) < 2) { echo '[]'; exit; }

$posts = searchPosts($q, 8);
$results = array_map(fn($p) => [
    'title'         => $p['title'],
    'slug'          => $p['slug'],
    'category_name' => $p['category_name'] ?? '',
    'reading_time'  => readingTime($p['content']),
], $posts);

echo json_encode($results);
