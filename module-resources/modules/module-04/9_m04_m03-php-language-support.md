# M03 - PHP Companion: Reading Validation and Encoding Code

An equipment checkout page has a text field labeled **Equipment label**. Someone enters `  Loan kit  `, including two spaces at each end. The PHP program receives that text, removes the outside spaces, checks the field's rules, and displays the label on the page. What does each line actually do?

This companion follows that small example, then explains the other PHP operations used in Module 03. You will see the value before a statement, the statement that changes or checks it, and the result. The examples use equipment labels, tags, and quantities; the incident assignment asks you to apply the same ideas to the customer-search feature.

> [!CONCEPT] Follow the value through the statements
> PHP reads a value, tests conditions, and either stops or continues. A function name alone does not tell you whether the whole control works. Pay attention to the value passed in, the return value, and the branch that uses it.

The [security lecture](2_m04_m03-lecture-input-validation-and-output-encoding-in-php.html) explains the controls and their limits. This page helps you read and modify the PHP. Environment commands remain in the Orientation lab guide.

## 1. Recognize the parts of a PHP statement

In the example below, the line beginning with `$` creates a variable named `label` and puts text in it. The next line writes the text to the output.

```php
<?php
$label = 'Loan kit';
echo $label . "\n";
```

```text Output
Loan kit
```

Read the first statement as “store the text Loan kit in label.” `$label` names the variable, `=` assigns a value, quotes mark the string, and `;` ends the statement. `<?php` begins PHP code. The line break you see in the output comes from `"\n"`; a line break in the source file alone does not create output.

A function is a named operation. In `trim($label)`, `trim` is the function name and `$label` is the argument supplied to it. An argument is an input to the call. A return value is what the call gives back. For example, `trim('  Loan kit  ')` returns `'Loan kit'`. Assigning that returned value to a variable lets later statements use it.

> [!DEFINE] A condition produces true or false
> `is_string($label)` asks whether the value is text. Its result is a Boolean, `true` or `false`. An `if` uses that result to choose which statements run. It does not turn the value into a string.

## 2. Read an array entry and a default

PHP variables begin with `$`. An array associates keys with values. Square brackets select a key; `=>` associates a key with a value when creating an array. In web requests, PHP supplies arrays such as `$_GET` for query parameters.

```php
<?php
$fields = ['label' => '  Loan kit  '];
$raw = $fields['label'] ?? null;
$missing = $fields['unknown'] ?? null;
var_dump($raw);
var_dump($missing);
```

```text Output
string(12) "  Loan kit  "
NULL
```

`??` is the **null coalescing operator**. It uses the value on the left if it exists and is not null; otherwise it uses the expression on the right. Here the default is `null`, representing no value. A default does not validate the supplied value.

> [!DEFINE] String, array, and null
> A **string** is text, such as `'Loan kit'`. An **array** contains entries addressed by keys. **Null** represents the absence of a value. These are different types even if the application expects a text field.

A query such as `label[]=Loan` can make `$_GET['label']` an array. The normal text field in a browser form does not prevent someone from sending a different request shape.

