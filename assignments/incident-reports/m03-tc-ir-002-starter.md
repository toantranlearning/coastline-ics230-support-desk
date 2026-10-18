# TC-IR-002 — Guided First Repair Report
NAME: [Your name]
DATE AND TIME ZONE: [Actual date/time zone]
AI DISCLOSURE: [Tool, help, output used or changed, and checks; or None.]

Supplied case: customer search displays a stored name as bold HTML. A separate apostrophe-related SQL error is outside this repair. The following sections record my own work.

## 2. Executive summary
[Two or three sentences: symptom, change, observed repair status.]

## 5. Detection and analysis
Source and trust boundary: [One sentence naming the browser input and boundary.]

| Expression / my line number | Destination and interpreter | My handling |
|---|---|---|
| Search input value | [Context] | [Expression/control] |
| Results heading | [Context] | [Expression/control] |
| Stored result name | [Context] | [Expression/control] |
| ID in result link | [Context] | [Representation and reason] |
| SQL search query | SQL/database | [Known open limitation] |

Why the original list and search differed: [One sentence.]

## 6. Response actions
Allow-list pattern and reason: [Your pattern; one sentence.]
Validation versus encoding: [Two or three sentences about your implementation.]

## 7. Confirmation of remediation
| Test on fixed 8081 | Actual result | Evidence / what this checks |
|---|---|---|
| Test: stored markup displayed literally | [Observed] | [After screenshot; compare original] |
| Brien: O'Brien displayed correctly | [Observed] | [Normal display] |
| Missing and blank q | [Observed for each] | [Form still opens] |
| 40 letters | [Observed] | [Accepted boundary] |
| 41 letters | [Observed] | [Rejected boundary] |
| q=%3Cb%3E | [Observed] | [Invalid characters] |
| q[]=Test | [Observed] | [Array rejected cleanly] |
| q=%C3%A9 | [Observed] | [Accented letter accepted] |
| Customers and account link | [Observed] | [Navigation works] |

```text
[Paste actual PHP syntax-check output and any relevant response excerpts.]
```

![Original search rendering](m03-before.png)
![Working search after repair](m03-after.png)

Known remaining SQL limitation: [One sentence; do not claim it is fixed.]

## 9. Post-incident actions
Sources: [Name the two OWASP cheat sheets you used.]
Prevention: [One sentence: how to prevent similar output mistakes on another page.]
REFLECTION: [Two sentences about your learning or difficulty.]
