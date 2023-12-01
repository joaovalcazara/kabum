<?php
include_once '../config/database.php';
include_once '../model/cliente-model.php';

$conn = Database::getConexao();
$clienteModel = new ClienteModel($conn);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     $clientes = $clienteModel->listarClientes();
    echo json_encode($clientes);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $dados = json_decode(file_get_contents('php://input'), true);

    if ($dados) {
        $novoId = $clienteModel->adicionarCliente($dados);
        echo json_encode(['idCliente' => $novoId]);
    } else {
         http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Dados inválidos']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
     $dados = json_decode(file_get_contents('php://input'), true);

    if ($dados && isset($dados['idCliente'])) {
        $clienteModel->editarCliente($dados['idCliente'], $dados);
        echo json_encode(['success' => true]);
    } else {
         http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Dados inválidos']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
     $dados = json_decode(file_get_contents('php://input'), true);

    if ($dados && isset($dados['idCliente'])) {
        $clienteModel->excluirCliente($dados['idCliente']);
        echo json_encode(['success' => true]);
    } else {
         http_response_code(400); // Bad Request
        echo json_encode(['error' => 'ID do cliente não fornecido']);
    }
}
