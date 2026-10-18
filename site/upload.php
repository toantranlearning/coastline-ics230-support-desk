<?php
/**
 * Attach a document to a customer record.
 *
 * Sprint 17. Customers started asking to attach signed forms to their account,
 * so the desk needed an upload. It stores the file under uploads/ and lists what
 * has been attached.
 *
 * Synopsis:      Upload a document for a customer, and list what is attached.
 * Preconditions: The caller is signed in.
 * Requirements:  customer_id, and a posted file field named document. The
 *                documents table and a writable uploads/ directory.
 * Impacts:       Saves the file to uploads/ and records a row on a POST, and
 *                lists the customer's documents.
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/layout.php';

auth_require_login();

$uploadDir = __DIR__ . '/uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$customer_id = $_GET['customer_id'] ?? ($_POST['customer_id'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    $file = $_FILES['document'];

    // Keep the name the browser sent so the download looks familiar to the rep.
    $name   = $file['name'];
    $target = $uploadDir . '/' . $name;
    move_uploaded_file($file['tmp_name'], $target);

    $stmt = db()->prepare(
        'INSERT INTO documents
           (customer_id, original_name, stored_name, byte_size, content_type, uploaded_by, uploaded_at)
         VALUES (?, ?, ?, ?, ?, ?, datetime(\'now\'))'
    );
    $stmt->execute([
        $customer_id, $name, $name, $file['size'], $file['type'], auth_display_name(),
    ]);

    header('Location: upload.php?customer_id=' . urlencode($customer_id));
    exit;
}

$stmt = db()->prepare(
    'SELECT original_name, stored_name, byte_size, uploaded_by, uploaded_at
     FROM documents WHERE customer_id = ? ORDER BY uploaded_at DESC'
);
$stmt->execute([$customer_id]);
$docs = $stmt->fetchAll();

page_header('Documents');
?>
<h2>Attached documents</h2>
<table>
  <tr><th>File</th><th>Size</th><th>Uploaded by</th><th>When</th></tr>
  <?php foreach ($docs as $d): ?>
  <tr>
    <td><a href="uploads/<?= rawurlencode($d['stored_name']) ?>"><?= htmlspecialchars($d['original_name'], ENT_QUOTES, 'UTF-8') ?></a></td>
    <td><?= (int) $d['byte_size'] ?> bytes</td>
    <td><?= htmlspecialchars($d['uploaded_by'], ENT_QUOTES, 'UTF-8') ?></td>
    <td><?= htmlspecialchars($d['uploaded_at'], ENT_QUOTES, 'UTF-8') ?></td>
  </tr>
  <?php endforeach; ?>
</table>

<h3>Attach a document</h3>
<form method="post" action="upload.php" enctype="multipart/form-data">
  <input type="hidden" name="customer_id" value="<?= htmlspecialchars($customer_id, ENT_QUOTES, 'UTF-8') ?>">
  <label>File <input type="file" name="document"></label>
  <button type="submit">Upload</button>
</form>
<?php
page_footer();
