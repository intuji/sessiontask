<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// creating connection to the database

$conn = mysqli_connect($servername,$username,$password,$dbname);

if ($conn === "false"){
    die ("Database cannot be connected." . mysqli_connect_error());
}
?>