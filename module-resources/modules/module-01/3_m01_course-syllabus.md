# Course Syllabus

<!-- banner: ICS230_banner_light.png | Coastline College, ICS 230, Secure Coding and Design -->
## ICS C230: Secure Coding and Design

**Coastline College** · Information Computer Sciences **Modality:** Distance Education (fully online) **Units:** 3 · **Lecture hours:** 54 · **Outside-of-class hours:** 108 **Transferability:** Transfers to CSU **Advisories:** ICS C120, ICS C123, CYBR C101

These advisories identify the recommended preparation for this course. Students should be comfortable tracing code, using variables, conditions, loops and functions, and working through errors. The course builds on that programming experience to develop security analysis and design judgment. The browser-based lab is introduced in Orientation, and Module 01 introduces PHP language fundamentals; students who need a refresher should begin with the PHP Coding Standards page and contact the instructor early.

> [!NOTE] How the course is structured
> Course Orientation is both the starting point and a reference library for the rest of the course. It contains reference pages on topics such as the lab environment, Rules Of Engagement, writing reports, using AI, etc. Students return to these pages as they move through the modules; they are not only first-day reading. Each content module introduces its security concepts, teaches the methods, and provides opportunities to apply and assess them. Module pages point back to the shared Orientation references, while assignments explain the incident, repair scope, tests, and deliverables for that task.

> [!CONCEPT] What the course covers
> Secure coding and design are the course's central focus. Coverage includes topics such as:
>
> - **Secure design:** trust boundaries, threat modeling, risk assessment, least privilege, and security requirements.
> - **OWASP:** the Top 10:2025 and prevention guidance for injection, cross-site scripting, access-control failures, security misconfiguration, and other application weaknesses.
> - **Web application concepts:** browser and server behavior, HTTP requests and responses, HTML output, databases, cookies, sessions, and REST APIs.
> - **Security controls:** input validation, output encoding, parameterized queries, authentication, authorization, password protection, cryptography, TLS, security headers, and safe file handling.
> - **Incident response and reporting (IR):** analyzing assigned incidents, documenting evidence and root causes, explaining response actions, verifying repairs, and relating the work to NIST guidance.
> - **Security verification and maintenance:** interpreting supplied scan findings, testing controls, handling errors, recording security events, reviewing dependencies, and refactoring code.
> - **PHP Companion:** reading and modifying the PHP used in the lab. Module 01 introduces the language; lesson-specific PHP companion pages explain relevant syntax and functions. PHP and environment setup support the security work.
>
> These examples describe the course's coverage without listing every topic. Students apply the concepts through authorized lab work, incident reports, case discussions, and the secure design project. Lab repairs remain in their source files, such as `.php`; incident reports are written in Markdown (`.md`) with explanations and evidence.


---

## Instructor and communication


| **Field** | **Details** |
|---|---|
| **Instructor** | Toan Tran, MS, CISSP |
| **Primary contact** | Canvas Inbox |
| **Secondary contact** | tqtran@coastline.edu (use when Canvas is unavailable) |
| **Appointments** | https://scheduler.zoom.us/toan-tran-xq4byl |
| **Response time** | 24 to 48 hours, longer on weekends, holidays, and campus breaks |

Course correspondence is conducted through the Canvas Inbox, which forwards to the student's Coastline email address and retains a record of the exchange for institutional compliance. Announcements carry course updates.

Students are expected to check the Canvas Inbox, their Coastline email account, and Announcements **daily**, and are responsible for configuring Canvas notification preferences so that course communication is received.

Technical assistance with Canvas is available through Coastline Canvas Support, reachable from the Help button in the Canvas navigation menu.

## Catalog description

Secure coding and design have become critical as cyber threats and data breaches rise. This course covers the best practices, principles, and techniques for identifying and mitigating security vulnerabilities in software. Students learn to design and build applications with security in mind, reducing the risk of exploitation.

## Student learning outcomes

