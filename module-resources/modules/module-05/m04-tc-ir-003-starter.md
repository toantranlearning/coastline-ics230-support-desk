# TC-IR-003 — Module 04 Incident Report

Keep every [STUDENT] prompt. Write your answer directly below it after **Answer:**. Keep supplied case facts and section headings. In tables, write after Answer: in each prompted cell.


Student: [STUDENT] Your name

**Answer:**


Report date: [STUDENT] Actual date and time zone

**Answer:**


Working status: [STUDENT] Not yet investigated / investigating / repaired and verified / open

**Answer:**


## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-003 - Someone signed in to an admin account without its password**
> An ops engineer reported signing in to the portal using a username that is not an account. They typed `' OR 1=1 --` in the username box, any text in the password box, and were signed in as an administrator, with the Admin link showing in the navigation.
>
> **Analyst determination.** The sign-in builds its SQL by pasting the typed username straight into the query text. The input `' OR 1=1 --` closes the username string, adds a condition that is always true, and comments out the password check, so the query matches every account and the sign-in takes the first one, which is an administrator. Anyone can sign in as any account without a password. The same concatenation flaw sits at two more sinks in `customer.php`: the name search, where a crafted term returns records the rep never searched for, and the account-id lookup, where a crafted id opens an account, tax ID included, that was never requested. All three are SQL injection, and all three close this module.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Keep the prompts and write your answers directly below them. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: what was exposed, to whom, and whether it is fixed. No code.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 3. Systems and data affected

**Assignment requirement:** The `auth.php` sign-in query and the `users` table, and the `customer.php` name search and account-id lookup. Name the values involved: the typed username, and the accounts and customer records the injection exposes, tax IDs included.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 4. Timeline of events

**Assignment requirement:** When the bypass was reported and when you acted, in relative terms.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 5. Detection and analysis

**Assignment requirement:** Trace the typed value from each form into its query. Name the **source**, the **trust boundary**, the **sink**, and the **interpreter**. There are three injectable queries; account for all three.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 6. Response actions

**Assignment requirement:** The fix you applied: bound parameters for the sign-in query and both customer lookups, so user input is always data and never SQL.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2, with an annotation on each check saying what it proves and what it does not.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [STUDENT] Required check<br>Answer:  | [STUDENT] Observed result<br>Answer:  | [STUDENT] Observed result<br>Answer:  | [STUDENT] Supported conclusion and remaining uncertainty<br>Answer:  | [STUDENT] Reference<br>Answer:  |

## 9. Post-incident actions

**Assignment requirement:** The OWASP guidance you followed, by name, and one change that would stop this class of bug recurring on other pages.

[STUDENT] Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.

**Answer:**


## Sources and assistance

[STUDENT] Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.

**Answer:**


Screenshots are separate image attachments. In this report, identify each screenshot by filename and explain what it demonstrates; upload the image files alongside the report.
