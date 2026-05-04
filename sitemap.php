<?php
/**
 * Dynamic Sitemap — sitemap.xml
 */
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/xml; charset=UTF-8');
$posts      = getPosts(1000);
$categories = getCategories();
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc><?= SITE_URL ?>/</loc><changefreq>daily</changefreq><priority>1.0</priority></url>
  <url><loc><?= SITE_URL ?>/blog.php</loc><changefreq>daily</changefreq><priority>0.9</priority></url>
  <url><loc><?= SITE_URL ?>/about.php</loc><changefreq>monthly</changefreq><priority>0.5</priority></url>
  <url><loc><?= SITE_URL ?>/contact.php</loc><changefreq>monthly</changefreq><priority>0.4</priority></url>
  <?php foreach ($categories as $cat): ?>
  <url><loc><?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?></loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
  <?php endforeach; ?>
  <?php foreach ($posts as $post): ?>
  <url>
    <loc><?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?></loc>
    <lastmod><?= date('Y-m-d', strtotime($post['updated_at'])) ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach; ?>
</urlset>
