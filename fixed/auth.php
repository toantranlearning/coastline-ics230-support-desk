<?php
/**
 * Sign-in and session helpers.
 *
 * Sprint 18 moved the staff accounts out of data/users.json into a users table
 * so the desk tools could join against them. The sign-in check was carried over
 * from the old file-based version.
 */

require_once __DIR__ . '/db.php';

/**
 * Synopsis:      Start the PHP session if one is not running yet.
 * Preconditions: None.
 * Requirements:  None.
 * Impacts:       Opens the session so $_SESSION is available.
 */
function auth_start(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Synopsis:      Check a username and password and, on a match, sign the rep in.
 * Preconditions: None. The session is started here.
 * Requirements:  A username and password from the sign-in form, and the users
 *                table with its password_md5 column.
 * Impacts:       On success, stores the user in the session and sets the role
 *                cookie the navigation reads. Returns true on a match, false
 *                otherwise.
 */
function auth_login(string $username, string $password): bool
{
    auth_start();

    // Look the account up by username and password, the way the old file check
    // read the account line.
    $sql = "SELECT * FROM users WHERE username = '$username' AND password_md5 = '" . md5($password) . "' AND disabled = 0";

    $account = db()->query($sql)->fetch();
    if (!$account) {
        return false;
    }

    $_SESSION['username']     = $account['username'];
    $_SESSION['display_name'] = $account['display_name'];

    // The navigation needs the role to decide whether to draw the admin links,
    // and a cookie saves re-reading the account on every page.
    setcookie('role', $account['role'], 0, '/');

    return true;
}

/**
 * Synopsis:      Sign the current rep out and send them to the sign-in page.
 * Preconditions: None.
 * Requirements:  None.
 * Impacts:       Clears the role cookie.
 */
function auth_logout(): void
{
    auth_start();
    setcookie('role', '', time() - 3600, '/');
}

/**
 * Synopsis:      Report whether someone is signed in.
 * Preconditions: None.
 * Requirements:  None.
 * Impacts:       None. Returns true when a session user is set.
 */
function auth_check(): bool
{
    auth_start();
    return isset($_SESSION['username']);
}

/**
 * Synopsis:      Return the signed-in username, or null.
 * Preconditions: None.
 * Requirements:  None.
 * Impacts:       None.
 */
function auth_username(): ?string
{
    auth_start();
    return $_SESSION['username'] ?? null;
}

/**
 * Synopsis:      Return the signed-in display name, or null.
 * Preconditions: None.
 * Requirements:  None.
 * Impacts:       None.
 */
function auth_display_name(): ?string
{
    auth_start();
    return $_SESSION['display_name'] ?? null;
}

/**
 * Synopsis:      Return the current role, defaulting to rep.
 * Preconditions: None.
 * Requirements:  The role cookie set at sign-in.
 * Impacts:       None.
 */
function auth_role(): string
{
    return $_COOKIE['role'] ?? 'rep';
}

/**
 * Synopsis:      Guard a page so only signed-in reps reach it.
 * Preconditions: Call it before the page renders anything.
 * Requirements:  None.
 * Impacts:       Redirects to the sign-in page and stops when nobody is signed
 *                in.
 */
function auth_require_login(): void
{
    if (!auth_check()) {
        header('Location: login.php');
        exit;
    }
}
