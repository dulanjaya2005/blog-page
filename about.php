<?php
/**
 * About Page — about.php
 */

require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'About Us — ' . SITE_NAME;
$metaDesc  = 'Learn about CharmVibe — our story, mission, and the team behind the content.';

require_once __DIR__ . '/includes/header.php';
?>

<!-- About Hero -->
<div class="about-hero">
  <div class="container" style="text-align:center">
    <span style="display:inline-flex;align-items:center;gap:6px;padding:6px 16px;background:var(--accent-light);color:var(--accent);border-radius:99px;font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;margin-bottom:20px">
      <i class="fas fa-star"></i> Our Story
    </span>
    <h1 class="about-hero-title">We Tell Stories That <span>Move</span> You</h1>
    <p style="color:var(--text-secondary);font-size:1.1rem;max-width:580px;margin:20px auto 0;line-height:1.75">
      CharmVibe was born from a simple belief: the world needs more writing that makes you feel something real.
    </p>
  </div>
</div>

<!-- Brand Story -->
<section class="section">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center" class="about-story-grid">
      <div>
        <h2 class="section-title">The CharmVibe Story</h2>
        <div style="height:24px"></div>
        <p style="color:var(--text-secondary);line-height:1.85;margin-bottom:16px">
          CharmVibe started in 2022 as a small newsletter written by a single curious mind who couldn't stop reading about psychology, love, and the strange mysteries of being human. What began as private notes turned into essays. Essays turned into an audience. An audience turned into a community.
        </p>
        <p style="color:var(--text-secondary);line-height:1.85;margin-bottom:16px">
          Today we're a team of writers, researchers, and storytellers united by one goal: creating content that doesn't just inform — it <em>resonates</em>. Content that you share because it perfectly captures something you've always felt but never found the words for.
        </p>
        <p style="color:var(--text-secondary);line-height:1.85">
          We cover love in all its messy complexity, the psychology behind your everyday decisions, the technology reshaping your world, the mysteries that keep you up at night, and the financial strategies that actually move the needle.
        </p>
        <div style="display:flex;gap:32px;margin-top:36px">
          <div>
            <div style="font-family:var(--font-display);font-size:2.5rem;font-weight:900;color:var(--accent)">50K+</div>
            <div style="font-size:.85rem;color:var(--text-muted)">Monthly Readers</div>
          </div>
          <div>
            <div style="font-family:var(--font-display);font-size:2.5rem;font-weight:900;color:var(--accent)">120+</div>
            <div style="font-size:.85rem;color:var(--text-muted)">Articles Published</div>
          </div>
          <div>
            <div style="font-family:var(--font-display);font-size:2.5rem;font-weight:900;color:var(--accent)">6</div>
            <div style="font-size:.85rem;color:var(--text-muted)">Core Categories</div>
          </div>
        </div>
      </div>
      <div style="border-radius:var(--radius-lg);overflow:hidden;height:420px">
        <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=700&q=80"
             alt="Writing at desk" style="width:100%;height:100%;object-fit:cover" loading="lazy">
      </div>
    </div>
  </div>
</section>

<style>
@media(max-width:768px){.about-story-grid{grid-template-columns:1fr!important;gap:32px!important}}
</style>

