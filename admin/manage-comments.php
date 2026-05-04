<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

// Actions
if (isset($_GET['approve']) && is_numeric($_GET['approve'])) {
    $pdo->prepare("UPDATE comments SET status='approved' WHERE id=?")->execute([(int)$_GET['approve']]);
    header('Location: manage-comments.php?msg=approved'); exit;
}
if (isset($_GET['reject']) && is_numeric($_GET['reject'])) {
    $pdo->prepare("UPDATE comments SET status='rejected' WHERE id=?")->execute([(int)$_GET['reject']]);
    header('Location: manage-comments.php?msg=rejected'); exit;
}
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $pdo->prepare("DELETE FROM comments WHERE id=?")->execute([(int)$_GET['delete']]);
    header('Location: manage-comments.php?msg=deleted'); exit;
}

$filter = $_GET['filter'] ?? 'pending';
$allowed = ['pending','approved','rejected','all'];
if (!in_array($filter, $allowed)) $filter = 'pending';

$sql = "SELECT c.*, p.title AS post_title FROM comments c JOIN posts p ON c.post_id = p.id";
if ($filter !== 'all') $sql .= " WHERE c.status = " . $pdo->quote($filter);
$sql .= " ORDER BY c.created_at DESC";
$comments = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comments — CharmVibe Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <meta name="robots" content="noindex,nofollow">
</head>
<body>
<?php require_once 'sidebar.php'; ?>
<div class="admin-main">
  <div class="admin-topbar">
    <div class="topbar-title">Manage Comments</div>
    <div class="topbar-right"><div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_user'],0,1)) ?></div></div>
  </div>
  <div class="admin-content">
    <?php if (isset($_GET['msg'])): ?>
    <div class="admin-alert <?= $_GET['msg']==='approved'?'admin-alert-success':'admin-alert-error' ?>" style="margin-bottom:20px">
      <i class="fas fa-check-circle"></i>
      Comment <?= htmlspecialchars($_GET['msg']) ?>.
    </div>
    <?php endif; ?>

    <div class="admin-page-header">
      <div class="admin-page-title">Comments</div>
      <div style="display:flex;gap:8px">
        <?php foreach (['pending'=>'warning','approved'=>'success','rejected'=>'danger','all'=>'info'] as $f=>$color): ?>
        <a href="?filter=<?= $f ?>" class="admin-btn admin-btn-sm <?= $filter===$f?'admin-btn-primary':'' ?>"
           style="<?= $filter!==$f?"background:rgba(200,169,110,0.08);color:var(--admin-muted);border:1px solid var(--admin-border)":'' ?>">
          <?= ucfirst($f) ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <?php if (empty($comments)): ?>
    <div class="admin-card" style="text-align:center;padding:48px;color:var(--admin-muted)">
      <i class="fas fa-comments" style="font-size:2.5rem;display:block;margin-bottom:12px"></i>
      No <?= $filter ?> comments found.
    </div>
    <?php else: ?>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead><tr><th>Author</th><th>Comment</th><th>Post</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
          <?php foreach ($comments as $c): ?>
          <tr>
            <td>
              <div style="font-weight:600;font-size:.875rem"><?= htmlspecialchars($c['name']) ?></div>
              <?php if ($c['email']): ?><div style="font-size:.75rem;color:var(--admin-muted)"><?= htmlspecialchars($c['email']) ?></div><?php endif; ?>
            </td>
            <td style="max-width:300px;font-size:.82rem;color:var(--admin-muted)"><?= htmlspecialchars(substr($c['comment'],0,120)) ?>…</td>
            <td style="font-size:.82rem"><em><?= htmlspecialchars($c['post_title']) ?></em></td>
            <td><span class="badge badge-<?= $c['status'] ==='approved'?'approved':($c['status']==='rejected'?'rejected':'pending') ?>"><?= $c['status'] ?></span></td>
            <td style="font-size:.75rem;color:var(--admin-muted);white-space:nowrap"><?= date('M j, Y', strtotime($c['created_at'])) ?></td>
            <td>
              <div style="display:flex;gap:5px">
                <?php if ($c['status'] !== 'approved'): ?>
                <a href="?approve=<?= $c['id'] ?>&filter=<?= $filter ?>" class="admin-btn admin-btn-sm admin-btn-success"><i class="fas fa-check"></i></a>
                <?php endif; ?>
                <?php if ($c['status'] !== 'rejected'): ?>
                <a href="?reject=<?= $c['id'] ?>&filter=<?= $filter ?>" class="admin-btn admin-btn-sm admin-btn-danger"><i class="fas fa-times"></i></a>
                <?php endif; ?>
                <a href="?delete=<?= $c['id'] ?>&filter=<?= $filter ?>" class="admin-btn admin-btn-sm" onclick="return confirm('Delete comment?')" style="background:rgba(209,67,67,0.08);color:var(--admin-danger);border:1px solid rgba(209,67,67,0.2)"><i class="fas fa-trash"></i></a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </div>
</div>
</body></html>
