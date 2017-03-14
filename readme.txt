EZ Auth 1.0
Author: Andrew Goetz

Installation:
Add require('ezauth\hook.php');
to the main index if your site.
Modify config.php.

Functions:
Create a user:
createUser($level,$username,$password);

Login a user:
login($username,$password);

Logout a user:
logout();

Authorization Check:
Specify a $level of authorization (int) needed for the page.
protectme($level);

Get authorization level:
Returns authorization level (int).
getLevel();