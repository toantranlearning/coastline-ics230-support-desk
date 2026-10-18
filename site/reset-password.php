<?php
/**
 * Self-service password reset.
 *
 * Sprint 19. Reps kept locking themselves out over the weekend, so the desk lead
 * asked for a self-service reset. Each account already has a security question,
 * so the reset asks that and lets the rep set a new password.
 *
 * Synopsis:      Ask for a username, confirm the security answer, and set a new
 *                password.
 * Preconditions: None. This page is reachable without signing in.
 * Requirements:  username, answer, and new_password from the posted form, and
 *                the users table.
 * Impacts:       Updates the account's stored password when the answer matches.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

$step    = 'ask-username';
$message = '';
$username = '';
$question = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';

    $stmt = db()->prepare('SELECT username, security_question, security_answer FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $account = $stmt->fetch();

    if (!$account) {
        $message = 'No account by that name.';
    } elseif (!isset($_POST['answer'])) {
        // Step one: they gave a username. Show the security question.
        $step     = 'answer-question';
        $question = $account['security_question'];
    } else {
        // Step two: they answered. If it matches, set the new password.
        $answer = $_POST['answer'] ?? '';
        $new    = $_POST['new_password'] ?? '';

        if (strcasecmp(trim($answer), trim($account['security_answer'])) === 0) {
            $upd = db()->prepare('UPDATE users SET password_md5 = ? WHERE username = ?');
            $upd->execute([md5($new), $username]);
            $step    = 'done';
            $message = 'Your password has been reset. You can sign in now.';
        } else {
            $step     = 'answer-question';
            $question = $account['security_question'];
            $message  = 'That answer did not match. Try again.';
        }
    }
}

page_header('Reset password');
?>
<h2>Reset your password</h2>
<?php if ($message): ?><p class="error"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

<?php if ($step === 'ask-username'): ?>
  <form method="post" action="reset-password.php">
    <label>Username <input name="username" autofocus></label>
    <button type="submit">Continue</button>
  </form>

<?php elseif ($step === 'answer-question'): ?>
  <form method="post" action="reset-password.php">
    <input type="hidden" name="username" value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>">
    <p><strong><?= htmlspecialchars($question, ENT_QUOTES, 'UTF-8') ?></strong></p>
    <label>Answer <input name="answer" autofocus></label>
    <label>New password <input name="new_password" type="password"></label>
    <button type="submit">Reset password</button>
  </form>

<?php else: ?>
  <p><a href="login.php">Back to sign in</a></p>
<?php endif; ?>
<?php
page_footer();
