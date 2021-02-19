<?php
session_start();

if (isset($_SESSION['uid'])) {

    include "_database.php";
    $id = $_REQUEST['id'];
    $sql = "DELETE FROM `student` WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Record Delete successfully');</script>";
        echo "<script>window.location.href = 'delete.php';</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    header("http://localhost/Event/");
}
