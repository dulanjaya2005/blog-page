<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

$msg = $error = '';

// Delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    try {
        $pdo->prepare("DELETE FROM categories WHERE id = ?")->execute([(int)$_GET['delete']]);
        $msg = 'Category deleted.';
    } catch (PDOException $e) {
        $error = 'Cannot delete: category has posts linked to it.';
    }
}

// Add / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $slug = sanitize($_POST['slug'] ?? '') ?: generateSlug($name);
    $icon = sanitize($_POST['icon'] ?? 'fa-folder');
    $id   = (int)($_POST['id'] ?? 0);
    if (!$name) {
        $error = 'Category name is required.';
    } else {
        try {
            if ($id) {
                $pdo->prepare("UPDATE categories SET name=?,slug=?,icon=? WHERE id=?")->execute([$name,$slug,$icon,$id]);
                $msg = 'Category updated.';
            } else {
                $pdo->prepare("INSERT INTO categories (name,slug,icon) VALUES (?,?,?)")->execute([$name,$slug,$icon]);
                $msg = 'Category added.';
            }
        } catch (PDOException $e) {
            $error = 'A category with this slug already exists.';
        }
    }
}

$categories = getCategories();
$editCat = null;
if (isset($_GET['edit'])) $editCat = getCategoryById((int)$_GET['edit']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categories — CharmVibe Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <meta name="robots" content="noindex,nofollow">
</head>
<body>
<?php require_once 'sidebar.php'; ?>
<div class="admin-main">
  <div class="admin-topbar">
    <div class="topbar-title">Manage Categories</div>
    <div class="topbar-right"><div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_user'],0,1)) ?></div></div>
  </div>
  <div class="admin-content">
    <div class="admin-page-header">
      <div class="admin-page-title">Categories</div>
    </div>

    <?php if ($msg): ?><div class="admin-alert admin-alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($msg) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="admin-alert admin-alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div><?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 350px;gap:24px;align-items:start">
      <div class="admin-table-wrap">
        <table class="admin-table">
          <thead><tr><th>Icon</th><th>Name</th><th>Slug</th><th>Posts</th><th>Actions</th></tr></thead>
          <tbody>
            <?php foreach ($categories as $cat): ?>
            <tr>
              <td><i class="fas <?= htmlspecialchars($cat['icon']) ?>" style="color:var(--admin-accent);font-size:1.1rem"></i></td>
              <td style="font-weight:600"><?= htmlspecialchars($cat['name']) ?></td>
              <td style="color:var(--admin-muted);font-size:.82rem"><?= htmlspecialchars($cat['slug']) ?></td>
              <td><span class="badge badge-approved"><?= $cat['post_count'] ?></span></td>
              <td>
                <div style="display:flex;gap:6px">
                  <a href="manage-categories.php?edit=<?= $cat['id'] ?>" class="admin-btn admin-btn-sm" style="background:rgba(200,169,110,0.1);color:var(--admin-accent);border:1px solid rgba(200,169,110,0.2)"><i class="fas fa-pen"></i></a>
                  <a href="manage-categories.php?delete=<?= $cat['id'] ?>" class="admin-btn admin-btn-sm admin-btn-danger" onclick="return confirm('Delete this category?')"><i class="fas fa-trash"></i></a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="admin-card">
        <div style="font-weight:700;font-size:1rem;margin-bottom:20px"><?= $editCat ? 'Edit Category' : 'Add New Category' ?></div>
        <form method="POST" action="manage-categories.php">
          <?php if ($editCat): ?><input type="hidden" name="id" value="<?= $editCat['id'] ?>"><?php endif; ?>
          <div class="admin-form-group">
            <label class="admin-label">Name *</label>
            <input class="admin-input" type="text" name="name" value="<?= htmlspecialchars($editCat['name'] ?? '') ?>" required placeholder="e.g. Technology">
          </div>
          <div class="admin-form-group">
            <label class="admin-label">Slug</label>
            <input class="admin-input" type="text" name="slug" value="<?= htmlspecialchars($editCat['slug'] ?? '') ?>" placeholder="auto-generated">
          </div>
          <div class="admin-form-group">
            <label class="admin-label">Font Awesome Icon Class</label>
            <input class="admin-input" type="text" name="icon" value="<?= htmlspecialchars($editCat['icon'] ?? 'fa-folder') ?>" placeholder="fa-heart">
            <div style="font-size:.75rem;color:var(--admin-muted);margin-top:6px">e.g. fa-heart, fa-ghost, fa-brain</div>
          </div>
          <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;justify-content:center">
            <i class="fas fa-<?= $editCat ? 'floppy-disk' : 'plus' ?>"></i>
            <?= $editCat ? 'Update Category' : 'Add Category' ?>
          </button>
          <?php if ($editCat): ?>
          <a href="manage-categories.php" class="admin-btn" style="width:100%;justify-content:center;margin-top:8px;background:rgba(255,255,255,0.05);color:var(--admin-muted);border:1px solid var(--admin-border)">Cancel</a>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>
</body></html>
