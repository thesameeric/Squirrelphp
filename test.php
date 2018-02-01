<?php

// Initializine and instantiating the class object.
require('phpmySql.php');
use squirrel\squirrel as squirrel;
$sq = new squirrel();
$sq->connect('squirrel', 'root', '');
$completedForm = array();

$sq->insert('names', $completedForm);

function connect() {
  echo "this is to connect to the database";
}
connect();
?>