<!-- Mission & Vision -->
<section class="section-sm" style="background:var(--bg-secondary)">
  <div class="container">
    <h2 class="section-title" style="text-align:center;margin-bottom:40px">Mission &amp; Vision</h2>
    <div class="mission-grid">
      <div class="mission-card">
        <div class="mission-icon"><i class="fas fa-bullseye"></i></div>
        <h3 style="font-family:var(--font-display);font-size:1.3rem;font-weight:700;margin-bottom:12px">Our Mission</h3>
        <p style="color:var(--text-secondary);line-height:1.8">
          To publish thoughtful, well-researched, beautifully written content that helps people understand themselves and the world better. Every article we publish must pass one test: does it make the reader's life richer?
        </p>
      </div>
      <div class="mission-card">
        <div class="mission-icon" style="background:rgba(200,169,110,0.2)"><i class="fas fa-eye"></i></div>
        <h3 style="font-family:var(--font-display);font-size:1.3rem;font-weight:700;margin-bottom:12px">Our Vision</h3>
        <p style="color:var(--text-secondary);line-height:1.8">
          To become the most trusted independent blog for curious, growth-oriented readers worldwide — a place where intellectual curiosity is celebrated and every visit leaves you with something new to think about.
        </p>
      </div>
      <div class="mission-card">
        <div class="mission-icon" style="background:rgba(58,142,100,0.15);color:var(--success)"><i class="fas fa-leaf"></i></div>
        <h3 style="font-family:var(--font-display);font-size:1.3rem;font-weight:700;margin-bottom:12px">Our Values</h3>
        <p style="color:var(--text-secondary);line-height:1.8">
          Honesty over clicks. Depth over virality. Research over opinion. We'd rather publish one great article than ten mediocre ones. Quality is our only non-negotiable.
        </p>
      </div>
      <div class="mission-card">
        <div class="mission-icon" style="background:rgba(74,144,217,0.15);color:#4A90D9"><i class="fas fa-users"></i></div>
        <h3 style="font-family:var(--font-display);font-size:1.3rem;font-weight:700;margin-bottom:12px">Our Community</h3>
        <p style="color:var(--text-secondary);line-height:1.8">
          We write for the curious ones — the people who still read to the end, who question the obvious, who believe that understanding something deeply is always worth the effort.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Team -->
<section class="section">
  <div class="container">
    <div style="text-align:center;margin-bottom:40px">
      <h2 class="section-title" style="display:inline-block">Meet the Team</h2>
      <p style="color:var(--text-muted);margin-top:12px">The curious minds behind every article</p>
    </div>
    <div class="team-grid">
      <div class="team-card">
        <div class="team-avatar">A</div>
        <div class="team-name">Ariana Wells</div>
        <div class="team-role">Founder &amp; Editor-in-Chief</div>
        <p style="font-size:.82rem;color:var(--text-muted);margin-top:10px;line-height:1.6">Psychology researcher turned storyteller. Obsessed with why humans do what they do.</p>
        <div class="team-socials">
          <a href="#" class="social-icon-sm" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
          <a href="#" class="social-icon-sm" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">M</div>
        <div class="team-name">Marcus Chen</div>
        <div class="team-role">Technology Writer</div>
        <p style="font-size:.82rem;color:var(--text-muted);margin-top:10px;line-height:1.6">Former software engineer. Translates tech complexity into clarity. AI &amp; future enthusiast.</p>
        <div class="team-socials">
          <a href="#" class="social-icon-sm"><i class="fab fa-x-twitter"></i></a>
          <a href="#" class="social-icon-sm"><i class="fab fa-github"></i></a>
        </div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="background:linear-gradient(135deg,#ec4899,#f43f5e)">S</div>
        <div class="team-name">Sofia Navarro</div>
        <div class="team-role">Love &amp; Relationships Editor</div>
        <p style="font-size:.82rem;color:var(--text-muted);margin-top:10px;line-height:1.6">Couples therapist background. Writes about love with honesty, not fantasy.</p>
        <div class="team-socials">
          <a href="#" class="social-icon-sm"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-icon-sm"><i class="fab fa-x-twitter"></i></a>
        </div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="background:linear-gradient(135deg,#10b981,#059669)">J</div>
        <div class="team-name">James Okafor</div>
        <div class="team-role">Finance &amp; Business Writer</div>
        <p style="font-size:.82rem;color:var(--text-muted);margin-top:10px;line-height:1.6">CFA charterholder. Makes financial literacy genuinely interesting and accessible.</p>
        <div class="team-socials">
          <a href="#" class="social-icon-sm"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="social-icon-sm"><i class="fab fa-x-twitter"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Categories -->
<section class="section-sm" style="background:var(--bg-secondary)">
  <div class="container" style="text-align:center">
    <h2 class="section-title" style="display:inline-block;margin-bottom:12px">What We Cover</h2>
    <p style="color:var(--text-muted);margin-bottom:36px">Six rich categories. Infinite curiosity.</p>
    <div class="categories-grid">
      <?php foreach (getCategories() as $cat): ?>
      <a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?>" class="category-card">
        <div class="cat-icon"><i class="fas <?= htmlspecialchars($cat['icon']) ?>"></i></div>
        <div class="cat-name"><?= htmlspecialchars($cat['name']) ?></div>
        <div class="cat-count"><?= $cat['post_count'] ?> articles</div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>