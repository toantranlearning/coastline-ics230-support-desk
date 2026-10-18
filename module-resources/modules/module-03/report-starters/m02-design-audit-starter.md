# M02 Design Lab Worksheet
NAME: [Your name]
AI DISCLOSURE: [Tool, help, material used, and checks; or None.]

## 1. Read and observe
| Claim | Supported or contradicted by my check? | Actual evidence |
|---|---|---|
| Supporting files are not served | [Answer] | [Status/excerpt] |
| Unsigned-in visitors cannot reach application data | [Answer] | [Status/file identification] |
| A signed-in rep can open Customers | [Answer] | [Observed page] |

Flow: Visitor → [requested path and boundary] → web server/router → [returned data].
Why the page sign-in check did not protect the files: [One sentence.]
Threat and STRIDE category: [One threat; one category; why.]
Requirement: The portal must [One observable rule.]

## 2. Change and prove
Changed file: fixed/router.php
What my rule does: [One sentence.]

| Check | Original site 8080 | Fixed 8081 |
|---|---|---|
| /data/seed.sql | [Actual status] | [Actual status] |
| /data/portal.sqlite | [Actual status] | [Actual status] |
| Signed-in Customers and one account | [Actual result] | [Actual result] |

```text
[Paste actual syntax result, relevant request status lines, and database file identification.]
```

## 3. Explain and reflect
[Two sentences: why is this a mitigation; what remains exposed without the rule?]
REFLECTION: [Two sentences about what you learned or found difficult.]

Submission check: [ ] This worksheet [ ] Complete changed router.php [ ] Any referenced images
