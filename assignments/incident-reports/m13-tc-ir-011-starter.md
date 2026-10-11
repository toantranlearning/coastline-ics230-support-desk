# TC-IR-011 — Module 13 Incident Report

Student: [Your name]

Report date: [Actual date and time zone]

Working status: [Not yet investigated / investigating / repaired and verified / open]

## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-011 - An uploaded file ran as code on the server**
> A rep attached a document to a customer record, then opened it from the record's document list. Instead of the file downloading, the page showed output the file itself produced. The document was a `.php` file the rep had attached by mistake.
>
> **Analyst determination.** `upload.php` accepts any file, keeps the name the browser supplied, and writes it into `uploads/`, a folder inside the one the server serves. When a URL asks for that file, the PHP engine runs it instead of returning it, so an uploaded `.php` executes on the server. That is remote code execution reached through an upload form. A second, separate finding: no page sends `Content-Security-Policy`, `X-Content-Type-Options`, or a framing header. The upload defect is the main work here; the headers are the deployment posture around it.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Replace the bracketed prompts with your work. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: that a file attached to a customer record ran as code on the server, who could reach the feature, and whether it is fixed. No code.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 3. Systems and data affected

**Assignment requirement:** The `upload.php` feature, the `uploads/` folder the files land in, the `documents` table, and the headers every page gets from `layout.php`.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 4. Timeline of events

**Assignment requirement:** When it was reported and when you acted, in relative terms.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5. Detection and analysis

**Assignment requirement:** Trace the file from the upload request to the server running it. Name the **source**, the **trust boundary**, the **sink**, and the **interpreter**. State the missing headers as a second finding, with the response that shows their absence.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6. Response actions

**Assignment requirement:** The fix you applied: the checks on the upload, the generated name, where files are stored now, how they are served, and the headers. Name the principle and the control, using the lecture's words.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2. The `.php` no longer runs; a real PDF still attaches and downloads; the headers are present.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [Required check] | [Observed result] | [Observed result] | [Supported conclusion and remaining uncertainty] | [Reference] |

## 9. Post-incident actions

**Assignment requirement:** The OWASP cheat sheets you followed, by name, and one change that would stop this class of bug from recurring on other features.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## Sources and assistance

[Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.]
