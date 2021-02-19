<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "event";

$conn = mysqli_connect("$server", "$username", "", "$db");
if (!$conn) {
    die("conn fail" . mysqli_connect_error());
}
