-- TechCorp Customer Portal - incident state.
--
-- Load this into your own portal database before you begin the Module 14 assignment.
-- It puts your instance into the state the portal was found in on the morning
-- of Monday 21 September 2026, when the support lead opened a customer record
-- and did not recognise the last note on it.
--
-- Run it from the application directory:
--
--     php -d extension=pdo_sqlite -r "$p=new PDO('sqlite:data/portal.sqlite'); $p->exec(file_get_contents('incident-injection.sql'));"
--
-- or, if you have the sqlite3 command-line tool:
--
--     sqlite3 data/portal.sqlite < incident-injection.sql
--
-- The script is additive. It inserts rows and changes nothing that is already
-- there, so you can load it into the database you have been using all term.
-- It is also the only synthetic thing in this exercise: everything else you
-- will look at is the real behaviour of the real application.
--
-- Do not read past this line until you have finished the assignment. The rows below
-- are the evidence; reading them here instead of finding them in the portal is
-- reading the answer key.

INSERT INTO notes (customer_id, body, created_by_name, created_at) VALUES
    (4, 'Verified account details with caller. Confirmed tax id on file.', 'Rae Marsh', '2026-09-19 02:47:00'),
    (4, 'Pulled full record for review.',                                 'Rae Marsh', '2026-09-19 02:51:00'),
    (6, 'Account reopened at customer request.',                          'Rae Marsh', '2026-09-19 03:14:00'),
    (5, 'Verified account details with caller. Confirmed tax id on file.', 'Rae Marsh', '2026-09-19 03:22:00'),
    (5, 'Contact number updated. No further action.',                     'Rae Marsh', '2026-09-20 02:08:00'),
    (6, 'Escalated to billing per supervisor.',                           'Rae Marsh', '2026-09-20 02:33:00'),
    (4, 'Duplicate record, disregard.',                                   'Rae Marsh', '2026-09-20 02:39:00');
