<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

$editId   = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$editPost = $editId ? getPostById($editId) : null;
$categories = getCategories();
$msg = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title      = sanitize($_POST['title']      ?? '');
    $content    = $_POST['content']             ?? '';
    $catId      = (int)($_POST['category_id']   ?? 0);
    $author     = sanitize($_POST['author']     ?? 'Admin');
    $tags       = sanitize($_POST['tags']       ?? '');
    $slugInput  = sanitize($_POST['slug']       ?? '');
    $slug       = $slugInput ?: generateSlug($title);

    if (!$title || !$content || !$catId) {
        $error = 'Title, content, and category are required.';
    } else {
        try {
            if ($editId) {
                $stmt = $pdo->prepare("UPDATE posts SET title=?,slug=?,content=?,category_id=?,author=?,tags=?,updated_at=NOW() WHERE id=?");
                $stmt->execute([$title,$slug,$content,$catId,$author,$tags,$editId]);
                $msg = 'Post updated successfully.';
            } else {
                $stmt = $pdo->prepare("INSERT INTO posts (title,slug,content,category_id,author,tags) VALUES (?,?,?,?,?,?)");
                $stmt->execute([$title,$slug,$content,$catId,$author,$tags]);
                $editId   = (int)$pdo->lastInsertId();
                $editPost = getPostById($editId);
                $msg = 'Post published successfully.';
            }
        } catch (PDOException $e) {
            $error = 'A post with this slug already exists. Please modify the title or slug.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $editPost ? 'Edit Post' : 'Add New Post' ?> — CharmVibe Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <meta name="robots" content="noindex,nofollow">
</head>
<body>
<?php require_once 'sidebar.php'; ?>
<div class="admin-main">
  <div class="admin-topbar">
    <div class="topbar-title"><?= $editPost ? 'Edit Post' : 'Add New Post' ?></div>
    <div class="topbar-right">
      <div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_user'],0,1)) ?></div>
    </div>
  </div>
  <div class="admin-content">
    <div class="admin-page-header">
      <div class="admin-page-title"><?= $editPost ? 'Edit: ' . htmlspecialchars($editPost['title']) : 'Write New Post' ?></div>
      <a href="manage-posts.php" class="admin-btn" style="background:rgba(200,169,110,0.1);color:var(--admin-accent);border:1px solid rgba(200,169,110,0.2)"><i class="fas fa-arrow-left"></i> All Posts</a>
    </div>

    <?php if ($msg): ?>
    <div class="admin-alert admin-alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
    <div class="admin-alert admin-alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="add-post.php<?= $editId ? '?edit='.$editId : '' ?>">
      <div style="display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start">
        <div>
          <div class="admin-form-group">
            <label class="admin-label" for="title">Post Title *</label>
            <input class="admin-input" type="text" id="title" name="title"
              value="<?= htmlspecialchars($editPost['title'] ?? $_POST['title'] ?? '') ?>"
              placeholder="Enter a compelling title…" required
              oninput="autoSlug(this.value)">
          </div>

          <div class="admin-form-group">
            <label class="admin-label" for="slug">SEO Slug</label>
            <input class="admin-input" type="text" id="slug" name="slug"
              value="<?= htmlspecialchars($editPost['slug'] ?? $_POST['slug'] ?? '') ?>"
              placeholder="auto-generated-from-title">
            <div style="font-size:.75rem;color:var(--admin-muted);margin-top:6px"><i class="fas fa-info-circle"></i> Leave blank to auto-generate from title</div>
          </div>

          <div class="admin-form-group">
            <label class="admin-label" for="content">Content *</label>
            <textarea class="admin-input" id="content" name="content" rows="20"><?= htmlspecialchars($editPost['content'] ?? $_POST['content'] ?? '') ?></textarea>
          </div>
        </div>

        <div>
          <div class="admin-card" style="margin-bottom:20px">
            <div style="font-weight:700;font-size:.875rem;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--admin-border)">Publish</div>
            <div class="admin-form-group">
              <label class="admin-label" for="category_id">Category *</label>
              <select class="admin-input" id="category_id" name="category_id" required>
                <option value="">— Select Category —</option>
                <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= ($editPost['category_id'] ?? $_POST['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($cat['name']) ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="admin-form-group">
              <label class="admin-label" for="author">Author</label>
              <input class="admin-input" type="text" id="author" name="author"
                value="<?= htmlspecialchars($editPost['author'] ?? $_POST['author'] ?? 'Admin') ?>">
            </div>
            <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;justify-content:center">
              <i class="fas fa-<?= $editPost ? 'floppy-disk' : 'upload' ?>"></i>
              <?= $editPost ? 'Update Post' : 'Publish Post' ?>
            </button>
            <?php if ($editPost): ?>
            <a href="../post.php?slug=<?= urlencode($editPost['slug']) ?>" target="_blank"
               class="admin-btn" style="width:100%;justify-content:center;margin-top:8px;background:rgba(74,144,217,0.1);color:#4A90D9;border:1px solid rgba(74,144,217,0.2)">
              <i class="fas fa-eye"></i> Preview Post
            </a>
            <a href="manage-posts.php?delete=<?= $editPost['id'] ?>" onclick="return confirm('Delete this post permanently?')"
               class="admin-btn admin-btn-danger" style="width:100%;justify-content:center;margin-top:8px">
              <i class="fas fa-trash"></i> Delete Post
            </a>
            <?php endif; ?>
          </div>

          <div class="admin-card">
            <div style="font-weight:700;font-size:.875rem;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--admin-border)">SEO & Tags</div>
            <div class="admin-form-group" style="margin-bottom:0">
              <label class="admin-label" for="tags">Tags</label>
              <input class="admin-input" type="text" id="tags" name="tags"
                value="<?= htmlspecialchars($editPost['tags'] ?? $_POST['tags'] ?? '') ?>"
                placeholder="love, psychology, relationships">
              <div style="font-size:.75rem;color:var(--admin-muted);margin-top:6px">Comma-separated tags</div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function autoSlug(title) {
  const slugField = document.getElementById('slug');
  if (!slugField.dataset.manual) {
    slugField.value = title.toLowerCase().trim()
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-');
  }
}
document.getElementById('slug').addEventListener('input', function() {
  this.dataset.manual = '1';
});

tinymce.init({
  selector: '#content',
  plugins: 'lists link image media table code fullscreen',
  toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image | fullscreen code',
  skin: 'oxide-dark',
  content_css: 'dark',
  height: 500,
  promotion: false,
  branding: false,
  setup: function(editor) {
    editor.on('change', function() { editor.save(); });
  }
});
</script>
</body></html>
