<?php
/**
 * Database connection for the portal.
 *
 * SQLite keeps the data in one file, so operations never had to run a database
 * service for a tool this size. The file is built from seed.sql the first time
 * a page asks for a connection.
 */

// Show errors on the page so problems are easy to spot while the portal is new.
ini_set('display_errors', '1');
error_reporting(E_ALL);

/**
 * Synopsis:      Return the shared PDO connection, building the database on
 *                first use.
 * Preconditions: The data directory is writable.
 * Requirements:  data/seed.sql for the first run, and the pdo_sqlite extension.
 * Impacts:       Creates data/portal.sqlite on the first call and reuses a
 *                single connection for the rest of the request.
 */
function db(): PDO
{
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $file  = __DIR__ . '/data/portal.sqlite';
    $fresh = !file_exists($file);

    $pdo = new PDO('sqlite:' . $file);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if ($fresh) {
        $pdo->exec(file_get_contents(__DIR__ . '/data/seed.sql'));
    }

    return $pdo;
}
