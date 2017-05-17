# Fixed Issues in the project

1. “SQLSTATE[HY000]: General error: 17 database schema has changed (SQL: select max(“batch”) as aggregate 
from “migrations”)” as well as “ErrorException: unlink(path\to\database\testing.sqlite): Resource temporarily unavailable”

Solution: Uncommented line code

2. ErrorException: unlink(C:\xampp56\htdocs\laravel5-social-network.and\database\testing.sqlite): Permission denied

Solution: 

3. "SQLSTATE[HY000]: General error: 1 no such function: CONCAT (SQL: select * from "users" where CONCAT(first_name, ' ' ,last_name) LIKE %TEST1% or "username" LIKE %TEST1%)"

Solution: Replace 'CONCAT' on '+' which works for SQLite and Mysql

4. "SQLSTATE[23000]: Integrity constraint violation: 19 NOT NULL constraint failed: friends.accepted (SQL: insert into "friends" ("friend_id", "user_id") values (10, 1))"