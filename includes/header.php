<?php
/**
 * Global Header Partial
 * Usage: require_once __DIR__ . '/header.php';
 * Variables: $pageTitle, $metaDesc, $metaKeywords
 */

if (!defined('INCLUDED')) define('INCLUDED', true);
session_start();
require_once __DIR__ . '/functions.php';

$pageTitle  = $pageTitle  ?? SITE_NAME . ' — ' . SITE_TAGLINE;
$metaDesc   = $metaDesc   ?? 'Engaging stories across Love, Horror, Mystery, Psychology, Technology and Make Money Online.';
$metaKeywords = $metaKeywords ?? 'blog, love, horror, mystery, psychology, technology, make money online';
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
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
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Styles -->
  <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
  <?php if (isset($extraHead)) echo $extraHead; ?>
  <script>
    // Apply saved theme before paint to avoid flash
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

<!-- Reading Progress -->
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
      <li><a href="<?= SITE_URL ?>/index.php">Home</a></li>
      <li><a href="<?= SITE_URL ?>/blog.php">Blog</a></li>
      <?php foreach (array_slice($categories, 0, 4) as $cat): ?>
      <li><a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?>"><?= htmlspecialchars($cat['name']) ?></a></li>
      <?php endforeach; ?>
      <li><a href="<?= SITE_URL ?>/about.php">About</a></li>
      <li><a href="<?= SITE_URL ?>/contact.php">Contact</a></li>
    </ul>

    <div class="nav-actions">
      <button class="search-btn" aria-label="Search">
        <i class="fas fa-magnifying-glass"></i>
      </button>
      <button class="theme-btn" aria-label="Toggle dark mode">
        <i class="fas fa-moon"></i>
      </button>
      <button class="hamburger" aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<!-- Mobile Nav -->
<div class="mobile-nav" aria-hidden="true">
  <a href="<?= SITE_URL ?>/index.php">Home</a>
  <a href="<?= SITE_URL ?>/blog.php">Blog</a>
  <?php foreach ($categories as $cat): ?>
  <a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?>"><?= htmlspecialchars($cat['name']) ?></a>
  <?php endforeach; ?>
  <a href="<?= SITE_URL ?>/about.php">About</a>
  <a href="<?= SITE_URL ?>/contact.php">Contact</a>
</div>

<!-- Search Overlay -->
<div class="search-overlay" role="dialog" aria-label="Search">
  <div style="width:90%;max-width:600px">
    <div class="search-box">
      <i class="fas fa-magnifying-glass" style="color:var(--text-muted);padding-left:8px"></i>
      <input type="text" placeholder="Search articles…" aria-label="Search articles">
      <button class="search-close" aria-label="Close search"><i class="fas fa-times"></i></button>
    </div>
    <div class="search-results"></div>
  </div>
</div>

<!-- AdSense Top Banner -->
<div class="container">
  <div class="ad-placeholder ad-banner" style="margin-top:16px">
    <i class="fas fa-rectangle-ad"></i>
    <span>Advertisement</span>
    <!-- Google AdSense: Top Banner 728×90 -->
  </div>
</div>