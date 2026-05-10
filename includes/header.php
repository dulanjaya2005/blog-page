<?php
/**
 * Global Header Partial — includes/header.php
 */

if (!defined('INCLUDED')) define('INCLUDED', true);
session_start();
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/lang.php';

$pageTitle    = $pageTitle    ?? SITE_NAME . ' — ' . SITE_TAGLINE;
$metaDesc     = $metaDesc     ?? 'Engaging stories across Love, Horror, Mystery, Psychology, Technology and Make Money Online.';
$metaKeywords = $metaKeywords ?? 'blog, love, horror, mystery, psychology, technology, make money online';
$categories   = getCategories();
$currentLang  = getCurrentLang();
$langDir      = getLangDir();
?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>" dir="<?= $langDir ?>" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($metaDesc) ?>">
  <meta name="keywords"    content="<?= htmlspecialchars($metaKeywords) ?>">
  <meta property="og:title"       content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($metaDesc) ?>">
  <meta property="og:type"        content="website">
  <meta property="og:url"         content="<?= SITE_URL ?>">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="canonical" href="<?= SITE_URL . htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
  <style>
    /* ── Language Switcher ── */
    .lang-switcher { position:relative; }
    .lang-btn {
      display:flex; align-items:center; gap:6px;
      padding:6px 12px; border-radius:99px;
      background:var(--bg-secondary); border:1px solid var(--border);
      font-size:.8rem; font-weight:600; cursor:pointer;
      color:var(--text-primary); transition:all .2s ease;
    }
    .lang-btn:hover { border-color:var(--accent); color:var(--accent); }
    .lang-flag { font-size:1rem; }
    .lang-dropdown {
      position:absolute; top:calc(100% + 8px); right:0;
      background:var(--bg-card); border:1px solid var(--border);
      border-radius:12px; padding:8px;
      min-width:200px; max-height:360px; overflow-y:auto;
      box-shadow:0 12px 40px rgba(0,0,0,.15);
      opacity:0; visibility:hidden; transform:translateY(-8px);
      transition:all .2s ease; z-index:999;
    }
    .lang-switcher.open .lang-dropdown {
      opacity:1; visibility:visible; transform:translateY(0);
    }
    .lang-option {
      display:flex; align-items:center; gap:10px;
      padding:9px 12px; border-radius:8px;
      font-size:.82rem; font-weight:500; cursor:pointer;
      color:var(--text-primary); text-decoration:none;
      transition:background .15s ease;
    }
    .lang-option:hover { background:var(--bg-secondary); color:var(--accent); }
    .lang-option.active { background:var(--accent-light); color:var(--accent); font-weight:700; }
    .lang-option .flag { font-size:1.1rem; }
    /* RTL support */
    [dir="rtl"] .nav-links { flex-direction:row-reverse; }
    [dir="rtl"] .lang-dropdown { right:auto; left:0; }
  </style>
  <?php if (isset($extraHead)) echo $extraHead; ?>
  <script>
    const t = localStorage.getItem('theme');
    if (t) document.documentElement.setAttribute('data-theme', t);
    window.SITE_URL = '<?= SITE_URL ?>';
  </script>
</head>
<body>

<!-- Page Loader -->
<div id="page-loader">
  <div class="loader-inner">
    <div class="loader-logo">CharmVibe</div>
    <div class="loader-bar"></div>
  </div>
</div>

<?php if (isset($showProgress) && $showProgress): ?>
<div id="reading-progress"></div>
<?php endif; ?>

