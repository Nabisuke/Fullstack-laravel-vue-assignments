<?php

include "db.php";

if (isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $res = $conn->query("SELECT filename from photos where id=$id ");

    $row = $res->fetch_assoc();

    $filePath = "uploads/". $row['filename'];

    if (file_exists($filePath)){
        unlink($filePath);
    }
    $conn->query("DELETE from photos where id = $id");


}
header("Location: index.php");

?>