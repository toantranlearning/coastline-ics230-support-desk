# Cyber Incident Response Playbook

**Kestrel Specialty Insurance Group: Cyber, Privacy and Technology Liability**

| | |
|---|---|
| Document | Appendix C to Form CYB-11 (Rev. 7.2) |
| Policy number | CYB-4471-08 |
| Named insured | TechCorp Services, Inc. |
| Effective | January 1, 2026 |
| Supersedes | Rev. 6.4 (January 1, 2024) |
| Review cycle | Annual, or upon material change to the insured's environment |

---

## 1. Purpose and applicability

1.1 This Playbook establishes the minimum incident response procedure that the Named Insured shall follow upon discovery of a Security Incident. It is derived from NIST Special Publication 800-61, *Computer Security Incident Handling Guide*, and is organized into the four phases described therein.

1.2 **Compliance with this Playbook is a condition precedent to coverage** under Insuring Agreement II (Breach Response Costs) and Insuring Agreement IV (Business Interruption). Failure to follow the procedure set out below may reduce or void recovery for costs incurred.

1.3 This Playbook applies to all information systems owned, leased, or operated by the Named Insured, and to all systems operated on the Named Insured's behalf by a third party.

1.4 This Playbook is a minimum standard. It does not replace the Named Insured's own operational procedures, and the Named Insured remains solely responsible for the security of its environment.

## 2. Definitions

**Security Incident**: any actual or reasonably suspected unauthorized access to, acquisition of, use of, disclosure of, modification of, or destruction of information or information systems.

**Discovery**: the earliest point at which any employee, contractor, or agent of the Named Insured knew or reasonably should have known that a Security Incident had occurred.

**Incident Commander**: the individual designated by the Named Insured to direct the response. There shall be exactly one Incident Commander at any time.

**Containment**: action taken to limit ongoing harm without necessarily removing the cause.

**Eradication**: removal of the cause of the incident and of any attacker-established persistence.

**Severity**: the classification assigned under Appendix A of this document.

## 3. Roles and responsibilities

3.1 The Named Insured shall maintain, and provide to the Carrier on request, a current roster identifying the individuals holding the following roles, with primary and alternate assignments for each:

| Role | Responsibility |
|---|---|
| Incident Commander | Directs the response; sole authority to declare phase transitions |
| Chief Information Security Officer | Accountable executive; approves containment actions with service impact |
| Security Operations Center (SOC) Manager | Owns detection tooling and first-line triage |
| On-call Security Analyst | Acknowledges alerts within the interval specified in §5.2 |
| System Administrator | Executes containment and recovery actions on affected hosts |
| Privacy Counsel | Determines regulatory notification obligations |
| Communications Lead | Sole authorized speaker to media, customers, and partners |
| Executive Sponsor | Approves expenditure outside normal delegation |

3.2 Where the Named Insured's organization does not have a distinct individual for a role, the role shall be assigned to the nearest equivalent position and the assignment documented on the roster.

3.3 *[Insert organization-specific escalation contact list here. Attach as Exhibit C-1.]*

---

## 4. Phase 1: Preparation

Preparation activities are performed **before** an incident. The Carrier will assess the Named Insured's compliance with this section at each policy renewal.

**P-1. Maintain an asset inventory.** Enumerate all systems, applications, and data stores, classified by sensitivity. Review quarterly.

**P-2. Maintain centralized logging.** All in-scope systems shall forward security-relevant events to the Named Insured's Security Information and Event Management (SIEM) platform. Retention shall be not less than twelve (12) months, with ninety (90) days available for immediate query.

**P-3. Maintain endpoint detection.** All servers and workstations shall run the Named Insured's Endpoint Detection and Response (EDR) agent, with the isolation capability enabled and tested.

**P-4. Maintain 24x7 monitoring coverage.** Either through an internal SOC or through the Managed Detection and Response (MDR) provider named in Appendix B.

**P-5. Maintain an on-call rotation.** With a documented escalation path and a tested paging mechanism.

