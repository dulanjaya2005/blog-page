<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $pdo->prepare("DELETE FROM contacts WHERE id=?")->execute([(int)$_GET['delete']]);
    header('Location: manage-contacts.php?msg=deleted'); exit;
}

$contacts = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages — CharmVibe Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <meta name="robots" content="noindex,nofollow">
</head>
<body>
<?php require_once 'sidebar.php'; ?>
<div class="admin-main">
  <div class="admin-topbar">
    <div class="topbar-title">Contact Messages</div>
    <div class="topbar-right"><div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_user'],0,1)) ?></div></div>
  </div>
  <div class="admin-content">
    <?php if (isset($_GET['msg'])): ?>
    <div class="admin-alert admin-alert-error" style="margin-bottom:20px"><i class="fas fa-trash"></i> Message deleted.</div>
    <?php endif; ?>

    <div class="admin-page-header">
      <div class="admin-page-title">Messages <span style="font-size:1rem;color:var(--admin-muted);font-family:var(--font-body)">(<?= count($contacts) ?>)</span></div>
    </div>

    <?php if (empty($contacts)): ?>
    <div class="admin-card" style="text-align:center;padding:48px;color:var(--admin-muted)">
      <i class="fas fa-envelope-open" style="font-size:2.5rem;display:block;margin-bottom:12px"></i>
      No messages yet.
    </div>
    <?php else: ?>
    <div style="display:flex;flex-direction:column;gap:16px">
      <?php foreach ($contacts as $c): ?>
      <div class="admin-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:12px">
          <div>
            <div style="font-weight:700;font-size:.95rem"><?= htmlspecialchars($c['name']) ?> <span style="color:var(--admin-muted);font-weight:400;font-size:.82rem">— <?= htmlspecialchars($c['email']) ?></span></div>
            <?php if ($c['subject']): ?><div style="font-size:.82rem;color:var(--admin-accent);margin-top:4px"><i class="fas fa-tag"></i> <?= htmlspecialchars($c['subject']) ?></div><?php endif; ?>
          </div>
          <div style="display:flex;align-items:center;gap:10px;flex-shrink:0">
            <span style="font-size:.75rem;color:var(--admin-muted)"><?= date('M j, Y g:i A', strtotime($c['created_at'])) ?></span>
            <a href="mailto:<?= htmlspecialchars($c['email']) ?>" class="admin-btn admin-btn-sm" style="background:rgba(74,144,217,0.1);color:#4A90D9;border:1px solid rgba(74,144,217,0.2)"><i class="fas fa-reply"></i></a>
            <a href="?delete=<?= $c['id'] ?>" class="admin-btn admin-btn-sm admin-btn-danger" onclick="return confirm('Delete this message?')"><i class="fas fa-trash"></i></a>
          </div>
        </div>
        <p style="font-size:.875rem;color:var(--admin-muted);line-height:1.7;padding:14px;background:var(--admin-bg);border-radius:var(--radius);border-left:3px solid var(--admin-accent)"><?= nl2br(htmlspecialchars($c['message'])) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</div>
</body></html>
