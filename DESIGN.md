# TechCorp Customer Portal Design

*Written sprint 9, updated sprint 19. Owner: the portal team.*

An internal tool for the customer-support desk. Reps look up a customer, read
the account details, and record what happened on a call.

## Scope

In scope: customer lookup, account details, call notes, staff sign-in, and a
self-service password reset. Out of scope: anything customer-facing. The portal
is reachable only from the internal network and is never exposed publicly.

## Architecture

Plain PHP, one file per page, no framework. A page requires the three shared
includes (`db.php`, `auth.php`, `layout.php`), does its work, and renders.

Storage is SQLite in a single file, created on first run from `data/seed.sql`.
This was chosen so operations would not have to run a database service for an
internal tool of this size.

## Authentication

Staff sign in with a username and password. **Passwords are stored hashed,
never in the clear.** Accounts moved into a `users` table in sprint 18; they
used to live in a `data/users.json` file, and were brought into the database so
the desk tools could join against them.

Sessions are handled by PHP. The signed-in user's role is carried alongside the
session so pages can show or hide the administrative navigation.

Reps who lock themselves out use the self-service reset, which confirms identity
with the security question on the account before letting them set a new
password.

## Authorization

Every page that is not the sign-in page calls `auth_require_login()` before
doing anything else, so **unauthenticated users cannot reach application
data.**

Customers are assigned to a rep. **A rep works with their own customers**, and
notes are attributed to whoever wrote them.

## Data protection

Account records include a tax identifier, which the desk needs in order to
verify a caller. **Sensitive fields are handled with care and are not exposed
beyond the pages that require them.**

## Input handling

**Values arriving from the browser are checked before use**, and output is
written so that the browser displays it as text.

## Deployment

The application is served by the PHP built-in server. The `data/` directory
holds the database and the seed file; **these are supporting files rather than
pages and are not part of the served application.**

## Known limitations

Written honestly, because the next person will find these anyway:

- There is no audit trail. If someone asks who changed a record last month, we
  cannot answer.
- Sign-in has no lockout or rate limit. A slow guessing attempt would not be
  noticed.
- The password reset trusts the security question, and the answers are not
  exactly secret.
- There is no automated test suite. Changes are checked by hand.
- The date picker on the notes filter is loaded from a public CDN. It was the
  quickest way to get one and has not been reviewed.

## Open questions for whoever picks this up

- The role travels in a cookie so the navigation can read it without a query.
  Is that the right place for it?
- The notes table records the author's display name rather than joining to the
  user. This seemed simpler at the time.
