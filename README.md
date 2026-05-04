# CharmVibe Blog System

A modern, full-featured PHP/MySQL blog with admin panel, AdSense-ready layout, dark mode, and SEO optimization.

---

## ⚡ Quick Setup

### Requirements
- PHP 8.0+
- MySQL 5.7+ or MariaDB 10.4+
- Apache/Nginx with mod_rewrite

### Installation Steps

1. **Upload Files**
   - Copy the entire `blog-system` folder to your web server root (e.g., `htdocs` or `www`)

2. **Create Database**
   - Open phpMyAdmin (or MySQL CLI)
   - Run the `database.sql` file:
     ```sql
     source /path/to/database.sql
     ```

3. **Configure Database**
   - Open `includes/db.php`
   - Update the credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'blog_system');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('SITE_URL', 'http://yourdomain.com/blog-system');
     ```

4. **Set Permissions**
   ```bash
   chmod 755 assets/images/
   ```

5. **Visit Your Blog**
   - Blog: `http://localhost/blog-system/`
   - Admin: `http://localhost/blog-system/admin/login.php`
     - Username: `admin`
     - Password: `Admin@1234`

---

## 📁 Folder Structure

```
blog-system/
├── assets/
│   ├── css/
│   │   ├── style.css       # Main frontend styles
│   │   └── admin.css       # Admin panel styles
│   ├── js/
│   │   └── main.js         # Frontend JavaScript
│   └── images/             # Uploaded post images
├── includes/
│   ├── db.php              # Database config & constants
│   ├── functions.php       # Core helper functions
│   ├── header.php          # Global header partial
│   ├── footer.php          # Global footer partial
│   └── search.php          # AJAX search endpoint
├── admin/
│   ├── login.php           # Admin login
│   ├── dashboard.php       # Stats overview
│   ├── add-post.php        # Create/Edit posts
│   ├── manage-posts.php    # All posts list
│   ├── manage-categories.php
│   ├── manage-comments.php
│   ├── manage-contacts.php
│   ├── logout.php
│   └── sidebar.php         # Admin sidebar partial
├── index.php               # Home page
├── blog.php                # Blog listing
├── post.php                # Single post
├── category.php            # Category archive
├── about.php               # About page
├── contact.php             # Contact page
├── 404.php                 # Error page
├── sitemap.php             # Dynamic XML sitemap
├── robots.txt
├── .htaccess
└── database.sql            # Database schema + demo data
```

---

## 🔐 Admin Credentials (Default)

| Field    | Value             |
|----------|-------------------|
| Username | admin             |
| Password | Admin@1234        |
| URL      | /admin/login.php  |

> ⚠️ **Change the password immediately** after first login via phpMyAdmin:
> ```sql
> UPDATE users SET password = '$2y$12$...' WHERE username = 'admin';
> ```
> Use PHP's `password_hash('NewPassword', PASSWORD_BCRYPT, ['cost'=>12])` to generate a new hash.

---

## 💰 Google AdSense Integration

Replace the `ad-placeholder` divs with your AdSense code:

```html
<!-- Find this pattern in: header.php, footer.php, post.php, blog.php -->
<div class="ad-placeholder ad-banner">
  <!-- Replace with: -->
  <ins class="adsbygoogle" style="display:block"
       data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
       data-ad-slot="XXXXXXXXXX"
       data-ad-format="auto"></ins>
  <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
```

Ad placement locations:
- **Top Banner** — `includes/header.php`
- **In-Article** — `post.php` (after 3rd paragraph)
- **Sidebar** — `blog.php`, `post.php`, `index.php`
- **Footer Banner** — `includes/footer.php`

---

## 🌐 SEO

- **Sitemap**: Visit `/sitemap.php` (submit to Google Search Console)
- **Meta tags**: Auto-generated per page
- **Schema markup**: JSON-LD on post pages
- **robots.txt**: Configured at root

---

## 🎨 Customization

- **Colors**: Edit CSS variables in `assets/css/style.css` (`:root` block)
- **Site Name**: Change `SITE_NAME` in `includes/db.php`
- **Logo**: Edit the `.nav-logo` in `includes/header.php`
- **Categories**: Add/edit via Admin → Categories

---

## 🛡️ Security Features

- PDO prepared statements (SQL injection prevention)
- `htmlspecialchars()` on all output (XSS prevention)
- CSRF tokens on all forms
- Honeypot field on contact form
- `password_hash()` with bcrypt cost 12
- `session_regenerate_id()` on login
- `.htaccess` blocks directory listing & sensitive files
