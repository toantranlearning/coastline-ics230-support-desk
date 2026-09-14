<?php
/**
 * One-time tokens for links that must be used once and then expire.
 *
 * Written for email-confirmation links, reused here for password reset. A token
 * is a long random string. Only its hash is stored, so a leak of the table does
 * not reveal a usable link. A token is valid until it expires or is burned,
 * whichever comes first, and burning is what makes it one-time.
 *
 * Needs a reset_tokens table (username, token_hash, expires_at, used_at) and the
 * global db().
 */

/**
 * Synopsis:      Issue a fresh token for a username and store its hash.
 * Preconditions: None.
 * Requirements:  $username, an optional $ttlSeconds (default 3600), and db().
 * Impacts:       Stores the token hash and returns the plaintext token once. It
 *                cannot be recovered later, so hand it to the caller now. Throws
 *                if secure randomness is unavailable.
 */
function token_issue(string $username, int $ttlSeconds = 3600): string
{
    $token   = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', time() + $ttlSeconds);
    $stmt = db()->prepare(
        'INSERT INTO reset_tokens (username, token_hash, expires_at, used_at)
         VALUES (?, ?, ?, NULL)'
    );
    $stmt->execute([$username, hash('sha256', $token), $expires]);
    return $token;
}

/**
 * Synopsis:      Return the username a token authorizes, or null.
 * Preconditions: None. Does not burn the token; call token_burn on success.
 * Requirements:  $token, the plaintext token from the link, and db().
 * Impacts:       Returns the username when the token is known, unexpired, and
 *                unused, else null. Looks it up by hash.
 */
function token_check(string $token): ?string
{
    $stmt = db()->prepare(
        'SELECT username FROM reset_tokens
         WHERE token_hash = ? AND used_at IS NULL AND expires_at > ?'
    );
    $stmt->execute([hash('sha256', $token), date('Y-m-d H:i:s')]);
    $row = $stmt->fetch();
    return $row ? $row['username'] : null;
}

/**
 * Synopsis:      Retire a token so it cannot be used again.
 * Preconditions: Call it the moment the protected action completes.
 * Requirements:  $token, the plaintext token to retire, and db().
 * Impacts:       Marks the token used.
 */
function token_burn(string $token): void
{
    $stmt = db()->prepare('UPDATE reset_tokens SET used_at = ? WHERE token_hash = ?');
    $stmt->execute([date('Y-m-d H:i:s'), hash('sha256', $token)]);
}
