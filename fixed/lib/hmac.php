<?php
/**
 * Keyed-hash (HMAC) signing and verification.
 *
 * Written first to sign webhook payloads, reused here for any short value the
 * server hands the client and later trusts back, such as a cookie or a form
 * field. It proves a value was issued by this server and not altered. It does
 * not hide the value (it is not encryption), and it does not expire on its own
 * (pair it with a timestamp or a stored record if you need that).
 *
 * The signing key comes from the environment, never from source. Set
 * TECHCORP_HMAC_KEY to a long random string.
 */

/**
 * Synopsis:      Return the signing key from the environment.
 * Preconditions: TECHCORP_HMAC_KEY is set.
 * Requirements:  The TECHCORP_HMAC_KEY environment variable, 16 or more chars.
 * Impacts:       Returns the key, or throws if it is missing or too short.
 */
function hmac_key(): string
{
    $key = getenv('TECHCORP_HMAC_KEY') ?: '';
    if (strlen($key) < 16) {
        throw new RuntimeException('TECHCORP_HMAC_KEY is missing or too short');
    }
    return $key;
}

/**
 * Synopsis:      Sign a value for handing to the client.
 * Preconditions: The signing key is set.
 * Requirements:  $value, the plaintext to protect from tampering.
 * Impacts:       Returns "value.signature". Throws if the key is missing.
 */
function hmac_sign(string $value): string
{
    $sig = hash_hmac('sha256', $value, hmac_key());
    return $value . '.' . $sig;
}

/**
 * Synopsis:      Verify a signed value and return it, or null.
 * Preconditions: The signing key is set.
 * Requirements:  $signed, a string produced by hmac_sign, as received back.
 * Impacts:       Returns the value if the signature holds, else null. Compares
 *                in constant time, so a caller cannot time the check.
 */
function hmac_verify(string $signed): ?string
{
    $dot = strrpos($signed, '.');
    if ($dot === false) {
        return null;
    }
    $value = substr($signed, 0, $dot);
    $sig   = substr($signed, $dot + 1);
    $good  = hash_hmac('sha256', $value, hmac_key());
    return hash_equals($good, $sig) ? $value : null;
}
