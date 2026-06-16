<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "registration"
);

if(!$conn){
    die("Connection Failed");
}
?>