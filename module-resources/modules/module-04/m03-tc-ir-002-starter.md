# TC-IR-002 — Module 03 Incident Report

Student: [Your name]

Report date: [Actual date and time zone]

Working status: [Not yet investigated / investigating / repaired and verified / open]

## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-002 - Customer search renders a name as markup**
> A support rep reported that a customer account named `<b>Test Account</b>` shows up in the search results in **bold**, not as the literal name. A second rep reported that searching for the customer `O'Brien` returns an error page instead of results.
>
> **Analyst determination.** These are two symptoms of one root cause: the search page takes the term the rep types and the names it finds, and writes them into the page and into a database query without treating them as data. The bold rendering is the browser reading a stored value as HTML. The error on the apostrophe is the database reading the search term as part of a query. This assignment closes the rendering half. The query half is out of scope for this module and is expected to remain open at the end of it.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Replace the bracketed prompts with your work. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: what was exposed, to whom, and whether it is fixed. No code.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 3. Systems and data affected

**Assignment requirement:** The `customer.php` search feature, and which values are involved: the search term the rep types, and the customer names the search returns.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 4. Timeline

**Assignment requirement:** When it was reported and when you acted, in relative terms.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5. Detection and analysis

**Assignment requirement:** Trace the search term from the request to the page. Name the **source**, the **trust boundary**, each **sink**, and the **interpreter** beyond it. There is more than one sink; name all of them.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6. Response actions

**Assignment requirement:** The fix you applied: server-side validation of the term on an allow-list, and output encoding at each sink. Name the principle and the control, using the lecture's words.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 7. Confirmation of remediation

**Assignment requirement:** Your before and after evidence from Part 2. The markup case renders as text after the fix; a legitimate punctuated name still displays.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [Required check] | [Observed result] | [Observed result] | [Supported conclusion and remaining uncertainty] | [Reference] |

## 9. Post-incident actions

**Assignment requirement:** The OWASP cheat sheet you followed, by name, and one change that would stop this class of bug from recurring on other pages.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## Sources and assistance

[Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.]
