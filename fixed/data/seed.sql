-- TechCorp Customer Portal - schema and fixture data.
-- Sprint 8. Set up the tables and load the demo accounts.

-- Staff accounts. Moved into the database in sprint 18 so the desk tools could
-- join against them; before that they lived in a data/users.json file. The
-- password column holds the hash carried over from that file, so accounts moved
-- across without anyone having to reset a password.
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id                INTEGER PRIMARY KEY AUTOINCREMENT,
    username          TEXT    NOT NULL,
    display_name      TEXT    NOT NULL,
    password_md5      TEXT    NOT NULL,
    role              TEXT    NOT NULL DEFAULT 'rep',
    disabled          INTEGER NOT NULL DEFAULT 0,
    home_office       TEXT    NOT NULL DEFAULT '',
    -- Password reset uses a security question. The support lead picked the
    -- questions; the answers are stored as typed.
    security_question TEXT    NOT NULL DEFAULT '',
    security_answer   TEXT    NOT NULL DEFAULT ''
);

-- Devi Patel is first so the audit export lists the admin at the top.
INSERT INTO users (username, display_name, password_md5, role, disabled, home_office, security_question, security_answer) VALUES
    ('dpatel', 'Devi Patel', '25d55ad283aa400af464c76d713c07ad', 'admin', 0, 'Costa Mesa',   'Which office are you based in?',        'Costa Mesa'),
    ('rmarsh', 'Rae Marsh',  '5f4dcc3b5aa765d61d8327deb882cf99', 'rep',   0, 'Long Beach',   'Which office are you based in?',        'Long Beach'),
    ('lchen',  'Lin Chen',   'e10adc3949ba59abbe56e057f20f883e', 'rep',   0, 'Irvine',       'Which office are you based in?',        'Irvine'),
    ('sformer','Sam Former', '827ccb0eea8a706c4c34a16891f84e7b', 'rep',   1, 'Santa Ana',    'Which office are you based in?',        'Santa Ana'),
    -- The shared administrator account from initial setup.
    ('admin',  'Administrator', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0, 'HQ',        'Which office are you based in?',        'HQ');

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
    id             INTEGER PRIMARY KEY AUTOINCREMENT,
    display_name   TEXT    NOT NULL,
    city           TEXT    NOT NULL,
    account_status TEXT    NOT NULL DEFAULT 'active',
    -- Stored as entered so the desk can match a caller by the exact tax id.
    tax_id         TEXT    NOT NULL,
    assigned_rep   TEXT    NOT NULL,
    -- Sprint 20. Which business partner the account came through. 0 is direct.
    partner_id     INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE notes (
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    customer_id     INTEGER NOT NULL,
    body            TEXT    NOT NULL,
    created_by_name TEXT    NOT NULL,
    created_at      TEXT    NOT NULL
);

INSERT INTO customers (display_name, city, account_status, tax_id, assigned_rep, partner_id) VALUES
    ('Alma Restrepo',      'Long Beach',   'active',    '412-88-2130', 'rmarsh', 1),
    ('Dermot O''Brien',    'Costa Mesa',   'active',    '318-55-9042', 'rmarsh', 1),
    ('Yusuf Adeyemi',      'Irvine',       'active',    '229-41-7788', 'rmarsh', 2),
    ('Priya Raghunathan',  'Santa Ana',    'past_due',  '556-20-3391', 'lchen',  2),
    ('Marta Kowalczyk',    'Westminster',  'active',    '701-63-5514', 'lchen',  0),
    ('Desmond Achebe',     'Fountain Vly', 'closed',    '884-19-2276', 'lchen',  1),
    ('Josephine Tran',     'Garden Grove', 'active',    '145-72-6608', 'rmarsh', 2),
    ('<b>Test Account</b>','Huntington',   'active',    '000-00-0000', 'rmarsh', 0);

