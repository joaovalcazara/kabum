<?php
 include_once ("../config/session_create.php");

include_once '../config/database.php';
include_once '../model/usuario-model.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$conn = Database::getConexao();
$usuarioModel = new UsuarioModel($conn);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     if (isset($_GET['id'])) {
        $idUsuario = $_GET['id'];
        $usuario = $usuarioModel->getUsuario($idUsuario);

        if ($usuario) {
            echo json_encode($usuario);
        } else {
            http_response_code(404); 
            echo json_encode(['error' => 'Usuário não encontrado']);
        }
    } else {
        http_response_code(400); 
        echo json_encode(['error' => 'ID do usuário não fornecido']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $dados = json_decode(file_get_contents('php://input'), true); 

    if($dados['acao'] == "cadastrar"){
        if ($dados) {
            $novoId = $usuarioModel->adicionarUsuario($dados);
            echo json_encode(['idUsuario' => $novoId]);
        } else {
            http_response_code(400); 
            echo json_encode(['error' => 'Dados inválidos']);
        } 
    }else if ($dados['acao'] == 'login') {
        if ($dados) {
            $res = $usuarioModel->login($dados);
            echo json_encode($res);
        } else {
            http_response_code(400); 
            echo json_encode(['error' => 'Dados inválidos']);
        } 

    }
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Editar usuário
    $dados = json_decode(file_get_contents('php://input'), true);

    if ($dados && isset($dados['idUsuario'])) {
        $idUsuario = $dados['idUsuario'];
        if ($usuarioModel->editarUsuario($idUsuario, $dados)) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);  
            echo json_encode(['error' => 'Erro ao editar usuário']);
        }
    } else {
        http_response_code(400);  
        echo json_encode(['error' => 'Dados inválidos ou ID do usuário não fornecido']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Excluir usuário
    $dados = json_decode(file_get_contents('php://input'), true);

    if ($dados && isset($dados['idUsuario'])) {
        $idUsuario = $dados['idUsuario'];
        if ($usuarioModel->excluirUsuario($idUsuario)) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);  
            echo json_encode(['error' => 'Erro ao excluir usuário']);
        }
    } else {
        http_response_code(400);  
        echo json_encode(['error' => 'ID do usuário não fornecido']);
    }
}
