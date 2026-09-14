<?php
/**
 * Password hashing and verification.
 *
 * Wraps PHP's password_* functions at the current recommended defaults, so a
 * caller never picks an algorithm or a cost. A stored hash is self describing:
 * it carries its own algorithm and parameters, so verifying needs only the hash
 * and the candidate password.
 */

/**
 * Synopsis:      Hash a plaintext password for storage.
 * Preconditions: $password is the chosen password, not yet stored.
 * Requirements:  $password, one or more characters.
 * Impacts:       Returns an algorithm-tagged hash safe to store as is. Throws
 *                RuntimeException if hashing fails, never returns false quietly.
 */
function pw_hash(string $password): string
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    if (!is_string($hash)) {
        throw new RuntimeException('password_hash failed');
    }
    return $hash;
}

/**
 * Synopsis:      Check a candidate password against a stored hash.
 * Preconditions: $hash came from pw_hash or any password_hash call.
 * Requirements:  $password, the candidate typed by the user, and $hash to check
 *                against.
 * Impacts:       Returns true only on a match, compared in constant time.
 *                Returns false for any non-match, including a malformed hash.
 */
function pw_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * Synopsis:      Say whether a stored hash should be re-hashed at the current
 *                defaults.
 * Preconditions: Call it after a successful pw_verify.
 * Requirements:  $hash that just verified.
 * Impacts:       Returns true when the hash predates the current defaults. Then
 *                hash again with pw_hash and store the new value, so accounts
 *                strengthen as their owners sign in.
 */
function pw_needs_rehash(string $hash): bool
{
    return password_needs_rehash($hash, PASSWORD_DEFAULT);
}
