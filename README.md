# Squirrel
Squirrel is php library that handles mySql database related operations such as connecting to the database and application CRUD.

# How it works
It works simply by calling functions to perform a specific task..
you'll need to instantiate the squirrel object in your page using the code below
<?php 
require('squirrel.php');
use squirrel\squirrel as squirrel;
$sq = new squirrel();
?>

Once you're done with the above step you are good to go
the functions avaialable includes;
  # $sq->connect($dbname, $username, $password, $host='127.0.0.1');
  # $sq::insert($tablename,$data);
  The insert function requires a data set that must be an array containing a key value pair.
  The key is the table column while the value is the value to be inserted into the database
      #$data = array('id' => '1', 'email' => 'info@github.com');
  
  # $sq::update($tablename,$row,$id,$data);
    The $row and $id specifies the row to be updated. e.g Where row = id (WHERE id = 1 Or WHERE username = Osivwi);
  # $sq::delete($tablename,$row,$id);
  # $sq::selectAll($tablename)
  # $sq::selectById($table,$id)
  # $sq::selectColumn($table,$column)
  # $sq::Find($table,$column,$name)
	
