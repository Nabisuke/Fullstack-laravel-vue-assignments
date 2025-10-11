<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = (int)$_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$old_filename = $_POST['old_filename'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $image = $_FILES['image'];
    
    $maxFileSize = 5000000; // 5 MB
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    
    if ($image['size'] > $maxFileSize) {
        header("Location: edit.php?id=$id&error=" . urlencode("File size exceeds 5 MB."));
        exit;
    }
    
    if (!in_array($image['type'], $allowedTypes)) {
        header("Location: edit.php?id=$id&error=" . urlencode("Only JPG, JPEG, PNG, GIF, and WEBP files are allowed."));
        exit;
    }
    
    $targetDir = "uploads/";
    $fileName = time() . "_" . basename($image['name']);
    $targetFilePath = $targetDir . $fileName;
    
    if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
        // Delete old image
        $oldFilePath = $targetDir . $old_filename;
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }
        
        // Update database with new image
        $stmt = $conn->prepare("UPDATE photos SET title = ?, description = ?, filename = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $fileName, $id);
    } else {
        header("Location: edit.php?id=$id&error=" . urlencode("File upload failed."));
        exit;
    }
}else
{
    $stmt = $conn->prepare("UPDATE photos SET title = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $description, $id);
}

if ($stmt->execute()) {
    header("Location: index.php?success=" . urlencode("Photo updated successfully."));
}else{
    header("Location: edit.php?id=$id&error=" . urlencode("Update failed."));
}

$stmt->close();
$conn->close();
?>