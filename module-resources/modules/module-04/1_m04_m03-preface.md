# M03 - Preface: Input Validation and Output Encoding

## What this module is for

When you search for `Test` in the portal, the page shows the word you typed and the customer names it found. One customer is named `<b>Test Account</b>`. The search page treats the `<b>` tags as HTML and displays the name in bold. The customer-list page shows the same name with its brackets and tags visible.

In this module, you will compare those two pages and repair the search page. Your change should let people search for valid names and display the results as text, without allowing a customer name to change the page's HTML.

You will use two controls:

- **Input validation** checks the search term before the application uses it. For example, is it a string, is it within the allowed length, and does it contain the characters permitted for a name search?
- **Output encoding** changes how a value is written into the page so the browser displays it as text. For example, the customer name's `<b>` tags should appear on screen rather than make the name bold.

The page displays both what you typed and names read from the database. You will find the PHP statements that display those values and check each one. Fixing only one statement can leave another place displaying the same kind of data incorrectly.

This assignment addresses the HTML-display problem. The separate database-query error caused by searching for an apostrophe is outside this module's repair scope.

## The question this module answers

How do input validation and output encoding work together, and why does an application need both?

## What you will be able to do

After Module 03 you can:

1. Find where a search term enters the PHP code and where the term and matched customer names are displayed. Use the terms **source**, **trust boundary**, and **sink** to explain that path.
2. Write PHP checks for the search term's type, length, and permitted characters. Run these checks on the server before using the term.
3. Identify whether a value appears as page text or inside an HTML attribute, and apply `htmlspecialchars` with the appropriate flags and encoding.
4. Explain why checking a search term and displaying a name safely require separate controls.
5. Recognize when a request supplies an array instead of a string, and when PHP's loose comparison treats different values as equal.
6. Show that supplied HTML tags display as text after your change and that legitimate names retain their punctuation.

## Before you start

- Review **Module 01 lecture sections 4 and 5** for source, sink, and trust boundary. The M03 lecture explains how these terms apply to this exercise.
- Use the [TechCorp Lab Guide](../module-01/19_m01_lab-guide.html) to open your environment and sign in with the customer-service demo account. It contains the shared setup, credentials, testing routine, and submission guidance.
- For this module, open the customer search page, `customer.php`, and search for `Test`. Compare the displayed name with the same customer on the customer-list page before changing the code.

## Materials

- The lecture page, which teaches everything the quiz and the assignment need.
- OWASP Top 10:2025 A05 Injection and the OWASP Input Validation Cheat Sheet, the two required readings.
- `customer.php`, the customer lookup and search feature in your course environment, and `index.php`, the customer list that shows the same data correctly.
- The [Incident Reporting Guide](../module-01/20_m01_incident-reporting-guide.html) and [TC-IR-01 Form and Worked Example](../module-01/10_m01_tc-ir-01-form-and-worked-example.html) in Course Orientation.

## Where you may run this

You change code this module, in your own course environment. There is no scanning and no exploitation beyond typing values into the application's own search box. Your own environment is the only target you are authorized to test.

## How the module is shaped

| **Segment** | **Suggested time** | **What you produce** |
|---|---|---|
| Security lecture, PHP companion, and required readings | 4 hours | Notes explaining the controls and PHP examples traced to their outputs |
| Practice and self-check | 1 hour | Examples tried and the ten retrieval questions answered |
| Forum: a real incident | 45 minutes | An initial post and a peer reply that tests a proposed control |
| Quiz | 15 minutes | Ten responses |
| Assignment: initial repair and incident report | 2 hours | The TC-IR-002 report, changed code, and evidence for each required behavior |
| Verification and revision | 2 hours | Boundary cases checked and explanations revised against the evidence |

Plan about ten hours for the complete module, including reading, practice, troubleshooting, and writing. These estimates are planning guides. Keep track of where you need more time and ask for help while working on the task.

## When you are done

Module 03 is complete when you have posted and replied in the forum, submitted the quiz, and submitted the incident report for TC-IR-002: the completed TC-IR-01 form with a source-to-sink trace in section 5, the validated and encoded `customer.php`, and before-and-after evidence in section 7 showing the markup rendered as text while a legitimate punctuated name still works.

## PHP Companion

Read the [PHP companion](9_m04_m03-php-language-support.html) alongside the security lecture. It explains the PHP operations used in this module with worked examples. The security concepts remain the focus of the module.

## Assignment progression

Modules 1–2 supply exact edits and short worksheets. In this module you choose a name-search allow-list and identify the output contexts using taught examples. Setup, test paths, and a short selected-section incident-report starter remain supplied. Read/reproduce in site (8080), edit/prove in fixed (8081), and submit fixed/customer.php with the report and evidence.
