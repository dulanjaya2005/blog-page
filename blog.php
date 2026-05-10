<?php
/**
 * Blog Listing Page — blog.php (with translation)
 */

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/translator.php';

$perPage  = 9;
$page     = max(1, (int)($_GET['page'] ?? 1));
$offset   = ($page - 1) * $perPage;
$search   = sanitize($_GET['search'] ?? '');
$catSlug  = sanitize($_GET['cat']    ?? '');
$currentLang = getCurrentLang();

if ($search) {
    $posts = searchPosts($search, $perPage);
    $total = count($posts);
} elseif ($catSlug) {
    $cat   = getCategoryBySlug($catSlug);
    $catId = $cat ? $cat['id'] : null;
    $posts = $catId ? getPosts($perPage, $offset, $catId) : [];
    $total = $catId ? countPosts($catId) : 0;
} else {
    $posts = getPosts($perPage, $offset);
    $total = countPosts();
}

$totalPages = (int)ceil($total / $perPage);
$categories = getCategories();
$trending   = getTrendingPosts(5);

$pageTitle = t('blog') . ' — ' . SITE_NAME;
$metaDesc  = 'Browse all articles across Love, Horror, Mystery, Psychology, Technology and Make Money Online.';

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
    <h1 class="page-hero-title">
      <?php if ($search): ?>
        <?= t('search') ?>: <span class="text-accent"><?= htmlspecialchars($search) ?></span>
      <?php elseif ($catSlug && isset($cat)): ?>
        <?= htmlspecialchars($cat['name']) ?>
      <?php else: ?>
        <?= t('all_articles') ?>
      <?php endif; ?>
    </h1>
    <div class="breadcrumb">
      <a href="<?= SITE_URL ?>"><?= t('home') ?></a>
      <span class="breadcrumb-sep">›</span>
      <span><?= t('blog') ?></span>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="content-layout">
      <div>
        <!-- Controls -->
        <div class="blog-controls">
          <div class="filter-buttons">
            <button class="filter-btn <?= !$catSlug ? 'active' : '' ?>"
              onclick="window.location='<?= SITE_URL ?>/blog.php?lang=<?= $currentLang ?>'">
              <?= t('all') ?>
            </button>
            <?php foreach ($categories as $c): ?>
            <button class="filter-btn <?= $catSlug === $c['slug'] ? 'active' : '' ?>"
              onclick="window.location='<?= SITE_URL ?>/blog.php?cat=<?= urlencode($c['slug']) ?>&lang=<?= $currentLang ?>'">
              <i class="fas <?= htmlspecialchars($c['icon']) ?>"></i>
              <?= htmlspecialchars($c['name']) ?>
            </button>
            <?php endforeach; ?>
          </div>
          <div class="view-toggle">
            <button class="view-btn active" data-view="grid"><i class="fas fa-grid-2"></i></button>
            <button class="view-btn" data-view="list"><i class="fas fa-list"></i></button>
          </div>
        </div>

        <!-- Search -->
        <form method="GET" action="<?= SITE_URL ?>/blog.php" style="margin-bottom:28px">
          <input type="hidden" name="lang" value="<?= $currentLang ?>">
          <div style="display:flex;gap:8px">
            <div class="form-control" style="padding:0;display:flex;align-items:center;gap:8px;flex:1">
              <i class="fas fa-magnifying-glass" style="color:var(--text-muted);padding-left:14px"></i>
              <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                placeholder="<?= t('search_placeholder') ?>"
                style="border:none;background:none;flex:1;padding:12px 14px 12px 0;font-family:var(--font-body);font-size:.9rem;color:var(--text-primary);outline:none">
            </div>
            <button type="submit" class="btn btn-primary"><?= t('search') ?></button>
          </div>
        </form>

        <?php if ($search || $catSlug): ?>
        <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:24px">
          <?= $total ?> <?= t('articles') ?> <?= t('found') ?>
        </p>
        <?php endif; ?>

        <?php if (empty($posts)): ?>
        <div class="empty-state">
          <i class="fas fa-newspaper"></i>
          <h3><?= t('no_articles_found') ?></h3>
          <p><?= $search ? t('try_different_search') : t('no_posts_category') ?></p>
          <a href="<?= SITE_URL ?>/blog.php?lang=<?= $currentLang ?>" class="btn btn-outline" style="margin-top:16px"><?= t('browse_all') ?></a>
        </div>
        <?php else: ?>

        <div class="posts-grid">
          <?php foreach ($posts as $i => $post): ?>
          <?php
          $displayTitle = $currentLang !== 'en'
              ? translateText($post['title'], $currentLang)
              : $post['title'];
          $displayExcerpt = $currentLang !== 'en'
              ? translateText(excerpt($post['content'], 25), $currentLang)
              : excerpt($post['content'], 25);
          ?>
          <article class="post-card post-card-wrap"
                   data-cat="<?= htmlspecialchars($post['category_name'] ?? '') ?>"
                   itemscope itemtype="https://schema.org/BlogPosting">
            <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>&lang=<?= $currentLang ?>" class="card-image">
              <img src="<?= postImage($post['image'] ?? null, $post['title'], $i) ?>"
                   alt="<?= htmlspecialchars($displayTitle) ?>"
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
                <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>&lang=<?= $currentLang ?>">
                  <?= htmlspecialchars($displayTitle) ?>
                </a>
              </h2>
              <p class="card-excerpt"><?= htmlspecialchars($displayExcerpt) ?></p>
              <div class="card-footer">
                <span style="font-size:.8rem;color:var(--text-muted)">
                  <i class="fas fa-user-pen" style="color:var(--accent)"></i>
                  <?= htmlspecialchars($post['author']) ?>
                </span>
                <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>&lang=<?= $currentLang ?>" class="read-more">
                  <?= t('read_more') ?> <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <div class="pagination">
          <?php if ($page > 1): ?>
          <a href="?page=<?= $page-1 ?><?= $catSlug?'&cat='.$catSlug:'' ?>&lang=<?= $currentLang ?>" class="page-btn"><i class="fas fa-chevron-left"></i></a>
          <?php endif; ?>
          <?php for ($p = max(1,$page-2); $p <= min($totalPages,$page+2); $p++): ?>
          <a href="?page=<?= $p ?><?= $catSlug?'&cat='.$catSlug:'' ?>&lang=<?= $currentLang ?>"
             class="page-btn <?= $p===$page?'active':'' ?>"><?= $p ?></a>
          <?php endfor; ?>
          <?php if ($page < $totalPages): ?>
          <a href="?page=<?= $page+1 ?><?= $catSlug?'&cat='.$catSlug:'' ?>&lang=<?= $currentLang ?>" class="page-btn"><i class="fas fa-chevron-right"></i></a>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
      </div>

      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="sidebar-widget">
          <h3 class="widget-title"><i class="fas fa-fire" style="color:var(--accent)"></i> <?= t('trending_now') ?></h3>
          <?php foreach ($trending as $i => $tr): ?>
          <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($tr['slug']) ?>&lang=<?= $currentLang ?>" class="trending-item">
            <span class="trending-num"><?= str_pad($i+1,2,'0',STR_PAD_LEFT) ?></span>
            <img src="<?= postImage($tr['image'] ?? null, $tr['title'], $i) ?>"
                 class="trending-thumb" alt="<?= htmlspecialchars($tr['title']) ?>" loading="lazy">
            <div class="trending-info">
              <div class="trending-title">
                <?= htmlspecialchars($currentLang !== 'en' ? translateText($tr['title'], $currentLang) : $tr['title']) ?>
              </div>
              <div class="trending-meta"><i class="far fa-clock"></i> <?= readingTime($tr['content']) ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>

        <div class="sidebar-widget" style="padding:0">
          <div class="ad-placeholder ad-sidebar">
            <i class="fas fa-rectangle-ad"></i><span><?= t('advertisement') ?></span>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
