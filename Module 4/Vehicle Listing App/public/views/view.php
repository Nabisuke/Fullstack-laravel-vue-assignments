<?php
include './header.php';

require_once "../../app/classes/VehicleManager.php";
$vehicleManager = new VehicleManager("","","","");

$id = $_GET['id'] ?? null;

$vehicle = $vehicleManager->viewVehicle($id);

if (!$vehicle){
    header("Location: ../index.php");
    exit;
}

// var_dump($id);
// exit;

?>
<div class="container my-4 text-center">
    <h1>View Vehicle</h1>
    <hr class="mx-auto" style="width: 200px;">
    <div class="row justify-content-center">      
        <div class="col-md-4 ">
            <div class="card">
                <img src="<?= $vehicle['image']?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Name: <?= $vehicle['name']?></h5> 
                        <p class="card-text">Type: <?= $vehicle['type']?></p>
                    <p class="card-text">Price: $<?= $vehicle['price']?></p>
                    <a href="edit.php?id=<?= $id ?>" class="btn btn-primary">Edit</a>
                    <a href="delete.php?id=<?= $id ?>" class="btn btn-danger">Delete</a>
                    <a href="../index.php?id=<?= $id ?>" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
