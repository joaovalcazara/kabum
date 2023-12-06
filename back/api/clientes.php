<?php
 include_once ("../config/session_create.php");
include_once '../config/database.php';
include_once '../model/cliente-model.php';
 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");


$conn = Database::getConexao();
$clienteModel = new ClienteModel($conn);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     $dados = $_GET; 
     if(isset($dados['acao']) && $dados['acao'] === "listarClientes") {
         $clientes = $clienteModel->listarClientes(); 
         echo json_encode($clientes);
    }else if(isset($dados['acao']) && $dados['acao'] === "getCliente"){
        $cliente = $clienteModel->getCliente($dados['idCliente']); 
        echo json_encode($cliente);
   }
 }

 elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $dados = json_decode(file_get_contents('php://input'), true);  
     if($dados['acao'] == "cadastrar"){
         if ($dados) {
            $idCliente = $clienteModel->adicionarCliente($dados);
            if($idCliente !== false) {
                echo json_encode(['idCliente' =>  $idCliente]);
            } else {
                http_response_code(500); 
                echo json_encode(['error' => true, 'message' => 'Erro ao cadastrar cliente']);
            }
         } else {
             http_response_code(400); 
             echo json_encode(['error' => 'Dados inválidos']);
         } 
     } 
} 

elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
     $dados = json_decode(file_get_contents('php://input'), true); 
    if (isset($dados['idCliente'])) { 
        $idCliente = $clienteModel->editarCliente($dados);
        if($idCliente !== false) {
            echo json_encode(['idCliente' =>  $idCliente]);
        } else {
            http_response_code(500); 
            echo json_encode(['error' => true, 'message' => 'Erro ao editar cliente']);
        }
    } else {
         http_response_code(400);  
        echo json_encode(['error' => 'Dados inválidos']);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
     $dados = json_decode(file_get_contents('php://input'), true); 
    if ($dados && isset($dados['idCliente'])) {
        $res = $clienteModel->excluirCliente($dados['idCliente']);
        echo json_encode(['success' => $res]);  
    } else {
         http_response_code(400); 
        echo json_encode(['error' => 'ID do cliente não fornecido']);
    }
}
