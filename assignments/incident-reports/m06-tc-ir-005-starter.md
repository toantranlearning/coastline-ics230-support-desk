# TC-IR-005 — Module 06 Incident Report

Student: [Your name]

Report date: [Actual date and time zone]

Working status: [Not yet investigated / investigating / repaired and verified / open]

## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-005 - A note appeared that no rep wrote**
> A support rep reported a call note on a customer account that they do not remember writing, and no other rep on the team remembers writing it either. The note is stamped with the rep's own display name and was saved while the rep was signed in.
>
> **Analyst determination.** The add-note form on `notes.php` posts two fields, `customer_id` and `body`, back to `notes.php`. The handler checks that someone is signed in, then inserts the note with the session's display name. Nothing in the request proves it came from the portal's own form, and the browser attaches the session cookie to any request bound for the portal. A request assembled anywhere else, carrying the rep's session, is accepted. The request is authentic and was never intended. This is cross-site request forgery. The fix is a per-session token another page cannot read, checked on the server before the note is written.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Replace the bracketed prompts with your work. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: that a note was saved on a customer account without any rep intending it, whose session was used, and whether it is fixed. No code.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 3. Systems and data affected

**Assignment requirement:** The `notes.php` add-note feature, the row it writes to the `notes` table (`customer_id`, `body`, `created_by_name`, `created_at`), and the rep session the request rode on.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 4. Timeline of events

**Assignment requirement:** When the unexplained note was noticed and when you acted, in relative terms.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5. Detection and analysis

**Assignment requirement:** Explain the mechanism in the lecture's words. Name the **ambient authority** the browser supplies, what the **same-origin policy** lets another page do and not do, and which of the three questions (who, may they, did they mean to) the request leaves unanswered. Classify it: the OWASP category and the CWE.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6. Response actions

**Assignment requirement:** The fix you applied: one shared token check called from the add-note form and from the first line of the POST branch, and the cookie attributes set before the session starts. Name the pattern and the control in the lecture's words, and say which is the primary control and which is defense in depth.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2. A token-less POST with a valid session saves a note before the fix and is refused after it, while the portal's own add-note form still saves a note.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [Required check] | [Observed result] | [Observed result] | [Supported conclusion and remaining uncertainty] | [Reference] |

## 9. Post-incident actions

**Assignment requirement:** The OWASP guidance you followed, by name, and one change that would stop this class of bug from recurring on every state-changing page in the portal.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## Sources and assistance

[Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.]
