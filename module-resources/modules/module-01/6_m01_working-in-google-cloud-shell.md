# Working in Google Cloud Shell

[First time: Set up and launch](https://shell.cloud.google.com/cloudshell/open?cloudshell_git_repo=https://github.com/toantranlearning/coastline-ics230-support-desk&cloudshell_tutorial=TUTORIAL.md){button} [Returning: Open my Cloud Shell](https://shell.cloud.google.com/){button}

Sign in to Google first. On your first visit, use **Set up and launch** and confirm any welcome or repository-trust prompts. On later visits, use **Open my Cloud Shell** with the same Google account. No paid trial or credit card is required.

## Your three folders

- **site/** contains the original portal. Read and reproduce the starting defect here; leave its files unchanged.
- **fixed/** contains your working portal. Make repairs here and retain them across the term.
- **reports/** holds saved command output and working evidence, outside both served portals. Your Word report is downloaded from Canvas and edited separately in Word or Word Online.

Each portal has its own database under its own `data/` directory. The starting credentials are the same, but sign in separately to each portal. Your Google sign-in opens Cloud Shell; the fictional portal account opens the application.

## Launch both portals

1. Open the course workspace in the editor. If only the terminal is visible, select **Open Editor**.
2. Find the workspace folder containing `site`, `fixed`, `reports`, and `scripts`. Right-click that folder and choose **Open in Integrated Terminal**.
3. In that terminal, run the command below and press **Enter**. Run it from the workspace root, not inside `site/` or `fixed/`.

```bash
bash scripts/start.sh
```

4. Wait for both messages:

```text
site portal is running on port 8080.
fixed portal is running on port 8081.
```

5. Select **Web Preview → Preview on port 8080** for the original site.
6. Select **Web Preview → Change port**, enter **8081**, and click **Change and Preview** for your working copy. Keep both tabs and check the port in each address before testing.
7. Sign in separately to each using the account specified by the assignment. For ordinary customer exercises use `rmarsh` / `password`.

Startup preserves both source trees and their separate databases. Ports 8080 and 8081 are reserved for the course portals. Startup stops any processes using these ports, including servers left by older checkouts, before launching both copies. Include the relevant `.lab-runtime/site.log` or `.lab-runtime/fixed.log` error when asking for help.

## Read, fix, prove, report

Read and reproduce on **site, port 8080**. Edit the corresponding file in **fixed/**. Save, reload **fixed, port 8081**, and run both the hostile and legitimate-use checks. Save command evidence in `reports/`, then paste the relevant output and screenshots into your Word report. Download the required complete changed source files and supplied `assignment.md`; upload them with your report to Canvas.

Paths such as `customer.php` in a lecture describe a file within a portal. Open `site/customer.php` to inspect the original and `fixed/customer.php` to repair it. Terminal commands run from the workspace root must include the folder, for example:

```bash
php -l fixed/customer.php
```

A syntax check does not establish that a repair works. Record behavior on the correct port as the assignment directs. Existing repairs stay in `fixed/` for later modules.

## Returning, saving, and resetting

Reopen the existing workspace, run the startup command, and reopen both previews. Keep reports and an independent copy of submitted work; Canvas is the lasting submission record.

- `bash scripts/diff.sh` compares original and working source.
- `bash scripts/save.sh "describe repair"` saves working source in Git; it does not submit to Canvas.
- For a single accidental edit, restore just that text in `fixed/` and save.
- `bash scripts/reset.sh --baseline` confirms before replacing **all of fixed/** from `site/` and resetting its database. Earlier repairs would be lost from the active working copy. It keeps the previous folder under `.lab-runtime/`, preserves `reports/` and `site/`, and tells you where the recovery copy is. Download work first and rerun startup afterward.

Do not use **Discard All Changes** to reset the lab; it can discard unrelated repairs. Keep the original `site/` unchanged so it remains a reliable comparison.

## Moving from the old single-folder layout

Download existing source edits and reports before updating the repository. Reapply intended changes to `fixed/` after comparing them with the new source. Root-level legacy files are not served by the new launcher. Startup preserves them rather than silently migrating or deleting work. Ask the instructor for help if you are unsure which copy contains your repairs.

## Gemini code assistance

Gemini can help explain a function, draft a focused code change, or propose tests. AI-generated code is permitted on practice work and project builds under the syllabus policy. You are responsible for reviewing, testing, and explaining the code you use.

### Choose an available route

**In Cloud Shell Editor:** if Gemini Code Assist is already configured for your account, open a source file, select the relevant function, and open the Gemini chat control next to the search bar. Paste the learning-coach instructions, then describe the behavior you need. Google documents a project-selection and API-enablement step for this integration. Follow your institution's approved setup if one is supplied; this course does not require you to purchase an AI subscription or enable paid services.

**In a separate browser tab:** use [Gemini web chat](https://gemini.google.com/) if available to your account. Paste the learning-coach instructions at the beginning of a conversation, followed by a small course-code excerpt and your question. Review any proposed change before copying it into Cloud Shell. A saved Gem is optional. The web chat does not automatically see your editor, files, or terminal results. If Gemini is unavailable, continue with the lecture, PHP Manual, and instructor support; paid AI access is not required.

Google's [Cloud Shell Code Assist guide](https://docs.cloud.google.com/code/docs/shell/write-code-gemini) describes the editor integration. The Gemini Learning Coach page supplies the course instructions to paste into either route; a saved Gem does not automatically configure the Cloud Shell extension.

### Try a focused learning request

Use an example function from the lecture, rather than asking the tool to replace the entire application. Supply the field's actual rules.

```text
I am practicing input validation in PHP. Here is my current function.
The field accepts whole-number quantities from 1 through 25.
Explain the current behavior, propose a small change if needed,
and explain each changed line. Give expected results for missing,
array-shaped, out-of-range, and valid inputs. Do not claim you ran tests.
Ask me to predict one result before revealing its expected value.
```

Before applying the proposal, explain what you expect to change. Inspect the diff in the Source Control panel, then run a syntax check on the changed file. For example, from the project folder:

```bash
php -l fixed/customer.php
```

The expected syntax-check output is `No syntax errors detected in customer.php`. A clean syntax check means PHP can parse the file; it does not prove the security fix works. Send the assignment's hostile input and a legitimate input to your own portal, record the actual results, and compare them with your prediction. A proposed test remains a proposal until you run it.

> [!NOTE] Keep the record in your submission
> Disclose the AI help, describe what you changed, and include your own evidence. Canvas submissions remain the lasting record of finished work.

Disable AI chat and inline suggestions during unaided assessments. Do not share real credentials, personal data, or protected assessment prompts. Ask before running a generated command you cannot explain, especially one that deletes files, installs tools, or tests another system. The lab's no-scanner rule still applies.


## Authorized testing

Test only your own portal copies using manual browser or individual curl requests. Follow the [Rules Of Engagement](18_m01_rules-of-engagement.html); scanners and attack tools are not part of this environment. When asking for help, include the action, which copy and port, and the exact error without account details or secrets.