**P-6. Maintain an incident management system.** Tickets shall be opened for all Severity 1 and Severity 2 events.

**P-7. Maintain tested backups.** Restoration shall be tested no less than semi-annually, and at least one copy shall be held offline or immutable.

**P-8. Maintain the Carrier's panel vendor contact details** (Appendix B) in a location accessible without access to production systems.

**P-9. Exercise this Playbook annually.** A tabletop exercise satisfies this requirement. Retain the exercise summary for the Carrier's renewal review.

---

## 5. Phase 2: Detection and Analysis

**D-1. Receive and acknowledge the signal.** Incidents may be identified by monitoring alerts, by a user report, by a third-party notification, or by the Carrier. All sources are treated identically once received.

**D-2. Acknowledge within the required interval.** The on-call analyst shall acknowledge any Severity 1 or Severity 2 alert within fifteen (15) minutes of issuance, at any hour.

**D-3. Validate the signal.** Determine whether the reported activity is genuine before escalating. Rule out routine maintenance, authorized testing, and known false-positive conditions. Do not declare an incident on an unvalidated signal.

**D-4. Assign a severity.** Apply Appendix A. Severity may be revised as understanding improves; the initial classification is not binding.

**D-5. Designate the Incident Commander.** For Severity 1, the CISO shall designate the Incident Commander within thirty (30) minutes of validation.

**D-6. Query the SIEM.** Retrieve all authentication events, privilege changes, and administrative actions for the affected systems covering the thirty (30) days preceding the earliest suspected activity. Extend the window if activity is found at its boundary.

**D-7. Review detection tooling for related activity.** Check EDR detections, data loss prevention (DLP) alerts, and email gateway quarantine for the same period.

**D-8. Establish the timeline.** Correlate events across sources into a single chronological account of the incident.

**D-9. Determine the scope.** Identify the systems, accounts, and data categories affected. Where scope cannot be established, state so explicitly rather than estimating.

**D-10. Preserve evidence.** Evidence shall be preserved before any remediation activity that would alter it. Where systems are virtualized, snapshot the affected virtual machines and preserve the volumes for forensic imaging by the panel forensics vendor.

**D-11. Notify the Carrier.** See §8.

---

## 6. Phase 3: Containment, Eradication, and Recovery

### 6.1 Containment

**C-1. Contain before eradicating.** The objective of containment is to stop ongoing harm while preserving the evidence needed to understand the incident. Rebuilding a system immediately destroys the record of how it was reached.

**C-2. Isolate affected endpoints.** Use the EDR console's network isolation function. Do not power off affected systems; volatile memory is evidence.

**C-3. Revoke access for affected principals.** Through the identity provider, force a global session revocation and require multi-factor re-enrollment on next sign-in.

**C-4. Disable affected accounts** in the directory service.

**C-5. Block attacker infrastructure.** Add identified indicators to perimeter and endpoint block lists.

**C-6. Suspend automated deployment pipelines** serving the affected systems until eradication is complete.

**C-7. Notify the cloud service provider.** For incidents involving cloud-hosted resources, open a case with the provider's security team through the management console and request their assistance with account-level indicators.

**C-8. Engage the Managed Detection and Response provider** under the panel agreement (Appendix B) for continuous monitoring during the response period.

### 6.2 Eradication

**E-1. Remove attacker persistence.** Identify and remove any accounts, scheduled tasks, services, keys, agents, or code introduced by the attacker.

**E-2. Rotate credentials.** Reset passwords for all affected accounts. Rotate any API keys, service account credentials, or certificates that may have been exposed.

**E-3. Remediate the root cause.** Apply the patch, configuration change, or code change that closes the entry path. An incident is not eradicated while the entry path remains open.

**E-4. Reimage where warranted.** Systems on which attacker code executed should be rebuilt from a known-good image rather than cleaned in place.

**E-5. Validate.** Confirm that the actions above were effective before proceeding to recovery.

### 6.3 Recovery