INSERT INTO notes (customer_id, body, created_by_name, created_at) VALUES
    (1, 'Called about the invoice dispute. Escalating to billing.', 'Rae Marsh',  datetime('now', '-18 days', '+9 hours')),
    (1, 'Billing confirmed the credit. Customer satisfied.',        'Rae Marsh',  datetime('now', '-17 days', '+14 hours')),
    (2, 'Requested a copy of the service agreement. Sent.',         'Rae Marsh',  datetime('now', '-16 days', '+11 hours')),
    (4, 'Payment plan discussed. Follow up in two weeks.',          'Lin Chen',   datetime('now', '-13 days', '+16 hours')),
    (5, 'Address change confirmed by phone.',                       'Lin Chen',   datetime('now', '-12 days', '+10 hours'));

-- Sprint 17. Customers want to attach documents to their record.
DROP TABLE IF EXISTS documents;
CREATE TABLE documents (
    id            INTEGER PRIMARY KEY AUTOINCREMENT,
    customer_id   INTEGER NOT NULL,
    original_name TEXT    NOT NULL,
    stored_name   TEXT    NOT NULL,
    byte_size     INTEGER NOT NULL,
    content_type  TEXT    NOT NULL,
    uploaded_by   TEXT    NOT NULL,
    uploaded_at   TEXT    NOT NULL
);

-- Sprint 19. The password-reset flow needs somewhere to record the messages it
-- would email, and somewhere to keep one-time links. The desk reads the outbox
-- because there is no mail server on the box yet.
DROP TABLE IF EXISTS outbox;
CREATE TABLE outbox (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    to_address TEXT    NOT NULL,
    subject    TEXT    NOT NULL,
    body       TEXT    NOT NULL,
    created_at TEXT    NOT NULL
);

DROP TABLE IF EXISTS reset_tokens;
CREATE TABLE reset_tokens (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    username   TEXT    NOT NULL,
    token_hash TEXT    NOT NULL,
    expires_at TEXT    NOT NULL,
    used_at    TEXT
);

-- Sprint 20. The desk asked for a record of failed sign-ins after a run of
-- lockout complaints that nobody could reconstruct. The table is here; nothing
-- writes to it or reads it yet.
DROP TABLE IF EXISTS login_failures;
CREATE TABLE login_failures (
    id        INTEGER PRIMARY KEY AUTOINCREMENT,
    username  TEXT    NOT NULL,
    source    TEXT    NOT NULL,
    failed_at TEXT    NOT NULL
);

-- Sprint 20. Tables for the partner API project. Business partners will reach
-- their own customers' records through an API under api/. The schema is in
-- place so the project can start; no endpoint exists yet.
DROP TABLE IF EXISTS partners;
CREATE TABLE partners (
    id   INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT    NOT NULL
);

INSERT INTO partners (name) VALUES
    ('Harbor Logistics'),
    ('Pacific Rim Dental Group');

-- One row per API key a partner holds. Only the SHA-256 of the key is stored;
-- the key itself is given to the partner once and never kept here.
DROP TABLE IF EXISTS api_clients;
CREATE TABLE api_clients (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    partner_id INTEGER NOT NULL,
    name       TEXT    NOT NULL,
    key_hash   TEXT    NOT NULL,
    created_at TEXT    NOT NULL,
    disabled   INTEGER NOT NULL DEFAULT 0
);

-- The development key is the string demo-key. Hash: sha256('demo-key').
INSERT INTO api_clients (partner_id, name, key_hash, created_at) VALUES
    (1, 'Harbor Logistics dashboard', 'c48a01f49fd0f2cc404bc3cbbc80e91457a3d41bb429a695243de4c61794155c', datetime('now', '-3 days'));

-- One row per API request, for rate limiting. made_at is a Unix timestamp.
DROP TABLE IF EXISTS api_calls;
CREATE TABLE api_calls (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    partner_id INTEGER NOT NULL,
    made_at    INTEGER NOT NULL
);

-- One row per change made through the API, so every change is traceable.
DROP TABLE IF EXISTS audit_log;
CREATE TABLE audit_log (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    partner_id INTEGER NOT NULL,
    action     TEXT    NOT NULL,
    target     TEXT    NOT NULL,
    at         INTEGER NOT NULL
);
