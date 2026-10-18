<?php
/**
 * Admin console.
 *
 * Sprint 16. The support lead wanted one page that lists every account with its
 * tax id for the quarterly audit. The navigation shows the link to admins only.
 *
 * Sprint 20. Added the staff account list with an enable/disable control, so
 * the lead can switch off an account the day someone leaves without waiting
 * for operations.
 *
 * Synopsis:      Show the account audit table and the staff list to an
 *                administrator, and enable or disable a staff account.
 * Preconditions: The caller is signed in, and the role is admin.
 * Requirements:  The role from auth_role(), the customers table, the users
 *                table, and on a POST the username and the action.
 * Impacts:       Reads customers and users and renders both tables, or returns
 *                403. A POST flips users.disabled for one account.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

auth_require_login();

// Admin only. The role travels in the cookie the navigation already reads.
if (auth_role() !== 'admin') {
    http_response_code(403);
    page_header('Forbidden');
    echo '<h2>Forbidden</h2><p>This page is for administrators.</p>';
    page_footer();
    exit;
}

// Enable or disable a staff account. The form posts back here.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $disabled = ($_POST['action'] ?? '') === 'disable' ? 1 : 0;

    $stmt = db()->prepare('UPDATE users SET disabled = ? WHERE username = ?');
    $stmt->execute([$disabled, $username]);

    header('Location: admin.php');
    exit;
}

$customers = db()
    ->query('SELECT display_name, city, account_status, tax_id, assigned_rep
             FROM customers ORDER BY display_name')
    ->fetchAll();

$staff = db()
    ->query('SELECT username, display_name, role, disabled, home_office
             FROM users ORDER BY display_name')
    ->fetchAll();

page_header('Admin');
?>
<h2>Staff accounts</h2>
<table>
  <tr><th>Name</th><th>Username</th><th>Role</th><th>Office</th><th>Status</th><th></th></tr>
  <?php foreach ($staff as $s): ?>
  <tr>
    <td><?= htmlspecialchars($s['display_name'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($s['username'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($s['role'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($s['home_office'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= $s['disabled'] ? 'disabled' : 'active' ?></td>
    <td>
      <form method="post" action="admin.php">
        <input type="hidden" name="username" value="<?= htmlspecialchars($s['username'], ENT_QUOTES, 'UTF-8') ?>">
        <?php if ($s['disabled']): ?>
          <button type="submit" name="action" value="enable">Enable</button>
        <?php else: ?>
          <button type="submit" name="action" value="disable">Disable</button>
        <?php endif; ?>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<h2>Account audit</h2>
<table>
  <tr><th>Name</th><th>City</th><th>Status</th><th>Tax ID</th><th>Rep</th></tr>
  <?php foreach ($customers as $c): ?>
  <tr>
    <td><?= htmlspecialchars($c['display_name'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($c['city'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($c['account_status'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($c['tax_id'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($c['assigned_rep'], ENT_QUOTES, 'UTF-8') ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php
page_footer();