Upon successful completion of this course, students will be able to:

1. Describe the key principles of secure coding and design.
2. Provide mitigation techniques for common vulnerabilities, including injection, cross-site scripting, and cross-site request forgery.
3. Design and develop a software application with security in mind.

Each outcome is assessed across the course's graded categories: module assignments, the design project, the midterm, the forums, and quizzes. Outcome 2 is assessed in full by the Module 04 to 06 incident reports and the midterm practical; outcome 3 by the design project, which runs from Module 08 to Module 16.

## Methods of instruction

Instruction is delivered asynchronously and organized around three no-cost sources:


| **Source** | **Instructional function** |
|---|---|
| The lecture page in each module | Teaches everything the module's quiz and assignment need; opens with the required reading |
| OWASP Top 10:2025 and the OWASP Cheat Sheet Series, with a CLARK module (clark.center) where one matches | The required reading in each lecture: the same material in the industry's own words |
| The TechCorp customer portal, a deliberately insecure PHP application in the student's own Google Cloud Shell | The practice target the student repairs across the term, launched from the Launch Course Environment page in Module 01 and edited in the Cloud Shell editor |

Each module's pages appear in a fixed order: a preface (what the module is for, its objectives, and how it is shaped), the lecture, a case-study forum on odd-numbered Modules 03 to 15, the quiz, and the assignment or lab. Module 01 opens with the introductions forum and closes with the setup lab. Module 02 has one graded design-and-repair assignment. Module 07 has a scan-reading assignment. Module 08 adds the midterm companion, the design project kickoff, the Design Project Expectations page, and the midterm practical page. Module 12 carries the design project draft and Module 16 the design project final.

Students repair the portal itself. In Module 01 each student launches their own copy of the portal in Google Cloud Shell and works in that copy for the rest of the term, changing its code in the editor. There is nothing to install and no local server. In eleven modules a TechCorp security incident arrives against one of the portal's features. The student writes the incident report on the TC-IR-01 form, then reproduces the incident in their own copy, repairs the code, and proves the fix with two tests: the hostile request fails after the change, and legitimate use still works. The report and the fix are submitted together.

As a Distance Education course, each module includes asynchronous instruction and an instructor-assessed deliverable, and the instructor participates in the graded discussion forums, satisfying the requirement for regular and substantive interaction.

Course materials are written at transfer level. Students read specifications, published standards, vendor advisories, and vulnerability disclosures in their professional form rather than in adapted summaries, because accurate interpretation of technical documentation is itself a course competency: requirements that are misread produce defective software, and gaps in requirements produce insecure software.

### Original and working portal copies

The Cloud Shell workspace contains `site/` (original, port 8080), `fixed/` (working repairs, port 8081), and `reports/` (evidence and writing). Students reproduce the starting behavior in `site/`, change code in `fixed/`, and prove both hostile rejection and legitimate success in the working copy. Each portal has its own database. Repairs accumulate in `fixed/` throughout the term. Submit the complete changed source files with the required report and evidence; code snippets in a report do not replace the source files. The setup lab downloads its practice edits before restoring the two labels; the design lab keeps its router mitigation.

## Required materials

The total required materials cost for this course is **$0.00**. No textbook purchase and no access code are required.

**The lab:** each student works in their own copy of the TechCorp customer portal in Google Cloud Shell, reached from a browser, with a built-in editor for changing its code. There is nothing to install and no local server.

**Optional local environment:** a student who prefers to work offline may run the portal locally with PHP 8.2 or newer (with the SQLite database driver) and a code editor such as Visual Studio Code. This path is optional and unsupported: help in the course targets the course environment.

**Accounts:** a Google account for Cloud Shell, a no-cost CLARK account (clark.center) for the CLARK readings, and an active Coastline student email account.

**Reference materials:** OWASP Top 10:2025; OWASP Cheat Sheet Series; the PHP Manual (php.net); MDN Web Docs; W3Schools PHP.

