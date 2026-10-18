# api/

The partner API goes here, one script per resource. The front router maps
`/api/<resource>` to `api/<resource>.php` and leaves anything after the resource
name in `$_SERVER['PATH_INFO']`, so `/api/customers/7` runs `api/customers.php`
with `PATH_INFO` set to `/7`.

Tables the API uses are in `data/seed.sql` (sprint 20): `partners`,
`api_clients`, `api_calls`, and `audit_log`, and `customers.partner_id`. The
development key for the seeded client is `demo-key`.

Nothing is here yet.
