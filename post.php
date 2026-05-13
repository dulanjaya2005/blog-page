<?php
/**
 * Single Post Page — post.php
 */

require_once __DIR__ . '/includes/functions.php';

$slug = sanitize($_GET['slug'] ?? '');
if (!$slug) { header('Location: ' . SITE_URL . '/blog.php'); exit; }

$post = getPostBySlug($slug);
if (!$post) { header('HTTP/1.0 404 Not Found'); include '404.php'; exit; }

$comments     = getApprovedComments($post['id']);
$relatedPosts = getRelatedPosts($post['id'], $post['category_id']);

$showProgress = true;
$pageTitle    = htmlspecialchars($post['title']) . ' — ' . SITE_NAME;
$metaDesc     = htmlspecialchars(excerpt($post['content'], 30));

// JSON-LD Schema
$schema = json_encode([
  '@context'      => 'https://schema.org',
  '@type'         => 'BlogPosting',
  'headline'      => $post['title'],
  'description'   => excerpt($post['content'], 30),
  'author'        => ['@type' => 'Person', 'name' => $post['author']],
  'datePublished' => $post['created_at'],
  'dateModified'  => $post['updated_at'],
  'publisher'     => ['@type' => 'Organization', 'name' => SITE_NAME],
]);
$extraHead = "<script type=\"application/ld+json\">{$schema}</script>";

$heroImg = postImage($post['image'] ?? null, $post['title']);
$relatedImages = [
  'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=400&q=80',
  'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=400&q=80',
  'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&q=80',
];

// Handle comment submission
$commentMsg   = '';
$commentError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
  global $pdo;
  $name    = sanitize($_POST['name']    ?? '');
  $email   = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL) ? $_POST['email'] : '';
  $comment = sanitize($_POST['comment'] ?? '');

  if ($name && $comment && strlen($comment) >= 10) {
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, name, email, comment, status) VALUES (?,?,?,?,'pending')");
    $stmt->execute([$post['id'], $name, $email, $comment]);
    $commentMsg = 'Thank you! Your comment is awaiting moderation.';
  } else {
    $commentError = 'Please fill in your name and a comment (min 10 characters).';
  }
}

require_once __DIR__ . '/includes/header.php';
?>

<!-- Post Hero -->
<div class="post-hero" style="position:relative;width:100%;max-height:500px;overflow:hidden;background:#000">
  <img src="<?= $heroImg ?>"
       alt="<?= htmlspecialchars($post['title']) ?>"
       loading="eager"
       style="width:100%;height:500px;object-fit:cover;object-position:center;display:block">
  <div class="post-hero-overlay"></div>
</div>

