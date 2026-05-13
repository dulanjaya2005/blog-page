<?php
/**
 * Category Page — category.php
 */

require_once __DIR__ . '/includes/functions.php';

$slug    = sanitize($_GET['slug'] ?? '');
$perPage = 9;
$page    = max(1, (int)($_GET['page'] ?? 1));
$offset  = ($page - 1) * $perPage;

if (!$slug) { header('Location: ' . SITE_URL . '/blog.php'); exit; }

$cat = getCategoryBySlug($slug);
if (!$cat) { header('HTTP/1.0 404 Not Found'); include __DIR__ . '/404.php'; exit; }

// ── Save category data before header.php overwrites $categories ──
$catId      = (int)$cat['id'];
$catName    = $cat['name'];
$catIcon    = $cat['icon'];
$catSlug    = $cat['slug'];

$posts      = getPosts($perPage, $offset, $catId);
$total      = countPosts($catId);
$totalPages = (int) ceil($total / $perPage);

$pageTitle = htmlspecialchars($catName) . ' Articles — ' . SITE_NAME;
$metaDesc  = 'Browse all ' . $catName . ' articles on ' . SITE_NAME . '. Engaging stories and deep dives.';

$cardImages = [
  'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=600&q=80',
  'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=600&q=80',
  'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&q=80',
  'https://images.unsplash.com/photo-1474631245212-32dc3c8310c6?w=600&q=80',
  'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=600&q=80',
  'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&q=80',
];

require_once __DIR__ . '/includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:12px">
      <div style="width:52px;height:52px;border-radius:50%;background:var(--accent-light);display:flex;align-items:center;justify-content:center">
        <i class="fas <?= htmlspecialchars($catIcon) ?>" style="font-size:1.3rem;color:var(--accent)"></i>
      </div>
      <h1 class="page-hero-title" style="margin:0"><?= htmlspecialchars($catName) ?></h1>
    </div>
    <div class="breadcrumb">
      <a href="<?= SITE_URL ?>">Home</a>
      <span class="breadcrumb-sep">›</span>
      <a href="<?= SITE_URL ?>/blog.php">Blog</a>
      <span class="breadcrumb-sep">›</span>
      <span><?= htmlspecialchars($catName) ?></span>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <?php if (empty($posts)): ?>
    <div class="empty-state">
      <i class="fas <?= htmlspecialchars($catIcon) ?>"></i>
      <h3>No articles yet</h3>
      <p>We haven't published anything in <strong><?= htmlspecialchars($catName) ?></strong> yet. Check back soon!</p>
      <a href="<?= SITE_URL ?>/blog.php" class="btn btn-outline" style="margin-top:16px">Browse All Articles</a>
    </div>
    <?php else: ?>

    <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:28px"><?= $total ?> article<?= $total !== 1 ? 's' : '' ?> in this category</p>

    <div class="posts-grid">
      <?php foreach ($posts as $i => $post): ?>
      <article class="post-card" itemscope itemtype="https://schema.org/BlogPosting">
        <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>" class="card-image">
          <img src="<?= postImage($post['image'] ?? null, $post['title'], $i) ?>"
               alt="<?= htmlspecialchars($post['title']) ?>"
               loading="lazy" width="600" height="375">
          <span class="card-badge">
            <i class="fas <?= htmlspecialchars($catIcon) ?>"></i>
            <?= htmlspecialchars($catName) ?>
          </span>
        </a>
        <div class="card-body">
          <div class="card-meta">
            <span><i class="far fa-calendar"></i> <?= formatDate($post['created_at']) ?></span>
            <span><i class="far fa-clock"></i> <?= readingTime($post['content']) ?></span>
          </div>
          <h2 class="card-title" itemprop="headline">
            <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>">
              <?= htmlspecialchars($post['title']) ?>
            </a>
          </h2>
          <p class="card-excerpt"><?= htmlspecialchars(excerpt($post['content'], 25)) ?></p>
          <div class="card-footer">
            <span style="font-size:.8rem;color:var(--text-muted)">
              <i class="fas fa-user-pen" style="color:var(--accent)"></i>
              <?= htmlspecialchars($post['author']) ?>
            </span>
            <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>" class="read-more">
              Read more <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <?php if ($totalPages > 1): ?>
    <div class="pagination" role="navigation" aria-label="Page navigation">
      <?php if ($page > 1): ?>
      <a href="?slug=<?= $slug ?>&page=<?= $page-1 ?>" class="page-btn"><i class="fas fa-chevron-left"></i></a>
      <?php endif; ?>
      <?php for ($p = max(1,$page-2); $p <= min($totalPages,$page+2); $p++): ?>
      <a href="?slug=<?= $slug ?>&page=<?= $p ?>" class="page-btn <?= $p===$page?'active':'' ?>"><?= $p ?></a>
      <?php endfor; ?>
      <?php if ($page < $totalPages): ?>
      <a href="?slug=<?= $slug ?>&page=<?= $page+1 ?>" class="page-btn"><i class="fas fa-chevron-right"></i></a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>