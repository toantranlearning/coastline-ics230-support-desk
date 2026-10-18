<?php
/**
 * Authenticated encryption for values you must read back.
 *
 * For data that has to be recovered later, unlike a password, which is only ever
 * verified. An example is a stored tax identifier. Uses libsodium's
 * XChaCha20-Poly1305 AEAD: the ciphertext is bound to a fresh random nonce and
 * to optional associated data, and any tampering is caught on open. A version
 * tag is prepended so the format can change later without ambiguity.
 *
 * The key comes from the environment, never source. Generate one with
 *   php -r 'echo sodium_bin2base64(sodium_crypto_aead_xchacha20poly1305_ietf_keygen(), SODIUM_BASE64_VARIANT_ORIGINAL);'
 * and set it as TECHCORP_DATA_KEY.
 */

const ENC_VERSION = 'v1';

/**
 * Synopsis:      Return the data key from the environment.
 * Preconditions: TECHCORP_DATA_KEY is set to a valid key.
 * Requirements:  The TECHCORP_DATA_KEY environment variable.
 * Impacts:       Returns the raw key, or throws if it is missing or the wrong
 *                length.
 */
function enc_key(): string
{
    $b64 = getenv('TECHCORP_DATA_KEY') ?: '';
    $key = $b64 === '' ? '' : sodium_base642bin($b64, SODIUM_BASE64_VARIANT_ORIGINAL);
    if (strlen($key) !== SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES) {
        throw new RuntimeException('TECHCORP_DATA_KEY is missing or the wrong length');
    }
    return $key;
}

/**
 * Synopsis:      Encrypt a value for storage.
 * Preconditions: The data key is set.
 * Requirements:  $plaintext, and an optional $aad bound to the ciphertext but
 *                not encrypted (for example the row id), so a ciphertext cannot
 *                be moved to another row.
 * Impacts:       Returns a self-describing "v1.nonce.ciphertext" string, safe in
 *                a text column. Throws if the key is missing or malformed.
 */
function enc_seal(string $plaintext, string $aad = ''): string
{
    $key   = enc_key();
    $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
    $cipher = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt($plaintext, $aad, $nonce, $key);
    return ENC_VERSION
        . '.' . sodium_bin2base64($nonce, SODIUM_BASE64_VARIANT_ORIGINAL)
        . '.' . sodium_bin2base64($cipher, SODIUM_BASE64_VARIANT_ORIGINAL);
}

/**
 * Synopsis:      Decrypt a value produced by enc_seal.
 * Preconditions: The data key is set.
 * Requirements:  $sealed, and the same $aad that was passed to enc_seal.
 * Impacts:       Returns the plaintext, or null if the input is malformed or was
 *                tampered with (the authentication tag fails). Never returns
 *                altered data.
 */
function enc_open(string $sealed, string $aad = ''): ?string
{
    $parts = explode('.', $sealed, 3);
    if (count($parts) !== 3 || $parts[0] !== ENC_VERSION) {
        return null;
    }
    $nonce  = sodium_base642bin($parts[1], SODIUM_BASE64_VARIANT_ORIGINAL);
    $cipher = sodium_base642bin($parts[2], SODIUM_BASE64_VARIANT_ORIGINAL);
    $plain  = sodium_crypto_aead_xchacha20poly1305_ietf_decrypt($cipher, $aad, $nonce, enc_key());
    return $plain === false ? null : $plain;
}
