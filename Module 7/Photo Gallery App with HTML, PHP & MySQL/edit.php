<?php
include "db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

$result = $conn->query("SELECT * FROM photos WHERE id = $id");

if ($result->num_rows == 0) {
    header("Location: index.php");
    exit;
}

$photo = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Photo Gallery App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .gallery-img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="text-center mb-4">📸 Edit Photo</h2>

  <!-- Edit Form -->
  <div class="card mb-4 p-4">
    <form action="update.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $photo['id']; ?>">
      <input type="hidden" name="old_filename" value="<?php echo $photo['filename']; ?>">
      
      <div class="mb-3">
        <label class="form-label">Title:</label>
        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($photo['title']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Description:</label>
        <textarea class="form-control" name="description"><?php echo htmlspecialchars($photo['description']); ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Current Image:</label>
        <div class="mb-2">
          <img src="uploads/<?php echo $photo['filename']; ?>" class="gallery-img" alt="Current Photo">
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Select New Image (optional):</label>
        <input type="file" name="image" class="form-control" accept="image/*">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>