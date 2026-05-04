<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (isAdminLoggedIn()) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && verifyPassword($password, $user['password'])) {
            $_SESSION['admin_id']   = $user['id'];
            $_SESSION['admin_user'] = $user['username'];
            session_regenerate_id(true);
            header('Location: dashboard.php'); exit;
        } else { $error = 'Invalid username or password.'; }
    } else { $error = 'Please enter your username and password.'; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — <?= SITE_NAME ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <meta name="robots" content="noindex,nofollow">
</head>
<body style="display:block">
<div class="admin-login-wrap">
  <div class="admin-login-box">
    <div class="login-logo">CharmVibe<p>Admin Panel</p></div>
    <?php if ($error): ?>
    <div class="admin-alert admin-alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
      <div class="admin-form-group">
        <label class="admin-label" for="username">Username</label>
        <input class="admin-input" type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autocomplete="username" autofocus>
      </div>
      <div class="admin-form-group">
        <label class="admin-label" for="password">Password</label>
        <div style="position:relative">
          <input class="admin-input" type="password" id="password" name="password" required autocomplete="current-password" style="padding-right:44px">
          <button type="button" id="tpw" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--admin-muted);cursor:pointer"><i class="fas fa-eye" id="tpw-ico"></i></button>
        </div>
      </div>
      <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;justify-content:center;padding:13px;margin-top:8px">
        <i class="fas fa-right-to-bracket"></i> Sign In
      </button>
    </form>
    <div style="text-align:center;margin-top:24px">
      <a href="../index.php" style="font-size:.82rem;color:var(--admin-muted)"><i class="fas fa-arrow-left"></i> Back to Blog</a>
    </div>
  </div>
</div>
<script>
const b=document.getElementById('tpw'),i=document.getElementById('password'),c=document.getElementById('tpw-ico');
b.addEventListener('click',()=>{const s=i.type==='password';i.type=s?'text':'password';c.className=s?'fas fa-eye-slash':'fas fa-eye';});
</script>
</body></html>