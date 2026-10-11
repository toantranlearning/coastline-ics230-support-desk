# TC-IR-010 — Module 11 Incident Report

Student: [Your name]

Report date: [Actual date and time zone]

Working status: [Not yet investigated / investigating / repaired and verified / open]

## Supplied case background

These are fictional facts and an analyst determination supplied by the assignment. They are not observations you have personally verified. Keep your own observations and conclusions separate.

> **Incident TC-IR-010 - The session cookie carries no attributes**
> A reviewer read the headers the sign-in page returns and found the session cookie set as `PHPSESSID=...; path=/` and nothing more: no `Secure`, no `HttpOnly`, no `SameSite`. No response from the portal carries a `Strict-Transport-Security` header. The reviewer noted that the portal is reached over HTTPS and asked why that was not enough.
>
> **Analyst determination.** The browser reaches the portal over HTTPS, so the traffic on the wire is encrypted. That is the transport being available, not enforced. `auth.php` starts the session with `session_start()` and sets nothing about the session cookie, so the cookie carries PHP's defaults. A cookie without `Secure` will ride on a plain `http://` request to the host; one without `HttpOnly` can be read by page script; one without `SameSite` travels on cross-site requests. With no `Strict-Transport-Security` header, the browser has no standing rule to refuse `http://` for this host. Closing this incident sets the cookie's attributes before the session starts and sends the header on every page.

## How to complete this starter

Copy this file into `reports/` and remove `-starter` from the filename. Replace the bracketed prompts with your work. The Canvas assignment defines the repair scope, required tests, and submission requirements. Use only your own authorized lab. Capture evidence before changing code because the repair may remove the starting behavior. Submit the completed Markdown report and required attachments to Canvas.

Keep earlier incident reports as separate records. Where the assignment asks, reference prior incident IDs and add the new analysis; do not rewrite an earlier incident as though it contained evidence collected later. Later assignments require more detailed analysis and verification, rather than completion of every possible organizational field.

## 1. Administrative details

**Assignment requirement:** Report ID `TC-IR-010`, the severity with one sentence of justification, the dates in relative terms, and you as the preparer.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 2. Executive summary

**Assignment requirement:** Two or three sentences a manager could read: what the session cookie lacked, what that allowed, and whether it is fixed. No code.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 3. Systems and data affected

**Assignment requirement:** The session cookie `auth.php` creates and the responses `layout.php` writes, and what reaches through them: the session identifier, which is the signed-in session.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 4. Timeline of events

**Assignment requirement:** When it was reported and when you acted, in relative terms.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 5. Detection and analysis

**Assignment requirement:** The distinction the incident turns on: HTTPS is available but not enforced. Name each missing attribute and the header, and what each one's absence allows, in the lecture's words. Classify the flaw: the OWASP category and the CWE numbers from lecture section 11. In 5.3, name what your portal cannot show about TLS and why.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 6. Response actions

**Assignment requirement:** The fix you applied: the three attributes on the session cookie, set before the session starts, and the `Strict-Transport-Security` header with its `max-age`. Name the principle and the control, using the lecture's words.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 7. Confirmation of remediation, annotated

**Assignment requirement:** Your before and after evidence from Part 2, one row per check, each annotated with what it proves and what it does not.

| Check performed | Before repair | After repair | What the evidence proves and its limits | Evidence file or excerpt |
|---|---|---|---|---|
| [Required check] | [Observed result] | [Observed result] | [Supported conclusion and remaining uncertainty] | [Reference] |

## 8. Notification determination

**Assignment requirement:** Nothing is established to have left the system. Say who decided that and on what basis.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 9. Post-incident actions

**Assignment requirement:** The OWASP cheat sheets you followed, by name, and one corrective action that keeps the attributes and the header in place on every page the portal adds later.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## 10. Closure and attestation

**Assignment requirement:** Sign and date, once section 7 is complete.

[Write your response using supplied facts and your own evidence. If required information is unavailable, state what is unknown and why. Do not claim an action or outcome that you did not establish.]

## Sources and assistance

[Name the technical sources you relied on. Disclose AI assistance as the syllabus requires, and identify how you checked generated code or claims.]
