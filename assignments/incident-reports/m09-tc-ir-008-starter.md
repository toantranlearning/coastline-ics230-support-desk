# TC-IR-008 — Module 09 Incident Report

Keep every [STUDENT] prompt. Write your answer directly below it after **Answer:**. Keep supplied case facts and section headings. In tables, write after Answer: in each prompted cell.


Student: [STUDENT] Your name

**Answer:**


Report date: [STUDENT] Actual date and time zone

**Answer:**


Working status: [STUDENT] Not yet investigated / investigating / repaired and verified / open

**Answer:**


## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-008 - A rep's account was signed in by someone else, and the stored passwords are fast digests**
> A rep reported customer records opened on their account at a time they were not working. The password on the account was one the rep had reused on another site that was breached earlier in the year. The server's request log shows a long run of `POST` requests to `login.php` for that one username, seconds apart, then one answered with a redirect to `index.php`. Days later, the review of the database copy taken in the pre-term breach, TC-IR-001, found that the `users` table stores each staff password as an MD5 digest in the `password_md5` column.
>
> **Analyst determination.** One break-in, three weaknesses in `auth.php` and its data. First, the sign-in accepts attempts as fast as they arrive. Nothing counts a failed attempt, so an automated run works through candidate passwords until one lands, and the `login_failures` table added in sprint 20 is never written or read. Second, a successful sign-in keeps the session identifier the visitor arrived with, so an identifier fixed before sign-in is still valid after it. Third, the passwords are unsalted MD5 digests, a fast hash, so the copy taken in TC-IR-001 gives up every staff password quickly; treat every staff password as exposed. This assignment closes all three. The role cookie the sign-in sets, the session cookie's attributes, and the security-question reset on `reset-password.php` are out of scope for this module.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Keep the prompts and write your answers directly below them. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 1. Administrative details

**Assignment requirement:** The report ID, a severity with one sentence of justification, the discovery time, and you as the preparer.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 2. Executive summary

**Assignment requirement:** Five to eight sentences a manager could read: whose account was reached, how, what the attacker could see, the root cause in one plain sentence, and whether sign-in is fixed. No code.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 3. Systems and data affected

**Assignment requirement:** The `auth.php` sign-in and the session it issues; the `users` table and its `password_md5` column; the customer records a rep account can read, named by category.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 4. Timeline of events

**Assignment requirement:** The run of failed sign-ins, the one that succeeded, the TC-IR-001 database copy, and your actions, each with its source.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 5. Detection and analysis

**Assignment requirement:** 5.1: the rep's report and the request log. 5.2: the three weaknesses in your own words, each with its CWE from the lecture, and why each existed. 5.3: what the records cannot tell you, such as which customer records were opened and how many other accounts were tried.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 6. Response actions

**Assignment requirement:** 6.1: the stopgap, a reset of the rep's password, labelled as a mitigation. 6.2: the four changes from Part 2, with the threshold and window you chose and the per-account trade-off. 6.3: how a locked-out user gets back in.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2, one row per check, each with an annotation saying what it proves and what it does not.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [STUDENT] Required check<br>Answer:  | [STUDENT] Observed result<br>Answer:  | [STUDENT] Observed result<br>Answer:  | [STUDENT] Supported conclusion and remaining uncertainty<br>Answer:  | [STUDENT] Reference<br>Answer:  |

## 8. Notification determination

**Assignment requirement:** Whether the attacker could reach customer tax identifiers, who makes the call on notifying, and the reason for the call you record.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 9. Post-incident actions

**Assignment requirement:** The OWASP category you worked under, by name, and one corrective action from 5.3.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 10. Closure and attestation

**Assignment requirement:** Your name and the date; closure only if section 7 is complete.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## Sources and assistance

[STUDENT] Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.

**Answer:**


Screenshots are separate image attachments. In this report, identify each screenshot by filename and explain what it demonstrates; upload the image files alongside the report.
