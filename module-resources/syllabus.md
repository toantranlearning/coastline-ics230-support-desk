# ICS C230: Secure Coding and Design

**Coastline College** · Information Computer Sciences
**Modality:** Distance Education (fully online, asynchronous) · sixteen content modules plus Course Orientation
**Required materials cost to students:** $0.00

---

## 1. Course identification

| Attribute | Specification |
|---|---|
| Course number and title | ICS C230, Secure Coding and Design |
| Section | ICS230-26073 (ONL) |
| Term | October 19, 2026 to December 12, 2026 |
| Units | 3 |
| Lecture hours | 54 |
| Outside-of-class hours | 108 (162 total student learning hours) |
| Modality | Distance Education, fully online and asynchronous |
| Transferability | CSU |
| Advisories | ICS C120, ICS C123, CYBR C101. Recommended programming and cybersecurity preparation; PHP language fundamentals are introduced in Module 01. |
| Required materials cost to students | $0.00 |
| Language and environment | PHP 8.2 or newer, in each student's own copy of the TechCorp customer portal in Google Cloud Shell, worked through a browser |

> [!NOTE] Course structure and standing references
> Course Orientation serves as a reference library throughout the course. Reference pages cover topics such as the lab environment, Rules Of Engagement, writing reports, using AI, etc., and support the work in later modules. Students return to these pages as needed. Content modules introduce and teach the security concepts, then provide practice and assessment; their assignments supply task-specific scope, tests, and deliverables.

> [!CONCEPT] What the course covers
> Secure coding and design are the course's central focus. Coverage includes topics such as:
>
> - **Secure design:** trust boundaries, threat modeling, risk assessment, least privilege, and security requirements.
> - **OWASP:** the Top 10:2025 and prevention guidance for injection, cross-site scripting, access-control failures, security misconfiguration, and other application weaknesses.
> - **Web application concepts:** browser and server behavior, HTTP requests and responses, HTML output, databases, cookies, sessions, and REST APIs.
> - **Security controls:** input validation, output encoding, parameterized queries, authentication, authorization, password protection, cryptography, TLS, security headers, and safe file handling.
> - **Incident response and reporting (IR):** analyzing assigned incidents, documenting evidence and root causes, explaining response actions, verifying repairs, and relating the work to NIST guidance.
> - **Security verification and maintenance:** interpreting supplied scan findings, testing controls, handling errors, recording security events, reviewing dependencies, and refactoring code.
> - **PHP language support:** reading and modifying the PHP used in the lab. Module 01 introduces the language; lesson-specific PHP companion pages explain relevant syntax and functions. PHP and environment setup support the security work.
>
> These examples describe the course's coverage without listing every topic. Students apply the concepts through authorized lab work, incident reports, case discussions, and the secure design project. Lab repairs remain in their source files, such as `.php`; incident reports are written in Markdown (`.md`) with explanations and evidence.

## 2. Catalog description

This course provides the knowledge and skills necessary to develop secure software applications and systems. In an era of increasing cyber threats and data breaches, secure coding and design have become critical aspects of software development. The course covers best practices, principles, and techniques for identifying and mitigating security vulnerabilities in software. Students learn to design and develop applications with security in mind, reducing the risk of exploitation and data breaches.

## 3. Student learning outcomes

Learning outcomes are statements of the knowledge, skills, and abilities individual students should possess and can demonstrate upon completing a learning experience. Upon successful completion of this course, students will be able to:

1. Describe the key principles of secure coding and design in software development.
2. Provide mitigation techniques for common software vulnerabilities such as injection attacks, cross-site scripting, and cross-site request forgery.
3. Design and develop a software application with security in mind to reduce the risk of exploitation.

The mapping of each outcome to the instruments that assess it is recorded in the companion documents *docs/01-course-alignment* and *docs/05-assessment*.

## 4. Instructor and communication

| Field | Details |
|---|---|
| Instructor | Toan Tran, MS, CISSP |
| Channel of record | Canvas Inbox |
| Email (documented fallback) | tqtran@coastline.edu |
| Response time | 24 to 48 hours, and longer on weekends, holidays, and academic breaks |

