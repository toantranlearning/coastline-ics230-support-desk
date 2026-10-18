<?php
/**
 * The page shell every page shares.
 *
 * Call page_header() at the top of a page and page_footer() at the bottom, and
 * put the page's own HTML in between.
 */

/**
 * Synopsis:      Open the page: doctype, head, and the top navigation bar.
 * Preconditions: Call once, at the top of a page.
 * Requirements:  A page title, plus the signed-in name and role for the bar.
 * Impacts:       Writes HTML to the response, and shows the admin link when the
 *                role is admin.
 */
function page_header(string $title): void
{
    $user = auth_display_name();
    $role = auth_role();
    ?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $title ?> &middot; TechCorp Portal</title>
<link rel="stylesheet" href="portal.css">
<!-- Date picker for the notes filter. Loaded from the CDN so we do not have to
     carry it in the repo. -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
<header class="topbar">
  <span class="brand">TechCorp Portal</span>
  <nav>
    <a href="index.php">Customers</a>
    <a href="profile.php">Profile</a>
    <?php if ($role === 'admin'): ?><a href="admin.php">Admin</a><?php endif; ?>
  </nav>
  <span class="who">
    <?php if ($user): ?>
      <?= $user ?> (<?= $role ?>) &middot; <a href="logout.php">Sign out</a>
    <?php endif; ?>
  </span>
</header>
<main>
<?php
}

/**
 * Synopsis:      Close the page that page_header opened.
 * Preconditions: page_header was called first.
 * Requirements:  None.
 * Impacts:       Writes the closing HTML.
 */
function page_footer(): void
{
    ?>
</main>
<footer><small>TechCorp internal use only.</small></footer>
</body>
</html><?php
}
