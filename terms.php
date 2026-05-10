<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/lang.php';
$pageTitle = t('terms_of_service') . ' — ' . SITE_NAME;
$metaDesc  = 'Terms of Service for ' . SITE_NAME;
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <h1 class="page-hero-title"><?= t('terms_of_service') ?></h1>
    <div class="breadcrumb">
      <a href="<?= SITE_URL ?>"><?= t('home') ?></a>
      <span class="breadcrumb-sep">›</span>
      <span><?= t('terms_of_service') ?></span>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div style="max-width:780px;margin:0 auto">
      <div style="background:var(--bg-secondary);border:1px solid var(--border);border-radius:var(--radius-md);padding:20px 28px;margin-bottom:40px;font-size:.875rem;color:var(--text-muted)">
        <i class="fas fa-calendar" style="color:var(--accent)"></i>
        Last updated: <?= date('F j, Y') ?>
      </div>

      <div class="post-content">
        <h2>1. Acceptance of Terms</h2>
        <p>By accessing and using <?= SITE_NAME ?> ("the Website"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by these terms, please do not use this Website.</p>

        <h2>2. Use of Content</h2>
        <p>All content published on <?= SITE_NAME ?> — including articles, images, graphics, and other materials — is provided for informational and entertainment purposes only. You may read and share our content for personal, non-commercial use, provided you give appropriate credit and link back to the original article.</p>
        <p>You may not reproduce, distribute, modify, or create derivative works from our content for commercial purposes without our explicit written permission.</p>

        <h2>3. User Comments</h2>
        <p>When you submit a comment on our Website, you grant us a non-exclusive, royalty-free license to publish, edit, and display your comment. You are responsible for the content of your comments. We reserve the right to remove any comment that we deem inappropriate, offensive, or in violation of these Terms.</p>
        <p>By submitting a comment, you confirm that:</p>
        <ul>
          <li>You are the original author of the comment</li>
          <li>The comment does not infringe any third-party rights</li>
          <li>The comment does not contain spam, hate speech, or illegal content</li>
        </ul>

        <h2>4. Disclaimer of Warranties</h2>
        <p>The information on this Website is provided "as is" without any warranties, express or implied. <?= SITE_NAME ?> makes no representations or warranties about the accuracy, completeness, or suitability of the information for any purpose.</p>
        <p>Articles on topics such as finance, psychology, and health are for informational purposes only and should not be construed as professional advice. Always consult a qualified professional for advice specific to your situation.</p>

        <h2>5. Limitation of Liability</h2>
        <p><?= SITE_NAME ?> shall not be liable for any direct, indirect, incidental, special, or consequential damages resulting from your use of, or inability to use, this Website or its content.</p>

        <h2>6. Third-Party Links</h2>
        <p>Our Website may contain links to third-party websites. These links are provided for your convenience only. We have no control over the content of those sites and accept no responsibility for them or for any loss or damage that may arise from your use of them.</p>

        <h2>7. Advertising</h2>
        <p>This Website uses Google AdSense to display advertisements. Google may use cookies to serve ads based on your prior visits to this or other websites. You may opt out of personalized advertising by visiting <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener" style="color:var(--accent)">Google Ads Settings</a>.</p>

        <h2>8. Intellectual Property</h2>
        <p>The <?= SITE_NAME ?> name, logo, and all related marks are the intellectual property of <?= SITE_NAME ?>. Unauthorized use of our branding is prohibited.</p>

        <h2>9. Changes to Terms</h2>
        <p>We reserve the right to modify these Terms of Service at any time. Changes will be effective immediately upon posting to the Website. Your continued use of the Website following any changes constitutes your acceptance of the new Terms.</p>

        <h2>10. Contact</h2>
        <p>If you have any questions about these Terms of Service, please <a href="<?= SITE_URL ?>/contact.php" style="color:var(--accent)"><?= t('contact') ?></a> us.</p>
      </div>

      <div style="margin-top:48px;padding-top:32px;border-top:1px solid var(--border);display:flex;gap:16px;flex-wrap:wrap">
        <a href="<?= SITE_URL ?>/privacy.php" class="btn btn-outline">
          <i class="fas fa-shield-halved"></i> <?= t('privacy_policy') ?>
        </a>
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary">
          <i class="fas fa-envelope"></i> <?= t('contact') ?>
        </a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
