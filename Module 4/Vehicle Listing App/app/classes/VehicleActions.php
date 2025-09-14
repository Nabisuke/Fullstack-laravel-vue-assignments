<?php


interface VehicleActions {

    public function addVehicle($data);
    public function editVehicle($id, $data );
    public function deletevehicle($id);
    public function getvehicles();

    public function viewVehicle($id);
   
}
