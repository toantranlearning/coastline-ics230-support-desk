# TC-IR-012 — Module 14 Incident Report

Student: [Your name]

Report date: [Actual date and time zone]

Working status: [Not yet investigated / investigating / repaired and verified / open]

## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-012 - A call note nobody on the desk wrote**
> On Monday morning the support lead opened the account of customer 4 and found a call note, "Duplicate record, disregard.", dated 02:39 on Sunday and signed Rae Marsh. Rae Marsh says she did not write it and was not signed in that weekend. Six more weekend notes signed with her name sit on customers 4, 5, and 6. The team went to find out who was signed in and what they did. The portal has nothing to say: it records no sign-ins, no failed sign-ins, no admin actions, and no reads of customer records. The only record is the web server's own log, one line per request. Separately, a rep reported that asking the customer page for an account by a non-numeric id prints an error, a file path, and part of a query to the screen.
>
> **Analyst determination.** Two weaknesses, one incident. First, the portal writes no security events. `auth_login` in `auth.php` returns `false` on a bad password and records nothing. `admin.php` runs its `UPDATE` on the `users` table and redirects. `customer.php` shows a record and writes nothing. The server log holds a method, a path, and a status, and no identity. Which account the weekend sign-ins used, and whether the person who owns that account made them, cannot be established from the records. Second, `db.php` turns error display on for every page, and the lookup at `customer.php` line 58 is built by concatenation, so `customer.php?id=abc` prints the exception, the file path, and the start of the query. This assignment closes both. The concatenated query itself is out of scope for this module.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Replace the bracketed prompts with your work. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 1. Administrative details

**Assignment requirement:** The report id, TC-IR-012. The severity per runbook section 4, with the one sentence of justification naming the record that supports the tier word you chose, as lecture section 9 explains. Discovery, with its time zone. Earliest established activity, saying "earliest established" and who established it. The Incident Commander, the status, and the carrier field.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 2. Executive summary

**Assignment requirement:** Five to eight sentences a manager could read: what was found, what the portal could and could not tell you, the root cause in one plain sentence, what you did, and where things stand. Written last. No code.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 3. Systems and data affected

**Assignment requirement:** One row per asset: the sign-in path, the admin page, the customer record page, and the call notes. Name the data categories precisely, as the form asks. The customer record page shows a tax identifier. For each asset say read, changed, exposed, or unknown, and say "unknown" where the records cannot tell you.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 4. Timeline of events

**Assignment requirement:** Every event with a time and the source that proves it. A server log line proves a request happened and nothing about who sent it; the row says so. Where the source is a record that was never written, the row says that too. Keep the weekend activity apart from the response actions.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5.1 How the incident was found

**Assignment requirement:** The actual channel: the support lead, reading a note, by accident. Not an alert, because there is nothing to alert on.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5.2 The vulnerability identified

**Assignment requirement:** The two weaknesses in your own words, each with its OWASP Top 10:2025 category and CWE number, and whether it lives in the code, the configuration, or the design. Say why each existed, not only what it was.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5.3 What analysis could not determine

**Assignment requirement:** The center of this report. Each question the weekend activity raises that the records cannot answer, written as a question, with the missing record named. Do not guess the answers. Lecture section 10 shows the shape.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6.1 Containment

**Assignment requirement:** Any stopgap you took, labeled a mitigation, with what it does not protect against. Turning error display off in configuration is a mitigation.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6.2 Eradication: the remediation

**Assignment requirement:** Three parts, in order: the remediation identified against 5.2, the pseudocode, then the code. The logging you added, the fail-closed rule on the admin action, and the error handler.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6.3 Recovery

**Assignment requirement:** How the portal was kept in service, what you now watch and for how long, and what would count as recurrence.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 7. Confirmation of remediation, annotated

**Assignment requirement:** One row per check from Part 2, step 8. Each row records what you did, what resulted, and what the check proves and does not prove.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [Required check] | [Observed result] | [Observed result] | [Supported conclusion and remaining uncertainty] | [Reference] |

## 8. Notification determination

**Assignment requirement:** Who decides, on what basis, and the outcome, with your confidence stated as lecture section 9 defines it. Say plainly what the missing records prevent you from ruling out. The carrier's 72-hour rule is playbook section 8.1.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 9. Post-incident actions

**Assignment requirement:** Every corrective action with an owner, a target date, and a status. Each entry in 5.3 reappears here. Name the OWASP guidance you followed: A09, the Logging Cheat Sheet, the Error Handling Cheat Sheet. Playbook steps P-2 and D-6 name what the portal must now be able to produce.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 10. Closure and attestation

**Assignment requirement:** What the form requires before the Incident Commander may sign, and which of those conditions are met at the time you submit.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## Sources and assistance

[Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.]
