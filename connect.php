<?php
/**
 * before you touch:
 * edit the dabatase name at default = demoregistration
 * edit the table at default = usertable
 * i implememted a condition to check if this (firstname,email) is presents in my table
 *  if true return a alert
 * else continue the procces create a new table for that data
 *  
 */



include 'db.php';
// collection of data
$firstname= $_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$password= $_POST['password'];
$gender=$_POST['gender'];
$age=$_POST['age'];

// check for connection_error
// this is where we start our query
if ($connection->connect_error){
    echo 'Error while connectnig', $connection->error;}
else{


// CHECK IF USER ALREADY EXISTS
$check = $connection->prepare("SELECT * FROM usertable WHERE email = ? AND firstname = ?");
 /**
     * Check if a user already exists with the same email and firstname in my database.
     * This prevents duplicate registrations.
     * Prepared statements are used to prevent SQL injection.
     */
$check->bind_param("ss", $email, $firstname);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {

    echo "User with this email and firstname already exists.";

}
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
}
?>



