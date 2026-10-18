# M01 - Launch Course Environment

## What you are doing, and why

Set up two copies of the TechCorp portal: **site** is the original you read and compare, and **fixed** is the working copy you change throughout the term. Practice the read, change, prove, report routine with two harmless labels. Plan about an hour.

## Step 1: Launch Google Cloud Shell

1. Sign in to your Google account in this browser.
2. First visit: click [Launch Google Cloud Shell with the course files](https://shell.cloud.google.com/cloudshell/open?cloudshell_git_repo=https://github.com/toantranlearning/coastline-ics230-support-desk&cloudshell_tutorial=TUTORIAL.md). Accept the welcome and repository-trust prompts if shown. No credit card or paid trial is needed.
3. Returning: [open your existing Cloud Shell](https://shell.cloud.google.com/) with the same account. Keep using that copy rather than launching another clone.
4. Select **Open Editor** if needed. Locate the workspace folder containing `site`, `fixed`, `reports`, and `scripts`. Right-click the workspace folder and choose **Open in Integrated Terminal**.
5. Type the following and press **Enter**:

```bash
bash scripts/start.sh
```

6. Wait for both startup messages and copy your actual messages for the report:

```text
site portal is running on port 8080.
fixed portal is running on port 8081.
```

For missing folders, an occupied port, or an older workspace, follow the [Cloud Shell Guide](../module-01/6_m01_working-in-google-cloud-shell.html). Your own two portal copies are the only authorized targets.

![Workspace map identifying original and fixed folders, editor, terminal, reports, and preview ports](m01-workspace-map.svg)

*Workspace map: a simplified instructional diagram, not a Cloud Shell screenshot. Commands and labels remain written in the steps above.*

## Step 2: Read the original and open the working copy

1. Choose **Web Preview → Preview on port 8080**. This is **site**, the original.
2. Sign in with username `rmarsh` and password `password`. These fictional portal credentials are separate from your Google account.
3. Check for **TechCorp Portal** in the top bar and **Customers** as the heading. Take **Capture 1**, saved as `m01-setup-before.png`.
4. Return to Cloud Shell. Choose **Web Preview → Change port**, enter **8081**, and click **Change and Preview**. This is **fixed**, your working copy. Sign in separately with the same fictional credentials.
![Cloud Shell Web Preview menu showing the selected port and Change port](m01-cloud-shell-preview-menu.jpg)

*Actual Cloud Shell controls: the Preview label remembers the last selected port (8081 here). Use Change port to select 8080 for site or 8081 for fixed.*

![Change Preview Port dialog with Port Number set to 8081](m01-cloud-shell-port-8081.jpg)

*Enter 8081, then select Change and Preview to open fixed.*

5. Check that both copies initially show the same labels. Keep both tabs open and check their ports before reloading or testing.
6. In the editor, open `site/layout.php` and `site/index.php` to read the original labels. Leave these files unchanged.

![Actual original portal customer list showing TechCorp Portal and Customers](m01-portal-original.jpg)

*Reference screenshot from the local course portal: look for TechCorp Portal in the top bar and Customers above the table. Use your own captures in your submission.*

## Step 3: Change only the working copy

1. Open `fixed/layout.php`. Use **Ctrl+F** (**Cmd+F** on a Mac) to find:

```html
<span class="brand">TechCorp Portal</span>
```

2. Replace only `TechCorp Portal` with your own label, such as `Rae's Support Desk`. Keep the HTML tags and save with **Ctrl+S** (**Cmd+S** on a Mac).
3. Open `fixed/index.php`. Find `<h2>Customers</h2>` and change it to:

```html
<h2>My Customers</h2>
```

4. Save. From the workspace-root terminal, check both files:

```bash
php -l fixed/layout.php
php -l fixed/index.php
```

5. Resolve any syntax errors. Successful checks say `No syntax errors detected`; you still need the browser comparison below.

![Actual Cloud Shell editor with fixed/layout.php open and the brand label at line 34](m01-cloud-shell-edit-label.jpg)

*Actual Cloud Shell editor: fixed is expanded in the file list, with layout.php selected and its brand span visible. Change only the TechCorp Portal text inside the brand span. Your workspace folder name may differ.*

## Step 4: Prove the copies are separate

1. Reload **fixed, port 8081**. Confirm both your custom label and **My Customers** appear. Save **Capture 2** as `m01-setup-changed.png`.
2. Reload **site, port 8080**. Confirm it still shows **TechCorp Portal** and **Customers**. Record this comparison in your report.
3. Before restoring the labels, right-click `fixed/layout.php` in the editor file list and choose **Download**. Do the same for `fixed/index.php`. These are the changed source files you will submit. Keep them in a local folder named `changed-code` so you can distinguish them from restored files.

## Step 5: Restore only the two practice labels

1. In `fixed/layout.php`, replace your label with `TechCorp Portal` and save.
2. In `fixed/index.php`, change `My Customers` back to `Customers` and save.
3. Reload **fixed, port 8081**. Save **Capture 3** as `m01-setup-restored.png`, showing the original labels again.
4. Check that **site, port 8080** remains unchanged. Restore only these practice labels by editing; a full reset would discard other repairs.

This setup exercise restores its cosmetic edits after you download the changed source. Later security repairs stay in `fixed/` across the term.

## Step 6: Report and submit

1. Copy the short supplied worksheet into `reports/`:

```bash
cp assignments/early-reports/m01-setup-starter.md reports/m01-setup.md
```

2. Open `reports/m01-setup.md` and replace the bracketed prompts. A [downloadable report starter](report-starters/m01-setup-starter.md) is also available here.
3. Use brief answers: the two startup messages, both syntax results, two sentences comparing the copies, and a two-sentence reflection. Keep the supplied image references and fill in your disclosure. No full incident form or essay is required.
4. Save the three captures using the supplied filenames. Keep them alongside your downloaded report.
5. Save the report. Use the command palette (**Ctrl+Shift+P**, or **Cmd+Shift+P** on a Mac) to open **Markdown: Open Preview**. Check headings and code blocks. Local screenshots will not appear in Cloud Shell until uploaded there; keep them alongside your downloaded report.
6. Right-click the report and choose **Download**. See [Writing in Markdown](../module-01/8_m01_writing-in-markdown.html) for formatting and file download help.
7. In Canvas, choose **Start Assignment** (or **New Attempt**) and upload all six files below. Use the PHP downloads saved **before** restoring the labels. Select **Submit Assignment** and check the confirmation and filenames.

If blocked, record the exact action, which copy and port, and the error. Contact the instructor through Canvas Inbox or course Q&A; report only results you actually observed.

Open notes and open book are both fine. Respond in your own words; do not copy from other sources.

**AI use on this assignment.** The syllabus policy governs; these are its terms for a setup lab.

> [!CORRECT] Permitted, with disclosure
> - Asking an AI to explain a concept, an OWASP guideline, or a PHP error message in general terms.
> - A grammar or spelling checker on your own writing.
> - Generating or refactoring code, proposing tests, and planning or editing the report, with disclosure of the tool, help requested, material used or changed, and checks performed. Report only results you observed.

> [!CRITICAL] Not permitted
> - Submitting AI-generated code, analysis, or writing without disclosing it.
> - Pointing an AI-assisted tool at any target other than your own course environment.

You must be able to explain every line you submit, on request. Undisclosed AI use is handled as academic dishonesty under the syllabus.

## Expected output

- Both portals start and allow the fictional representative to sign in.
- Only `fixed/` shows the two label changes; `site/` stays original.
- Both changed PHP files pass syntax checks and are downloaded before restoration.
- The working labels are restored after the comparison, with three captures documenting the exercise.
- The report explains the two copies and contains actual startup and syntax results.

## What to submit

Upload all six files:

- `m01-setup.md`
- Changed `layout.php`, downloaded from `fixed/` before restoring the label
- Changed `index.php`, downloaded from `fixed/` before restoring the heading
- `m01-setup-before.png`
- `m01-setup-changed.png`
- `m01-setup-restored.png`

At the top of the report, complete:

```text
NAME: First Last
AI DISCLOSURE: What you asked an AI and what you used, or "None."
REFLECTION: Two or three sentences: what you set up, what was
difficult, and what you learned.
```
