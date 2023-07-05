<?php
$conn = mysqli_connect("localhost", "admin", "Admin@123", "login_system");
// $conn = mysqli_connect("localhost", "root", "", "login_system");

if (!$conn) {
    echo mysqli_connect_errno();
}
