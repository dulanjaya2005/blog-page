<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

$stats        = getDashboardStats();
$recentPosts  = getPosts(5);
$pendingComments = $pdo->query("SELECT c.*, p.title AS post_title FROM comments c JOIN posts p ON c.post_id = p.id WHERE c.status = 'pending' ORDER BY c.created_at DESC LIMIT 5")->fetchAll();

$cardImages = [
  'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?w=80&q=80',
  'https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=80&q=80',
  'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=80&q=80',
  'https://images.unsplash.com/photo-1474631245212-32dc3c8310c6?w=80&q=80',
  'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=80&q=80',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — CharmVibe Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <meta name="robots" content="noindex,nofollow">
</head>
<body>
<?php require_once 'sidebar.php'; ?>

<div class="admin-main">
  <!-- Topbar -->
  <div class="admin-topbar">
    <div class="topbar-title">Dashboard</div>
    <div class="topbar-right">
      <span style="font-size:.82rem;color:var(--admin-muted)">Welcome back,</span>
      <span style="font-size:.875rem;font-weight:600"><?= htmlspecialchars($_SESSION['admin_user']) ?></span>
      <div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_user'],0,1)) ?></div>
    </div>
  </div>

  <div class="admin-content">
    <!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-newspaper"></i></div>
        <div class="stat-value"><?= $stats['posts'] ?></div>
        <div class="stat-label">Total Posts</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-layer-group"></i></div>
        <div class="stat-value"><?= $stats['categories'] ?></div>
        <div class="stat-label">Categories</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-comments"></i></div>
        <div class="stat-value"><?= $stats['comments'] ?></div>
        <div class="stat-label">Comments</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-envelope"></i></div>
        <div class="stat-value"><?= $stats['contacts'] ?></div>
        <div class="stat-label">Messages</div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div style="display:flex;gap:12px;margin-bottom:32px;flex-wrap:wrap">
      <a href="add-post.php" class="admin-btn admin-btn-primary"><i class="fas fa-plus"></i> New Post</a>
      <a href="manage-categories.php" class="admin-btn" style="background:rgba(200,169,110,0.1);color:var(--admin-accent);border:1px solid rgba(200,169,110,0.3)"><i class="fas fa-layer-group"></i> Categories</a>
      <a href="manage-comments.php" class="admin-btn" style="background:rgba(74,144,217,0.1);color:#4A90D9;border:1px solid rgba(74,144,217,0.3)"><i class="fas fa-comments"></i> Moderate Comments</a>
      <a href="../index.php" target="_blank" class="admin-btn" style="background:rgba(58,142,100,0.1);color:var(--admin-success);border:1px solid rgba(58,142,100,0.3)"><i class="fas fa-external-link"></i> View Blog</a>
    </div>

    <div style="display:grid;grid-template-columns:1.5fr 1fr;gap:24px;align-items:start">

      <!-- Recent Posts -->
      <div>
        <div class="admin-page-header" style="margin-bottom:16px">
          <div class="admin-page-title" style="font-size:1.1rem">Recent Posts</div>
          <a href="manage-posts.php" class="admin-btn admin-btn-sm" style="background:rgba(200,169,110,0.1);color:var(--admin-accent);border:1px solid rgba(200,169,110,0.2)">View All</a>
        </div>
        <div class="admin-table-wrap">
          <table class="admin-table">
            <thead>
              <tr><th>Title</th><th>Category</th><th>Date</th><th>Actions</th></tr>
            </thead>
            <tbody>
              <?php foreach ($recentPosts as $i => $post): ?>
              <tr>
                <td style="max-width:220px">
                  <div style="display:flex;align-items:center;gap:10px">
                    <img src="<?= $cardImages[$i % count($cardImages)] ?>" style="width:36px;height:36px;border-radius:6px;object-fit:cover;flex-shrink:0" loading="lazy" alt="">
                    <span style="font-weight:500;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($post['title']) ?></span>
                  </div>
                </td>
                <td><span style="font-size:.78rem;color:var(--admin-accent)"><?= htmlspecialchars($post['category_name'] ?? '—') ?></span></td>
                <td style="color:var(--admin-muted);font-size:.82rem;white-space:nowrap"><?= date('M j, Y', strtotime($post['created_at'])) ?></td>
                <td>
                  <div style="display:flex;gap:6px">
                    <a href="add-post.php?edit=<?= $post['id'] ?>" class="admin-btn admin-btn-sm" style="background:rgba(200,169,110,0.1);color:var(--admin-accent);border:1px solid rgba(200,169,110,0.2);padding:5px 10px"><i class="fas fa-pen"></i></a>
                    <a href="../post.php?slug=<?= urlencode($post['slug']) ?>" target="_blank" class="admin-btn admin-btn-sm" style="background:rgba(74,144,217,0.1);color:#4A90D9;border:1px solid rgba(74,144,217,0.2);padding:5px 10px"><i class="fas fa-eye"></i></a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Pending Comments -->
      <div>
        <div class="admin-page-header" style="margin-bottom:16px">
          <div class="admin-page-title" style="font-size:1.1rem">Pending Comments</div>
          <a href="manage-comments.php" class="admin-btn admin-btn-sm" style="background:rgba(200,169,110,0.1);color:var(--admin-accent);border:1px solid rgba(200,169,110,0.2)">All</a>
        </div>
        <?php if (empty($pendingComments)): ?>
        <div class="admin-card" style="text-align:center;padding:40px;color:var(--admin-muted)">
          <i class="fas fa-check-circle" style="font-size:2rem;color:var(--admin-success);display:block;margin-bottom:8px"></i>
          No pending comments
        </div>
        <?php else: ?>
        <div class="admin-card" style="padding:0">
          <?php foreach ($pendingComments as $c): ?>
          <div style="padding:14px 16px;border-bottom:1px solid var(--admin-border)">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:8px">
              <div>
                <div style="font-weight:600;font-size:.875rem"><?= htmlspecialchars($c['name']) ?></div>
                <div style="font-size:.78rem;color:var(--admin-muted);margin:2px 0"><?= htmlspecialchars(substr($c['comment'],0,70)) ?>…</div>
                <div style="font-size:.75rem;color:var(--admin-muted)">on <em><?= htmlspecialchars($c['post_title']) ?></em></div>
              </div>
              <span class="badge badge-pending" style="flex-shrink:0">Pending</span>
            </div>
            <div style="display:flex;gap:6px;margin-top:10px">
              <a href="manage-comments.php?approve=<?= $c['id'] ?>" class="admin-btn admin-btn-sm admin-btn-success" style="font-size:.75rem"><i class="fas fa-check"></i> Approve</a>
              <a href="manage-comments.php?reject=<?= $c['id'] ?>" class="admin-btn admin-btn-sm admin-btn-danger" style="font-size:.75rem"><i class="fas fa-times"></i> Reject</a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div><!-- /admin-content -->
</div><!-- /admin-main -->

<script>
// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('adminSidebar');
  const btn = document.createElement('button');
  btn.innerHTML = '<i class="fas fa-bars"></i>';
  btn.style.cssText = 'position:fixed;top:16px;left:16px;z-index:200;background:var(--admin-accent);color:#fff;border:none;border-radius:8px;width:40px;height:40px;cursor:pointer;display:none;align-items:center;justify-content:center';
  document.body.appendChild(btn);
  function checkMobile() {
    btn.style.display = window.innerWidth <= 768 ? 'flex' : 'none';
  }
  checkMobile();
  window.addEventListener('resize', checkMobile);
  btn.addEventListener('click', () => sidebar.classList.toggle('open'));
});
</script>
</body></html>