**Optional:** Janca, T. *Alice and Bob Learn Secure Coding.* Wiley, 2025. Not required and not assessed.

**Technology requirements:** the lab runs in the student's own Google Cloud Shell environment, so a browser, a keyboard, and a Google account are enough. A Chromebook, a school computer, or a home laptop all complete the work equally. There is no software to install and no administrator rights required. No scanner or attack tool runs in the course environment; in Module 07 students analyze supplied testing evidence. Canvas supports the current and prior major versions of Chrome, Firefox, Edge, and Safari.

## Methods of evaluation


| **Component** | **Weight** | **Count** |
|---|---|---|
| Quizzes | 40% | 16 graded quizzes |
| Assignments (reports and repairs, labs, analyses, both midterm parts, and project submissions) | 40% | 19 |
| Forums (introductions and seven case studies) | 20% | 8 |

**Module assignments.** In eleven modules (03 to 06, 08 to 11, and 13 to 15) a TechCorp security incident arrives against one of the portal's features, and the assignment has the same two parts each time. First, the incident report: on the TechCorp TC-IR-01 form, the student documents what happened, how it happened, the response, and the confirmation that it is fixed. Second, the hands-on fix: the student reproduces the incident in their own course environment, repairs the code in the editor, and proves the fix holds, so that the hostile request fails afterward while legitimate use still works. The report and the fix are submitted together. The Module 01 setup lab report, the Module 02 design-and-repair assignment, and the Module 07 scan reading and tool comparison are graded in this category.

**Design project.** A partner REST API for the portal, designed by each team of three in one shared document with three sections (authentication; authorization and data; operations) and built by each member under `api/` in their own course environment, tested with `curl` typed by hand. The required core, built by every member, is API-key authentication, the exchange of a key for a scoped, expiring token, a per-object ownership check, input validation, and errors that leak nothing. Kickoff at Module 08, one increment on each assignment page from Module 09 to Module 15, draft at Module 12, final at Module 16. At the final each member also submits a decision under challenge: the strongest objection to one safeguard they authored, defended with reasoning or conceded with a stated reason. The Design Project Expectations is a page in Module 08 and is attached to the project in Canvas.

**Midterm examination.** In Module 08, in two parts. The timed practical is taken in Canvas without assistance: one seeded flaw from the Modules 01 to 07 material is placed in the student's own portal copy, and the student diagnoses it, repairs it, proves the repair, and submits a Markdown report. The practical page in Module 08 states the time limit and the conditions. The written companion is a take-home analysis of one documented real-world breach: the root cause named in the course's vocabulary with its CWE, the control that would have prevented it, and the response judged on detection, containment speed, and disclosure.

**Discussion forums.** In Module 01 the forum is the introductions, graded complete or incomplete. Each odd-numbered module from 03 to 15 has one case forum about one real incident whose root cause is that module's topic. Students say what the organization did wrong in the module's own vocabulary, name the specific control that would have prevented it, and reply substantively to a classmate. The initial post is due Friday and the reply Sunday.

**Module quizzes.** Ten multiple-choice items per module drawn from that module's lecture page, one attempt, graded automatically in Canvas. The appendix quiz is practice.

Module assignments, the design project, and the case forums are evaluated against the rubrics on the *How Your Work Is Graded* page. Feedback is returned within one week of the due date through the Canvas rubric, submission annotations, or assignment comments. Quizzes return results automatically.

### Grading scale


| **Letter grade** | **Percentage** |
|---|---|
| A | 90 to 100% |
| B | 80 to 89% |
| C | 70 to 79% |
| D | 60 to 69% |
| F | 59% and below |

Final grades are calculated by weighted category rather than by total points.

## Course policies

### 7.1 Module schedule and deadlines

