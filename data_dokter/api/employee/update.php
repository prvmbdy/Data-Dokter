<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../models/employees.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Employee($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // employee values
    $item->name = $data->name;
    $item->rumah_sakit = $data->rumah_sakit;
    $item->age = $data->age;
    $item->spesialis = $data->spesialis;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updateEmployee()){
        echo json_encode(['message'=>'Data berhasil diperbarui.']);
    } else{
        echo json_encode(['message'=>'Data tidak dapat diperbarui.']);
    }
?>