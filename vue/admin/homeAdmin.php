<?php
    session_start();

    include_once ("../../classes/user/User.php");
    include_once ("../../lib/functions.php");
    include_once ("../../classes/admin/Admin.php");

    sessionsSignInForAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> bienvenue admin</h1>
</body>
</html>