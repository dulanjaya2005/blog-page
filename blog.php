<?php
/**
 * Blog Listing Page — blog.php
 */

require_once __DIR__ . '/includes/functions.php';

$perPage    = 9;
$page       = max(1, (int)($_GET['page'] ?? 1));
$offset     = ($page - 1) * $perPage;
$search     = sanitize($_GET['search'] ?? '');
$catSlug    = sanitize($_GET['cat']    ?? '');

if ($search) {
  $posts    = searchPosts($search, $perPage);
  $total    = count($posts);
} elseif ($catSlug) {
  $cat      = getCategoryBySlug($catSlug);
  $catId    = $cat ? $cat['id'] : null;
  $posts    = $catId ? getPosts($perPage, $offset, $catId) : [];
  $total    = $catId ? countPosts($catId) : 0;
} else {
  $posts    = getPosts($perPage, $offset);
  $total    = countPosts();
}

$totalPages   = (int) ceil($total / $perPage);
$categories   = getCategories();
$trending     = getTrendingPosts(5);

$pageTitle  = 'All Articles — ' . SITE_NAME;
$metaDesc   = 'Browse all articles across Love, Horror, Mystery, Psychology, Technology and Make Money Online.';

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

<!-- Page Hero -->
<div class="page-hero">
  <div class="container">
    <h1 class="page-hero-title">
      <?php if ($search): ?>
        Search: <span class="text-accent"><?= htmlspecialchars($search) ?></span>
      <?php elseif ($catSlug && isset($cat)): ?>
        <?= htmlspecialchars($cat['name']) ?> Articles
      <?php else: ?>
        All Articles
      <?php endif; ?>
    </h1>
    <div class="breadcrumb">
      <a href="<?= SITE_URL ?>">Home</a>
      <span class="breadcrumb-sep">›</span>
      <span>Blog</span>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="content-layout">

      <!-- Main Content -->
      <div>
        <!-- Controls -->
        <div class="blog-controls">
          <!-- Category Filters -->
          <div class="filter-buttons">
            <button class="filter-btn <?= !$catSlug ? 'active' : '' ?>" data-cat="all"
              onclick="window.location='<?= SITE_URL ?>/blog.php'">All</button>
            <?php foreach ($categories as $c): ?>
            <button class="filter-btn <?= $catSlug === $c['slug'] ? 'active' : '' ?>"
              data-cat="<?= htmlspecialchars($c['slug']) ?>"
              onclick="window.location='<?= SITE_URL ?>/blog.php?cat=<?= urlencode($c['slug']) ?>'">
              <i class="fas <?= htmlspecialchars($c['icon']) ?>"></i>
              <?= htmlspecialchars($c['name']) ?>
            </button>
            <?php endforeach; ?>
          </div>

          <!-- View Toggle -->
          <div class="view-toggle">
            <button class="view-btn active" data-view="grid" aria-label="Grid view">
              <i class="fas fa-grid-2"></i>
            </button>
            <button class="view-btn" data-view="list" aria-label="List view">
              <i class="fas fa-list"></i>
            </button>
          </div>
        </div>

        <!-- Search bar on blog page -->
        <form method="GET" action="<?= SITE_URL ?>/blog.php" style="margin-bottom:28px">
          <div style="display:flex;gap:8px">
            <div class="form-control" style="padding:0;display:flex;align-items:center;gap:8px;flex:1">
              <i class="fas fa-magnifying-glass" style="color:var(--text-muted);padding-left:14px"></i>
              <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                placeholder="Search articles…"
                style="border:none;background:none;flex:1;padding:12px 14px 12px 0;font-family:var(--font-body);font-size:.9rem;color:var(--text-primary);outline:none">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </form>

        <!-- Results count -->
        <?php if ($search || $catSlug): ?>
        <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:24px">
          <?= $total ?> article<?= $total !== 1 ? 's' : '' ?> found
        </p>
        <?php endif; ?>

        <!-- Posts Grid -->
        <?php if (empty($posts)): ?>
        <div class="empty-state">
          <i class="fas fa-newspaper"></i>
          <h3>No articles found</h3>
          <p><?= $search ? "Try a different search term." : "No posts in this category yet." ?></p>
          <a href="<?= SITE_URL ?>/blog.php" class="btn btn-outline" style="margin-top:16px">Browse All</a>
        </div>
        <?php else: ?>

        <div class="posts-grid">
          <?php foreach ($posts as $i => $post): ?>
          <article class="post-card post-card-wrap"
                   data-cat="<?= htmlspecialchars($post['category_name'] ?? '') ?>"
                   itemscope itemtype="https://schema.org/BlogPosting">
            <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>" class="card-image">
              <img src="<?= $cardImages[$i % count($cardImages)] ?>"
                   alt="<?= htmlspecialchars($post['title']) ?>"
                   loading="lazy" width="600" height="375">
              <span class="card-badge">
                <i class="fas <?= htmlspecialchars($post['category_icon'] ?? 'fa-tag') ?>"></i>
                <?= htmlspecialchars($post['category_name'] ?? '') ?>
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

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <div class="pagination" role="navigation" aria-label="Page navigation">
          <?php if ($page > 1): ?>
          <a href="?page=<?= $page-1 ?><?= $catSlug ? '&cat='.$catSlug : '' ?>" class="page-btn" aria-label="Previous">
            <i class="fas fa-chevron-left"></i>
          </a>
          <?php endif; ?>

          <?php for ($p = max(1, $page-2); $p <= min($totalPages, $page+2); $p++): ?>
          <a href="?page=<?= $p ?><?= $catSlug ? '&cat='.$catSlug : '' ?>"
             class="page-btn <?= $p === $page ? 'active' : '' ?>"
             aria-current="<?= $p === $page ? 'page' : 'false' ?>">
            <?= $p ?>
          </a>
          <?php endfor; ?>

          <?php if ($page < $totalPages): ?>
          <a href="?page=<?= $page+1 ?><?= $catSlug ? '&cat='.$catSlug : '' ?>" class="page-btn" aria-label="Next">
            <i class="fas fa-chevron-right"></i>
          </a>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
      </div>

      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="sidebar-widget">
          <h3 class="widget-title"><i class="fas fa-fire" style="color:var(--accent)"></i> Trending</h3>
          <?php foreach ($trending as $i => $t): ?>
          <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($t['slug']) ?>" class="trending-item">
            <span class="trending-num"><?= str_pad($i+1,2,'0',STR_PAD_LEFT) ?></span>
            <img src="<?= $cardImages[$i % count($cardImages)] ?>"
                 class="trending-thumb" alt="<?= htmlspecialchars($t['title']) ?>" loading="lazy">
            <div class="trending-info">
              <div class="trending-title"><?= htmlspecialchars($t['title']) ?></div>
              <div class="trending-meta"><i class="far fa-clock"></i> <?= readingTime($t['content']) ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>

        <div class="sidebar-widget" style="padding:0">
          <div class="ad-placeholder ad-sidebar">
            <i class="fas fa-rectangle-ad"></i><span>Advertisement</span>
          </div>
        </div>
      </aside>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>