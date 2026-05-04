<?php
/**
 * Core Helper Functions
 */

require_once __DIR__ . '/db.php';

// ─── Security ──────────────────────────────────────────────────────────────

function sanitize(string $input): string {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function generateSlug(string $title): string {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    return $slug;
}

function hashPassword(string $password): string {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function verifyPassword(string $password, string $hash): bool {
    return password_verify($password, $hash);
}

// ─── Session / Auth ────────────────────────────────────────────────────────

function isAdminLoggedIn(): bool {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

function requireAdmin(): void {
    if (!isAdminLoggedIn()) {
        header('Location: ' . SITE_URL . '/admin/login.php');
        exit;
    }
}

// ─── Reading Time ──────────────────────────────────────────────────────────

function readingTime(string $content): string {
    $wordCount = str_word_count(strip_tags($content));
    $minutes   = (int) ceil($wordCount / 200);
    return $minutes < 1 ? '1 min read' : $minutes . ' min read';
}

// ─── Posts ─────────────────────────────────────────────────────────────────

function getPosts(int $limit = 10, int $offset = 0, ?int $categoryId = null): array {
    global $pdo;
    $sql    = "SELECT p.*, c.name AS category_name, c.icon AS category_icon
               FROM posts p
               LEFT JOIN categories c ON p.category_id = c.id";
    $params = [];
    if ($categoryId !== null) {
        $sql    .= " WHERE p.category_id = ?";
        $params[] = $categoryId;
    }
    $sql .= " ORDER BY p.created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getPostBySlug(string $slug): ?array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT p.*, c.name AS category_name, c.icon AS category_icon
         FROM posts p LEFT JOIN categories c ON p.category_id = c.id
         WHERE p.slug = ?"
    );
    $stmt->execute([$slug]);
    return $stmt->fetch() ?: null;
}

function getPostById(int $id): ?array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT p.*, c.name AS category_name
         FROM posts p LEFT JOIN categories c ON p.category_id = c.id
         WHERE p.id = ?"
    );
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function getTrendingPosts(int $limit = 5): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT p.*, c.name AS category_name
         FROM posts p LEFT JOIN categories c ON p.category_id = c.id
         ORDER BY p.created_at DESC LIMIT ?"
    );
    $stmt->execute([$limit]);
    return $stmt->fetchAll();
}

function getRelatedPosts(int $postId, int $categoryId, int $limit = 3): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT p.*, c.name AS category_name
         FROM posts p LEFT JOIN categories c ON p.category_id = c.id
         WHERE p.category_id = ? AND p.id != ?
         ORDER BY p.created_at DESC LIMIT ?"
    );
    $stmt->execute([$categoryId, $postId, $limit]);
    return $stmt->fetchAll();
}

function countPosts(?int $categoryId = null): int {
    global $pdo;
    if ($categoryId !== null) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE category_id = ?");
        $stmt->execute([$categoryId]);
    } else {
        $stmt = $pdo->query("SELECT COUNT(*) FROM posts");
    }
    return (int) $stmt->fetchColumn();
}

function searchPosts(string $query, int $limit = 10): array {
    global $pdo;
    $q    = "%{$query}%";
    $stmt = $pdo->prepare(
        "SELECT p.*, c.name AS category_name
         FROM posts p LEFT JOIN categories c ON p.category_id = c.id
         WHERE p.title LIKE ? OR p.content LIKE ?
         ORDER BY p.created_at DESC LIMIT ?"
    );
    $stmt->execute([$q, $q, $limit]);
    return $stmt->fetchAll();
}

// ─── Categories ────────────────────────────────────────────────────────────

function getCategories(): array {
    global $pdo;
    return $pdo->query(
        "SELECT c.*, COUNT(p.id) AS post_count
         FROM categories c LEFT JOIN posts p ON c.id = p.category_id
         GROUP BY c.id ORDER BY c.name"
    )->fetchAll();
}

function getCategoryById(int $id): ?array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function getCategoryBySlug(string $slug): ?array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetch() ?: null;
}

// ─── Comments ──────────────────────────────────────────────────────────────

function getApprovedComments(int $postId): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT * FROM comments WHERE post_id = ? AND status = 'approved' ORDER BY created_at ASC"
    );
    $stmt->execute([$postId]);
    return $stmt->fetchAll();
}

function countComments(): int {
    global $pdo;
    return (int) $pdo->query("SELECT COUNT(*) FROM comments WHERE status = 'pending'")->fetchColumn();
}

// ─── Stats ─────────────────────────────────────────────────────────────────

function getDashboardStats(): array {
    global $pdo;
    return [
        'posts'      => (int) $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn(),
        'categories' => (int) $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn(),
        'comments'   => (int) $pdo->query("SELECT COUNT(*) FROM comments")->fetchColumn(),
        'contacts'   => (int) $pdo->query("SELECT COUNT(*) FROM contacts")->fetchColumn(),
    ];
}

// ─── Excerpt ───────────────────────────────────────────────────────────────

function excerpt(string $content, int $words = 25): string {
    $text  = strip_tags($content);
    $arr   = explode(' ', $text);
    $slice = array_slice($arr, 0, $words);
    return implode(' ', $slice) . (count($arr) > $words ? '…' : '');
}

// ─── Date Format ───────────────────────────────────────────────────────────

function formatDate(string $date): string {
    return date('F j, Y', strtotime($date));
}

// ─── Image Helper ──────────────────────────────────────────────────────────

function postImage(string $image, string $alt = ''): string {
    if ($image && file_exists(__DIR__ . '/../assets/images/' . $image)) {
        return SITE_URL . '/assets/images/' . htmlspecialchars($image);
    }
    // Fallback placeholder
    $encoded = urlencode($alt ?: 'Blog Post');
    return "https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&q=80";
}

// ─── CSRF ──────────────────────────────────────────────────────────────────

function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}