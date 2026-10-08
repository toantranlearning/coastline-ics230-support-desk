<?php
/**
 * Front router for the PHP built-in server.
 *
 * The built-in server has no configuration file, so the rules for which
 * request goes where live in this one script. scripts/start.sh hands it to the
 * server, and the server runs it at the start of every request.
 *
 * Synopsis:      Decide whether the server answers a request with the file that
 *                was asked for, with the home page, or with Not Found.
 * Preconditions: Started as `php -S 0.0.0.0:8080 router.php` from the project
 *                folder.
 * Requirements:  None.
 * Impacts:       Returning false tells the server to serve the requested file
 *                as it is. A request for something that does not exist gets a
 *                404. Add a routing rule for the portal here.
 */

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// The site root is the customer list.
if ($path === '/') {
    require __DIR__ . '/index.php';
    return true;
}

// Sprint 20. The partner API lives under api/, one script per resource, and
// partners call it without a .php extension: /api/customers runs
// api/customers.php, and /api/customers/7 runs the same script with "/7" left
// in PATH_INFO for the script to read.
if (preg_match('#^/api/([a-z][a-z0-9_-]*)(/.*)?$#', $path, $m)) {
    $script = __DIR__ . '/api/' . $m[1] . '.php';
    if (file_exists($script)) {
        $_SERVER['PATH_INFO'] = $m[2] ?? '';
        require $script;
        return true;
    }
    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No such resource']);
    return true;
}

// Anything that exists in the project folder is served as it is.
if (file_exists(__DIR__ . $path)) {
    return false;
}

http_response_code(404);
header('Content-Type: text/plain; charset=utf-8');
echo "Not found\n";
return true;
