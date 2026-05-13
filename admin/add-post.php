<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

$editId     = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$editPost   = $editId ? getPostById($editId) : null;
$categories = getCategories();
$msg = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title     = sanitize($_POST['title']       ?? '');
    $content   = $_POST['content']              ?? '';
    $catId     = (int)($_POST['category_id']    ?? 0);
    $author    = sanitize($_POST['author']       ?? 'Admin');
    $tags      = sanitize($_POST['tags']         ?? '');
    $slugInput = sanitize($_POST['slug']         ?? '');
    $slug      = $slugInput ?: generateSlug($title);

    // ── Image Upload ──────────────────────────────────────
    $imagePath = $editPost['image'] ?? null;

    if (!empty($_FILES['thumbnail']['name'])) {
        $file     = $_FILES['thumbnail'];
        $allowed  = ['image/jpeg','image/jpg','image/png','image/webp','image/gif'];
        $maxSize  = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowed)) {
            $error = 'Only JPG, PNG, WEBP, GIF images are allowed.';
        } elseif ($file['size'] > $maxSize) {
            $error = 'Image size must be under 5MB.';
        } else {
            $uploadDir = __DIR__ . '/../assets/images/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            $ext       = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newName   = 'post_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . strtolower($ext);
            $destPath  = $uploadDir . $newName;

            if (move_uploaded_file($file['tmp_name'], $destPath)) {
                // Delete old image if editing
                if ($editPost && $editPost['image'] && file_exists($uploadDir . $editPost['image'])) {
                    @unlink($uploadDir . $editPost['image']);
                }
                $imagePath = $newName;
            } else {
                $error = 'Failed to upload image. Check folder permissions.';
            }
        }
    }

    if (!$error) {
        if (!$title || !$content || !$catId) {
            $error = 'Title, content, and category are required.';
        } else {
            try {
                if ($editId) {
                    $stmt = $pdo->prepare("UPDATE posts SET title=?,slug=?,content=?,category_id=?,author=?,tags=?,image=?,updated_at=NOW() WHERE id=?");
                    $stmt->execute([$title,$slug,$content,$catId,$author,$tags,$imagePath,$editId]);
                    $msg = 'Post updated successfully!';
                    $editPost = getPostById($editId);
                } else {
                    $stmt = $pdo->prepare("INSERT INTO posts (title,slug,content,category_id,author,tags,image) VALUES (?,?,?,?,?,?,?)");
                    $stmt->execute([$title,$slug,$content,$catId,$author,$tags,$imagePath]);
                    $newId    = (int)$pdo->lastInsertId();
                    $editId   = $newId;
                    $editPost = getPostById($newId);
                    $msg      = 'Post published successfully!';
                }
            } catch (PDOException $e) {
                $error = 'A post with this slug already exists. Change the title or slug.';
            }
        }
    }
}

