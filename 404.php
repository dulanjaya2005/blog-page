<?php
/**
 * 404 Not Found Page
 */
require_once __DIR__ . '/includes/functions.php';
$pageTitle = '404 — Page Not Found | ' . SITE_NAME;
$metaDesc  = 'The page you are looking for could not be found.';
http_response_code(404);
require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="min-height:60vh;display:flex;align-items:center">
  <div class="container" style="text-align:center">
    <div style="font-family:var(--font-display);font-size:8rem;font-weight:900;color:var(--accent);line-height:1;margin-bottom:16px">404</div>
    <h1 style="font-family:var(--font-display);font-size:2rem;font-weight:700;margin-bottom:16px">Page Not Found</h1>
    <p style="color:var(--text-muted);max-width:480px;margin:0 auto 32px;line-height:1.7">
      The page you're looking for doesn't exist or has been moved. Let's get you back on track.
    </p>
    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?= SITE_URL ?>/index.php" class="btn btn-primary"><i class="fas fa-home"></i> Go Home</a>
      <a href="<?= SITE_URL ?>/blog.php" class="btn btn-outline"><i class="fas fa-newspaper"></i> Browse Articles</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
