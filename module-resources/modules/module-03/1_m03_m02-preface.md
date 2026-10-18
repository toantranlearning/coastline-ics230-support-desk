# M02 - Preface: Security by Design

## What this module is for

Module 01 gave you trust boundaries, source and sink, and the session cookie. This module moves one step earlier, to the decisions made before any code is written: what the system must refuse to do, where each check lives, and where the data sits.

The lab focuses on one design claim: whether supporting data files can be served without signing in. You read the original source, add a stopgap in `fixed/router.php`, prove both blocked requests and legitimate use, and complete a short supplied worksheet. You practice one flow, one threat, and one security requirement. The lecture teaches the broader threat-modeling method; the first report does not require an exhaustive audit.

The optional, ungraded readiness review uses a short starter: three selected runbook checks, one provision to keep, and one adoption recommendation. Reports become more complete as you gain practice.

## The question this module answers

Which security failures are decided before the first line of code, and how do you find them while they are still cheap to fix?

## What you will be able to do

After Module 02 you can:

1. Tell a design flaw from an implementation flaw, and say why careful code cannot remove the first kind.
2. Decompose a feature into a data-flow diagram: actors, assets, entry points, processes, data stores, and trust boundaries.
3. Apply STRIDE to each element and arrow, and turn a threat into an abuse case.
4. Write a security requirement someone else can verify, and the two-outcome test that checks it.
5. Rank threats by likelihood and impact, choose a treatment, and state the residual risk with an owner.
6. Explain where a control lives and where data lives in a secure software architecture, and why a file under the published folder is served with no check at all.
7. Tell a mitigation from a remediation, and name the test that separates them.
8. Use the incident-response vocabulary the TC-IR-01 form uses: Discovery, severity, Incident Commander, the four lifecycle phases, containment and eradication.

## The two-copy workspace

Run `bash scripts/start.sh` from the workspace root. Read and reproduce on **site, port 8080**; edit and prove the stopgap on **fixed, port 8081**. Keep evidence in `reports/`. Submit the changed `fixed/router.php` with the lab report and required images. The optional readiness review uses the working copy for practice; nothing is submitted.

## Before you start

- Reread **Module 01 lecture section 4** (trust boundaries and untrusted input) and **section 5** (source, sink, and flow). The data-flow diagram is those two ideas drawn for a whole feature.
- Reread **Module 01 lecture section 6** if the session cookie and ambient authority are not yet automatic. Several claims in `site/DESIGN.md` are about what travels in a cookie.
- Sign in to your course environment as `rmarsh` and open `site/DESIGN.md` in the editor. You will read it once before you test anything.

## Materials

- The lecture page, which teaches everything the quiz, the lab, and the assignment need.
- OWASP Top 10:2025 A06 Insecure Design, the OWASP Threat Modeling Cheat Sheet, and the CLARK module Threat and Risk Analysis, the three required readings.
- `site/DESIGN.md` and the portal files it describes, in your course environment.
- The **Incident Response Runbook** page in this module, the document the assignment reviews.
- The **TC-IR-01 Form and Worked Example** page in the Course Orientation module. Lecture section 10 explains the words the form uses.
- The **Requests and Developer Tools** page in the Course Orientation module, for `curl` and cookie editing in the lab.

## Where you may run this

Everything you test in this module is your own course environment. The assignment sends individual requests by hand with `curl` and adds a routing rule to the working copy. No scanner or attack tool runs anywhere; the **Working in Google Cloud Shell** page states the rule. One file, `fixed/router.php`, is changed, and that page shows how to reset it.

## How the module is shaped


| **Segment** | **Suggested time** | **What you produce** |
|---|---|---|
| Lecture | 75 minutes | Notes and the examples tried in your environment |
| Quiz | 15 minutes | 10 responses |
| Lab: audit the design document and model the threats | 60–75 minutes | Three claim checks, one flow/threat/requirement, stopgap, before/after results, and short worksheet |
| Optional practice: incident response readiness review | 30 minutes, optional | Personal notes; ungraded, no submission |
| Incident Response Runbook page | 15 minutes | Read during the assignment; nothing to submit |

## When you are done

Module 02 is complete when you submit the quiz and the single Block Direct Access assignment: its short worksheet and changed `router.php`. Keep the working stopgap in `fixed/` for later modules.

## PHP Companion

Read the [PHP companion](9_m03_m02-php-language-support.html) alongside the security lecture. It explains the PHP operations used in this module with worked examples. The security concepts remain the focus of the module.