Each module opens Monday at 12:00 a.m. and closes Sunday at 11:59 p.m. Pacific Time. In Module 01 and on odd-numbered Modules 03 to 15, the forum post is due Friday at 11:59 p.m., with the required reply to a classmate due Sunday at 11:59 p.m. Quizzes and module assignments are due Sunday at 11:59 p.m.

### 7.2 Late work

Quizzes and the midterm practical close on the posted due date; no late attempts are available. Module assignments and the design project are accepted for up to seven calendar days after the due date, with a penalty of ten percent per day. Forum posts are not accepted once the forum has closed. No work is accepted after the last day of instruction. Alternative arrangements for documented circumstances must be requested in advance of the deadline.

### 7.3 Participation and enrollment

Participation in a Distance Education course is determined by the frequency and substance of a student's interaction: discussion contributions, quizzes completed, and assignments submitted.

Students who do not participate during the first week of instruction will be dropped. First-week participation requires completion of the Student Learning Contract, an introduction posted to the Module 01 discussion with a reply to a classmate, and submission of the Module 01 setup lab report and Quiz 1.

Following the first week, a student with no login activity or submitted work for five consecutive days may be dropped from the course. Students who experience circumstances affecting their participation should notify the instructor as early as possible.

Students remain responsible for officially withdrawing from a course they no longer attend. Refund, drop, and withdrawal deadlines are specific to each section and are listed in the Student Class Program (Web Schedule Bill) in MyCCC. A student who does not withdraw before the final withdrawal deadline will receive a grade for the course regardless of completion.

### 7.4 Academic integrity

Students are responsible for reading, understanding, and abiding by the Coastline College Academic Honesty Policy, published in the college catalog. Academic dishonesty includes submitting another person's work as one's own, using unauthorized materials during an assessment, obtaining or sharing assessment content, using sources without attribution, and assisting another student in any of these acts. Violations are addressed under college policy and may result in a failing grade for the assignment or the course and referral for disciplinary action.

Integrity in this discipline carries professional weight beyond the academic setting. Recognized security credentials, including the CISSP, impose codes of ethics whose violation results in revocation.

### 7.5 Generative artificial intelligence

Generative AI assistance is permitted on labs, module assignments, forum preparation, and the design-project build. Students may request explanations, generate or refactor code, propose tests, compare designs, and revise drafts. This course develops secure-coding judgment on top of prior programming experience. Students are assessed on the accuracy of their reasoning, their verification, and their ability to explain the work they submit.

AI-assisted code may be submitted when the student has read it, checked its fit with the existing application, tested it, and can explain its security mechanism and limitations. Written reports and forum posts may use AI for planning and editing; the final claims must reflect the student's own analysis and observations. A tool's suggested result is not evidence that a test passed.

Students disclose the tool, the help requested, the output used or changed, and the checks performed in the AI DISCLOSURE line of the report, or a short note at the end of a forum post. Disclosed AI assistance is allowed and does not itself reduce the grade. Fabricated evidence, undisclosed assistance, or presenting unverified generated claims as observations does not meet the course requirements.

Quizzes, the midterm practical and its companion assessment, and the design project's individual decision under challenge remain unaided. AI assistance, including editor completions, is disabled during these assessments. Specific assessment instructions govern any exception.

Students use only demo data and their own authorized portal copy. They do not upload credentials, real personal data, classmates' submissions, or protected assessment content. AI instructions are a learning aid, not an enforcement mechanism. Students remain responsible for following the course policy.

### 7.6 Authorized use of security tools

No student runs a scanner or attack tool in the course environment: it is Google Cloud Shell, whose terms of service prohibit network scanning. In Module 07 students analyze the supplied testing evidence packet and compare Nessus, OWASP ZAP, and Burp Suite. This course build uses a clearly labeled simulated packet.

Students may test only their own copy of the TechCorp customer portal in their course environment, and only within the assignment's rules of engagement. Testing means requests typed by hand at the student's own portal, in the browser or with `curl`, and nothing else.

