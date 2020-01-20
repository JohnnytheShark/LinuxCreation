#PHP + POSTGRESQL Login System

## I wanted to create a login system for another project and also wanted to create a template for future projects.

### The code in system runs off a local system between POSTGRESQL and PHP
----

When uploading to the internet insure to add the databases to your database:

POSTGRESQL DATABASE SQL for resetting the password:

```
CREATE TABLE password_reset (
	password_reset_ID serial PRIMARY KEY NOT NULL,
	password_reset_Email TEXT NOT NULL,
	password_reset_Selector TEXT NOT NULL,
	password_reset_Token TEXT NOT NULL,
	password_reset_Expires TEXT NOT NULL
);
```
