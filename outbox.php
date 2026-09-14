<?php
/**
 * Mail outbox.
 *
 * Sprint 19. There is no mail server on this box yet, so anything the portal
 * would email is written to the outbox table, and the desk reads it here.
 *
 * Synopsis:      Show the messages the portal would have emailed.
 * Preconditions: The caller is signed in.
 * Requirements:  The outbox table.
 * Impacts:       Reads the outbox and renders it. No writes.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

auth_require_login();

$messages = db()
    ->query('SELECT to_address, subject, body, created_at FROM outbox ORDER BY created_at DESC')
    ->fetchAll();

page_header('Outbox');
?>
<h2>Mail outbox</h2>
<p>Messages the portal would have emailed. There is no mail server yet, so they land here.</p>
<?php if (!$messages): ?>
  <p>The outbox is empty.</p>
<?php else: ?>
  <?php foreach ($messages as $m): ?>
  <article class="mail">
    <p><strong>To:</strong> <?= htmlspecialchars($m['to_address'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Subject:</strong> <?= htmlspecialchars($m['subject'], ENT_QUOTES, 'UTF-8') ?></p>
    <pre><?= htmlspecialchars($m['body'], ENT_QUOTES, 'UTF-8') ?></pre>
    <p class="note-meta"><?= htmlspecialchars($m['created_at'], ENT_QUOTES, 'UTF-8') ?></p>
  </article>
  <?php endforeach; ?>
<?php endif; ?>
<?php
page_footer();
