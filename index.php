<?php
/**
 * Home Page — index.php
 */

require_once __DIR__ . '/includes/functions.php';

$pageTitle = SITE_NAME . ' — ' . SITE_TAGLINE;
$metaDesc  = 'Stories that move you. Engaging articles on Love, Horror, Mystery, Psychology, Technology and Making Money Online.';

require_once __DIR__ . '/includes/header.php';

$featuredPosts = getPosts(5);
$latestPosts   = getPosts(6);
$trendingPosts = getTrendingPosts(5);
$categories    = getCategories();

$heroImages = [
  'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=1400&q=80',
  'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=1400&q=80',
  'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1400&q=80',
  'https://images.unsplash.com/photo-1474631245212-32dc3c8310c6?w=1400&q=80',
  'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=1400&q=80',
];
$cardImages = [
  'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=600&q=80',
  'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=600&q=80',
  'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&q=80',
  'https://images.unsplash.com/photo-1474631245212-32dc3c8310c6?w=600&q=80',
  'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=600&q=80',
  'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&q=80',
];
?>

<!-- ── Hero Slider ──────────────────────────────────────── -->
<section class="hero" aria-label="Featured posts slider">
  <?php foreach ($featuredPosts as $i => $post): ?>
  <div class="hero-slide <?= $i === 0 ? 'active' : '' ?>">
    <img src="<?= $heroImages[$i % count($heroImages)] ?>"
         alt="<?= htmlspecialchars($post['title']) ?>"
         loading="<?= $i === 0 ? 'eager' : 'lazy' ?>">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <div class="hero-badge">
        <i class="fas <?= htmlspecialchars($post['category_icon'] ?? 'fa-star') ?>"></i>
        <?= htmlspecialchars($post['category_name'] ?? 'Featured') ?>
      </div>
      <h1 class="hero-title"><?= htmlspecialchars($post['title']) ?></h1>
      <p class="hero-excerpt"><?= htmlspecialchars(excerpt($post['content'], 20)) ?></p>
      <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>" class="btn btn-primary">
        Read Article <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="hero-controls" aria-label="Slider navigation">
    <?php for ($i = 0; $i < count($featuredPosts); $i++): ?>
    <button class="hero-dot <?= $i === 0 ? 'active' : '' ?>" aria-label="Go to slide <?= $i+1 ?>"></button>
    <?php endfor; ?>
  </div>
</section>

<!-- ── Latest Posts + Sidebar ──────────────────────────── -->
<section class="section">
  <div class="container">
    <div class="content-layout">

      <!-- Posts -->
      <div>
        <div class="section-header">
          <h2 class="section-title">Latest Stories</h2>
          <a href="<?= SITE_URL ?>/blog.php" class="section-link">View all <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="posts-grid">
          <?php foreach ($latestPosts as $i => $post): ?>
          <article class="post-card" itemscope itemtype="https://schema.org/BlogPosting">
            <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>" class="card-image">
              <img src="<?= $cardImages[$i % count($cardImages)] ?>"
                   alt="<?= htmlspecialchars($post['title']) ?>"
                   loading="lazy" width="600" height="375"
                   itemprop="image">
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
              <h3 class="card-title" itemprop="headline">
                <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($post['slug']) ?>">
                  <?= htmlspecialchars($post['title']) ?>
                </a>
              </h3>
              <p class="card-excerpt" itemprop="description"><?= htmlspecialchars(excerpt($post['content'], 25)) ?></p>
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
      </div>

      <!-- Sidebar -->
      <aside class="sidebar">
        <!-- Trending -->
        <div class="sidebar-widget">
          <h3 class="widget-title"><i class="fas fa-fire" style="color:var(--accent)"></i> Trending Now</h3>
          <?php foreach ($trendingPosts as $i => $t): ?>
          <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($t['slug']) ?>" class="trending-item">
            <span class="trending-num"><?= str_pad($i+1, 2, '0', STR_PAD_LEFT) ?></span>
            <img src="<?= $cardImages[$i % count($cardImages)] ?>"
                 class="trending-thumb" alt="<?= htmlspecialchars($t['title']) ?>" loading="lazy">
            <div class="trending-info">
              <div class="trending-title"><?= htmlspecialchars($t['title']) ?></div>
              <div class="trending-meta">
                <i class="far fa-clock"></i> <?= readingTime($t['content']) ?>
              </div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>

        <!-- AdSense Sidebar -->
        <div class="sidebar-widget" style="padding:0">
          <div class="ad-placeholder ad-sidebar">
            <i class="fas fa-rectangle-ad"></i>
            <span>Advertisement</span>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="sidebar-widget">
          <h3 class="widget-title"><i class="fas fa-layer-group" style="color:var(--accent)"></i> Categories</h3>
          <?php foreach ($categories as $cat): ?>
          <a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?>"
             style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--border);text-decoration:none;transition:color .2s ease"
             onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color=''">
            <span style="display:flex;align-items:center;gap:10px;font-size:.875rem;font-weight:500">
              <i class="fas <?= htmlspecialchars($cat['icon']) ?>" style="color:var(--accent);width:18px"></i>
              <?= htmlspecialchars($cat['name']) ?>
            </span>
            <span style="font-size:.78rem;color:var(--text-muted);background:var(--bg-secondary);padding:2px 8px;border-radius:99px">
              <?= $cat['post_count'] ?>
            </span>
          </a>
          <?php endforeach; ?>
        </div>
      </aside>

    </div>
  </div>
</section>

<!-- ── Categories Section ───────────────────────────────── -->
<section class="section-sm" style="background:var(--bg-secondary)">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Browse by Category</h2>
      <a href="<?= SITE_URL ?>/blog.php" class="section-link">See all <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="categories-grid">
      <?php foreach ($categories as $cat): ?>
      <a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?>" class="category-card">
        <div class="cat-icon">
          <i class="fas <?= htmlspecialchars($cat['icon']) ?>"></i>
        </div>
        <div class="cat-name"><?= htmlspecialchars($cat['name']) ?></div>
        <div class="cat-count"><?= $cat['post_count'] ?> articles</div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ── Newsletter ───────────────────────────────────────── -->
<section class="section">
  <div class="container">
    <div class="newsletter-section">
      <h2 class="newsletter-title">Stories Worth Subscribing To</h2>
      <p class="newsletter-subtitle">Join 12,000+ readers who get our best articles delivered every week.</p>
      <form class="newsletter-form" novalidate>
        <input type="email" class="newsletter-input" placeholder="Enter your email address" required>
        <button type="submit" class="btn btn-white">
          <i class="fas fa-paper-plane"></i> Subscribe
        </button>
      </form>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>