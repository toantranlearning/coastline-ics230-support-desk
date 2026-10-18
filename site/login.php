<?php
/**
 * Sign-in page.
 *
 * Synopsis:      Show the sign-in form and handle the submitted credentials.
 * Preconditions: None. This page is reachable without signing in.
 * Requirements:  username and password from the posted form.
 * Impacts:       On success, starts the session and sends the rep to the home
 *                page. On failure, shows a message.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (auth_login($_POST['username'] ?? '', $_POST['password'] ?? '')) {
        header('Location: index.php');
        exit;
    }
    $error = 'That username and password did not match.';
}

page_header('Sign in');
?>
<h2>Sign in</h2>
<?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
<form method="post" action="login.php">
  <label>Username <input name="username" autofocus></label>
  <label>Password <input name="password" type="password"></label>
  <button type="submit">Sign in</button>
</form>
<p><a href="reset-password.php">Forgot your password?</a></p>
<?php
page_footer();
