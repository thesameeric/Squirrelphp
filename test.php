<?php

// Initializine and instantiating the class object.
require('squirrelv1.1.1.php');
use squirrel\squirrel as squirrel;

// Get instance of Squirell Database Object
$sq = squirrel::getInstance();

// Connect to database
$sq->connect('squirrel', 'root', '');
$completedForm = array(
    'firstname' => 'Osiwvime',
    'lastname' => 'Okiti'
  );

/*
  CRUD FUNCTONS USING SQUIRREL
*/

// Insert into Database
// $insert = $sq->insert('names', $completedForm);
// if ($insert){
//   echo "Inserted";
// } else {
//   echo "An error occurred.";
// }

// Delete From database
// $deleted = $sq->delete('names', 'id', '4');
// if ($deleted) { 
//   echo "Deleted.";
// } else {
//   echo "An error occurred.";
// }

// Update values in database
// $update = $sq->update('names', 'id', '5', $completedForm);
// if ($update) {
//   echo "Updated!";
// } else {
//   echo "An error occurred.";
// }

// Select all from database
$all = $sq->selectAll('names', 'ASC');
if ($all) {
  while ($row = $all->fetch(PDO::FETCH_OBJ)) {
    echo $row->id . " " . $row->firstname .  " " . $row->lastname . "<br>";
  }
}

// Select by id
// $user = $sq->selectById('names', '5');
// $row = $user->fetch(PDO::FETCH_OBJ);
// echo "<br>";
// echo $row->id . " " . $row->firstname .  " " . $row->lastname . "<br>";

// Select particlular row in database
// $get_username = $sq->find('names', 'firstname', 'Daniel');
// $row = $get_username->fetch(PDO::FETCH_OBJ);
// $username = $row->firstname;
// echo $username;

?>
