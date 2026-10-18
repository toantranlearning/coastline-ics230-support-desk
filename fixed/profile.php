<?php
/**
 * The signed-in rep's own profile card.
 *
 * Synopsis:      Show the signed-in rep their own account details.
 * Preconditions: The caller is signed in.
 * Requirements:  The users table.
 * Impacts:       Reads the rep's own row and renders it. No writes.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

auth_require_login();

$stmt = db()->prepare('SELECT display_name, username, home_office FROM users WHERE username = ?');
$stmt->execute([auth_username()]);
$me = $stmt->fetch() ?: [];

page_header('Profile');
?>
<h2>Your profile</h2>
<dl class="profile">
  <dt>Display name</dt><dd><?= htmlspecialchars(auth_display_name() ?? '', ENT_QUOTES, 'UTF-8') ?></dd>
  <dt>Username</dt><dd><?= htmlspecialchars(auth_username() ?? '', ENT_QUOTES, 'UTF-8') ?></dd>
  <dt>Role</dt><dd><?= htmlspecialchars(auth_role(), ENT_QUOTES, 'UTF-8') ?></dd>
  <dt>Home office</dt><dd><?= htmlspecialchars($me['home_office'] ?? '', ENT_QUOTES, 'UTF-8') ?></dd>
</dl>
<?php
page_footer();
