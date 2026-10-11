# TC-IR-009 — Module 10 Incident Report

Student: [Your name]

Report date: [Actual date and time zone]

Working status: [Not yet investigated / investigating / repaired and verified / open]

## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-009 - Customer tax identifiers stored and shown in the clear**
> The review that followed the pre-term breach, TC-IR-001, compared the copy of the database that left the server against the live portal. Every customer's tax identifier is in that copy, readable exactly as it was typed. The reviewer also found the identifier printed on the account detail page, which any signed-in rep can open for any account, and in the admin console's audit table.
>
> **Analyst determination.** The `tax_id` column of the `customers` table holds the identifier as entered, so whoever holds a copy of `data/portal.sqlite` holds every identifier. Two pages print it: the account detail on `customer.php` and the account audit table on `admin.php`. Only the audit table has a workflow that needs the full value; the support lead's quarterly audit runs from it, and that page already refuses anyone who is not an administrator. The account detail does not need it. This assignment closes the storage: show the identifier only where the workflow needs it, encrypt it at rest with authenticated encryption, and convert the rows already in the file. Protecting the value as it crosses the network is out of scope for this module.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Replace the bracketed prompts with your work. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: what was exposed, to whom, and whether it is fixed. No code.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 3. Systems and data affected

**Assignment requirement:** The `customers` table and its `tax_id` column in `data/portal.sqlite`, and the two pages that print it, `customer.php` and `admin.php`. Name the data category precisely: a tax identifier, not "customer data".

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 4. Timeline of events

**Assignment requirement:** When the copy left, when the reviewer reported, and when you acted, in relative terms, each with its source.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5. Detection and analysis

**Assignment requirement:** Which property the identifier needs and why a hash cannot hold it. The weakness by name, CWE-311, and its OWASP Top 10 category. Every page that prints the value, with the role that can reach each. In 5.3, what the stored copy cannot tell you: who has read it.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6. Response actions

**Assignment requirement:** The fix you applied, in the lecture's words: the identifier removed from the page that does not need it, sealed with authenticated encryption bound to its row, the key kept in the environment, and the seeded rows converted by a one-time migration. Name the principle and the control. State what encryption at rest does not protect against.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2, one row per check, each annotated with what it proves and what it does not.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [Required check] | [Observed result] | [Observed result] | [Supported conclusion and remaining uncertainty] | [Reference] |

## 8. Notification determination

**Assignment requirement:** Whether a tax identifier is a data category that raises the notification question, who makes that call per the form, and the call for your environment, where every identifier is seeded. State the reason, not only the call.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 9. Post-incident actions

**Assignment requirement:** The OWASP guidance you followed, by name, and one change that would stop this class of bug from recurring on other fields.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## Sources and assistance

[Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.]
