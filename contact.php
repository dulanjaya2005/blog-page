<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Contact Us — ' . SITE_NAME;
$metaDesc  = 'Get in touch with the CharmVibe team. We read every message.';
$success = ''; $errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Invalid request. Please refresh and try again.';
    } elseif (!empty($_POST['website'])) {
        // honeypot triggered — silently ignore
        $success = "Thank you! Your message has been received.";
    } else {
        $name    = sanitize($_POST['name']    ?? '');
        $email   = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $subject = sanitize($_POST['subject'] ?? '');
        $message = sanitize($_POST['message'] ?? '');
        if (!$name)                         $errors[] = 'Name is required.';
        if (!$email)                        $errors[] = 'A valid email address is required.';
        if (!$message || strlen($message)<10) $errors[] = 'Message must be at least 10 characters.';
        if (empty($errors)) {
            global $pdo;
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?,?,?,?)");
            $stmt->execute([$name, $email, $subject, $message]);
            $success = "Thank you, {$name}! Your message has been received. We'll reply within 48 hours.";
        }
    }
}
require_once __DIR__ . '/includes/header.php';
?>
<div class="page-hero">
  <div class="container">
    <h1 class="page-hero-title">Get in Touch</h1>
    <div class="breadcrumb">
      <a href="<?= SITE_URL ?>">Home</a><span class="breadcrumb-sep">›</span><span>Contact</span>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="contact-grid">
      <div>
        <h2 style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;margin-bottom:8px">Let's Talk</h2>
        <p style="color:var(--text-muted);margin-bottom:32px;line-height:1.75">Have a story idea? Want to collaborate? Spotted an error? We'd love to hear from you.</p>
        <div class="contact-info-item">
          <div class="contact-icon"><i class="fas fa-envelope"></i></div>
          <div><div style="font-weight:700;margin-bottom:4px">Email</div><div style="color:var(--text-muted);font-size:.9rem"><?= ADMIN_EMAIL ?></div></div>
        </div>
        <div class="contact-info-item">
          <div class="contact-icon"><i class="fas fa-clock"></i></div>
          <div><div style="font-weight:700;margin-bottom:4px">Response Time</div><div style="color:var(--text-muted);font-size:.9rem">Within 48 hours on business days</div></div>
        </div>
        <div class="contact-info-item" style="border:none">
          <div class="contact-icon"><i class="fas fa-share-nodes"></i></div>
          <div>
            <div style="font-weight:700;margin-bottom:10px">Follow Us</div>
            <div style="display:flex;gap:10px">
              <a href="#" class="social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
              <a href="#" class="social-btn" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
              <a href="#" class="social-btn" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
              <a href="#" class="social-btn" aria-label="Twitter/X"><i class="fab fa-x-twitter"></i></a>
            </div>
          </div>
        </div>
        <div style="margin-top:32px;border-radius:var(--radius-md);overflow:hidden;border:1px solid var(--border)">
          <div style="background:var(--bg-secondary);height:200px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:10px;color:var(--text-muted)">
            <i class="fas fa-map-location-dot" style="font-size:2rem;color:var(--accent)"></i>
            <span style="font-size:.85rem">Replace with Google Maps iframe</span>
          </div>
        </div>
      </div>

      <div class="contact-form-box">
        <h3 style="font-family:var(--font-display);font-size:1.4rem;font-weight:700;margin-bottom:24px">Send a Message</h3>
        <?php if ($success): ?>
        <div style="background:rgba(58,142,100,0.1);border:1px solid var(--success);color:var(--success);padding:16px;border-radius:var(--radius-sm);margin-bottom:24px;font-size:.9rem;display:flex;gap:10px">
          <i class="fas fa-check-circle" style="margin-top:2px;flex-shrink:0"></i><span><?= htmlspecialchars($success) ?></span>
        </div>
        <?php endif; ?>
        <?php if (!empty($errors)): ?>
        <div style="background:rgba(209,67,67,0.1);border:1px solid var(--danger);color:var(--danger);padding:16px;border-radius:var(--radius-sm);margin-bottom:24px;font-size:.9rem">
          <i class="fas fa-exclamation-circle"></i>
          <ul style="margin:8px 0 0 20px"><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
        <?php endif; ?>
        <form method="POST" action="<?= SITE_URL ?>/contact.php" novalidate>
          <input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">
          <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="c-name">Name <span style="color:var(--danger)">*</span></label>
              <input class="form-control" type="text" id="c-name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required maxlength="100" placeholder="Your name">
            </div>
            <div class="form-group">
              <label class="form-label" for="c-email">Email <span style="color:var(--danger)">*</span></label>
              <input class="form-control" type="email" id="c-email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required maxlength="120" placeholder="you@example.com">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="c-subject">Subject</label>
            <input class="form-control" type="text" id="c-subject" name="subject" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>" maxlength="200" placeholder="What's this about?">
          </div>
          <div class="form-group">
            <label class="form-label" for="c-message">Message <span style="color:var(--danger)">*</span></label>
            <textarea class="form-control" id="c-message" name="message" required minlength="10" rows="6" placeholder="Tell us what's on your mind…"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:16px">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
          <p style="font-size:.78rem;color:var(--text-muted);text-align:center;margin-top:12px"><i class="fas fa-lock"></i> Your information is kept private.</p>
        </form>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>