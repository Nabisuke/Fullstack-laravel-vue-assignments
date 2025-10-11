<?php
include "db.php";

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

<!-- Success & Error Message Examples -->
<div class="container mt-3">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Image uploaded successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <!-- Error Message Example -->
  <!--
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    File size exceeds 5MB limit.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  -->
</div>

<!-- Update Message -->
<div class="alert alert-success text-center">
  Photo updated successfully!
</div>

<div class="container py-5">
  <h2 class="text-center mb-4">📸 Photo Gallery</h2>

  <!-- Upload Form -->
  <div class="card mb-4 p-4">
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Title:</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Description:</label>
        <textarea class="form-control" name="description"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Select Image:</label>
        <input type="file" name="image" class="form-control" accept="image/*" required>
      </div>
      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
  </div>

  <!-- Gallery Display (Static Demo) -->
  <div class="row">

  <?php
    $sql = "SELECT * FROM photos ORDER BY uploaded_on DESC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<div class='col-md-4 mb-4'>
              <div class='card shadow-sm'>
                <img src='uploads/{$row["filename"]}' class='gallery-img' alt='Sunset'>
                <div class='card-body'>
                  <h5>{$row["title"]}</h5>
                  <p>{$row["description"]}</p>
                  <a href='edit.php?id={$row["id"]}' class='btn btn-warning btn-sm me-2'>Edit</a>
                  <a href='delete.php?id={$row["id"]}' class='btn btn-danger btn-sm'>Delete</a>
                </div>
              </div>
            </div>
          ";
      }
    }else{
      echo "<p class='text-center'>No data found</p>";
    }


    
  ?>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