Source: [PHP arrays](https://www.php.net/manual/en/language.types.array.php) explains key/value entries and bracket access.

## 3. Check the type before calling a string function

`is_string($raw)` returns a Boolean: `true` for a string, `false` otherwise. An `if` executes its block when its condition is true. `!` means logical NOT, so `!is_string($raw)` is true when the value is not a string.

```php secure
<?php
// WHY: Rejecting the wrong type prevents a string operation from receiving an array.
$raw = ['Loan kit'];
if (!is_string($raw)) {
    echo "Expected text.\n";
} else {
    echo trim($raw) . "\n";
}
```

```text Output
Expected text.
```

Braces `{ ... }` group the statements belonging to a branch. The `else` branch runs when the condition is false. In a web handler, rejection commonly sets a response status, writes a generic message, then uses `exit` to stop processing. This runnable example prints a message so you can examine the branch without a web server.

> [!WARNING] Casting can conceal the wrong input shape
> `(string)` converts a value; it does not establish that the requester supplied a string. Check the expected type first because continuing with a converted value can hide a malformed request.

Source: [PHP is_string](https://www.php.net/manual/en/function.is-string.php) describes the type check and Boolean result.

## 4. Assignment and comparison do different jobs

`=` assigns a value. `===` compares both type and value. `!==` is true when the operands are not identical. `==` allows type conversion in some comparisons.

```php
<?php
$value = '10';
var_dump($value === 10);
var_dump($value == 10);
var_dump($value !== 10);
```

```text Output
bool(false)
bool(true)
bool(true)
```

> [!EXAMPLE] Read the first comparison
> `$value` is the string `'10'`. The other operand is the integer `10`. They have different types, so `===` produces `false`. The second comparison allows conversion and produces `true`.

A function may return `false` to indicate failure while returning an integer for success or a nonmatch. Strict comparisons let you distinguish those results rather than combining them accidentally.

Source: [PHP comparison operators](https://www.php.net/manual/en/language.operators.comparison.php) defines these operators and conversion rules.

## 5. Trim and measure text

A function call puts its arguments in parentheses. `trim($raw)` returns a new string with specified whitespace removed at its ends; it does not modify `$raw` automatically. Store the returned value if you need to use it.

```php
<?php
$raw = '  Loan kit  ';
$label = trim($raw);
echo $label . "\n";
echo strlen($label) . "\n";
```

```text Output
Loan kit
8
```

The dot `.` joins strings. `"\n"` is a newline inside a double-quoted string. `echo` writes its expression to the output.

`strlen` counts bytes. `mb_strlen($label, 'UTF-8')`, when the mbstring extension is available, counts characters for the specified encoding. ASCII examples have the same byte and character count; many other characters use multiple UTF-8 bytes. Choose the measurement that matches the field's stated rule.

> [!NOTE] Trimming and validation are separate operations
> Trimming removes permitted padding at the ends. It does not reject forbidden internal characters, establish a length limit, or protect HTML output. The security lecture explains why those remain separate decisions.

Source: [PHP string functions](https://www.php.net/manual/en/ref.strings.php) provides the contracts for `trim` and `strlen`; [PHP mb_strlen](https://www.php.net/manual/en/function.mb-strlen.php) explains character counting.

## 6. Read a regular-expression check

`preg_match($pattern, $value)` returns `1` for a match, `0` for no match, or `false` for failure. Testing `!== 1` rejects both a nonmatch and a failure.

```php secure
<?php
// WHY: Requiring a successful full match rejects characters outside this field's stated rules.
$tag = 'loan-kit_2';
$pattern = '/\A[a-z0-9_-]{1,20}\z/';
if (preg_match($pattern, $tag) !== 1) {
    echo "Invalid tag.\n";
} else {
    echo "Accepted tag.\n";
}
```

```text Output
Accepted tag.
```

The outer `/` characters delimit the pattern. `\A` marks the beginning of the subject and `\z` the end. `[a-z0-9_-]` permits lowercase ASCII letters, digits, underscore, and hyphen. The hyphen at the end of the class is literal. `{1,20}` requires between one and twenty occurrences. This is a rule for an equipment tag, not a rule for every text field. The lecture's username pattern also uses `/u`, which asks the pattern engine to interpret the subject as UTF-8. That flag does not expand `[a-z]` to every language's letters: the character class still permits only the letters named in it.

> [!SECURE] Tie the pattern to the field
> Write down the permitted values before choosing a pattern because the pattern enforces a business requirement. A customer name needs different rules from an equipment tag.

### Why removing a word is different from accepting a pattern

The security lecture also uses `str_replace`, a function that replaces literal matching text. The first argument names the text to find, the second names its replacement, and the third is the input string. Matching is case-sensitive.

```php vulnerable
<?php
// WHY: Removing one exact substring can expose another matching tag and misses other spellings.
$raw = '<scr<script>ipt>';
$changed = str_replace('<script>', '', $raw);
echo $changed . "\n";
```

```text Output
<script>
```

The empty string `''` tells PHP to replace the exact substring with nothing. Removing the middle `<script>` joins the remaining pieces into `<script>`. Changing the input to `<SCRIPT>` would leave it unchanged. This example demonstrates a text transformation; it does not run JavaScript. The lesson's allow-list approach makes an acceptance decision instead of trying to remove known bad fragments.

Source: [PHP str_replace](https://www.php.net/manual/en/function.str-replace.php) explains literal replacements.

Source: [PHP preg_match](https://www.php.net/manual/en/function.preg-match.php) documents the three return outcomes.

## 7. Read the arguments to htmlspecialchars

`htmlspecialchars` converts special HTML characters into entity representations. The function returns a string; it does not display the string until an output operation uses it.

```php secure
<?php
// WHY: HTML encoding keeps the label's special characters from forming markup in HTML text.
$label = '<b>Loan kit</b>';
$encoded = htmlspecialchars(
    $label,
    ENT_QUOTES | ENT_SUBSTITUTE,
    'UTF-8'
);
echo $encoded . "\n";
```

```text Output
&lt;b&gt;Loan kit&lt;/b&gt;
```

The arguments are the original value, the flags, and the character encoding. `ENT_QUOTES` includes both quote types. `ENT_SUBSTITUTE` replaces invalid encoding sequences rather than silently losing the whole value. These names are constants; they have no `$` prefix.

`|` combines flag bits. It is the **bitwise OR operator**, not the logical OR operator `||`. Formatting one argument per line changes readability, not the call's behavior.

If the encoded string appears in HTML page text, the browser displays the literal `<b>Loan kit</b>`. The entities are the HTML source representation; the learner does not see bold markup applied. The security lecture explains why a JavaScript expression, URL, or database query requires different handling.

> [!CRITICAL] An HTML function does not protect every destination
> Do not reuse this encoded value as proof of safety for SQL or JavaScript because those interpreters have different syntax. Identify where a value is used before selecting its control.

Source: [PHP htmlspecialchars](https://www.php.net/manual/en/function.htmlspecialchars.php) defines the flags, encoding argument, and return value.

## 8. Read HTTP rejection and execution order

The following is a web-handler fragment. It needs an HTTP request to demonstrate its response and is not one of the standalone command-line exercises above.

```php secure
<?php
// WHY: Stopping after rejection prevents later statements from processing the invalid value.
$raw = $_GET['tag'] ?? null;
if (!is_string($raw)) {
    http_response_code(400);
    echo 'Invalid request.';
    exit;
}
$tag = trim($raw);
```

`http_response_code(400)` sets the HTTP status. `echo` writes the generic message. `exit` terminates the script, so the assignment to `$tag` is not reached for a nonstring value. A status code alone does not stop execution.

This fragment demonstrates type handling only. It still needs the field's length and permitted-character checks before the value is used. Sending a response status must occur before response output has committed the headers.

Source: [PHP http_response_code](https://www.php.net/manual/en/function.http-response-code.php) and [PHP exit](https://www.php.net/manual/en/function.exit.php) describe the separate operations.

## 9. Read a quantity with filter_input

A checkout form includes `<input name="quantity">` and uses the POST method. PHP receives a submitted field as request data. Even when someone types digits, the incoming field ordinarily begins as text. The lecture uses an integer filter to ask whether that text represents an integer.

```php secure
<?php
// WHY: Distinct failure checks prevent a missing or invalid quantity from reaching the range check.
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
if ($quantity === null) {
    exit('Quantity is missing.');
}
if ($quantity === false) {
    exit('Quantity must be an integer.');
}
if ($quantity < 1 || $quantity > 25) {
    exit('Quantity must be between 1 and 25.');
}
echo 'Accepted quantity: ' . $quantity;
```

This is a web-request example. Its outcomes depend on the submitted POST field:

| Submitted field | Filter result | What this program does |
|---|---|---|
| No quantity field | `null` | Stops with the missing message |
| `quantity=two` | `false` | Stops with the integer message |
| `quantity=2` | Integer `2` | Prints `Accepted quantity: 2` |
| `quantity=26` | Integer `26` | Stops with the range message |

Read the call's three arguments: `INPUT_POST` selects POST input, `'quantity'` names the field, and `FILTER_VALIDATE_INT` names the validation filter. The constants have no `$` prefix. The filter checks integer representation; the separate comparisons check the business range.

`||` means logical OR. In the range condition, either being below 1 **or** being above 25 is enough to reject the quantity. `<` and `>` compare sizes. For a field allowing zero, `if (!$quantity)` would mix a valid zero with failure, which is why the example compares specifically with `null` and `false`.

> [!NOTE] Request data and local test data are different
> `filter_input` reads the original input supplied to the PHP request environment. Setting `$_POST['quantity'] = '2'` in a practice script does not create an original POST request for this function. To experiment with a local variable, use `filter_var($value, FILTER_VALIDATE_INT)` instead. Its result can be an integer or `false`; the missing-field `null` case belongs to `filter_input` with these default options.

Source: [PHP filter_input](https://www.php.net/manual/en/function.filter-input.php) defines the original-input behavior and default return outcomes.

## 10. Read list membership and short-circuit conditions

Suppose the equipment page offers exactly three colors. The array holds the permitted choices; `in_array` asks whether the submitted value is one of them.

```php secure
<?php
// WHY: Strict membership accepts only the named string choices without loose conversion.
$allowedColors = ['red', 'green', 'blue'];
$color = 'green';
if (!is_string($color) || !in_array($color, $allowedColors, true)) {
    echo "Rejected color.\n";
} else {
    echo "Accepted color.\n";
}
```

```text Output
Accepted color.
```

The first argument is the value to find. The second is the array to search. The third, `true`, asks for strict matching of type and value. For `'purple'`, the membership result is false and the rejection branch runs.

PHP evaluates this `||` expression from the left. If the value is not a string, the first part is already true and PHP skips the second part. This is **short-circuit evaluation**: once the result is determined, the remaining operand is not evaluated. With `&&` (logical AND), PHP skips the second part when the first is false.

Source: [PHP in_array](https://www.php.net/manual/en/function.in-array.php) documents the strict third argument.

## 11. See why decoding changes a value

The original URL can contain percent-encoded characters. PHP has already decoded query values when it creates `$_GET`. This practice example starts with the string PHP would provide after one decoding step.

```php
<?php
$parsedValue = '%2F';
echo $parsedValue . "\n";
echo urldecode($parsedValue) . "\n";
```

```text Output
%2F
/
```

For the request `?tag=%252F`, PHP's query parsing changes `%25` into `%`, leaving the string `%2F`. Calling `urldecode` again changes that string into `/`. A rule that accepted the first representation has not checked the second representation.

The lecture's vulnerable loop uses `while`, meaning “repeat this block while the condition remains true.” Its repeated decoding changes the value until a later decoding produces no further change. That is not the routine for the tag field: the parsed value is the one the field should check and use.

> [!WARNING] Validation belongs to the value you actually use
> Do not add another decoding step after the check because it can introduce a character absent from the checked value. For this field, PHP's query parsing has already performed the needed decoding.

Source: [PHP urldecode](https://www.php.net/manual/en/function.urldecode.php) specifically warns that query data is already decoded.

## 12. Find output inside a PHP and HTML template

A PHP file can contain both PHP and ordinary HTML. `?>` leaves PHP mode; `<?php` enters it again. The short echo tag `<?= expression ?>` means “write the expression here.”

```php secure
<?php
// WHY: Each displayed value is HTML-encoded at the output expression for its HTML context.
$label = 'Jordan & Lee';
?>
<p>Equipment label: <?= htmlspecialchars($label, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
<input name="label" value="<?= htmlspecialchars($label, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
```

```text Output
<p>Equipment label: Jordan &amp; Lee</p>
<input name="label" value="Jordan &amp; Lee">
```

This output is HTML source. In the browser, the paragraph and the field both show `Jordan & Lee`. The first output expression occurs in page text. The second occurs inside the quoted `value` attribute. The quotes around the attribute belong to HTML; quotes around `'UTF-8'` belong to PHP.

The same variable appears twice, so there are two output locations to review. Encoding one occurrence does not change the other. An HTML tag such as `<input>` is not a PHP function; it tells the browser which element to create.

A results table often uses `foreach` to display several rows:

```php secure
<?php
// WHY: Encoding every row's label protects each displayed value, rather than only the first result.
$rows = [
    ['label' => 'Loan kit'],
    ['label' => 'Jordan & Lee'],
];
foreach ($rows as $row) {
    echo '<p>' . htmlspecialchars($row['label'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</p>\n";
}
```

```text Output
<p>Loan kit</p>
<p>Jordan &amp; Lee</p>
```

`foreach ($rows as $row)` takes one entry from `$rows`, places it in `$row`, runs the block, then repeats for the next entry. Each `$row` is itself an array. `$row['label']` selects its label. A value read from a database still needs the correct output handling; being stored does not change the browser's interpretation.

Source: [PHP escaping from HTML](https://www.php.net/manual/en/language.basic-syntax.phpmode.php) explains mixed templates; [PHP foreach](https://www.php.net/manual/en/control-structures.foreach.php) describes array iteration.

## 13. Build a URL, then write it into HTML

Consider a link to equipment results. The topic contains an ampersand, which would separate query parameters if inserted into a URL unchanged. `http_build_query` represents the value as a query parameter first.

```php secure
<?php
// WHY: Query encoding preserves parameter values; HTML encoding protects the finished URL in the quoted href.
$query = http_build_query(['topic' => 'Loan & return', 'page' => 1]);
$url = '/equipment.php?' . $query;
echo '<a href="' . htmlspecialchars($url, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">Open equipment</a>' . "\n";
```

```text Output
<a href="/equipment.php?topic=Loan+%26+return&amp;page=1">Open equipment</a>
```

The array provides parameter names and values. The query builder represents the ampersand **inside** the topic as `%26` and spaces as `+`. The ampersand **between** parameters becomes `&amp;` when the finished URL is written into HTML. Those two ampersands have different jobs.

The URL's destination is fixed in this example. Accepting an entire URL from a requester also requires deciding which schemes and destinations the application permits. Encoding a query value does not make that policy decision.

Source: [PHP http_build_query](https://www.php.net/manual/en/function.http-build-query.php) explains the query builder and its default encoding.

## 14. Give structured data to JavaScript

PHP arrays can hold named values. `json_encode` turns such an array into a JSON string that another program can read as data. JSON means **JavaScript Object Notation**; a JSON string is a representation of values, not a PHP array anymore.

```php secure
<?php
// WHY: Serialization represents the value as JSON; the flags prevent HTML-sensitive characters from forming a script end tag.
$displayName = '<b>Loan kit</b>';
$payload = json_encode(
    ['name' => $displayName],
    JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR
);
echo $payload . "\n";
```

```text Output
{"name":"\u003Cb\u003ELoan kit\u003C\/b\u003E"}
```

`'name' => $displayName` creates a named array entry. The output's `"name"` is a JSON property. `\u003C` represents `<` and `\u003E` represents `>`. A JSON parser reconstructs the original text from those escape sequences.

The four `JSON_HEX_*` flags represent angle brackets, ampersands, and quotes inside string values using escapes. `JSON_THROW_ON_ERROR` raises an exception when serialization fails, such as for malformed UTF-8, instead of returning `false`. An exception interrupts the normal path until handled; a production handler needs controlled error handling rather than exposing an error trace.

The lecture places the result inside a `<script type="application/json">` element. That element holds data instead of executable JavaScript. The JavaScript that consumes it can read its `textContent` and parse JSON. If that code later inserts a value into an unsafe HTML operation, JSON serialization alone does not protect the later output.

Source: [PHP json_encode](https://www.php.net/manual/en/function.json-encode.php) documents the serialization flags and failure behavior.

## 15. Compare a submitted secret deliberately

Two different strings can compare equal with `==`. For example, PHP treats `'10'` and `'1e1'` as numeric strings for loose comparison; both represent ten. That is not the right meaning of an exact token check.

```php secure
<?php
// WHY: The type check and string comparison avoid numeric-string coercion in a token decision.
$expected = '10';
$submitted = '1e1';
if (is_string($submitted) && hash_equals($expected, $submitted)) {
    echo "Token matches.\n";
} else {
    echo "Token does not match.\n";
}
```

```text Output
Token does not match.
```

These short example values demonstrate comparison only; they are not suitable generated secrets. `&&` requires both conditions. If the submitted value is an array, the first condition is false and the function call is skipped. `hash_equals` expects strings; its first argument is the known value, and its second is the submitted value.

The function avoids a comparison that stops at the first unequal character. A length mismatch returns false immediately, so it does not hide the known value's length. Use `===` for ordinary exact comparisons and `hash_equals` where a secret comparison needs its timing-aware behavior. Neither function decides whether someone is authorized to use a resource.

Source: [PHP hash_equals](https://www.php.net/manual/en/function.hash-equals.php) describes the argument order and length caveat.

## 16. Check your reading

| Question | Answer and explanation |
|---|---|
| **1. What does `?? null` do when an array key is missing?** | It supplies `null` as the default value. It does not validate a value that is present. |
| **2. What makes `'10' === 10` false?** | One value is a string and the other is an integer. `===` requires matching types and values. |
| **3. Does `trim($raw)` change `$raw` without assignment?** | No. It returns a trimmed string. Use `$label = trim($raw);` to store that result. |
| **4. What are the three possible return outcomes of `preg_match`?** | `1` means a match, `0` means no match, and `false` means the operation failed. |
| **5. What does the single vertical bar between the two `ENT_` constants do?** | It combines the flag bits so both options apply to the function call. |
| **6. Does setting HTTP status 400 stop the script?** | No. `http_response_code(400)` sets the status. `exit` stops execution. |
| **7. Why are the integer filter and quantity range check separate?** | The filter checks whether the input represents an integer. The range check decides whether that integer is an allowed quantity. |
| **8. What does the third argument to `in_array` do?** | Passing `true` requires strict matching of both type and value. |
| **9. Why can `$_GET['tag']` differ from the original URL's query representation?** | PHP decodes query values when it constructs `$_GET`. For example, `%252F` becomes `%2F`. |
| **10. What does `<?= ... ?>` do in an HTML template?** | It writes the PHP expression’s value at that position in the output. It does not automatically HTML-encode it. |
| **11. What does `foreach` do for a table of records?** | It runs the block once for each entry, making the current entry available through the loop variable. |
| **12. Why does a link have query encoding followed by HTML encoding?** | Query encoding preserves the parameter values in the URL. HTML encoding represents the finished URL in the quoted HTML attribute. |
| **13. What changes when an array becomes JSON?** | The PHP array becomes a string representation of structured values. A JSON parser can reconstruct those values. |
| **14. Why does the secret example reject `'1e1'` when the expected string is `'10'`?** | `hash_equals` compares the strings without converting numeric-looking text into numbers. These strings are different. |

## 17. Try different values and explain the results

This practice checks whether you can follow a PHP condition and explain its result. Use the equipment-tag code in section 6. The rule accepts **1 to 20 lowercase letters, digits, underscores, or hyphens**.

### Practice 1: Change the equipment tag

Find this line in the example:

```php
$tag = 'loan-kit_2';
```

Replace the text inside the quotes with one value from the table below. Keep the quotes and semicolon. Run the example again, then repeat with the next value. For the empty value, write `$tag = '';` with nothing between the quotes.

| Value to put between the quotes | Expected output | Why |
|---|---|---|
| `loan-kit` | `Accepted tag.` | All characters are permitted, and the length is within the limit |
| `Loan-kit` | `Invalid tag.` | Uppercase `L` is outside the permitted lowercase letters |
| Empty text: `''` | `Invalid tag.` | The rule requires at least one character |
| `abcdefghijklmnopqrstu` | `Invalid tag.` | This value has 21 characters; the limit is 20 |

> [!EXAMPLE] Follow one rejected value
> With `$tag = 'Loan-kit';`, `preg_match` returns `0` because the uppercase `L` is not permitted. The condition `0 !== 1` is true, so PHP runs the block that prints `Invalid tag.`. The `else` block does not run.

For each value, explain which part of the rule accepts or rejects it. If your output differs from the table, check that you changed only the value and kept the original pattern. Changing the pattern would change the rule being tested.

### Practice 2: Compare HTML source with visible text

Use the mixed PHP/HTML example in section 12, where `$label` is `'Jordan & Lee'`. That example displays the label in a paragraph and in a text field.

The PHP output contains `Jordan &amp; Lee`. The browser displays `Jordan & Lee`. These are two representations of the same name:

| Where you look | What you should see | What it means |
|---|---|---|
| HTML source produced by PHP | `Jordan &amp; Lee` | The ampersand is represented as an HTML entity |
| Paragraph displayed by the browser | `Jordan & Lee` | The browser displays the original name |
| Text field displayed by the browser | `Jordan & Lee` | The attribute value preserves the original name too |

> [!CONCEPT] Encoding changes the representation, not the name
> The customer-facing text keeps its ampersand. PHP writes `&amp;` in the HTML so the browser can display that character as part of the name. Removing the ampersand would change the data rather than encode it.

Explain this difference in your own words: **What did PHP write, and what did the browser display?** The goal is to recognize why correct HTML encoding can change the source while preserving the visible text.

## Name-search pattern choices for the assignment

A rule for names needs more than ASCII `[a-z]`. In a PHP regular expression, `\p{L}` matches Unicode letters and `\p{N}` matches Unicode numbers. Use the `u` modifier to interpret UTF-8 input. For example, this different field allows only letters in a short language label:

```php
$label = 'français';
$matches = preg_match('/\A[\p{L}]+\z/u', $label);
```

Here `\A` and `\z` require the whole value to match; `+` requires one or more letters. `$matches` is `1` for this label, `0` for `français!`, and `false` if the pattern or input encoding causes an error. Accept only a result of `1`. The search assignment adds its own specified digits, punctuation, spaces, and separate length check; write and explain that character class yourself. An apostrophe inside a PHP single-quoted string needs escaping, while a literal hyphen in a character class can be placed at the end or escaped.

For a record ID that is defined as an integer, `(int) $row['id']` produces an integer representation: `'12'` becomes `12`. This is different from encoding an arbitrary string as a URL parameter with `rawurlencode`. Choose the representation that matches the value's contract, and keep the HTML attribute quoted. Neither operation repairs an SQL query.