// Image preview URL
function thumbUrl(?string $img): string {
    if ($img && file_exists(__DIR__ . '/../assets/images/' . $img)) {
        return SITE_URL . '/assets/images/' . htmlspecialchars($img);
    }
    return '';
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
  <meta name="robots" content="noindex,nofollow">
  <style>
    /* ── Custom Editor ── */
    .editor-toolbar {
      display: flex; flex-wrap: wrap; gap: 4px;
      padding: 10px 12px;
      background: var(--admin-surface);
      border: 1.5px solid var(--admin-border);
      border-bottom: none;
      border-radius: var(--radius) var(--radius) 0 0;
    }
    .editor-toolbar button {
      padding: 6px 10px; border-radius: 6px;
      background: var(--admin-card); border: 1px solid var(--admin-border);
      color: var(--admin-text); cursor: pointer;
      font-size: .8rem; font-weight: 600;
      transition: all .15s ease; min-width: 32px;
      display: flex; align-items: center; justify-content: center;
    }
    .editor-toolbar button:hover { background: var(--admin-accent); color: #fff; border-color: var(--admin-accent); }
    .editor-toolbar .sep { width: 1px; background: var(--admin-border); margin: 2px 4px; align-self: stretch; }
    #editor {
      width: 100%; min-height: 420px;
      background: var(--admin-bg);
      border: 1.5px solid var(--admin-border);
      border-radius: 0 0 var(--radius) var(--radius);
      color: var(--admin-text);
      padding: 20px; font-size: .95rem;
      line-height: 1.8; outline: none;
      font-family: var(--font-body);
    }
    #editor:focus { border-color: var(--admin-accent); }
    #editor h1,#editor h2,#editor h3 { font-family: var(--font-display); color: var(--admin-text); margin: 16px 0 8px; }
    #editor h2 { font-size: 1.4rem; }
    #editor h3 { font-size: 1.15rem; }
    #editor p  { margin-bottom: 12px; }
    #editor ul,#editor ol { padding-left: 24px; margin-bottom: 12px; }
    #editor blockquote { border-left: 3px solid var(--admin-accent); padding: 8px 16px; margin: 16px 0; color: var(--admin-muted); font-style: italic; }
    #editor a  { color: var(--admin-accent); }
    #editor img { max-width: 100%; border-radius: 8px; margin: 8px 0; }

    /* ── Thumbnail Upload ── */
    .thumb-upload-box {
      border: 2px dashed var(--admin-border);
      border-radius: var(--radius);
      padding: 32px 20px;
      text-align: center; cursor: pointer;
      transition: all .2s ease; position: relative;
      background: var(--admin-bg);
    }
    .thumb-upload-box:hover, .thumb-upload-box.drag { border-color: var(--admin-accent); background: rgba(200,169,110,0.05); }
    .thumb-upload-box input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .thumb-preview {
      width: 100%; height: 200px; object-fit: cover;
      border-radius: var(--radius); display: block;
    }
    .thumb-preview-wrap { position: relative; }
    .thumb-remove-btn {
      position: absolute; top: 8px; right: 8px;
      background: rgba(209,67,67,0.9); color: #fff;
      border: none; border-radius: 50%;
      width: 28px; height: 28px; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      font-size: .75rem;
    }

    /* ── Word Count ── */
    .editor-meta {
      display: flex; justify-content: space-between; align-items: center;
      padding: 8px 12px; font-size: .75rem; color: var(--admin-muted);
      background: var(--admin-surface); border: 1px solid var(--admin-border);
      border-top: none; border-radius: 0 0 var(--radius) var(--radius);
      margin-bottom: 4px;
    }
  </style>
</head>
<body>
<?php require_once 'sidebar.php'; ?>

<div class="admin-main">
  <div class="admin-topbar">
    <div class="topbar-title"><?= $editPost ? 'Edit Post' : 'Add New Post' ?></div>
    <div class="topbar-right">
      <?php if ($editPost): ?>
      <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($editPost['slug']) ?>" target="_blank"
         class="admin-btn admin-btn-sm" style="background:rgba(74,144,217,0.1);color:#4A90D9;border:1px solid rgba(74,144,217,0.2)">
        <i class="fas fa-eye"></i> Preview
      </a>
      <?php endif; ?>
      <a href="manage-posts.php" class="admin-btn admin-btn-sm" style="background:rgba(200,169,110,0.1);color:var(--admin-accent);border:1px solid rgba(200,169,110,0.2)">
        <i class="fas fa-arrow-left"></i> All Posts
      </a>
      <div class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_user'],0,1)) ?></div>
    </div>
  </div>

  <div class="admin-content">

    <?php if ($msg): ?>
    <div class="admin-alert admin-alert-success" style="margin-bottom:24px">
      <i class="fas fa-check-circle"></i> <?= htmlspecialchars($msg) ?>
      <?php if ($editPost): ?>
      &nbsp;— <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($editPost['slug']) ?>" target="_blank" style="color:var(--admin-success);font-weight:700">View Post →</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php if ($error): ?>
    <div class="admin-alert admin-alert-error" style="margin-bottom:24px">
      <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="add-post.php<?= $editId?'?edit='.$editId:'' ?>" enctype="multipart/form-data" id="postForm">

      <div style="display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start">

        <!-- LEFT: Main Content -->
        <div>
          <!-- Title -->
          <div class="admin-form-group">
            <label class="admin-label">Post Title *</label>
            <input class="admin-input" type="text" id="titleInput" name="title"
              value="<?= htmlspecialchars($editPost['title'] ?? '') ?>"
              placeholder="Write a compelling title…" required
              style="font-size:1.1rem;padding:14px 16px"
              oninput="autoSlug(this.value)">
          </div>

          <!-- Slug -->
          <div class="admin-form-group">
            <label class="admin-label">SEO Slug</label>
            <div style="display:flex;gap:8px;align-items:center">
              <span style="font-size:.8rem;color:var(--admin-muted);white-space:nowrap"><?= SITE_URL ?>/post.php?slug=</span>
              <input class="admin-input" type="text" id="slugInput" name="slug"
                value="<?= htmlspecialchars($editPost['slug'] ?? '') ?>"
                placeholder="auto-generated" style="flex:1">
            </div>
          </div>

          <!-- Rich Text Editor -->
          <div class="admin-form-group">
            <label class="admin-label">Content *</label>

            <!-- Toolbar -->
            <div class="editor-toolbar">
              <button type="button" onclick="fmt('bold')" title="Bold"><i class="fas fa-bold"></i></button>
              <button type="button" onclick="fmt('italic')" title="Italic"><i class="fas fa-italic"></i></button>
              <button type="button" onclick="fmt('underline')" title="Underline"><i class="fas fa-underline"></i></button>
              <button type="button" onclick="fmt('strikeThrough')" title="Strikethrough"><i class="fas fa-strikethrough"></i></button>
              <div class="sep"></div>
              <button type="button" onclick="fmtBlock('h2')" title="Heading 2"><b>H2</b></button>
              <button type="button" onclick="fmtBlock('h3')" title="Heading 3"><b>H3</b></button>
              <button type="button" onclick="fmtBlock('p')" title="Paragraph"><i class="fas fa-paragraph"></i></button>
              <div class="sep"></div>
              <button type="button" onclick="fmt('insertUnorderedList')" title="Bullet List"><i class="fas fa-list-ul"></i></button>
              <button type="button" onclick="fmt('insertOrderedList')" title="Numbered List"><i class="fas fa-list-ol"></i></button>
              <button type="button" onclick="fmtBlock('blockquote')" title="Quote"><i class="fas fa-quote-left"></i></button>
              <div class="sep"></div>
              <button type="button" onclick="alignText('justifyLeft')" title="Align Left"><i class="fas fa-align-left"></i></button>
              <button type="button" onclick="alignText('justifyCenter')" title="Center"><i class="fas fa-align-center"></i></button>
              <button type="button" onclick="alignText('justifyRight')" title="Align Right"><i class="fas fa-align-right"></i></button>
              <div class="sep"></div>
              <button type="button" onclick="insertLink()" title="Insert Link"><i class="fas fa-link"></i></button>
              <button type="button" onclick="insertInlineImage()" title="Insert Image URL"><i class="fas fa-image"></i></button>
              <div class="sep"></div>
              <button type="button" onclick="document.execCommand('undo')" title="Undo"><i class="fas fa-rotate-left"></i></button>
              <button type="button" onclick="document.execCommand('redo')" title="Redo"><i class="fas fa-rotate-right"></i></button>
              <div class="sep"></div>
              <button type="button" onclick="clearFormat()" title="Clear Formatting" style="font-size:.7rem">Clear</button>
            </div>

            <!-- Editable Area -->
            <div id="editor" contenteditable="true" spellcheck="true"><?= $editPost['content'] ?? '' ?></div>

            <!-- Word count bar -->
            <div class="editor-meta">
              <span id="wordCount">0 words</span>
              <span id="readTime">~0 min read</span>
            </div>

            <!-- Hidden textarea that gets submitted -->
            <textarea name="content" id="contentHidden" style="display:none"></textarea>
          </div>
        </div>

        <!-- RIGHT: Sidebar -->
        <div style="position:sticky;top:80px">

          <!-- Publish Card -->
          <div class="admin-card" style="margin-bottom:16px">
            <div style="font-weight:700;font-size:.875rem;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--admin-border)">
              <i class="fas fa-upload" style="color:var(--admin-accent);margin-right:6px"></i> Publish
            </div>

            <div class="admin-form-group">
              <label class="admin-label">Category *</label>
              <select class="admin-input" name="category_id" required>
                <option value="">— Select —</option>
                <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                  <?= ($editPost['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($cat['name']) ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="admin-form-group">
              <label class="admin-label">Author</label>
              <input class="admin-input" type="text" name="author"
                value="<?= htmlspecialchars($editPost['author'] ?? 'Admin') ?>">
            </div>

            <div class="admin-form-group" style="margin-bottom:0">
              <label class="admin-label">Tags</label>
              <input class="admin-input" type="text" name="tags"
                value="<?= htmlspecialchars($editPost['tags'] ?? '') ?>"
                placeholder="love, psychology, relationships">
              <div style="font-size:.72rem;color:var(--admin-muted);margin-top:5px">Comma separated</div>
            </div>
          </div>

          <!-- Thumbnail Card -->
          <div class="admin-card" style="margin-bottom:16px">
            <div style="font-weight:700;font-size:.875rem;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--admin-border)">
              <i class="fas fa-image" style="color:var(--admin-accent);margin-right:6px"></i> Thumbnail Image
            </div>

            <!-- Preview -->
            <div id="previewWrap" style="<?= $editPost && $editPost['image'] ? '' : 'display:none' ?>;margin-bottom:12px">
              <div class="thumb-preview-wrap">
                <img id="thumbPreview"
                     src="<?= thumbUrl($editPost['image'] ?? null) ?>"
                     class="thumb-preview" alt="Thumbnail">
                <button type="button" class="thumb-remove-btn" onclick="removeThumb()" title="Remove image">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>

            <!-- Upload Box -->
            <div class="thumb-upload-box" id="uploadBox"
                 style="<?= $editPost && $editPost['image'] ? 'display:none' : '' ?>"
                 ondragover="this.classList.add('drag')" ondragleave="this.classList.remove('drag')"
                 ondrop="this.classList.remove('drag')">
              <input type="file" name="thumbnail" id="thumbFile"
                     accept="image/jpeg,image/png,image/webp,image/gif"
                     onchange="previewThumb(this)">
              <i class="fas fa-cloud-arrow-up" style="font-size:2rem;color:var(--admin-accent);margin-bottom:10px;display:block"></i>
              <div style="font-weight:600;font-size:.875rem;margin-bottom:4px">Click or drag to upload</div>
              <div style="font-size:.75rem;color:var(--admin-muted)">
                JPG, PNG, WEBP · Max 5MB<br>
                <strong style="color:var(--admin-accent)">Best size: 1280 × 720px (YouTube thumbnail)</strong>
              </div>
            </div>

            <!-- Hidden remove flag -->
            <input type="hidden" name="remove_image" id="removeImageFlag" value="0">
          </div>

          <!-- Action Buttons -->
          <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;justify-content:center;padding:14px;font-size:.95rem;margin-bottom:8px">
            <i class="fas fa-<?= $editPost ? 'floppy-disk' : 'rocket' ?>"></i>
            <?= $editPost ? 'Update Post' : 'Publish Post' ?>
          </button>

          <?php if ($editPost): ?>
          <a href="<?= SITE_URL ?>/post.php?slug=<?= urlencode($editPost['slug']) ?>" target="_blank"
             class="admin-btn" style="width:100%;justify-content:center;margin-bottom:8px;background:rgba(74,144,217,0.1);color:#4A90D9;border:1px solid rgba(74,144,217,0.2)">
            <i class="fas fa-eye"></i> View Live Post
          </a>
          <a href="manage-posts.php?delete=<?= $editPost['id'] ?>"
             onclick="return confirm('Delete this post permanently?')"
             class="admin-btn admin-btn-danger" style="width:100%;justify-content:center">
            <i class="fas fa-trash"></i> Delete Post
          </a>
          <?php endif; ?>

        </div>
      </div>
    </form>
  </div>
</div>

<script>
// ── Slug auto-generate ─────────────────────────────────
let slugManual = <?= $editPost ? 'true' : 'false' ?>;
function autoSlug(val) {
  if (slugManual) return;
  document.getElementById('slugInput').value = val.toLowerCase().trim()
    .replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-');
}
document.getElementById('slugInput').addEventListener('input', () => { slugManual = true; });

// ── Editor commands ─────────────────────────────────────
const editor = document.getElementById('editor');

function fmt(cmd) {
  editor.focus();
  document.execCommand(cmd, false, null);
}
function fmtBlock(tag) {
  editor.focus();
  document.execCommand('formatBlock', false, tag);
}
function alignText(cmd) {
  editor.focus();
  document.execCommand(cmd, false, null);
}
function clearFormat() {
  editor.focus();
  document.execCommand('removeFormat', false, null);
  document.execCommand('formatBlock', false, 'p');
}
function insertLink() {
  editor.focus();
  const url = prompt('Enter URL:', 'https://');
  if (url) {
    const sel = window.getSelection();
    const text = sel && sel.toString() ? sel.toString() : url;
    document.execCommand('insertHTML', false, `<a href="${url}" target="_blank">${text}</a>`);
  }
}
function insertInlineImage() {
  editor.focus();
  const url = prompt('Enter image URL:');
  if (url) {
    document.execCommand('insertHTML', false, `<img src="${url}" alt="image" style="max-width:100%;border-radius:8px;margin:8px 0">`);
  }
}

// ── Word count ──────────────────────────────────────────
function updateWordCount() {
  const text = editor.innerText || '';
  const words = text.trim().split(/\s+/).filter(w => w.length > 0).length;
  const mins  = Math.max(1, Math.ceil(words / 200));
  document.getElementById('wordCount').textContent = words.toLocaleString() + ' words';
  document.getElementById('readTime').textContent  = '~' + mins + ' min read';
}
editor.addEventListener('input', updateWordCount);
updateWordCount();

// ── Sync editor → hidden textarea on submit ─────────────
document.getElementById('postForm').addEventListener('submit', function() {
  document.getElementById('contentHidden').value = editor.innerHTML;
});

// ── Thumbnail preview ───────────────────────────────────
function previewThumb(input) {
  if (!input.files || !input.files[0]) return;
  const reader = new FileReader();
  reader.onload = e => {
    document.getElementById('thumbPreview').src = e.target.result;
    document.getElementById('previewWrap').style.display = '';
    document.getElementById('uploadBox').style.display = 'none';
    document.getElementById('removeImageFlag').value = '0';
  };
  reader.readAsDataURL(input.files[0]);
}

function removeThumb() {
  document.getElementById('thumbPreview').src = '';
  document.getElementById('previewWrap').style.display = 'none';
  document.getElementById('uploadBox').style.display = '';
  document.getElementById('removeImageFlag').value = '1';
  document.getElementById('thumbFile').value = '';
}

// ── Drag & drop on upload box ───────────────────────────
const uploadBox = document.getElementById('uploadBox');
uploadBox.addEventListener('drop', e => {
  e.preventDefault();
  const file = e.dataTransfer.files[0];
  if (file && file.type.startsWith('image/')) {
    const dt = new DataTransfer();
    dt.items.add(file);
    document.getElementById('thumbFile').files = dt.files;
    previewThumb(document.getElementById('thumbFile'));
  }
});

// ── Keyboard shortcuts ──────────────────────────────────
editor.addEventListener('keydown', e => {
  if (e.ctrlKey || e.metaKey) {
    if (e.key === 'b') { e.preventDefault(); fmt('bold'); }
    if (e.key === 'i') { e.preventDefault(); fmt('italic'); }
    if (e.key === 'u') { e.preventDefault(); fmt('underline'); }
  }
  // Tab → indent
  if (e.key === 'Tab') {
    e.preventDefault();
    document.execCommand('insertHTML', false, '&nbsp;&nbsp;&nbsp;&nbsp;');
  }
});
</script>
</body>
</html>
