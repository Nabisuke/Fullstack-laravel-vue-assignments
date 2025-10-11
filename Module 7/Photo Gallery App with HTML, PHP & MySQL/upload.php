<?php
include "db.php";

$title = $_POST['title'];
$description = $_POST['description'];
$image = $_FILES['image'];

$maxFileSize = 5000000; // 5 MB
$allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

if ($image['error'] !== 0) {
    header("Location: index.php?error=" . urlencode("Please select a valid image file."));
    exit;
}

if ($image['size'] > $maxFileSize) {
    header("Location: index.php?error=" . urlencode("File size exceeds 5 MB."));
    exit;
}

if (!in_array($image['type'], $allowedTypes)) {
    header("Location: index.php?error=" . urlencode("Only JPG, JPEG, PNG, GIF, and WEBP files are allowed."));
    exit;
}

$targetDir = "uploads/";
$fileName = time() . "_" . basename($image['name']);
$targetFilePath = $targetDir . $fileName;

if (move_uploaded_file($image["tmp_name"], $targetFilePath)){

    $stmt = $conn->prepare("INSERT INTO photos (title, description, filename) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        header("Location: index.php?error=" . urlencode("Database prepare failed: " . $conn->error));
        exit;
    }

    $stmt->bind_param("sss", $title, $description, $fileName);

    if ($stmt->execute()) {
        header("Location: index.php?success=" . urlencode("Data uploaded successfully."));
    } else {
        header("Location: index.php?error=" . urlencode("Database error: " . $stmt->error));
    }

    $stmt->close();

} else {
    header("Location: index.php?error=" . urlencode("File upload failed. Please try again."));
}

$conn->close();
?>
