# Incident Response Runbook (v0.1 DRAFT)

This is TechCorp's incident response runbook, the procedure the team follows on the worst day. It is a three-day-old draft that nobody has walked against a real system. It is retained as a fictional reference for the lecture’s incident-response discussion. There is no runbook-review activity or submission.

---

**INCIDENT RESPONSE RUNBOOK**
TechCorp Services, Inc. · Customer Portal
Version 0.1 · DRAFT · Circulated for review before adoption

> CIRCULATION NOTE FROM THE TEAM LEAD We handled TC-IR-001 by improvising, and one corrective action from that incident was to write the procedure down before the next one. This is that procedure, adapted from the carrier’s playbook to what we actually have: three people, one server, and a support desk that opens at seven. Before we adopt it, review it against the system. Walk every step and mark anything you could not execute as written at 2 a.m. with the rest of the team unreachable. Comments by Friday.

## 1. Purpose and scope
This runbook is the procedure TechCorp follows when a security incident affects the customer portal or the data it holds. It covers the three members of the technical team and the customer-support desk, and it satisfies the minimum standard in the carrier’s Incident Response Playbook (Appendix C to Form CYB-N1), compliance with which is a condition of coverage. Until superseded, this is the operative document; there is no other.
## 2. Definitions
Security incident. Any actual or reasonably suspected unauthorized access to, acquisition of, modification of, or destruction of customer data or the systems that hold it.
Discovery. The earliest point at which anyone at TechCorp knew or reasonably should have known that an incident had occurred. Discovery starts the carrier’s 72-hour notification clock, whether or not anyone has told the carrier yet.
Incident Commander (IC). The single person directing the response. There is exactly one IC at any time. Every decision below that says "the IC decides" means that person and nobody else.
## 3. The team

| Function | Held by | Alternate |
|---|---|---|
| Incident Commander | Team lead | Developer (assumes after 30 minutes unreachable) |
| System actions: contain, change, restore | Developer | Team lead |
| Evidence and records: IC log, incident folder, analyst liaison | Security reviewer | Team lead |
| External communication | Owner | None. If the owner is unreachable, nothing goes out |
| Regulatory determination | Carrier panel counsel | Reached through the Breach Response Unit |
| Customer channel | Support desk | Speaks only from the holding statement (Appendix B) |

Three people cannot hold six functions without doubling, and during a Severity 1 the IC and the person doing system actions may briefly be the same person. That is the reality of this team, and it is why the second person joins the incident as soon as they are reachable: the IC should be deciding, not typing.
Taking the portal offline is the IC’s decision. The IC informs the owner but does not wait for an answer. A portal that is serving customer data to an attacker is not kept online out of politeness.
## 4. Severity

| Severity | Meaning, in this portal’s terms | Commitment |
|---|---|---|
| 1 (Critical) | Customer records or the staff accounts are known or reasonably suspected to have left the system; or someone has acted in the portal as a rep who is not that rep | Drop everything, whatever the hour someone is aware of it. IC designated within 30 minutes. Carrier called within 24 hours |
| 2 (High) | A confirmed way to reach or change customer data without authorization exists, with no evidence yet that it has been used | Same business day. Containment in place before the day ends |
| 3 (Moderate) | One account or one machine is affected, and there is no evidence customer data was reached | Within one business day |
| 4 (Low) | An unsuccessful attempt, or a policy violation with no impact | Next business day. Recorded, not escalated |

Coverage is business hours. An incident that starts overnight is found when someone next looks, and the response commitments above run from that moment, not from the event. That is a fact about this team, not a target; the corrective actions in TC-IR-001 are what will change it.
## 5. What starts this runbook
**Start the procedure when any of the following is observed:**
The portal serves a file, record, or page to someone not authorized to see it.
A record or note exists that nobody on the team or the desk created.
A rep reports an action taken under their account that they did not take.
A customer demonstrates knowledge of their record’s contents that TechCorp never sent them.
The deny rule in front of the data directory records repeated refused requests from the same source.
The senior analyst reports that a known finding is being exploited.
Do not start it for: slow pages, a PHP error on one page, a forgotten password, a planned restart, or a scanner alert by itself. A scanner alert is a claim; verify it first. The line between the lists is unauthorized access or change, not inconvenience.
## 6. The first hour
Step 1. Whoever sees it reports it to the team lead and writes down the time. That time is Discovery, and the 72-hour carrier clock is now running.
Step 2. The team lead becomes Incident Commander. If the lead is unreachable for 30 minutes, the developer assumes IC and does not wait. The IC opens an incident folder and an IC log: one line per action, with the time and the person, for everything that happens from here on.
Step 3. Preserve before you change anything. Copy the application directory and the database file (data/portal.sqlite) into the incident folder, timestamped. Delete nothing, clean nothing, rebuild nothing. If in doubt, isolate rather than power off.
Step 4. Assign a severity from §4 and record one sentence of justification in the IC log.
Step 5. Severity 1 or 2: contain now, using §7.1. Severity 3 or 4: the IC schedules containment and the response continues in business hours.
Step 6. Severity 1, or any suspected access to customer data: telephone the carrier’s Breach Response Unit today (Appendix A). The written Form CYB-N1 follows within 72 hours of Discovery.
Step 7. Before the support desk next opens, the IC gives it the holding statement (Appendix B). The desk answers from that statement and nothing else.
Step 8. Engage the senior security analyst for a written determination of what happened and what condition allowed it. Eradication waits for the determination. Containment does not.
## 7. The response, phase by phase
## 7.1 Containment
C-1. Decide: online or offline. Offline means stopping the portal process on WEB01. Online means placing a deny rule in front of the affected path so matching requests are refused and recorded, as was done for the data directory in TC-IR-001. The IC decides and informs the owner.
C-2. Invalidate every active session by clearing the server’s session store. Every rep signs in again; an attacker holding a stolen session does not.
C-3. Rotate credentials in the database for every account that may be affected. If you cannot bound "may be affected", rotate all of them.
C-4. Touch nothing else. Every action taken goes into the IC log as it happens, not from memory afterward.

