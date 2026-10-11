# TC-IR-004 — Module 05 Incident Report

Student: [Your name]

Report date: [Actual date and time zone]

Working status: [Not yet investigated / investigating / repaired and verified / open]

## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-004 - A call note runs as script in a rep's browser**
> A support rep opened a customer's call notes and the page ran code in their browser instead of showing a note's text. The rep had not typed anything unusual. They only opened the account.
>
> **Analyst determination.** A call note is saved to the `notes` table and later written into the notes page without encoding. A note whose body contains markup is handed to the browser as HTML and run, not shown as text. The note is stored, so it runs for every rep who opens that account, not only for the person who wrote it. The author name and the date on the same page are already encoded; the note body is not.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Replace the bracketed prompts with your work. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: what was exposed, to whom, and whether it is fixed. No code.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 3. Systems and data affected

**Assignment requirement:** The `notes.php` call-notes page, and which values are involved: the note body, and the browser session of every rep who opens the account.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 4. Timeline of events

**Assignment requirement:** When it was reported and when you acted, in relative terms.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5. Detection and analysis

**Assignment requirement:** Trace the note from the request that saved it, into the database, and back out onto the page. Name the **source**, the **trust boundary**, each **sink**, the **context** at the browser sink, and the **interpreter**. Say why this is stored XSS rather than reflected, and who it fires for.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6. Response actions

**Assignment requirement:** The fix you applied: output encoding of the note body at the point it is written into the page, for the context it lands in. Name the principle and the control, using the lecture's words.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2. The markup case is inert for a second signed-in rep after the fix; an ordinary note with punctuation still reads as typed.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [Required check] | [Observed result] | [Observed result] | [Supported conclusion and remaining uncertainty] | [Reference] |

## 9. Post-incident actions

**Assignment requirement:** The OWASP cheat sheet you followed, by name. Then name a Content Security Policy as the control you would add on top, and say what it restricts and why it is not the fix.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## Sources and assistance

[Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.]
