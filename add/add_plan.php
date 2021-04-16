<?php
    require_once '../connect.php';

    session_start();
    $_SESSION['plan'] = $_POST['id'];
    $date = $_POST['date'];

    if($_SESSION['plan'] == NULL){
        mysqli_query($connect, "INSERT INTO `план` (`ID`, `Місяць`) VALUES (NULL, '$date')");
    }else{
        mysqli_query($connect, "INSERT INTO `план` (`ID`, `Місяць`) VALUES ('$_SESSION[plan]', '$date')");
    }

    header('Location: table_forms.php');
?>

