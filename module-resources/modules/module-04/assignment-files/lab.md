# M03 - Assignment: Fix Customer Search Rendering

## The problem and your objective

The search page treats a stored customer name as HTML: `<b>Test Account</b>` appears bold instead of displaying its angle brackets. Your job is to make the browser display customer data as text and refuse invalid search inputs. This practices input validation and output encoding under **OWASP Top 10:2025 A05 Injection**.

You will read, reproduce, fix, prove, and report. Module 3 adds two small decisions: choose an allow-list for names and identify the output expressions that need encoding. Setup, test inputs, and report prompts are supplied. Plan about two hours, with extra time for debugging if needed.

## The supplied incident: TC-IR-002

A representative reported the bold customer name and an error when searching for `O'Brien`. These are fictional supplied case facts. Your own evidence comes from the tests below.

**Repair scope:** fix HTML rendering and search-input validation in `fixed/customer.php`. The SQL query's handling of apostrophes is a separate flaw for the next module. Leave the query unchanged and record that limitation. Keep Module 2's `fixed/router.php` stopgap.

## Step 1: Launch the workspace

1. [Open Google Cloud Shell](https://shell.cloud.google.com/) with the same account as before. Open your existing course folder containing `site`, `fixed`, `reports`, and `scripts`.
2. Select **Open Editor** if needed. Right-click the course folder and choose **Open in Integrated Terminal**.
3. Paste this command in the terminal and press **Enter**:

```bash
bash scripts/start.sh
```

4. Wait for both startup messages. Open **Web Preview → Preview on port 8080** for the original site. Use **Web Preview → Change port → 8081** for fixed.
5. Sign in separately to each with username `rmarsh` and password `password`. Check the port before testing. Read original files in `site/`; edit only `fixed/`.
6. Copy the supplied report from the workspace root:

```bash
cp assignments/incident-reports/m03-tc-ir-002-starter.md reports/m03-tc-ir-002.md
```

7. Open `reports/m03-tc-ir-002.md` in the editor. Fill in your name, date/time zone, and disclosure. A [downloadable starter](m03-tc-ir-002-starter.md) is also available here.

For startup help, use the [Cloud Shell Guide](../module-01/6_m01_working-in-google-cloud-shell.html). Test only your own portals under the [Rules Of Engagement](../module-01/18_m01_rules-of-engagement.html).

## Step 2: Reproduce the rendering problem

1. In the **8080** preview address bar, keep the existing host and replace the path after it with `/customer.php`. Press **Enter**. You should see **Customer lookup** and a Search box.
2. Type `Test` in the Search box and click **Search**. Find the customer named Test Account. Its name should appear bold, without visible `<b>` tags.
3. Take a screenshot and save it as `m03-before.png`. Add the filename in report section 7's evidence column. Record what you actually see.
4. Click **Customers** in the navigation. The same name should show its literal `<b>` tags. This comparison shows that one page already handles the stored name safely.
5. Open `site/index.php` in the editor. Search for `display_name` and find the expression using `htmlspecialchars`. Open `site/customer.php` and find the name inside the results link. In report section 5, explain the difference in one sentence.

**Instructional image:** Actual original customer search for Test showing Test Account as bold text without visible markup tags.

*Reference screenshot from the local original portal: the stored name renders as bold text. After your repair, its literal angle brackets must be visible. Collect your own before-and-after evidence.*

## Step 3: Locate the input and outputs

1. Open **fixed/customer.php**. Use **Ctrl+F** (**Cmd+F** on a Mac) to find `$_GET['q']`. This is the search term arriving from the browser.
2. Find these four expressions and fill in the supplied table in report section 5. Record their line numbers from your editor; line numbers change as you edit.

| Find | What the destination does |
|---|---|
| `value="<?= $q ?>"` | Puts the term into a quoted HTML attribute |
| `Results for <?= $q ?>` | Puts the term into HTML text |
| `<?= $row['display_name'] ?>` | Puts a stored name into HTML text |
| `customer.php?id=<?= $row['id'] ?>` | Puts the record ID into a URL inside a quoted attribute |

3. In the table, name the interpreter for these page outputs. Also record the SQL query as a separate sink whose repair is deferred. The browser-to-server request crosses a trust boundary; stored database values still need safe output handling.

## Step 4: Validate the search term

1. Find the existing `$q = $_GET['q'] ?? '';` assignment (spacing may differ). Replace that input-handling statement with validation before `page_header('Customers')` and before any query or output uses `$q`. Keep `$id` handling and the query unchanged.
2. Use lecture section 4's validation examples and the PHP companion. Follow this order: read the raw value; verify it is a string; trim it; check character length; check the allowed characters. A failed check must return **400** with a short generic message and stop processing.
3. Allow a missing or blank term to open the lookup form without running a search. For a nonempty trimmed term, require **1–40 characters**. Use `mb_strlen` with UTF-8 so accented letters count as characters.
4. Choose your allow-list pattern. It must accept letters (including accented letters), digits, spaces, apostrophes, hyphens, and periods; it must reject markup characters such as `<` and `>`. Anchor the whole input. The PHP companion explains Unicode letter classes and the UTF-8 modifier. Write your pattern and one sentence explaining it in report section 6.
5. Reject array-shaped input before calling `trim` or measuring length. An address containing `q[]=Test` sends an array, not a string. Do not cast it to a string or let it produce a warning.
6. Save your file. Do not add a browser-only check as the security control: a requester can bypass it.

## Step 5: Encode the outputs

1. Return to the three HTML text/attribute expressions that print `$q` or the stored display name. At each output, use `htmlspecialchars` with `ENT_QUOTES | ENT_SUBSTITUTE` and `'UTF-8'`. The safe name output in `site/index.php` is a starting example; include both required flags in your repair.
2. Apply encoding where the value is printed. Do not replace the raw search term with an HTML-encoded version before validation or querying.
3. For the record ID in the results link, choose a representation appropriate for an integer ID, then keep the `href` quoted. Use the lecture's URL-versus-HTML explanation to justify the expression in your section-5 table. Do not modify the account query in this module.
4. Save with **Ctrl+S** (**Cmd+S** on a Mac). In the workspace-root terminal, run:

```bash
php -l fixed/customer.php
```

5. Expect `No syntax errors detected in fixed/customer.php`. If PHP names a line with an error, inspect that line and the line immediately before it, correct the syntax, save, and rerun. Paste the actual result into report section 7.

## Step 6: Prove the repair

Run these checks in the **8081** preview. Change only the path/query after the existing preview host; do not replace the Cloud Shell host with localhost. Record actual results in the supplied section-7 table.

1. Open `/customer.php?q=Test`. The result must show the literal name `<b>Test Account</b>` with visible angle brackets. Take `m03-after.png`. The stored name is still present; the browser must stop treating it as markup.
2. Open `/customer.php?q=Brien`. The result must include the name `O'Brien` with its apostrophe intact. This tests normal display without asking the still-vulnerable SQL query to parse an apostrophe in the search term.
3. Open `/customer.php?q=`. The lookup form should open normally without an error or a search. Open `/customer.php` as well to check a missing term.
4. Paste this path to test exactly 40 letters. It should be accepted; no matching customers is a valid result:

```text
/customer.php?q=aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
```

5. Add one more `a` and press Enter. The resulting 41-character term must be refused with your generic message. Record both boundary outcomes.
6. Open `/customer.php?q=%3Cb%3E`. The encoded query value is `<b>`; it must be refused by validation. This is a separate check from the stored-name rendering test.
7. Open `/customer.php?q[]=Test`. It must be refused cleanly, without a PHP warning or stack trace.
8. Open `/customer.php?q=%C3%A9`. This sends `é`. It should pass validation; no matching rows is acceptable. Record the result to check your Unicode rule.
9. On 8081, open **Customers**, return to `/customer.php?q=Test`, and click a result's account link. Check that ordinary navigation still works.
10. Repeat `Test` on the original **8080** copy and confirm it still shows the original bold rendering. Keep the original unchanged and keep your fix in `fixed/`.

If a result differs, record it before correcting the code. Check the port, saved filename, validation order, and the output expression involved. Rerun the failed check and normal search after a correction.

**Known limit:** searching with a full apostrophe-containing term such as `O'Brien` still reaches the separate SQL flaw. Do not claim to have fixed it. Accepting an apostrophe in the validation rule does not make string-built SQL safe.

## Step 7: Complete the short incident report

The starter introduces selected TC-IR-01 sections without requiring the full organizational form. Use short answers and the supplied tables:

1. **Section 2:** two or three sentences naming the symptom, your repair, and its observed status. Distinguish the supplied ticket from your own tests.
2. **Section 5:** finish the source/output table and one sentence describing the trust boundary. Identify the separate SQL sink as still open.
3. **Section 6:** give your allow-list pattern and reason, and explain validation versus output encoding in two or three sentences. Name your integer-ID representation choice.
4. **Section 7:** complete each test row with actual results, add your syntax output, and reference the before/after screenshots. A proposed result is not evidence.
5. **Section 9:** name the OWASP Input Validation and Cross Site Scripting Prevention cheat sheets from the lecture and give one prevention idea for other pages. Add a two-sentence reflection and your disclosure.

## What to submit

1. Save and preview the report: **Ctrl+Shift+P** (**Cmd+Shift+P** on a Mac), then **Markdown: Open Preview**. Check its tables and image filenames.
2. Right-click each file in the editor's file list and choose **Download**: `reports/m03-tc-ir-002.md` and the complete changed `fixed/customer.php`. Keep your screenshots beside the report on your computer.
3. In Canvas, choose **Start Assignment** (or **New Attempt**) and upload:
   - supplied `lab.md`
   - `m03-tc-ir-002.md`
   - changed `customer.php` from `fixed/`
   - `m03-before.png` and `m03-after.png`, plus any other images you reference
4. Select **Submit Assignment** and check the confirmation and filenames. Retain the repairs in `fixed/`; do not upload the database or the original source tree.

Screenshots are separate image attachments. In the Markdown report, give each image's filename and describe what it proves. Upload those image files with the other submission files.

## Download and submit the lab instructions

Submit these three parts together: **lab.md**, your completed **m03-tc-ir-002.md**, and your changed **customer.php**. Include any screenshots required above. Keep the [STUDENT] prompts in your report and write each answer directly below its prompt.

1. In the IDE file list, expand `assignments`, then `module-03`, and click `lab.md`. This is the supplied task description. Leave it unchanged.
2. Right-click that `lab.md` file and choose **Download**. You can also [download lab.md here](assignment-files/lab.md).
3. Download your completed report from `reports/` and the complete changed source file(s) from `fixed/`, as directed above.
4. Upload **all three parts** to the same Canvas attempt, together with required evidence images. For Module 1, the code part contains both changed `layout.php` and `index.php` downloaded before restoration.
5. Before selecting **Submit Assignment**, confirm the upload list contains `lab.md`, your report, every required changed source file, and required images. Keep the lab instructions, your completed report, and your changed code together in the same submission.

Open notes and open book are both fine. Respond in your own words; do not copy from other sources.

**AI use on this assignment.** The syllabus policy governs; these are its terms for an incident report and fix.

> [!CORRECT] Permitted, with disclosure
> - Asking an AI to explain a concept, an OWASP guideline, or a PHP error message in general terms.
> - A grammar or spelling checker on your own writing.
> - Generating or refactoring code, proposing tests, and planning or editing the report. Disclose the tool, help requested, output used or changed, and checks performed. Report only test results you observed.

> [!CRITICAL] Not permitted
> - Submitting AI-generated code, analysis, or writing without disclosing it.
> - Pointing an AI-assisted tool at any target other than your own course environment.

You must be able to explain every line you submit, on request. Undisclosed AI use is handled as academic dishonesty under the syllabus.

## Grading rubric

Use the shared [Assignment rubric](../module-01/22_m01_assignment-rubric.html). The activity-specific evidence and source-file requirements are listed above.
