# TC-IR-002 — Guided First Repair Report

Keep every [STUDENT] prompt. Write your answer directly below it after **Answer:**. Keep supplied case facts and section headings. In tables, write after Answer: in each prompted cell.

NAME: [STUDENT] Your name

**Answer:**

DATE AND TIME ZONE: [STUDENT] Actual date/time zone

**Answer:**

AI DISCLOSURE: [STUDENT] Tool, help, output used or changed, and checks; or None.

**Answer:**


Supplied case: customer search displays a stored name as bold HTML. A separate apostrophe-related SQL error is outside this repair. The following sections record my own work.

## 2. Executive summary
[STUDENT] Two or three sentences: symptom, change, observed repair status.

**Answer:**


## 5. Detection and analysis
Source and trust boundary: [STUDENT] One sentence naming the browser input and boundary.

**Answer:**


| Expression / my line number | Destination and interpreter | My handling |
|---|---|---|
| Search input value | [STUDENT] Context<br>Answer:  | [STUDENT] Expression/control<br>Answer:  |
| Results heading | [STUDENT] Context<br>Answer:  | [STUDENT] Expression/control<br>Answer:  |
| Stored result name | [STUDENT] Context<br>Answer:  | [STUDENT] Expression/control<br>Answer:  |
| ID in result link | [STUDENT] Context<br>Answer:  | [STUDENT] Representation and reason<br>Answer:  |
| SQL search query | SQL/database | [STUDENT] Known open limitation<br>Answer:  |

Why the original list and search differed: [STUDENT] One sentence.

**Answer:**


## 6. Response actions
Allow-list pattern and reason: [STUDENT] Your pattern; one sentence.

**Answer:**

Validation versus encoding: [STUDENT] Two or three sentences about your implementation.

**Answer:**


## 7. Confirmation of remediation
| Test on fixed 8081 | Actual result | Evidence / what this checks |
|---|---|---|
| Test: stored markup displayed literally | [STUDENT] Observed<br>Answer:  | [STUDENT] After screenshot; compare original<br>Answer:  |
| Brien: O'Brien displayed correctly | [STUDENT] Observed<br>Answer:  | [STUDENT] Normal display<br>Answer:  |
| Missing and blank q | [STUDENT] Observed for each<br>Answer:  | [STUDENT] Form still opens<br>Answer:  |
| 40 letters | [STUDENT] Observed<br>Answer:  | [STUDENT] Accepted boundary<br>Answer:  |
| 41 letters | [STUDENT] Observed<br>Answer:  | [STUDENT] Rejected boundary<br>Answer:  |
| q=%3Cb%3E | [STUDENT] Observed<br>Answer:  | [STUDENT] Invalid characters<br>Answer:  |
| q[]=Test | [STUDENT] Observed<br>Answer:  | [STUDENT] Array rejected cleanly<br>Answer:  |
| q=%C3%A9 | [STUDENT] Observed<br>Answer:  | [STUDENT] Accented letter accepted<br>Answer:  |
| Customers and account link | [STUDENT] Observed<br>Answer:  | [STUDENT] Navigation works<br>Answer:  |

```text
[STUDENT] Paste actual PHP syntax-check output and any relevant response excerpts.

**Answer:**

```

[STUDENT] Screenshot description — m03-before.png: Describe the original search on port 8080 for Test: explain how the stored <b>Test Account</b> name appears.

**Answer:**

[STUDENT] Screenshot description — m03-after.png: Describe the repaired search on port 8081 for Test: explain whether the angle brackets and tags appear as literal text.

**Answer:**


Known remaining SQL limitation: [STUDENT] One sentence; do not claim it is fixed.

**Answer:**


## 9. Post-incident actions
Sources: [STUDENT] Name the two OWASP cheat sheets you used.

**Answer:**

Prevention: [STUDENT] One sentence: how to prevent similar output mistakes on another page.

**Answer:**

REFLECTION: [STUDENT] Two sentences about your learning or difficulty.

**Answer:**


Screenshots are separate image attachments. In this report, identify each screenshot by filename and explain what it demonstrates; upload the image files alongside the report.
