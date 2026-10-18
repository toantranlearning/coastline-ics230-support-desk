# M02 - Assignment: A First Runbook Readiness Review

## What you will do

Read the completed TC-IR-001 example and review three selected instructions in TechCorp's draft runbook. Submit a short prompted worksheet, about one page plus evidence. Plan about 30 minutes after the design lab.

This is the syllabus's early written-review activity. The preceding lab supplies this module's code change and its proof. Here you practice separating what a document says from what you can verify. You do not need a full incident report, eight findings, a severity drill, a complete form audit, or a preservation archive.

## Step 1: Open both portals

1. [Launch Google Cloud Shell](https://shell.cloud.google.com/) with the Google account used for setup. Open your existing course folder containing `site`, `fixed`, `reports`, and `scripts`.
2. Select **Open Editor** if needed. Right-click the course folder and choose **Open in Integrated Terminal**.
3. Run this command and press **Enter**:

```bash
bash scripts/start.sh
```

4. Wait for both startup messages. Open **Web Preview → Preview on port 8080** for **site**, then **Web Preview → Change port → 8081** for **fixed**.
5. Sign in separately with fictional username `rmarsh` and password `password`. Check the port before each test. Leave `site/` unchanged and keep earlier repairs in `fixed/`.

Use the [Cloud Shell Guide](../module-01/6_m01_working-in-google-cloud-shell.html) for first setup or startup problems. Test only your own copies under the course [Rules Of Engagement](../module-01/18_m01_rules-of-engagement.html).

## Step 2: Open the starter and readings

1. Copy the supplied worksheet into `reports/`:

```bash
cp assignments/early-reports/m02-readiness-review-starter.md reports/m02-readiness-review.md
```

2. Open that copy in the editor and fill in your name and disclosure. A [downloadable starter](report-starters/m02-readiness-review-starter.md) is also available here.
3. Open [TC-IR-01 Form and Worked Example](../module-01/10_m01_tc-ir-01-form-and-worked-example.html). Read the TC-IR-001 summary and section 7 checks. In two sentences, explain why blocking an address differs from removing the exposed file's cause. You are reading the example; you are not claiming its production incident happened in your Cloud Shell copy.
4. Open [Runbook v0.1](6_m03_incident-response-runbook.html). Read section 6 Step 3, section 7.1 C-2, and section 5's deny-rule trigger. Use lecture section 10 for unfamiliar terms.

## Step 3: Check three instructions

Use the three rows already supplied under **2. Check three instructions**. Follow the checks below in order. After each check:

- In **What I actually checked and found**, name the file or draft section and write the specific fact you found.
- In **Verdict**, write **Executable** or **Needs changes**, based on that evidence.
- In **One-sentence improvement**, write proposed instruction text that supplies the missing detail. If you judged it executable, state what should be retained and why.

Keep each cell to one short sentence. You are evaluating instructions; do not perform the entire incident response.

1. **Preservation — section 6 Step 3:** expand `fixed`, then `data` in the editor file list and look for `portal.sqlite`. If absent, reload the 8081 Customers page and check again. Record whether the file exists; do not open its binary contents as text. Does the runbook specify where to put a preservation copy, who takes it, and how to record it? Identify one missing detail. You do not need to make or hash an archive for this introductory review.
2. **Sessions — section 7.1 C-2:** click `fixed/auth.php` in the file list, press **Ctrl+F** (**Cmd+F** on a Mac), and search for `function auth_start`. Read through the call to `session_start()`. Does the draft explain where to locate this system's session store or how to clear it? Record what the code and draft actually show. You do not need to clear sessions or rotate passwords.
3. **Detection — section 5:** open `fixed/router.php`, search for `/data/`, and read your rejection branch. Compare it with the sentence about denied requests in runbook section 5. Does it record denied requests, or only block them? Base your answer on your actual code and the lab evidence. Propose a clear improvement to the instruction or trigger; no additional code edit is required.

## Step 4: Make a small recommendation

1. Reread your three selected runbook passages. Choose one useful provision, put its section/step in the starter's **Keep** line, and explain in one sentence how it helps the response.
2. Choose **adopt as written**, **adopt with changes**, or **do not adopt**. In two or three sentences, give your decision and the single most important change supported by your three checks.
3. Add a two-sentence reflection. Distinguish an observation from a proposed improvement; report only checks you performed.

## Step 5: Submit

1. Check that all worksheet prompts are answered. Short sentences and the supplied table are enough; no separate essay or TC-IR-01 form is required.
2. Save with **Ctrl+S** (**Cmd+S** on a Mac). Press **Ctrl+Shift+P** (**Cmd+Shift+P** on a Mac), type **Markdown: Open Preview**, and select it to check formatting.
3. Right-click `reports/m02-readiness-review.md`, choose **Download**, and upload it to this assignment in Canvas. Select **Submit Assignment** and check the confirmation.

## What to submit

Submit **one file**, `m02-readiness-review.md`: the two-sentence reading response, three review rows, one provision to keep, a short adoption recommendation, disclosure, and reflection.

Your changed `router.php` is submitted with the separate design lab. This review introduces no further code change. Keep the lab stopgap in `fixed/`.

Open notes and open book are both fine. Respond in your own words; do not copy from other sources.

**AI use on this assignment.** The syllabus policy governs; these are its terms for a written review.

> [!CORRECT] Permitted, with disclosure
> - Asking an AI to explain a concept, an OWASP guideline, or a PHP error message in general terms.
> - A grammar or spelling checker on your own writing.
> - Generating or refactoring code, proposing tests, and planning or editing the report, with disclosure of the tool, help requested, material used or changed, and checks performed. Report only results you observed.

> [!CRITICAL] Not permitted
> - Submitting AI-generated code, analysis, or writing without disclosing it.
> - Pointing an AI-assisted tool at any target other than your own course environment.

You must be able to explain every line you submit, on request. Undisclosed AI use is handled as academic dishonesty under the syllabus.

