<?php
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$password=$_POST['password'];
$age=$_POST['age'];
$gender=$_POST['gender'];

$hashpassword=password_hash($password,PASSWORD_BCRYPT);

// databaseconnection
$connection= new mysqli('localhost','root','','demoregistration');
if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
} 
else{
$sqrt=$connection->prepare('INSERT INTO usertable(firstname,lastname,email,password,gender,age) VALUE (?,?,?,?,?,?)');

$sqrt->bind_param('ssssss', $firstname,$lastname,$email,$hashpassword,$gender,$age);
if($sqrt->execute()){
    echo 'Regitration Succesful User: ',$firstname;
}
else{
    echo 'Unsuccessful';
}
}
$connection->close();
$sqrt->close();
?>  