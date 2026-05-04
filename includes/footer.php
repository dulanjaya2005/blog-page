<?php
/**
 * Global Footer Partial
 */
$footerCategories = getCategories();
?>

<!-- AdSense Footer Banner -->
<div class="container">
  <div class="ad-placeholder ad-footer">
    <i class="fas fa-rectangle-ad"></i>
    <span>Advertisement</span>
  </div>
</div>

<footer role="contentinfo">
  <div class="container">
    <div class="footer-grid">
      <!-- Brand -->
      <div class="footer-brand">
        <a href="<?= SITE_URL ?>/index.php" class="nav-logo" style="display:inline-flex;margin-bottom:16px">
          Charm<span>Vibe</span>
        </a>
        <p class="footer-desc">
          Stories that move you. Deep dives into love, psychology, mystery, horror, technology and financial freedom.
        </p>
        <div class="footer-socials">
          <a href="#" class="social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-btn" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
          <a href="#" class="social-btn" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <a href="#" class="social-btn" aria-label="Twitter/X"><i class="fab fa-x-twitter"></i></a>
        </div>
      </div>

      <!-- Categories -->
      <div>
        <h4 class="footer-heading">Categories</h4>
        <ul class="footer-links">
          <?php foreach ($footerCategories as $cat): ?>
          <li>
            <a href="<?= SITE_URL ?>/category.php?slug=<?= urlencode($cat['slug']) ?>">
              <i class="fas <?= htmlspecialchars($cat['icon']) ?>" style="color:var(--accent);width:16px;margin-right:6px"></i>
              <?= htmlspecialchars($cat['name']) ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Quick Links -->
      <div>
        <h4 class="footer-heading">Quick Links</h4>
        <ul class="footer-links">
          <li><a href="<?= SITE_URL ?>/index.php">Home</a></li>
          <li><a href="<?= SITE_URL ?>/blog.php">All Articles</a></li>
          <li><a href="<?= SITE_URL ?>/about.php">About Us</a></li>
          <li><a href="<?= SITE_URL ?>/contact.php">Contact</a></li>
          <li><a href="<?= SITE_URL ?>/sitemap.xml">Sitemap</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
        </ul>
      </div>

      <!-- Newsletter Widget -->
      <div>
        <h4 class="footer-heading">Newsletter</h4>
        <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:16px;line-height:1.6">
          Get our best stories delivered weekly. No spam, ever.
        </p>
        <form class="newsletter-footer-form" style="display:flex;flex-direction:column;gap:10px">
          <input type="email" placeholder="your@email.com" class="form-control" required>
          <button type="submit" class="btn btn-primary" style="justify-content:center">
            <i class="fas fa-paper-plane"></i> Subscribe
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      &copy; <?= date('Y') ?> <?= SITE_NAME ?>. Crafted with <i class="fas fa-heart" style="color:var(--accent)"></i> for curious minds.
      &nbsp;|&nbsp; Built with PHP & MySQL
    </div>
  </div>
</footer>

<!-- Back To Top -->
<button id="back-to-top" aria-label="Back to top">
  <i class="fas fa-chevron-up"></i>
</button>

<!-- Toast Container -->
<div class="toast-container" aria-live="polite"></div>

<!-- Main JS -->
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
<script>
  // Footer newsletter
  document.querySelector('.newsletter-footer-form')?.addEventListener('submit', e => {
    e.preventDefault();
    showToast('Thanks for subscribing! 🎉', 'success');
    e.target.reset();
  });
</script>
<?php if (isset($extraFoot)) echo $extraFoot; ?>
</body>
</html>