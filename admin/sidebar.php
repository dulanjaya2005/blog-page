<?php
/**
 * Admin Sidebar Partial
 * Included in all admin pages
 */
$currentPage = basename($_SERVER['PHP_SELF']);
function isActive(string $page): string {
    global $currentPage;
    return $currentPage === $page ? ' active' : '';
}
?>
<aside class="admin-sidebar" id="adminSidebar">
  <div class="sidebar-logo">Charm<span>Vibe</span></div>

  <div class="sidebar-section-label">Main</div>
  <ul class="sidebar-nav">
    <li><a href="dashboard.php" class="<?= isActive('dashboard.php') ?>"><i class="fas fa-gauge"></i> Dashboard</a></li>
  </ul>

  <div class="sidebar-section-label">Content</div>
  <ul class="sidebar-nav">
    <li><a href="manage-posts.php" class="<?= isActive('manage-posts.php') ?>"><i class="fas fa-newspaper"></i> All Posts</a></li>
    <li><a href="add-post.php" class="<?= isActive('add-post.php') ?>"><i class="fas fa-plus-circle"></i> Add New Post</a></li>
    <li><a href="manage-categories.php" class="<?= isActive('manage-categories.php') ?>"><i class="fas fa-layer-group"></i> Categories</a></li>
  </ul>

  <div class="sidebar-section-label">Engagement</div>
  <ul class="sidebar-nav">
    <li><a href="manage-comments.php" class="<?= isActive('manage-comments.php') ?>"><i class="fas fa-comments"></i> Comments</a></li>
    <li><a href="manage-contacts.php" class="<?= isActive('manage-contacts.php') ?>"><i class="fas fa-envelope"></i> Messages</a></li>
  </ul>

  <div class="sidebar-section-label">Site</div>
  <ul class="sidebar-nav">
    <li><a href="../index.php" target="_blank"><i class="fas fa-globe"></i> View Blog</a></li>
  </ul>

  <div class="sidebar-footer">
    <a href="logout.php" class="logout-btn">
      <i class="fas fa-right-from-bracket"></i> Logout
    </a>
  </div>
</aside>