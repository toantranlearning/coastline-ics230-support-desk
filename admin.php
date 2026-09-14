<?php
/**
 * Admin console.
 *
 * Sprint 16. The support lead wanted one page that lists every account with its
 * tax id for the quarterly audit. The navigation shows the link to admins only.
 *
 * Synopsis:      Show the account audit table to an administrator.
 * Preconditions: The caller is signed in, and the role is admin.
 * Requirements:  The role from auth_role(), and the customers table.
 * Impacts:       Reads customers and renders the audit table, or returns 403.
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

$customers = db()
    ->query('SELECT display_name, city, account_status, tax_id, assigned_rep
             FROM customers ORDER BY display_name')
    ->fetchAll();

page_header('Admin');
?>
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
