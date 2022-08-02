<?php
    if(isset($_POST["deleteProject"])) {
        deleteData();
//        header('location:'.$_SERVER['PHP_SELF']);
//        die();
    }
    if(isset($_POST["editProject"])) {
        editData();
    }

    if(isset($_POST["addNew"])) {
        addData();
//        header('location:'.$_SERVER['PHP_SELF']);
//        die();
    }
?>