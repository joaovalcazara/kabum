<?php
include_once '../config/database.php';

class UsuarioModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUsuario($idUsuario) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
            $stmt->execute([$idUsuario]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter usuário: " . $e->getMessage());
            return false;
        }
    }

    public function login($dados) { 
        $query = "SELECT * FROM usuario WHERE Email = :email AND Senha = :senha";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':senha', $dados['senha']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;       
        }  

    }

    public function adicionarUsuario($dados) {

        try {
            $stmt = $this->conn->prepare("INSERT INTO usuario (Nome, Email, Senha) VALUES (:nome, :email, :senha)");
    
     
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':senha', $dados['senha']);
    
            $stmt->execute();
    
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return 0; // Ou algum valor que indique um erro no seu contexto.
        }
    }

    public function editarUsuario($idUsuario, $novosDados) {
        $sql = "UPDATE usuario SET Nome = :nome, Email = :Email, Senha = :senha WHERE idUsuario = :id";

        try {
            $query = $this->conn->prepare($sql);

            $query->bindParam(':id', $idUsuario);
            $query->bindParam(':nome', $novosDados['Nome']);
            $query->bindParam(':email', $novosDados['Email']);
            $query->bindParam(':senha', $novosDados['Senha']);

            $query->execute();

            return true;
        } catch (PDOException $e) {
            error_log("Erro ao editar usuário: " . $e->getMessage());
            return false;
        }
    }

    public function excluirUsuario($idUsuario) {
        $sql = "DELETE FROM usuario WHERE idUsuario = :id";

        try {
            $query = $this->conn->prepare($sql);
            $query->bindParam(':id', $idUsuario);
            $query->execute();

            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir usuário: " . $e->getMessage());
            return false;
        }
    }
}
