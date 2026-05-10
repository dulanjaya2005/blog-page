<?php
/**
 * Global Footer Partial — includes/footer.php
 */
$footerCategories = getCategories();
?>

<div class="container">
  <div class="ad-placeholder ad-footer">
    <i class="fas fa-rectangle-ad"></i>
    <span><?= t('advertisement') ?></span>
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
        <p class="footer-desc"><?= t('footer_desc') ?></p>
        <div style="margin-top:16px;margin-bottom:4px;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.07em">
          <?= t('follow_us') ?>
        </div>
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
        <h4 class="footer-heading"><?= t('categories') ?></h4>
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
        <h4 class="footer-heading"><?= t('quick_links') ?></h4>
        <ul class="footer-links">
          <li><a href="<?= SITE_URL ?>/index.php"><?= t('home') ?></a></li>
          <li><a href="<?= SITE_URL ?>/blog.php"><?= t('blog') ?></a></li>
          <li><a href="<?= SITE_URL ?>/about.php"><?= t('about') ?></a></li>
          <li><a href="<?= SITE_URL ?>/contact.php"><?= t('contact') ?></a></li>
          <li><a href="<?= SITE_URL ?>/sitemap.php"><?= t('sitemap') ?></a></li>
          <li><a href="<?= SITE_URL ?>/privacy.php"><?= t('privacy_policy') ?></a></li>
          <li><a href="<?= SITE_URL ?>/terms.php"><?= t('terms_of_service') ?></a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div>
        <h4 class="footer-heading"><?= t('newsletter') ?></h4>
        <p style="font-size:.875rem;color:var(--text-muted);margin-bottom:16px;line-height:1.6">
          <?= t('no_spam') ?>
        </p>
        <form class="newsletter-footer-form" style="display:flex;flex-direction:column;gap:10px">
          <input type="email" placeholder="<?= t('email_placeholder') ?>" class="form-control" required>
          <button type="submit" class="btn btn-primary" style="justify-content:center">
            <i class="fas fa-paper-plane"></i> <?= t('subscribe') ?>
          </button>
        </form>
      </div>

    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="container">
      <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px">

        <div>
          &copy; <?= date('Y') ?> <?= SITE_NAME ?>. <?= t('crafted_for') ?>
          <i class="fas fa-heart" style="color:var(--accent)"></i>
          <?= t('for_curious_minds') ?>
        </div>

        <div style="display:flex;flex-wrap:wrap;gap:16px;align-items:center;font-size:.8rem">
          <a href="<?= SITE_URL ?>/terms.php"
             style="color:var(--text-muted);text-decoration:none;transition:color .2s"
             onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color=''">
            <?= t('terms_of_service') ?>
          </a>
          <span style="color:var(--border)">|</span>
          <a href="<?= SITE_URL ?>/privacy.php"
             style="color:var(--text-muted);text-decoration:none;transition:color .2s"
             onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color=''">
            <?= t('privacy_policy') ?>
          </a>
          <span style="color:var(--border)">|</span>
          <a href="<?= SITE_URL ?>/sitemap.php"
             style="color:var(--text-muted);text-decoration:none;transition:color .2s"
             onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color=''">
            <?= t('sitemap') ?>
          </a>
        </div>

      </div>
    </div>
  </div>
</footer>

<!-- Back To Top -->
<button id="back-to-top" aria-label="Back to top">
  <i class="fas fa-chevron-up"></i>
</button>

<!-- Toast Container -->
<div class="toast-container" aria-live="polite"></div>

<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
<script>
  document.querySelector('.newsletter-footer-form')?.addEventListener('submit', e => {
    e.preventDefault();
    showToast('<?= addslashes(t('subscribe')) ?>! 🎉', 'success');
    e.target.reset();
  });
</script>
<?php if (isset($extraFoot)) echo $extraFoot; ?>
</body>
</html>
