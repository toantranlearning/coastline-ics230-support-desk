# TC-IR-004 — Module 05 Incident Report

Keep every [STUDENT] prompt. Write your answer directly below it after **Answer:**. Keep supplied case facts and section headings. In tables, write after Answer: in each prompted cell.


Student: [STUDENT] Your name

**Answer:**


Report date: [STUDENT] Actual date and time zone

**Answer:**


Working status: [STUDENT] Not yet investigated / investigating / repaired and verified / open

**Answer:**


## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-004 - A call note runs as script in a rep's browser**
> A support rep opened a customer's call notes and the page ran code in their browser instead of showing a note's text. The rep had not typed anything unusual. They only opened the account.
>
> **Analyst determination.** A call note is saved to the `notes` table and later written into the notes page without encoding. A note whose body contains markup is handed to the browser as HTML and run, not shown as text. The note is stored, so it runs for every rep who opens that account, not only for the person who wrote it. The author name and the date on the same page are already encoded; the note body is not.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Keep the prompts and write your answers directly below them. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: what was exposed, to whom, and whether it is fixed. No code.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 3. Systems and data affected

**Assignment requirement:** The `notes.php` call-notes page, and which values are involved: the note body, and the browser session of every rep who opens the account.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 4. Timeline of events

**Assignment requirement:** When it was reported and when you acted, in relative terms.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 5. Detection and analysis

**Assignment requirement:** Trace the note from the request that saved it, into the database, and back out onto the page. Name the **source**, the **trust boundary**, each **sink**, the **context** at the browser sink, and the **interpreter**. Say why this is stored XSS rather than reflected, and who it fires for.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 6. Response actions

**Assignment requirement:** The fix you applied: output encoding of the note body at the point it is written into the page, for the context it lands in. Name the principle and the control, using the lecture's words.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2. The markup case is inert for a second signed-in rep after the fix; an ordinary note with punctuation still reads as typed.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [STUDENT] Required check<br>Answer:  | [STUDENT] Observed result<br>Answer:  | [STUDENT] Observed result<br>Answer:  | [STUDENT] Supported conclusion and remaining uncertainty<br>Answer:  | [STUDENT] Reference<br>Answer:  |

## 9. Post-incident actions

**Assignment requirement:** The OWASP cheat sheet you followed, by name. Then name a Content Security Policy as the control you would add on top, and say what it restricts and why it is not the fix.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## Sources and assistance

[STUDENT] Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.

**Answer:**


Screenshots are separate image attachments. In this report, identify each screenshot by filename and explain what it demonstrates; upload the image files alongside the report.
