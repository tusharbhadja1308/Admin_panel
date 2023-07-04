<?php
$conn = mysqli_connect("localhost", "admin", "Admin@123", "login_system");

if (!$conn) {
    echo mysqli_connect_errno();
}
