# Launch the two-copy TechCorp workspace

Launch the course repository in Google Cloud Shell using the course launch link. Use the same Google account on return visits and reopen the existing folder. From the workspace root, run:

```bash
bash scripts/start.sh
```

Wait for both startup messages. **Web Preview → Preview on port 8080** opens `site`, the original portal. For your working portal, choose **Web Preview → Change port**, enter **8081**, and open it. Keep the two tabs labeled by port; check the address before every test.

```text
site/       Original source: read and reproduce here; leave it unchanged.
fixed/      Working source: edit here; repairs accumulate throughout the term.
reports/    Reports, diagrams, and evidence; outside both served folders.
scripts/    Startup, save, comparison, and scoped reset helpers.
```

Both portals initially contain the same PHP, CSS, API, library, and seed files. Each creates its own `data/portal.sqlite`. Startup never copies one database or source tree over the other. Each server uses its own PHP session-cookie name. Sign in separately in each preview tab; use the supplied fictional `rmarsh` / `password` account. Never reuse these credentials elsewhere.

1. **Read:** open `site/` files and reproduce the assigned behavior on port 8080.
2. **Fix:** open the matching file under `fixed/` and make the assigned change. Save it.
3. **Prove:** run the hostile request against both ports; on 8081 also verify legitimate use. A syntax check such as `php -l fixed/router.php` checks parsing, not behavior.
4. **Report:** record actual commands and results in `reports/`. Download the report, evidence, and every changed source file from `fixed/`; submit them to Canvas as the assignment directs. Keep the repairs in `fixed/` for later modules.

## First setup exercise

Open both previews and sign in to each. Change only `fixed/layout.php` (`TechCorp Portal` to your own label) and `fixed/index.php` (`Customers` to `My Customers`). Reload both tabs. Port 8080 must remain original; port 8081 must show both edits. Capture the original, changed, and restored working views. After capturing the edits, restore just those two labels by editing the text back and saving. Do not reset the entire working copy. Your submitted files for this setup exercise are the two changed PHP files downloaded **before** restoring, the report, and the three captures.

## Returning and recovering

Run `bash scripts/start.sh` from the workspace root each session. It starts both copies and preserves their files and databases. `bash scripts/diff.sh` compares the two source trees. `bash scripts/save.sh "describe repair"` commits only working source; reports and runtime databases are excluded.

`bash scripts/reset.sh --baseline` asks before replacing **all of fixed/** with the original source and a fresh database. It preserves `site/` and `reports/` and keeps the previous `fixed/` under `.lab-runtime/` for recovery. Download work first. Restore an individual edit manually when possible so earlier repairs remain intact. Source Control's Discard All Changes is not a course reset.

## Existing single-folder workspace

Before updating an old checkout, download changed source files and reports. After updating to this layout, compare your saved changes with `fixed/` and reapply the intended repairs there. Old root-level PHP files or databases are not used by these servers. Startup does not delete duplicate checkouts, migrate unreviewed changes, or overwrite work. Contact the instructor if you are unsure which copy holds your work.

Only your own course portals are authorized for testing. Use manual browser or curl requests; do not run scanners. No paid trial or credit card is required.
