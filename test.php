<?php

// Initializing and instantiating the class object.
require('squirrel.php');
use squirrel\squirrel as squirrel;
$sq = new squirrel();

//connecting to a database named squirrel, using a username 'root' and no password.
$sq->connect('squirrel', 'root', '');
//Testing a database connection using if statement
if($sq->connect('squirrel', 'root', '')){
  echo "Connected successfully";
}else{
  echo "Databse Error! : unable to connect";
}

//inserting into a database table called names
//the data is passed as an array having a key value pair.
//the key is the database table column name and the value is the value to be inserted.
$data = array('firstname' => 'Okiti', 'lastname' => 'osivwi');
$sq->insert('names', $data);

//we can also test if the operation was successfull by embending our code in an if statement.
if($sq->insert('names', $data)){
  echo "Inserted Successfully.";
}

