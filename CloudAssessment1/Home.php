<?php
//include crud
require('Components/CRUD.php');
session_start();
require_once 'php/google-api-php-client/vendor/autoload.php';
?>
<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" style="text/css" href="css/InfrastructureTable.css">
    <link rel="stylesheet" style="text/css" href="css/Header.css">
    <link rel="stylesheet" style="text/css" href="css/InfrastructureForm.css">
    <title>1st Question</title>
</head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="https://apis.google.com/js/client.js"></script>
<?php
include('Components/Header.php');
?>
<body>
<?php
include('Components/waitingRequest.php');
?>
<div class="main">
    <div class="table">
        <?php
        include('Components/InfrastructureTable.php');
        ?>
    </div>
    <div class="form">
        <?php
        include('Components/InfrastructureForm.php');
        ?>
    </div>
</div>
</body>
</html>