<!-- Navbar -->
<nav class="navbar" role="navigation" aria-label="Main navigation">
  <div class="nav-container">
    <a href="<?= SITE_URL ?>/index.php" class="nav-logo" aria-label="<?= SITE_NAME ?> Home">
      Charm<span>Vibe</span>
    </a>

    <ul class="nav-links" role="list">
      <li><a href="<?= SITE_URL ?>/index.php"><?= t('home') ?></a></li>
      <li><a href="<?= SITE_URL ?>/blog.php"><?= t('blog') ?></a></li>
      <?php foreach (array_slice($categories, 0, 4) as $cat): ?>
      <li><a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?>"><?= htmlspecialchars($cat['name']) ?></a></li>
      <?php endforeach; ?>
      <li><a href="<?= SITE_URL ?>/about.php"><?= t('about') ?></a></li>
      <li><a href="<?= SITE_URL ?>/contact.php"><?= t('contact') ?></a></li>
    </ul>

    <div class="nav-actions">
      <button class="search-btn" aria-label="<?= t('search') ?>">
        <i class="fas fa-magnifying-glass"></i>
      </button>
      <button class="theme-btn" aria-label="Toggle dark mode">
        <i class="fas fa-moon"></i>
      </button>

      <!-- Language Switcher -->
      <div class="lang-switcher" id="langSwitcher">
        <button class="lang-btn" id="langBtn" aria-label="<?= t('select_language') ?>">
          <span class="lang-flag"><?= $GLOBALS['languages'][$currentLang]['flag'] ?></span>
          <span><?= strtoupper($currentLang) ?></span>
          <i class="fas fa-chevron-down" style="font-size:.65rem"></i>
        </button>
        <div class="lang-dropdown" id="langDropdown">
          <?php
          $baseUrl = strtok($_SERVER['REQUEST_URI'], '?');
          $params  = $_GET;
          foreach ($GLOBALS['languages'] as $code => $info):
            $params['lang'] = $code;
            $url = $baseUrl . '?' . http_build_query($params);
          ?>
          <a href="<?= htmlspecialchars($url) ?>" class="lang-option <?= $code === $currentLang ? 'active' : '' ?>">
            <span class="flag"><?= $info['flag'] ?></span>
            <span><?= $info['name'] ?></span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <button class="hamburger" aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<!-- Mobile Nav -->
<div class="mobile-nav" aria-hidden="true">
  <a href="<?= SITE_URL ?>/index.php"><?= t('home') ?></a>
  <a href="<?= SITE_URL ?>/blog.php"><?= t('blog') ?></a>
  <?php foreach ($categories as $cat): ?>
  <a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?>"><?= htmlspecialchars($cat['name']) ?></a>
  <?php endforeach; ?>
  <a href="<?= SITE_URL ?>/about.php"><?= t('about') ?></a>
  <a href="<?= SITE_URL ?>/contact.php"><?= t('contact') ?></a>
  <!-- Mobile Language -->
  <div style="padding:12px 20px;border-top:1px solid var(--border);margin-top:8px">
    <div style="font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:10px"><?= t('select_language') ?></div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:6px">
      <?php foreach ($GLOBALS['languages'] as $code => $info):
        $params['lang'] = $code;
        $url = $baseUrl . '?' . http_build_query($params);
      ?>
      <a href="<?= htmlspecialchars($url) ?>"
         style="display:flex;align-items:center;gap:6px;padding:7px 10px;border-radius:8px;font-size:.75rem;border:1px solid var(--border);<?= $code===$currentLang?'border-color:var(--accent);color:var(--accent);background:var(--accent-light)':'' ?>">
        <span><?= $info['flag'] ?></span><span><?= $info['name'] ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- Search Overlay -->
<div class="search-overlay" role="dialog" aria-label="<?= t('search') ?>">
  <div style="width:90%;max-width:600px">
    <div class="search-box">
      <i class="fas fa-magnifying-glass" style="color:var(--text-muted);padding-left:8px"></i>
      <input type="text" placeholder="<?= t('search_placeholder') ?>" aria-label="<?= t('search_placeholder') ?>">
      <button class="search-close" aria-label="Close search"><i class="fas fa-times"></i></button>
    </div>
    <div class="search-results"></div>
  </div>
</div>

<!-- Ad Banner -->
<div class="container">
  <div class="ad-placeholder ad-banner" style="margin-top:16px">
    <i class="fas fa-rectangle-ad"></i>
    <span><?= t('advertisement') ?></span>
  </div>
</div>

<script>
// Language switcher toggle
const ls = document.getElementById('langSwitcher');
const lb = document.getElementById('langBtn');
lb?.addEventListener('click', e => { e.stopPropagation(); ls.classList.toggle('open'); });
document.addEventListener('click', () => ls?.classList.remove('open'));
</script>
