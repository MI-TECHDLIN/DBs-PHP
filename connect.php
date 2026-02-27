<?php

include 'db.php';
// collection of data
$firstname= $_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$password= $_POST['password'];
$gender=$_POST['gender'];
$age=$_POST['age'];

// check for connection_error

if ($connection->connect_error){
    echo 'Error while connectnig', $connection->error;}

// this is where we start our query
else{
$sqrt=$connection->prepare("INSERT INTO usertable(firstname,lastname,email,password,gender,age) VALUES(?,?,?,?,?,?)");
$sqrt->bind_param("sssssi",$firstname,$lastname,$email,$password,$gender,$age);
if($sqrt->execute()){
    echo 'User ',$firstname, ' Connected Sucessful';
}
else{
    echo 'this registration was unsuceesful';
}
$connection->close();
$sqrt->close();
} 
?>