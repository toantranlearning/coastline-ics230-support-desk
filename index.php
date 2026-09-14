<?php
/**
 * Customer list, the portal's home page.
 *
 * Synopsis:      Show every customer, sorted by name.
 * Preconditions: The caller is signed in.
 * Requirements:  The customers table.
 * Impacts:       Reads customers and renders the list. No writes.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

auth_require_login();

$rows = db()
    ->query('SELECT id, display_name, city, account_status FROM customers ORDER BY display_name')
    ->fetchAll();

page_header('Customers');
?>
<h2>Customers</h2>
<table>
  <tr><th>Name</th><th>City</th><th>Status</th></tr>
  <?php foreach ($rows as $row): ?>
  <tr>
    <td><?= htmlspecialchars($row['display_name'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($row['city'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($row['account_status'], ENT_QUOTES, 'UTF-8') ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php
page_footer();
