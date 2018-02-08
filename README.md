# Squirrel
Squirrel is php library that handles mySql database related operations such as connecting to the database and application CRUD.

# How it works
It works simply by calling functions to perform a specific task..
you'll need to instantiate the squirrel object in your page using the code below

```php
require('squirrel.php');
use squirrel\squirrel as squirrel;
$sq = squirrel::getInstance();
```
After instantiating the object, you can start calling functions to perform different tasks.
refer to test.php file to get examples
	
