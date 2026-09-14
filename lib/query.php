<?php
/**
 * Prepared-statement query helpers.
 *
 * Thin wrappers over PDO so a value from a request never lands in a SQL string.
 * The pattern is always the same: the SQL text holds ? placeholders, and the
 * values travel in a separate array. The database is handed the query and the
 * data apart, so it can never read the data as part of the query.
 *
 * Uses the global db() returning a configured PDO (see ../db.php).
 */

/**
 * Synopsis:      Run a query with bound parameters and return the statement.
 * Preconditions: $sql uses ? placeholders for every request-derived value.
 * Requirements:  $sql (placeholders only, no interpolation), $params (the
 *                values in placeholder order), and db().
 * Impacts:       Returns the executed PDOStatement, to fetch from or for a
 *                write. Lets a PDOException surface for the caller to handle.
 */
function q(string $sql, array $params = []): PDOStatement
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

/**
 * Synopsis:      Run a query and return the first row, or null.
 * Preconditions: As for q().
 * Requirements:  $sql and $params, as for q().
 * Impacts:       Returns the first row as an associative array, or null.
 */
function q_one(string $sql, array $params = []): ?array
{
    $row = q($sql, $params)->fetch();
    return $row === false ? null : $row;
}

/**
 * Synopsis:      Run a query and return all rows.
 * Preconditions: As for q().
 * Requirements:  $sql and $params, as for q().
 * Impacts:       Returns an array of rows, possibly empty.
 */
function q_all(string $sql, array $params = []): array
{
    return q($sql, $params)->fetchAll();
}
