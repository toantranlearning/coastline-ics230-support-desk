# lib/ helpers

Documented helpers to call rather than roll your own. Each function ships with a
header stating its synopsis, preconditions, requirements, and impacts. Read the
header, confirm the function fits what you need, and call it.

Some of these were written for one job and are reused here for another, so part
of the work is reading the contract and deciding whether it actually fits, the
same judgment you would make picking a function off a shelf.

| File | Functions | Used for |
|---|---|---|
| `passwords.php` | `pw_hash`, `pw_verify`, `pw_needs_rehash` | Authentication and password storage |
| `hmac.php` | `hmac_sign`, `hmac_verify` | Signing a value the client will hand back |
| `tokens.php` | `token_issue`, `token_check`, `token_burn` | One-time links, such as password reset |
| `query.php` | `q`, `q_one`, `q_all` | Any query that includes a value from a request |
| `crypto.php` | `enc_seal`, `enc_open` | Storing a value you must read back later |
