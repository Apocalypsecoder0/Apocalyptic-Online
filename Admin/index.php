<?php
require 'includes/auth.php';
requireLogin();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome, <?= $_SESSION['username'] ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
