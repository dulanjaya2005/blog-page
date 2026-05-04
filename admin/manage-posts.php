<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    header('Location: manage-posts.php?msg=deleted'); exit;
}

$perPage = 15;
$page    = max(1, (int)($_GET['page'] ?? 1));
$offset  = ($page - 1) * $perPage;
$posts   = getPosts($perPage, $offset);
$total   = countPosts();
$totalPages = (int)ceil($total / $perPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Posts — CharmVibe Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <meta name="robots" content="noindex,nofollow">
</head>
<body>
<?php require_once 'sidebar.php'; ?>
<div class="admin-main">
  <div class="admin-topbar">
    <div class="topbar-title">Manage Posts</div>
    <div class="topbar-right">
      <div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_user'],0,1)) ?></div>
    </div>
  </div>
  <div class="admin-content">
    <?php if (isset($_GET['msg'])): ?>
    <div class="admin-alert <?= $_GET['msg']==='deleted'?'admin-alert-error':'admin-alert-success' ?>" style="margin-bottom:20px">
      <?= $_GET['msg']==='deleted' ? '<i class="fas fa-trash"></i> Post deleted.' : '<i class="fas fa-check"></i> Post saved.' ?>
    </div>
    <?php endif; ?>

    <div class="admin-page-header">
      <div class="admin-page-title">All Posts <span style="font-size:1rem;color:var(--admin-muted);font-family:var(--font-body)">(<?= $total ?>)</span></div>
      <a href="add-post.php" class="admin-btn admin-btn-primary"><i class="fas fa-plus"></i> New Post</a>
    </div>

    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr><th>#</th><th>Title</th><th>Category</th><th>Author</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
          <?php foreach ($posts as $post): ?>
          <tr>
            <td style="color:var(--admin-muted);font-size:.78rem"><?= $post['id'] ?></td>
            <td style="max-width:280px">
              <span style="font-weight:500;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($post['title']) ?></span>
              <span style="font-size:.75rem;color:var(--admin-muted)"><?= htmlspecialchars($post['slug']) ?></span>
            </td>
            <td><span style="color:var(--admin-accent);font-size:.82rem"><?= htmlspecialchars($post['category_name'] ?? '—') ?></span></td>
            <td style="font-size:.82rem;color:var(--admin-muted)"><?= htmlspecialchars($post['author']) ?></td>
            <td style="font-size:.78rem;color:var(--admin-muted);white-space:nowrap"><?= date('M j, Y', strtotime($post['created_at'])) ?></td>
            <td>
              <div style="display:flex;gap:6px">
                <a href="add-post.php?edit=<?= $post['id'] ?>" class="admin-btn admin-btn-sm" style="background:rgba(200,169,110,0.1);color:var(--admin-accent);border:1px solid rgba(200,169,110,0.2)"><i class="fas fa-pen"></i></a>
                <a href="../post.php?slug=<?= urlencode($post['slug']) ?>" target="_blank" class="admin-btn admin-btn-sm" style="background:rgba(74,144,217,0.1);color:#4A90D9;border:1px solid rgba(74,144,217,0.2)"><i class="fas fa-eye"></i></a>
                <a href="manage-posts.php?delete=<?= $post['id'] ?>" class="admin-btn admin-btn-sm admin-btn-danger" onclick="return confirm('Delete this post?')"><i class="fas fa-trash"></i></a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if ($totalPages > 1): ?>
    <div style="display:flex;gap:8px;margin-top:20px">
      <?php for ($p = 1; $p <= $totalPages; $p++): ?>
      <a href="?page=<?= $p ?>" style="padding:7px 12px;border-radius:6px;font-size:.82rem;background:<?= $p===$page?'var(--admin-accent)':'var(--admin-card)' ?>;color:<?= $p===$page?'#fff':'var(--admin-text)' ?>;border:1px solid var(--admin-border)"><?= $p ?></a>
      <?php endfor; ?>
    </div>
    <?php endif; ?>

  </div>
</div>
</body></html>