The Canvas Inbox is the channel of record for this course, and it retains a record of every exchange. Email is the documented fallback for use when Canvas itself is unavailable.

Students are expected to check the Canvas Inbox and course Announcements regularly, and are responsible for setting their Canvas notification preferences so that announcements and updates reach them by email or text message.

Technical assistance with Canvas is available from Coastline Canvas Support through the Help button in the Canvas navigation bar. Students may begin the course after completing the Student Learning Contract and the Course Orientation module.

## 5. Required materials and cost

The total required materials cost to students is $0.00. There is no textbook to purchase and no access code to buy.

- **The lab.** Each student works on their own copy of the TechCorp customer portal in Google Cloud Shell, a free browser-based Linux environment that runs in the student's own Google account. The copy is launched once from the Launch Course Environment page in Module 01 and edited in the Cloud Shell editor. There is nothing to install, no cost, and no credit card required. A personal Google account is enough.
- **Lecture pages.** Each module has one authored lecture page that teaches everything the module's quiz and assignment need. Each lecture opens with its required reading: the module's OWASP Top 10:2025 entry and its main OWASP Cheat Sheet, plus a CLARK module (https://clark.center/, free account) where one matches the module. The readings give the same material in the industry's own words.
- **References.** The OWASP Top 10:2025 and the OWASP Cheat Sheet Series (https://cheatsheetseries.owasp.org/), the PHP Manual (https://www.php.net/manual/), MDN Web Docs, and W3Schools PHP (https://www.w3schools.com/php/).
- **Legacy material of record.** The Course Outline of Record lists an appropriate open educational resource as optional. *Alice and Bob Learn Secure Coding* (Janca, Wiley, 2025) is retained as optional supplementary material and is not assigned.

## 6. Technology requirements

- **The lab environment.** Everything hands-on runs in the student's own Cloud Shell copy of the portal, so a browser, a keyboard, and a Google account are enough. A Chromebook, a school computer, or a home laptop all complete the work equally. There is no software to install and no administrator rights required.
- **Optional local environment.** A student who prefers to work offline may run the portal locally with PHP 8.2 or newer (with `pdo_sqlite`) and a code editor such as Visual Studio Code. This path is optional and unsupported; help in the course targets the Cloud Shell copy.
- **No scanner.** No scanner or attack tool runs in Cloud Shell, because Google's Cloud Shell terms of service prohibit network scanning. In Module 07 students analyze the supplied testing evidence packet. This course build uses a clearly labeled simulated packet. Testing in this course means requests typed by hand at the student's own portal, in the browser or with `curl`.
- **Browser.** Canvas supports the current and prior major versions of Chrome, Firefox, Edge, and Safari.

## 7. Course structure

The course is delivered in sixteen content modules completed in sequence, preceded by a Course Orientation module. The course is module-paced: no week numbers appear in the student-facing content, and the term calendar exists as Canvas due dates. Two modules run per week across the eight-week term, the orientation and first modules open on the first day, and each later module opens before its due date.

Each module's pages appear in this order: a preface (what the module is for, its objectives, and how it is shaped), the lecture, a case-study forum on odd-numbered Modules 03 to 15, the quiz, and the assignment or lab. Module 01 opens with the introductions forum and closes with the setup lab. Module 02 has a lab and a runbook review. Module 07 has a scan-reading assignment. Module 08 adds the midterm companion, the design project kickoff, the Design Project Expectations page, and the midterm practical page. Module 12 carries the design project draft and Module 16 the design project final. An ungraded appendix on race conditions (a lecture, an optional forum, and a practice quiz) follows Module 16.

### 7.1 The assignment model

Every vulnerability module opens with a TechCorp security incident against one of the portal's features, and the assignment has the same two parts each time:

1. **The incident report.** The student documents the incident on the TechCorp TC-IR-01 form: what happened, how it happened, the response, and the confirmation that it is fixed. The worked example, TC-IR-001, is on the TC-IR-01 Form and Worked Example page in Course Orientation.
2. **The hands-on fix.** The student reproduces the incident in their own portal copy, repairs the code, and proves the fix with two tests: the hostile request fails after the change, and legitimate use still works. The report and the fix are submitted together.

Each fix stays in the student's own copy, so the portal is repaired across the term by the student's own work. Scenarios are set at a fictional company, TechCorp, where the student is the security reviewer.

### Original and working portal copies

The Cloud Shell workspace contains `site/` (original, port 8080), `fixed/` (working repairs, port 8081), and `reports/` (evidence and writing). Students reproduce the starting behavior in `site/`, change code in `fixed/`, and prove both hostile rejection and legitimate success in the working copy. Each portal has its own database. Repairs accumulate in `fixed/` throughout the term. Submit the complete changed source files with the required report and evidence; code snippets in a report do not replace the source files. The setup lab downloads its practice edits before restoring the two labels; the design lab keeps its router mitigation. The readiness review remains a written review.

### 7.2 Course outline

| Module | Topic | OWASP Top 10:2025 | Graded deliverables |
|---|---|---|---|
| Orientation | Course orientation, syllabus, Student Learning Contract | n/a | Student Learning Contract |
| M01 | Thinking like a secure developer; launching the course environment | Top 10 overview | Introductions forum (complete or incomplete); Quiz 1; setup lab report |
| M02 | Security by design and threat modeling; incident-response basics | A06 Insecure Design | Quiz 2; guided design lab (three claims, one flow/threat/requirement, stopgap and tests); short runbook review |
| M03 | Input validation and output encoding | A05 Injection | Forum; Quiz 3; incident report and fix TC-IR-002 |
| M04 | Injection attacks | A05 Injection | Quiz 4; incident report and fix TC-IR-003 |
| M05 | Cross-site scripting (XSS) | A05 Injection | Forum; Quiz 5; incident report and fix TC-IR-004 |
| M06 | Cross-site request forgery (CSRF) | A01 Broken Access Control | Quiz 6; incident report and fix TC-IR-005 |
| M07 | Security testing and scanning | A02 Security Misconfiguration | Forum; Quiz 7; scan reading and tool comparison |
| M08 | Access control and authorization; HTTP and REST primer | A01 Broken Access Control | Quiz 8; incident report and fix TC-IR-007; midterm practical; midterm companion; design project kickoff |
| M09 | Authentication, sessions, password hashing, and MFA | A07 Authentication Failures | Forum; Quiz 9; incident report and fix TC-IR-008 |
| M10 | Cryptography and data protection | A04 Cryptographic Failures | Quiz 10; incident report and fix TC-IR-009 |
| M11 | Secure communication (SSL/TLS) | A04 Cryptographic Failures | Forum; Quiz 11; incident report and fix TC-IR-010 |
| M12 | Securing REST APIs | A01 Broken Access Control | Quiz 12; design project draft |
| M13 | Security headers, CSP, and secure file upload | A02 Security Misconfiguration | Forum; Quiz 13; incident report and fix TC-IR-011 |
| M14 | Error handling, logging, and incident response | A09 Logging and Alerting Failures; A10 | Quiz 14; incident report and fix TC-IR-012 |
| M15 | Case studies, dependencies, and secure refactoring | A03 Software Supply Chain Failures | Forum; Quiz 15; incident report and fix TC-IR-013 |
| M16 | Capstone: collaborative secure design | All categories | Quiz 16; design project final |

The Module 01 lecture introduces the OWASP Top 10:2025 as a naming system; each later module teaches the category its incident falls under. REST API security (Module 12) is taught in the lecture and applied in the design project, where each team designs and each member builds a partner REST API. The complete content-area mapping is recorded in the companion document *coverage.md*.

## 8. Assessment and grading

Every scored quiz, assignment, midterm part, project submission, and case-study forum is worth 100 points. Introductions remains complete/incomplete; ungraded activities remain ungraded. Two reusable rubrics cover assignments and case-study forums. The course is graded on three weighted categories: quizzes 40%, assignments 40%, and forums 20%. Points earned within each category determine its contribution; the midterm and project do not have separate category weights.

| Category | Composition | % of final grade |
|---|---|---:|
| Quizzes | Sixteen graded module quizzes; appendix practice quiz is ungraded | 40% |
| Assignments | Incident reports and repairs, labs, written analyses, both midterm parts, and all project submissions | 40% |
| Forums | Introductions and seven case-study discussions | 20% |
| **Total** | | **100%** |

The Student Learning Contract is required and is worth 1 point. Midway and wrap-up feedback surveys are anonymous, ungraded, and carry no points.

**Grading scale**

| Letter grade | Percentage |
|---|---|
| A | 90 to 100% |
| B | 80 to 89% |
| C | 70 to 79% |
| D | 60 to 69% |
| F | 59% and below |

## 9. The submission model

Individual incident reports and lab evidence use Markdown (`.md`), following the Writing in Markdown page in Course Orientation, and are uploaded to the Canvas assignment. The team design project uses a shared document exported to PDF, as its assignment explains. Source code stays in its language's source files, including `.php`.

- **What is submitted.** The completed report as a `.md` file. Text evidence (a `curl` request and its response, a diff, lines from a log or a scan report) goes in fenced code blocks inside the file. Where the evidence is visual, the screenshot files are uploaded with the report.
- **Signed work.** Every report carries the NAME, AI DISCLOSURE, and REFLECTION block at the top. A report without the block is incomplete.
- **The team design document.** The one exception: the design project's team document has three authors and is a shared Google Doc, submitted once as a PDF export. Each member's build report is still a `.md` file.
- **Rules of engagement.** Every assignment states its rules of engagement: which tools and collaboration are in scope, and how to disclose AI use. The student's own portal copy is the only system they are authorized to test.

## 10. The graded work

### 10.1 Module assignments

All labs, incident reports and repairs, written analyses, both midterm parts, and project submissions use the shared Assignment Rubric. Each scored activity is worth 100 points. Activity instructions specify the required deliverables and evidence.

### 10.2 The design project

Each team of three designs a partner REST API for the TechCorp support portal from a requirements memo that lists features and never mentions security. The design lives in one shared document with three sections, authentication, authorization and data, and operations, each with a named owner, plus a threat model and a verification plan. Each member builds the API under `api/` in their own portal copy and tests it with `curl` typed by hand. The required core, built by every member, is API-key authentication, the exchange of a key for a scoped, expiring token, a per-object ownership check, input validation, and errors that leak nothing.

The project starts at the Module 08 kickoff; the Module 08 lecture carries the HTTP and REST primer and the API-key pattern. Modules 09 to 15 each add one increment, stated on that module's assignment page. The draft is due at Module 12 and the final at Module 16, where each member also submits a decision under challenge: the strongest objection to one safeguard they authored, defended with reasoning or conceded with a stated reason. The Design Project Expectations (`rubrics/design-project-rubric.md`) is a page in Module 08 and provides project-specific expectations; the shared Assignment Rubric is attached to each project submission in Canvas.

### 10.3 The midterm

The midterm, in Module 08, has two parts.

- **The timed practical (100 points).** Taken in Canvas, unaided. One seeded flaw from the Modules 01 to 07 material is placed in the student's own portal copy. The student diagnoses it, repairs it, and proves the repair, and submits a Markdown report. The practical page in Module 08 states the time limit and the conditions. The flaw bank is held by the instructor.
- **The written companion (100 points).** A take-home analysis of one documented real-world breach: the incident summarized from cited sources, the root cause named in the course's vocabulary with its CWE, the control that would have prevented it, and the response judged on detection, containment speed, and disclosure.

### 10.4 Discussion forums

The Module 01 introductions forum is graded complete or incomplete. Each odd module from 03 to 15 has one case forum about one real incident whose root cause is that module's topic: an initial post that names what went wrong and the control that would have prevented it, in the module's own vocabulary, and a reply to a classmate. The Forum rubric's criteria are diagnose, prevent, specific to this incident, peer engagement, and timeliness and communication. The appendix forum is optional and ungraded.

### 10.5 Quizzes

Each module quiz has ten questions drawn from that module's lecture, is taken in Canvas, and is graded automatically. The appendix quiz is practice: it is unscored and may be retaken.

### 10.6 Examination conditions

Before beginning a timed assessment, students note the time limit and the number of attempts, arrange their schedule to avoid interruption, confirm a reliable internet connection, and use a desktop or laptop computer.

## 11. Academic integrity and generative artificial intelligence

Generative AI assistance is permitted on labs, module assignments, forum preparation, and the design-project build. Students may request explanations, generate or refactor code, propose tests, compare designs, and revise drafts. This course develops secure-coding judgment on top of prior programming experience. Students are assessed on the accuracy of their reasoning, their verification, and their ability to explain the work they submit.

AI-assisted code may be submitted when the student has read it, checked its fit with the existing application, tested it, and can explain its security mechanism and limitations. Written reports and forum posts may use AI for planning and editing; the final claims must reflect the student's own analysis and observations. A tool's suggested result is not evidence that a test passed.

Students disclose the tool, the help requested, the output used or changed, and the checks performed in the AI DISCLOSURE line of the report, or a short note at the end of a forum post. Disclosed AI assistance is allowed and does not itself reduce the grade. Fabricated evidence, undisclosed assistance, or presenting unverified generated claims as observations does not meet the course requirements.

Quizzes, the midterm practical and its companion assessment, and the design project's individual decision under challenge remain unaided. AI assistance, including editor completions, is disabled during these assessments. Specific assessment instructions govern any exception.

Students use only demo data and their own authorized portal copy. They do not upload credentials, real personal data, classmates' submissions, or protected assessment content. AI instructions are a learning aid, not an enforcement mechanism. Students remain responsible for following the course policy.

## 12. Course policies

- **Cadence.** Two modules run per week. Each module runs Monday through Sunday, with graded work due Sunday at 11:59 PM Pacific Time. In a module with a forum, the initial post is due Friday so that classmates have time to reply.
- **Availability.** The orientation and the first modules open on the first day of the term; every later module opens before its due date.
- **Late work.** Quizzes and the midterm practical close on the due date. Assignments and the design project are accepted up to seven calendar days after the due date at a penalty of ten percent per day; after that an item receives zero unless arrangements were made in advance. Forum posts are not accepted once the forum has closed.
- **Course end date.** No work of any kind is accepted after Saturday, December 12, 2026 at 11:59 PM Pacific Time.
- **Participation.** Students complete the Student Learning Contract, the Module 01 introductions post and reply, the Module 01 setup lab report, and Quiz 1 during the first week. Students who do not participate during the first week may be dropped. After the first week, a student with no login activity or submitted work for five consecutive days may be dropped.
- **Accommodations.** Students with a documented disability arrange accommodations through Coastline College's Special Programs and Services office. Accommodations are applied from the date they are established and are not applied retroactively.
- **Syllabus changes.** The syllabus is an educational contract between the instructor and students. Items may be added, removed, or modified to correct errors or incorporate updates. Students are notified of every change through course Announcements.

## 13. Student support services

Coastline College provides tutoring, library research assistance, counseling, and disability services to distance education students. Contact information and access instructions are published on the College Support and Library Resources page in the Course Orientation module and at https://www.coastline.edu/. Canvas technical support is reached through the Help button in the Canvas navigation bar.

## 14. Distance Education compliance

- **Regular and substantive interaction.** The instructor posts a course announcement at the start of each module summarizing its content. The instructor participates in the graded discussion forums, provides written feedback on the graded assignment in every module, and responds to Canvas Inbox messages within 24 to 48 hours during the business week. Each module carries at least one instructor-assessed deliverable.
- **Accessibility.** Course pages are authored in markdown and generated to Canvas HTML through an automated pipeline that enforces an accessibility gate before publication: heading structure without skipped levels, meaningful alternative text on every image, descriptive link text, table captions and header rows, and a color palette verified at the WCAG 2.1 Level AAA contrast ratio of 7:1 for body text. Third-party video requiring captions the instructor cannot verify is not used. Verification results are recorded in the companion document *qa-report.md*.
- **Communication of record.** The Canvas Inbox is the channel of record and retains a record of every exchange. Course Announcements carry course-wide notices.

---

*ICS C230, Secure Coding and Design. Coastline College, Information Computer Sciences.*

Early reports use supplied worksheets: M01 records setup and a comparison; M02 adds brief design reasoning and three runbook checks. Full incident-report detail is introduced progressively in later vulnerability assignments.
