<?php
/**
 * Customer lookup and account detail.
 *
 * Sprint 12 shipped the quick search; sprint 14 added the detail view so a rep
 * could open one account.
 *
 * Synopsis:      Search customers by name, and show one account's details.
 * Preconditions: The caller is signed in.
 * Requirements:  q (a search term) and id (an account id) from the query
 *                string, and the customers table.
 * Impacts:       Reads customers and renders the page. No writes.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

auth_require_login();

$q  = $_GET['q']  ?? '';
$id = $_GET['id'] ?? '';

page_header('Customers');
?>
<h2>Customer lookup</h2>

<form method="get" action="customer.php">
  <label>Search <input name="q" value="<?= $q ?>"></label>
  <button type="submit">Search</button>
</form>

<?php if ($q !== ''): ?>
  <h3>Results for <?= $q ?></h3>
  <?php
    // Build the lookup from the search term and run it.
    $sql  = "SELECT id, display_name, city, account_status
             FROM customers
             WHERE display_name LIKE '%$q%'
             ORDER BY display_name";
    $rows = db()->query($sql)->fetchAll();
  ?>
  <table>
    <tr><th>Name</th><th>City</th><th>Status</th></tr>
    <?php foreach ($rows as $row): ?>
    <tr>
      <td><a href="customer.php?id=<?= $row['id'] ?>"><?= $row['display_name'] ?></a></td>
      <td><?= htmlspecialchars($row['city'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($row['account_status'], ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

<?php
if ($id !== ''):
    // Open the account named by the id in the link.
    $cust = db()->query("SELECT * FROM customers WHERE id = $id")->fetch();
    if ($cust):
?>
  <h3>Account: <?= htmlspecialchars($cust['display_name'], ENT_QUOTES, 'UTF-8') ?></h3>
  <dl class="account">
    <dt>City</dt><dd><?= htmlspecialchars($cust['city'], ENT_QUOTES, 'UTF-8') ?></dd>
    <dt>Status</dt><dd><?= htmlspecialchars($cust['account_status'], ENT_QUOTES, 'UTF-8') ?></dd>
    <dt>Tax ID</dt><dd><?= htmlspecialchars($cust['tax_id'], ENT_QUOTES, 'UTF-8') ?></dd>
    <dt>Assigned rep</dt><dd><?= htmlspecialchars($cust['assigned_rep'], ENT_QUOTES, 'UTF-8') ?></dd>
  </dl>
  <p><a href="notes.php?customer_id=<?= $cust['id'] ?>">Call notes for this account</a></p>
<?php
    endif;
endif;

page_footer();
