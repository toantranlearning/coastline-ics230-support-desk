<?php
/**
 * Call notes for a customer: list them, and add one.
 *
 * Sprint 15. The desk wanted to record what happened on a call and see the
 * history. The add form posts back to this page.
 *
 * Synopsis:      List a customer's call notes, and save a new one.
 * Preconditions: The caller is signed in.
 * Requirements:  customer_id from the query string, and body and customer_id
 *                from the posted form. The notes table. Sprint 20: an optional
 *                from date in the query string narrows the list.
 * Impacts:       Reads notes to list them, and inserts one on a POST.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

auth_require_login();

// Adding a note posts back here.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cid  = $_POST['customer_id'] ?? '';
    $body = $_POST['body'] ?? '';

    $stmt = db()->prepare(
        'INSERT INTO notes (customer_id, body, created_by_name, created_at)
         VALUES (?, ?, ?, datetime(\'now\'))'
    );
    $stmt->execute([$cid, $body, auth_display_name()]);

    header('Location: notes.php?customer_id=' . urlencode($cid));
    exit;
}

$customer_id = $_GET['customer_id'] ?? '';

// Sprint 20. The desk wanted to see only the notes since a date. The date comes
// from the picker in the filter form and arrives in the query string.
$from = $_GET['from'] ?? '';

if ($from !== '') {
    $stmt = db()->prepare(
        'SELECT body, created_by_name, created_at
         FROM notes WHERE customer_id = ? AND created_at >= ? ORDER BY created_at'
    );
    $stmt->execute([$customer_id, $from]);
} else {
    $stmt = db()->prepare(
        'SELECT body, created_by_name, created_at
         FROM notes WHERE customer_id = ? ORDER BY created_at'
    );
    $stmt->execute([$customer_id]);
}
$notes = $stmt->fetchAll();

page_header('Call notes');
?>
<h2>Call notes</h2>

<form method="get" action="notes.php" class="filter">
  <input type="hidden" name="customer_id" value="<?= htmlspecialchars($customer_id, ENT_QUOTES, 'UTF-8') ?>">
  <label>Since <input type="text" id="from" name="from" value="<?= htmlspecialchars($from, ENT_QUOTES, 'UTF-8') ?>" placeholder="pick a date"></label>
  <button type="submit">Filter</button>
</form>
<script>
  // The picker takes over the Since field and fills it in YYYY-MM-DD form. The
  // date already in the query string is handed back to it so the field shows
  // the filter that is in effect.
  flatpickr('#from', { dateFormat: 'Y-m-d', defaultDate: <?= json_encode($from) ?> });
</script>

<ul class="notes">
  <?php foreach ($notes as $note): ?>
  <li>
    <p class="note-body"><?= $note['body'] ?></p>
    <p class="note-meta">
      <?= htmlspecialchars($note['created_by_name'], ENT_QUOTES, 'UTF-8') ?>
      &middot;
      <?= htmlspecialchars($note['created_at'], ENT_QUOTES, 'UTF-8') ?>
    </p>
  </li>
  <?php endforeach; ?>
</ul>

<h3>Add a note</h3>
<form method="post" action="notes.php">
  <input type="hidden" name="customer_id" value="<?= htmlspecialchars($customer_id, ENT_QUOTES, 'UTF-8') ?>">
  <label>Note <textarea name="body" rows="3"></textarea></label>
  <button type="submit">Save note</button>
</form>
<?php
page_footer();
