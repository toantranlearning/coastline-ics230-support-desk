<?php
/**
 * Sign-out.
 *
 * Synopsis:      Sign the rep out and return them to the sign-in page.
 * Preconditions: None.
 * Requirements:  None.
 * Impacts:       Signs the rep out, then redirects to login.php.
 */

require_once __DIR__ . '/auth.php';

auth_logout();

header('Location: login.php');