<section class="section" style="padding-top:0">
  <div class="container">
    <div class="content-layout">

      <!-- Article -->
      <article itemscope itemtype="https://schema.org/BlogPosting">

        <!-- Post Header -->
        <div class="post-header">
          <a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode(generateSlug($post['category_name'] ?? '')) ?>"
             class="post-category-badge">
            <i class="fas <?= htmlspecialchars($post['category_icon'] ?? 'fa-tag') ?>"></i>
            <?= htmlspecialchars($post['category_name'] ?? '') ?>
          </a>
          <h1 class="post-title" itemprop="headline"><?= htmlspecialchars($post['title']) ?></h1>
          <div class="post-meta">
            <span><i class="fas fa-user-pen"></i> <?= htmlspecialchars($post['author']) ?></span>
            <span><i class="far fa-calendar"></i> <time itemprop="datePublished" datetime="<?= $post['created_at'] ?>"><?= formatDate($post['created_at']) ?></time></span>
            <span><i class="far fa-clock"></i> <?= readingTime($post['content']) ?></span>
            <span><i class="fas fa-comments"></i> <?= count($comments) ?> comments</span>
          </div>
        </div>

        <!-- AdSense Top -->
        <div class="ad-placeholder ad-banner">
          <i class="fas fa-rectangle-ad"></i><span>Advertisement</span>
        </div>

        <!-- Post Content -->
        <div class="post-content" itemprop="articleBody">
          <?php
          // Split content after 3rd paragraph for mid-article ad
          $paragraphs = preg_split('/(<\/p>)/', $post['content'], -1, PREG_SPLIT_DELIM_CAPTURE);
          $output     = '';
          $pCount     = 0;
          $adInserted = false;
          foreach ($paragraphs as $part) {
            $output .= $part;
            if (str_ends_with(trim($part), '</p>') || $part === '</p>') {
              $pCount++;
            }
            if ($pCount === 3 && !$adInserted) {
              $adInserted = true;
              $output .= '<div class="ad-placeholder ad-in-article"><i class="fas fa-rectangle-ad"></i><span>Advertisement — Article continues below</span></div>';
            }
          }
          echo $output;
          ?>
        </div>

        <!-- Tags -->
        <?php if ($post['tags']): ?>
        <div class="post-tags">
          <i class="fas fa-tags" style="color:var(--accent);margin-right:8px"></i>
          <?php
          $tagList = explode(',', $post['tags']);
          foreach ($tagList as $tag):
            $cleanTag = ltrim(trim($tag), '#');
            $cleanTag = trim(preg_replace('/[^a-zA-Z0-9\s\-_]/u', '', $cleanTag));
            if (!$cleanTag) continue;
          ?>
          <a href="<?= SITE_URL ?>/blog.php?search=<?= urlencode($cleanTag) ?>"
             class="tag"
             style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;
                    background:var(--bg-secondary);border:1px solid var(--border);
                    border-radius:99px;font-size:.8rem;font-weight:600;
                    color:var(--text-muted);text-decoration:none;
                    transition:all .2s ease;margin:3px"
             onmouseover="this.style.background='var(--accent-light)';this.style.color='var(--accent)';this.style.borderColor='var(--accent)'"
             onmouseout="this.style.background='var(--bg-secondary)';this.style.color='var(--text-muted)';this.style.borderColor='var(--border)'">
            <i class="fas fa-hashtag" style="font-size:.65rem"></i><?= htmlspecialchars($cleanTag) ?>
          </a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="divider"></div>

        <!-- Share Buttons -->
        <div class="share-section">
          <p class="share-title"><i class="fas fa-share-nodes"></i> Share this article</p>
          <div class="share-buttons">
            <button class="share-btn share-facebook" data-share="facebook">
              <i class="fab fa-facebook-f"></i> Facebook
            </button>
            <button class="share-btn share-twitter" data-share="twitter">
              <i class="fab fa-x-twitter"></i> Twitter
            </button>
            <button class="share-btn share-whatsapp" data-share="whatsapp">
              <i class="fab fa-whatsapp"></i> WhatsApp
            </button>
          </div>
        </div>

        <!-- Comments -->
        <div class="comments-section">
          <h2 class="comments-title">
            <i class="fas fa-comments" style="color:var(--accent);margin-right:10px"></i>
            <?= count($comments) ?> Comment<?= count($comments) !== 1 ? 's' : '' ?>
          </h2>

          <?php if (empty($comments)): ?>
          <p style="color:var(--text-muted);margin-bottom:32px">Be the first to share your thoughts!</p>
          <?php else: ?>
          <?php foreach ($comments as $c): ?>
          <div class="comment-item" itemscope itemtype="https://schema.org/Comment">
            <div class="comment-avatar"><?= strtoupper(substr($c['name'],0,1)) ?></div>
            <div class="comment-body">
              <div class="comment-header">
                <span class="comment-name" itemprop="author"><?= htmlspecialchars($c['name']) ?></span>
                <span class="comment-date"><?= formatDate($c['created_at']) ?></span>
              </div>
              <p class="comment-text" itemprop="text"><?= nl2br(htmlspecialchars($c['comment'])) ?></p>
            </div>
          </div>
          <?php endforeach; ?>
          <?php endif; ?>

          <!-- Comment Form -->
          <div class="comment-form">
            <h3 class="comment-form-title">Leave a Comment</h3>
            <?php if ($commentMsg): ?>
            <div style="background:var(--accent-light);border:1px solid var(--accent);color:var(--accent);padding:12px 16px;border-radius:var(--radius-sm);margin-bottom:20px;font-size:.875rem">
              <i class="fas fa-check-circle"></i> <?= htmlspecialchars($commentMsg) ?>
            </div>
            <?php endif; ?>
            <?php if ($commentError): ?>
            <div style="background:rgba(209,67,67,0.1);border:1px solid var(--danger);color:var(--danger);padding:12px 16px;border-radius:var(--radius-sm);margin-bottom:20px;font-size:.875rem">
              <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($commentError) ?>
            </div>
            <?php endif; ?>
            <form method="POST" action="<?= SITE_URL ?>/post.php?slug=<?= urlencode($slug) ?>">
              <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="name">Name <span style="color:var(--danger)">*</span></label>
                  <input class="form-control" type="text" id="name" name="name" required maxlength="100" placeholder="Your name">
                </div>
                <div class="form-group">
                  <label class="form-label" for="email">Email <span style="color:var(--text-muted);font-size:.75rem">(optional)</span></label>
                  <input class="form-control" type="email" id="email" name="email" maxlength="120" placeholder="your@email.com">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label" for="comment">Comment <span style="color:var(--danger)">*</span></label>
                <textarea class="form-control" id="comment" name="comment" required minlength="10" rows="5" placeholder="Share your thoughts…"></textarea>
              </div>
              <button type="submit" name="submit_comment" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Post Comment
              </button>
            </form>
          </div>
        </div>

      </article>

      <!-- Sidebar -->
      <aside class="sidebar">
        <!-- Author -->
        <div class="sidebar-widget" style="text-align:center">
          <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.6rem;font-weight:900;color:#fff;margin:0 auto 12px">
            <?= strtoupper(substr($post['author'],0,1)) ?>
          </div>
          <div style="font-weight:700;font-size:1rem;margin-bottom:4px"><?= htmlspecialchars($post['author']) ?></div>
          <div style="font-size:.8rem;color:var(--text-muted)">Contributing Writer</div>
        </div>

        <!-- Ad -->
        <div class="sidebar-widget" style="padding:0">
          <div class="ad-placeholder ad-sidebar">
            <i class="fas fa-rectangle-ad"></i><span>Advertisement</span>
          </div>
        </div>

        <!-- Trending -->
        <div class="sidebar-widget">
          <h3 class="widget-title"><i class="fas fa-fire" style="color:var(--accent)"></i> You May Like</h3>
          <?php foreach (getTrendingPosts(4) as $i => $t): ?>
          <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($t['slug']) ?>" class="trending-item">
            <span class="trending-num"><?= str_pad($i+1,2,'0',STR_PAD_LEFT) ?></span>
            <div class="trending-info">
              <div class="trending-title"><?= htmlspecialchars($t['title']) ?></div>
              <div class="trending-meta"><i class="far fa-clock"></i> <?= readingTime($t['content']) ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </aside>

    </div>

    <!-- Related Posts -->
    <?php if (!empty($relatedPosts)): ?>
    <div style="margin-top:64px">
      <div class="section-header">
        <h2 class="section-title">Related Articles</h2>
        <a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode(generateSlug($post['category_name'] ?? '')) ?>" class="section-link">More in <?= htmlspecialchars($post['category_name'] ?? '') ?> <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="posts-grid posts-grid-3">
        <?php foreach ($relatedPosts as $i => $r): ?>
        <article class="post-card">
          <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($r['slug']) ?>" class="card-image">
            <img src="<?= postImage($r['image'] ?? null, $r['title'], $i) ?>"
                 alt="<?= htmlspecialchars($r['title']) ?>" loading="lazy">
            <span class="card-badge"><?= htmlspecialchars($r['category_name'] ?? '') ?></span>
          </a>
          <div class="card-body">
            <div class="card-meta">
              <span><i class="far fa-calendar"></i> <?= formatDate($r['created_at']) ?></span>
              <span><i class="far fa-clock"></i> <?= readingTime($r['content']) ?></span>
            </div>
            <h3 class="card-title"><a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($r['slug']) ?>"><?= htmlspecialchars($r['title']) ?></a></h3>
            <div class="card-footer">
              <span></span>
              <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($r['slug']) ?>" class="read-more">Read more <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>