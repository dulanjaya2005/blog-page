<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/lang.php';
$pageTitle = t('privacy_policy') . ' — ' . SITE_NAME;
$metaDesc  = 'Privacy Policy for ' . SITE_NAME;
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-hero">
  <div class="container">
    <h1 class="page-hero-title"><?= t('privacy_policy') ?></h1>
    <div class="breadcrumb">
      <a href="<?= SITE_URL ?>"><?= t('home') ?></a>
      <span class="breadcrumb-sep">›</span>
      <span><?= t('privacy_policy') ?></span>
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
        <p>At <?= SITE_NAME ?>, accessible from <a href="<?= SITE_URL ?>" style="color:var(--accent)"><?= SITE_URL ?></a>, the privacy of our visitors is of utmost importance. This Privacy Policy document outlines the types of personal information we receive and collect and how we use it.</p>

        <h2>1. Information We Collect</h2>
        <p>We collect information in the following ways:</p>
        <ul>
          <li><strong>Comments:</strong> When you leave a comment, we collect your name, email address (optional), and comment content.</li>
          <li><strong>Contact Form:</strong> When you contact us, we collect your name, email address, subject, and message.</li>
          <li><strong>Cookies:</strong> We use cookies to enhance your browsing experience, including remembering your theme preference (dark/light mode) and selected language.</li>
          <li><strong>Log Data:</strong> Like most websites, our servers automatically record information such as your IP address, browser type, pages visited, and time spent.</li>
        </ul>

        <h2>2. How We Use Your Information</h2>
        <p>The information we collect is used to:</p>
        <ul>
          <li>Respond to your comments and messages</li>
          <li>Improve our Website content and user experience</li>
          <li>Analyze website traffic and usage patterns</li>
          <li>Display relevant advertisements through Google AdSense</li>
        </ul>

        <h2>3. Google AdSense & Cookies</h2>
        <p>We use Google AdSense to display advertisements. Google, as a third-party vendor, uses cookies to serve ads based on your prior visits to our website or other websites on the internet.</p>
        <p>Google's use of advertising cookies enables it and its partners to serve ads based on your visit to our site and/or other sites on the Internet. You may opt out of personalized advertising by visiting <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener" style="color:var(--accent)">Google Ads Settings</a>.</p>
        <p>For more information on how Google uses data, please visit: <a href="https://policies.google.com/technologies/partner-sites" target="_blank" rel="noopener" style="color:var(--accent)">Google Privacy & Terms</a>.</p>

        <h2>4. Third-Party Services</h2>
        <p>We may use the following third-party services which have their own privacy policies:</p>
        <ul>
          <li><strong>Google Analytics</strong> — website traffic analysis</li>
          <li><strong>Google AdSense</strong> — advertising</li>
          <li><strong>Font Awesome</strong> — icons via CDN</li>
          <li><strong>Google Fonts</strong> — typography</li>
          <li><strong>Unsplash</strong> — stock photography</li>
        </ul>

        <h2>5. Data Retention</h2>
        <p>Comment data is retained indefinitely unless you request deletion. Contact form submissions are retained for up to 12 months. You may request deletion of your data at any time by contacting us.</p>

        <h2>6. Your Rights</h2>
        <p>Depending on your location, you may have the following rights regarding your personal data:</p>
        <ul>
          <li>The right to access your personal data</li>
          <li>The right to correct inaccurate data</li>
          <li>The right to request deletion of your data</li>
          <li>The right to object to processing of your data</li>
          <li>The right to data portability (GDPR)</li>
        </ul>
        <p>To exercise any of these rights, please <a href="<?= SITE_URL ?>/contact.php" style="color:var(--accent)">contact us</a>.</p>

        <h2>7. Children's Privacy</h2>
        <p><?= SITE_NAME ?> does not knowingly collect personal information from children under the age of 13. If you believe we have inadvertently collected such information, please contact us immediately.</p>

        <h2>8. Security</h2>
        <p>We implement reasonable security measures to protect your personal information. However, no method of transmission over the Internet is 100% secure, and we cannot guarantee absolute security.</p>

        <h2>9. Changes to This Policy</h2>
        <p>We reserve the right to update this Privacy Policy at any time. We will notify users of any significant changes by posting the new policy on this page with an updated date.</p>

        <h2>10. Contact Us</h2>
        <p>If you have any questions about this Privacy Policy, please contact us at <a href="mailto:<?= ADMIN_EMAIL ?>" style="color:var(--accent)"><?= ADMIN_EMAIL ?></a> or through our <a href="<?= SITE_URL ?>/contact.php" style="color:var(--accent)">contact page</a>.</p>
      </div>

      <div style="margin-top:48px;padding-top:32px;border-top:1px solid var(--border);display:flex;gap:16px;flex-wrap:wrap">
        <a href="<?= SITE_URL ?>/terms.php" class="btn btn-outline">
          <i class="fas fa-file-contract"></i> <?= t('terms_of_service') ?>
        </a>
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary">
          <i class="fas fa-envelope"></i> <?= t('contact') ?>
        </a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