> EVERY STOPGAP IS A MITIGATION, NOT A REMEDIATION A deny rule, a disabled page, a stopped process: these limit ongoing harm without removing the cause. Name them as mitigations in the IC log and in the report, and keep the finding open until the cause itself is removed and verified. An incident is not eradicated while the entry path remains open.

## 7.2 Eradication
E-1. Restate the analyst’s determination in your own words in the report draft. If you cannot restate it, you do not yet understand the fix you are about to write; stop and ask.
E-2. Write the fix as pseudocode first: what moves, what changes, and what fails closed. Then write the code. A second person reviews both before anything is deployed.
E-3. Deploy the fix. Keep the containment mitigation in place afterward as depth; it is now the backup, not the defense.
E-4. Verify to the standard in TC-IR-01 §7: every check annotated with what it proves and what it does not, including at least one check that would still pass with the mitigation removed, and one that exercises the application end to end.
## 7.3 Recovery
R-1. Restore service in a controlled order, lowest-risk first.
R-2. Apply heightened attention for thirty days: the deny rule’s refusals are reviewed daily, and anything matching §5 starts this runbook again.
R-3. Confirm the remediation still behaves as intended under test at the end of the monitoring period.
R-4. Only the IC declares closure, and only when R-1 through R-3 are complete and the written report on TC-IR-01 is finished.
## 8. The carrier, and who may speak
Notify the Breach Response Unit within 72 hours of Discovery by telephone, followed by written notice on Form CYB-N1. This is a condition of coverage.
Beyond what is reasonably necessary to contain an incident in progress, no expense is incurred without the carrier’s prior written consent. Forensics, counsel, notification, and public relations come from the carrier’s panel.
No public statement, customer notice, or admission of any kind without the carrier’s prior written consent. The owner is the only person who speaks outside the company, and the support desk speaks only from the holding statement.
## 9. Afterward
The written report is completed on template TC-IR-01 before the review, and retained for seven years.
A blameless review is held within ten business days of closure. The subject is the system conditions that permitted the incident, never the individuals involved.
Every corrective action leaves the review with a named owner and a target date.
Where the response revealed a gap in this runbook, the runbook is updated in the same week.
## 10. What this runbook cannot do yet
These limits are written down here so that nobody discovers them for the first time at 2 a.m. Each one is a corrective action with an owner, not a complaint.

| Limit | Consequence | Corrective action and owner |
|---|---|---|
| Almost nothing on this system records history | We usually cannot say when something started, only when it was noticed; §5.3 of every report will be long | Access-history project (developer, Q4) |
| Detection is a person noticing | An overnight incident waits for the next person to look | Same project; until then, honesty in the severity commitments (§4) |
| Backups exist but restoration is untested | Recovery from backup is an assumption, not a capability | First restore test (developer, October 15) |
| Three people, no rotation | A Severity 1 during vacation season may land entirely on one person | Alternates named in §3; revisit at the next review |

## Appendix A. Contacts

| Who | How | When |
|---|---|---|
| Carrier Breach Response Unit (24x7) | Telephone number on the policy schedule; card taped inside the server cabinet and at the support desk | Severity 1 within 24 hours; anything notifiable within 72 |
| Team lead / Developer / Security reviewer | Mobile numbers on the same card | Per §6, Step 1 |
| Owner | Mobile, on the same card | Informed of any Severity 1 or 2, and of any offline decision |
| Privacy counsel | Through the Breach Response Unit only | Any incident touching customer data |

## Appendix B. Holding statement for the support desk
"We are investigating a technical issue affecting the customer
portal. If your information is affected, we will contact you
directly. I am not able to share more detail yet, and I would
rather tell you nothing than tell you something wrong."
The desk may read this, paraphrase it, or repeat it. It may not add to it.
## Appendix C. Evidence checklist
Timestamped copies of the application directory and data/portal.sqlite, taken before any change.
The IC log: every action, time, and person.
The senior analyst’s written determination.
Change records for every containment and eradication action.
Before-and-after output for every verification check in the report’s §7.
