# TC-IR-007 — Module 08 Incident Report

Student: [Your name]

Report date: [Actual date and time zone]

Working status: [Not yet investigated / investigating / repaired and verified / open]

## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-007 - A rep reached the admin console and other reps' customers**
> A support rep signed in with an ordinary rep account, reached the admin console, and from there opened customer accounts assigned to other reps, tax identifiers included.
>
> **Analyst determination.** Two weaknesses combine into one failure. The signed-in user's role travels in a browser cookie named `role`, which the client can edit, so setting it to `admin` opens `admin.php`, including its staff enable and disable form. And `customer.php` returns any account whose id is in the URL, with no check that the account is assigned to the requesting rep, so changing the number walks through every rep's accounts. In both cases the server lets the client say what it may do. Both halves are yours to close.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Replace the bracketed prompts with your work. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: what was reachable, by whom, and whether it is fixed. No code.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 3. Systems and data affected

**Assignment requirement:** The sign-in helpers in `auth.php`, the admin console `admin.php` with its staff enable and disable action, the customer lookup `customer.php`, and the data exposed: other reps' customer accounts, tax identifiers included.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 4. Timeline of events

**Assignment requirement:** When it was reported and when you acted, in relative terms.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5. Detection and analysis

**Assignment requirement:** Trace both paths. For the console: where the role is set, that it rides in a client-editable **cookie**, which is the trust boundary, and the line that trusts it. For the customer walk: where the **id** enters, the lookup that runs, and the ownership decision that never runs. Name the **subject**, the **action**, the **object**, and the **context** that was never checked, for each path. Classify the weakness with its CWE from the lecture.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6. Response actions

**Assignment requirement:** The fix you applied: the role carried in the server-side session and read from there on every request, and the ownership rule bound into the lookup. Name the principle and the control in the lecture's words.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2. The edited cookie no longer reaches `admin.php`; the id walk returns the same response as a record that does not exist; a rep's own customers still open with every field intact.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [Required check] | [Observed result] | [Observed result] | [Supported conclusion and remaining uncertainty] | [Reference] |

## 8. Notification determination

**Assignment requirement:** Tax identifiers were exposed, to an internal account. Say who makes the notification decision and on what basis, and what the exposure window was.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 9. Post-incident actions

**Assignment requirement:** The OWASP guidance you followed, by name, and one change that would stop this class of bug from recurring on other pages.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## Sources and assistance

[Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.]
