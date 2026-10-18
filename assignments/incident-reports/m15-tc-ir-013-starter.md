# TC-IR-013 — Module 15 Incident Report

Keep every [STUDENT] prompt. Write your answer directly below it after **Answer:**. Keep supplied case facts and section headings. In tables, write after Answer: in each prompted cell.


Student: [STUDENT] Your name

**Answer:**


Report date: [STUDENT] Actual date and time zone

**Answer:**


Working status: [STUDENT] Not yet investigated / investigating / repaired and verified / open

**Answer:**


## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-013 - Advisory against the date picker the page shell loads**
> Application security has forwarded a published advisory against `flatpickr`, the date-picker library the portal loads from a public CDN. The advisory says a value placed in the library's date field can reach a DOM sink inside the library and be read as markup. It asks the team for two things: a reachability determination, and a remediation decision with the reasoning written down.
>
> **Analyst determination.** `layout.php`, the page shell every page includes, loads the library's stylesheet and script from `cdn.jsdelivr.net` at lines 29 and 30. Neither URL names a version, and neither tag carries an `integrity` or `crossorigin` attribute, so the browser runs whatever the CDN serves and the application cannot state which version it is running. The picker is called on one page, the notes date filter added in sprint 20 on `notes.php`. Whether the advisory applies to this portal depends on that call site, and that determination is yours to make and defend. The weakness class is a software supply-chain failure (OWASP A03).

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Keep the prompts and write your answers directly below them. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 1. Administrative details

**Assignment requirement:** The report ID, a severity with one sentence of justification, and the status. Discovery is the arrival of the advisory.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: which dependency, why loading it unpinned and unverified is a risk, whether the advisory reaches this application, and whether it is fixed. No code.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 3. Systems and data affected

**Assignment requirement:** The `layout.php` page shell, the two `flatpickr` files it loads from the CDN, and `notes.php`, the page that calls the picker. Name what the picker's value could reach in a visitor's browser.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 4. Timeline of events

**Assignment requirement:** When the advisory records the finding as first accepted, when the advisory arrived, and when you acted, in relative terms, with a source for each row.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 5. Detection and analysis

**Assignment requirement:** 5.1: how the finding reached you. 5.2: the reachability determination. Name the **source**, the **trust boundary**, the **sink**, and the **interpreter** for the picker's value in `notes.php`, with line numbers, then state whether attacker-influenced input reaches the library's affected path and why. Work the nine triage questions from lecture section 7. 5.3: what you could not determine, and the record that would have answered it.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 6. Response actions

**Assignment requirement:** 6.2: the remediation, in the form's three parts: the change identified, the pseudocode, the code. Say which of the advisory's four options you applied, why, and what each one does not cover. 6.1 and 6.3: one sentence each on whether a stopgap was needed and how you confirmed the pages still work.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your evidence from Part 2, one row per check: the pinned and verified files loading, the tampered-file case refused, the two tests before and after the refactor, and the hostile and legitimate requests to `notes.php`. Each row says what it proves and what it does not.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [STUDENT] Required check<br>Answer:  | [STUDENT] Observed result<br>Answer:  | [STUDENT] Observed result<br>Answer:  | [STUDENT] Supported conclusion and remaining uncertainty<br>Answer:  | [STUDENT] Reference<br>Answer:  |

## 8. Notification determination

**Assignment requirement:** One sentence: whether any customer data left the system, and so whether notification is required.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 9. Post-incident actions

**Assignment requirement:** The OWASP guidance you followed, by name, and one change that would stop this class of finding from recurring on other tags and other libraries: an inventory, an integrity rule for third-party tags, or advisory monitoring.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 10. Closure and attestation

**Assignment requirement:** The residual risk in one line, as lecture section 10 shows for the CDN case, and whether you declare closure.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## Sources and assistance

[STUDENT] Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.

**Answer:**


Screenshots are separate image attachments. In this report, identify each screenshot by filename and explain what it demonstrates; upload the image files alongside the report.
