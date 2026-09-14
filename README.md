# TechCorp Customer Portal

[![Open in Cloud Shell](https://gstatic.com/cloudssh/images/open-btn.svg)](https://shell.cloud.google.com/cloudshell/open?cloudshell_git_repo=https://github.com/toantranlearning/coastline-ics230-support-desk&cloudshell_tutorial=TUTORIAL.md)


The internal portal the customer-support team uses to look up customers and log
call notes. Plain PHP and SQLite, no framework and no build step.

## Running it

You need **PHP 8.2 or newer**. Nothing else: no Composer, no framework, no
container runtime. The database is a SQLite file created on first run.

```
./scripts/start.sh
```

That starts the app on port 8080 in the background, so your terminal stays free.
In Cloud Shell, click **Web Preview** (top right) and choose **Preview on port
8080**. Working locally instead, open <http://127.0.0.1:8080/>.

`start.sh` gets your copy ready (adds the database driver Cloud Shell needs and
keeps a single working copy) and starts the server. Run it each time you open the
project; it only does the setup that is still needed.

## Signing in

| Username | Password | Role |
|---|---|---|
| `rmarsh` | `password` | rep |
| `lchen` | `123456` | rep |
| `dpatel` | `12345678` | admin |
| `sformer` | `12345` | rep (disabled) |

These are development fixtures. Do not reuse them anywhere, and do not put real
customer data or real passwords into a development copy.

## Saving and resetting your work

Every change stays in your own copy. Two helpers wrap version control so you
never touch it directly:

```
./scripts/save.sh "parameterized the search query"   # save a checkpoint you can return to
./scripts/reset.sh                                    # undo unsaved changes
./scripts/reset.sh --checkpoint <name>                # restore a saved checkpoint
./scripts/reset.sh --baseline                         # back to the original
./scripts/nukeitall.sh                                # remove every copy and fetch a fresh one
```

`reset.sh` also deletes `data/portal.sqlite`, which rebuilds from `data/seed.sql`
the next time you open a page, so a reset restores the data too.

## Layout

```
index.php          customer list, the home page
login.php          sign in
logout.php         sign out
reset-password.php self-service password reset
customer.php       customer search and account detail
notes.php          call notes for a customer
upload.php         attach a document to a record
admin.php          the account audit, for admins
profile.php        the signed-in user's own record
outbox.php         mail the portal would have sent (no mail server here)
db.php             database connection, shared
auth.php           sign-in and session helpers, shared
layout.php         the page shell, shared
portal.css         styles
data/              seed.sql and the generated database
lib/               shared helper functions (see lib/README.md)
scripts/           start, reset, save, diff, and reprovision helpers
```

## Notes

Internal tool, for development use. Do not put real customer data or real
passwords in a development copy, and run it only in your own environment.