**R-1. Restore service** in a controlled sequence, lowest-risk systems first.

**R-2. Monitor for recurrence.** Apply heightened monitoring to the affected systems for a period of not less than thirty (30) days.

**R-3. Verify that controls function.** Confirm that the remediation from E-3 behaves as intended under test.

**R-4. Declare the incident closed.** Only the Incident Commander may declare closure, and only when R-1 through R-3 are complete.

---

## 7. Phase 4: Post-Incident Activity

**L-1. Hold a post-incident review** within ten (10) business days of closure. The review shall be blameless: its purpose is to identify the system conditions that permitted the incident, not the individuals involved.

**L-2. Document actions taken.** Produce a written incident report for retention.

**L-3. Identify corrective actions.** Each shall have a named owner and a target date.

**L-4. Update this Playbook and the Named Insured's own procedures** where the response revealed a gap.

**L-5. Retain the incident file** for not less than seven (7) years, or the applicable statutory period, whichever is longer.

---

## 8. Carrier notification requirements

8.1 The Named Insured shall notify the Carrier's Breach Response Unit **within seventy-two (72) hours of Discovery** of any Security Incident reasonably likely to result in a claim, by telephone to the number in Appendix B, followed by written confirmation.

8.2 Written notice shall be given on Form CYB-N1 and shall state:

| Field | Notes |
|---|---|
| Policy number | |
| Date and time of Discovery | Local time, with time zone |
| Date and time of the earliest known activity | |
| Nature of the incident | Select from the categories on the form |
| Severity assigned | Per Appendix A |
| Systems affected | By name |
| Estimated number of affected individuals | Provide a range if exact figures are unavailable |
| Categories of information involved | Per the form's schedule |
| Estimated financial loss to date | |
| Whether law enforcement has been contacted | |
| Whether a ransom demand has been received | |
| Incident Commander and contact details | |

8.3 **No expense shall be incurred without the Carrier's prior written consent**, other than expenses reasonably necessary to contain an incident in progress. Legal, forensic, notification, credit monitoring, and public relations services shall be procured from the panel vendors listed in Appendix B unless the Carrier consents in writing to an alternative.

8.4 The Named Insured shall not admit liability, settle any claim, or make any public statement regarding the incident without the Carrier's prior written consent.

---

## Appendix A: Severity classification

| Severity | Criteria | Response |
|---|---|---|
| 1: Critical | Confirmed unauthorized access to regulated or confidential data; or loss of availability of a business-critical system | Immediate; Incident Commander designated within 30 minutes; Carrier notified within 24 hours |
| 2: High | Suspected unauthorized access; confirmed compromise of a credential with privileged access; malware with lateral movement capability | Within 1 hour; Carrier notified within 72 hours |
| 3: Moderate | Contained compromise of a single non-privileged account or endpoint with no evidence of data access | Within 1 business day |
| 4: Low | Policy violation, unsuccessful attack, or nuisance activity with no impact | Next business day; tracked, not escalated |

## Appendix B: Panel vendors and contacts

*[Carrier to supply current panel schedule at binding. Attach as Exhibit C-2.]*

| Service | Vendor | Contact |
|---|---|---|
| Breach Response Unit (24x7) | Kestrel Specialty | *[see Exhibit C-2]* |
| Digital forensics | *[panel vendor]* | |
| Managed Detection and Response | *[panel vendor]* | |
| Breach counsel | *[panel firm]* | |
| Notification and call center | *[panel vendor]* | |
| Public relations | *[panel firm]* | |

---

## Attestation

The undersigned certifies that the Named Insured has reviewed this Playbook, has assigned the roles in §3, and is in compliance with the Preparation requirements in §4.

```text
Signed: ______________________________   Date: ______________

Name:   ______________________________

Title:  ______________________________
```

*This document is provided by Kestrel Specialty Insurance Group as a minimum standard for policyholders and is not a substitute for professional security advice. It is generic to the policyholder base and is not tailored to any individual insured's environment.*
