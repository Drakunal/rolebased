<?php
session_start();
if(!isset($_SESSION['login_user'])||$_SESSION['role']!="employee")
{
    header("location:index.php");
}
?>

<h1>HI <?= $_SESSION['login_user'] ?><h1>
<h1>role <?= $_SESSION['role'] ?><h1>
    <a href="logout.php">Logout</a>
