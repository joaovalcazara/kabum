<?php
 include_once ("../config/session_create.php");
include_once '../config/database.php';
include_once '../model/cliente-model.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");  // Importante!


if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
     $_SESSION = array(); 
     session_destroy(); 
     echo json_encode(['success' => true]);
};