Unauthorized scanning or exploitation of any other system, including college systems, employer systems, the environments belonging to other students, and publicly accessible websites, violates the Coastline College student conduct code and applicable state and federal computer crime statutes, including California Penal Code section 502 and the federal Computer Fraud and Abuse Act. Such conduct will be addressed as a serious violation without regard to intent or outcome.

Students use the portal's demo accounts only, and never place real data or real passwords in the application.

### 7.7 Accommodations

It is the policy and practice of Coastline College to create inclusive and accessible learning environments consistent with federal and state law. Students who encounter barriers in this course or who qualify for academic accommodations should contact Special Programs and Services at specialprograms@coastline.edu or 714-241-6214. Accommodations are established through an interactive process involving the student, the instructor, and a Special Programs counselor, and are not applied retroactively. Students are encouraged to initiate this process at the beginning of the term.

### 7.8 Syllabus revision

This syllabus constitutes an educational agreement between the instructor and enrolled students. The instructor may revise it to correct errors or to incorporate necessary changes. Students will be notified of any revision through Canvas Announcements.

## Course outline and schedule


| **Module** | **Topic** | **OWASP Top 10:2025** | **Graded deliverables** |
|---|---|---|---|
| 1 | Thinking like a secure developer; launching the course environment | Top 10 overview | Introductions forum (complete or incomplete); Quiz 1; setup lab report |
| 2 | Security by design and threat modeling; incident-response basics | A06 Insecure Design | Quiz 2; one guided design-and-repair assignment (short worksheet and changed router.php) |
| 3 | Input validation and output encoding | A05 Injection | Forum; Quiz 3; incident report and fix TC-IR-002 |
| 4 | Injection attacks | A05 Injection | Quiz 4; incident report and fix TC-IR-003 |
| 5 | Cross-site scripting | A05 Injection | Forum; Quiz 5; incident report and fix TC-IR-004 |
| 6 | Cross-site request forgery | A01 Broken Access Control | Quiz 6; incident report and fix TC-IR-005 |
| 7 | Security testing and scanning | A02 Security Misconfiguration | Forum; Quiz 7; scan reading and tool comparison |
| 8 | Access control and authorization; HTTP and REST primer | A01 Broken Access Control | Quiz 8; incident report and fix TC-IR-007; **midterm practical and companion**; design project kickoff |
| 9 | Authentication, sessions, password hashing, and multifactor authentication | A07 Authentication Failures | Forum; Quiz 9; incident report and fix TC-IR-008 |
| 10 | Cryptography and data protection | A04 Cryptographic Failures | Quiz 10; incident report and fix TC-IR-009 |
| 11 | Secure communication and TLS | A04 Cryptographic Failures | Forum; Quiz 11; incident report and fix TC-IR-010 |
| 12 | Securing REST APIs | A01 Broken Access Control | Quiz 12; **design project draft** |
| 13 | Security headers, content security policy, and secure upload | A02 Security Misconfiguration | Forum; Quiz 13; incident report and fix TC-IR-011 |
| 14 | Error handling, logging, and incident response | A09 Logging and Alerting Failures; A10 | Quiz 14; incident report and fix TC-IR-012 |
| 15 | Case studies, dependencies, and secure refactoring | A03 Software Supply Chain Failures | Forum; Quiz 15; incident report and fix TC-IR-013 |
| 16 | Capstone: collaborative secure design | All categories | Quiz 16; **design project final: team design document, individual build and decision under challenge** |

An appendix on race conditions and concurrency follows Module 16: a lecture, an optional forum, and a practice quiz. None of it is graded.

Calendar dates for each module are published on the Module Schedule page in Canvas and in the Canvas Calendar, which are authoritative for all deadlines.

---

*ICS C230, Secure Coding and Design. Coastline College, Information Computer Sciences.*

---

Early reports use supplied worksheets: M01 records setup and a comparison; M02 adds brief design reasoning and before/after repair evidence. Full incident-report detail is introduced progressively in later vulnerability assignments.
