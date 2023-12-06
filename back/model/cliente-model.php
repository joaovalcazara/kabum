<?php
 include_once ("../config/session_create.php");
 include_once '../config/database.php';

 class ClienteModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;

    }

    public function listarClientes() { 
         try {
             session_start();
             if (isset($_SESSION['usuario'])) {
                $idUser = $_SESSION['user']; 
                $sql = "SELECT c.* FROM cliente c WHERE idUsuario = $idUser ORDER BY c.idCliente";
                $stmt = $this->conn->query($sql);
                $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                foreach ($clientes as &$cliente) {
                    $sql = "SELECT * FROM endereco WHERE idCliente =" . $cliente['idCliente'];
                    $stmt = $this->conn->query($sql);
                    $cliente['endereco'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
    
                unset($cliente);
    
                return $clientes;
            } else {
                 return false;
            }
        } catch (PDOException $e) {
            error_log("Erro ao listar clientes: " . $e->getMessage());
            return false;
        }
    }
    

    public function getCliente($idCliente) {
        try {
            $sql = "SELECT * FROM cliente WHERE idCliente =".$idCliente;
            $stmt = $this->conn->query($sql);
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
 
            $sqlEndereco = "SELECT * FROM endereco WHERE idCliente =" . $cliente['idCliente'];
            $stmt = $this->conn->query($sqlEndereco);
            $cliente['endereco'] = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $cliente;
        } catch (PDOException $e) {
            error_log("Erro ao listar clientes: " . $e->getMessage());
            return false;
        }
    }
    
    
    
    public function adicionarCliente($dados) {

        $sqlCliente = "INSERT INTO cliente (Nome, Data_Nascimento, Cpf, Rg, Telefone,idUsuario) VALUES (:nome, :data_nascimento, :cpf, :rg, :telefone, :idusuario)";
        $sqlEndereco = "INSERT INTO endereco (idCliente, Logradouro, Numero, Complemento, Bairro, Cidade, Estado, Cep) VALUES (:idCliente, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, :cep)";
    
        try {
            // Inicia uma transação para garantir atomicidade
            $this->conn->beginTransaction();
    
            $queryCliente = $this->conn->prepare($sqlCliente);
            $queryCliente->bindParam(':nome', $dados['Nome']);
            $queryCliente->bindParam(':data_nascimento', $dados['Data_Nascimento']);
            $queryCliente->bindParam(':cpf', $dados['Cpf']);
            $queryCliente->bindParam(':rg', $dados['Rg']);
            $queryCliente->bindParam(':telefone', $dados['Telefone']);
            $queryCliente->bindParam(':idusuario', $_SESSION['user']);
            $queryCliente->execute();
    
             $idCliente = $this->conn->lastInsertId();
    
             if (isset($dados['endereco']) && is_array($dados['endereco'])) {
                foreach ($dados['endereco'] as $endereco) {
                    $queryEndereco = $this->conn->prepare($sqlEndereco); 
                    $logradouro = $endereco['Logradouro'] ?? null;
                    $numero = $endereco['Numero'] ?? null;
                    $complemento = $endereco['Complemento'] ?? null;
                    $bairro = $endereco['Bairro'] ?? null;
                    $cidade = $endereco['Cidade'] ?? null;
                    $estado = $endereco['Estado'] ?? null;
                    $cep = $endereco['Cep'] ?? null;
                
                    $queryEndereco->bindParam(':idCliente', $idCliente);
                    $queryEndereco->bindParam(':logradouro', $logradouro);
                    $queryEndereco->bindParam(':numero', $numero);
                    $queryEndereco->bindParam(':complemento', $complemento);
                    $queryEndereco->bindParam(':bairro', $bairro);
                    $queryEndereco->bindParam(':cidade', $cidade);
                    $queryEndereco->bindParam(':estado', $estado);
                    $queryEndereco->bindParam(':cep', $cep);
                
                    $queryEndereco->execute();
                }    
            }
            $result = $this->conn->commit();

              if ($result) {
                return $idCliente;
            } else {
                return false;
            }
        } catch (PDOException $e) {
             $this->conn->rollBack();
    
             error_log("Erro ao inserir cliente: " . $e->getMessage());
            return false;
        }
    }
    

    public function editarCliente($dados) {
        try {
            $sqlEndereco = "INSERT INTO endereco (idCliente, Logradouro, Numero, Complemento, Bairro, Cidade, Estado, Cep) VALUES (:idCliente, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, :cep)";
            $this->conn->beginTransaction(); 
            $idCliente = $dados["idCliente"];  

            $stmtCliente = $this->conn->prepare("UPDATE cliente SET Nome=?, Data_Nascimento=?, Cpf=?, Rg=?, Telefone=? WHERE idCliente=?");
            $stmtCliente->execute([$dados['Nome'], $dados['Data_Nascimento'], $dados['Cpf'], $dados['Rg'], $dados['Telefone'], $idCliente]);
    
            $stmtDeleteEnderecos = $this->conn->prepare("DELETE FROM endereco WHERE idCliente = ?");
            $stmtDeleteEnderecos->execute([$idCliente]);
            if (isset($dados['endereco']) && is_array($dados['endereco'])) {
                foreach ($dados['endereco'] as $endereco) {
                    $queryEndereco = $this->conn->prepare($sqlEndereco);
                
                    $idCliente = $dados["idCliente"];
                    $logradouro = $endereco['Logradouro'] ?? null;
                    $numero = $endereco['Numero'] ?? null;
                    $complemento = $endereco['Complemento'] ?? null;
                    $bairro = $endereco['Bairro'] ?? null;
                    $cidade = $endereco['Cidade'] ?? null;
                    $estado = $endereco['Estado'] ?? null;
                    $cep = $endereco['Cep'] ?? null;
                
                    $queryEndereco->bindParam(':idCliente', $idCliente);
                    $queryEndereco->bindParam(':logradouro', $logradouro);
                    $queryEndereco->bindParam(':numero', $numero);
                    $queryEndereco->bindParam(':complemento', $complemento);
                    $queryEndereco->bindParam(':bairro', $bairro);
                    $queryEndereco->bindParam(':cidade', $cidade);
                    $queryEndereco->bindParam(':estado', $estado);
                    $queryEndereco->bindParam(':cep', $cep);
                
                    $queryEndereco->execute();
                }    
            }
            $result = $this->conn->commit();
             if ($result) {
                return $idCliente;
            } else {
                return false;
            }
            
        } catch (PDOException $e) {
             $this->conn->rollBack();
             error_log("Erro ao editar cliente: " . $e->getMessage());
        }
    }
    
    public function excluirCliente($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM cliente WHERE idCliente=?");
            $resCliente = $stmt->execute([$id]);
    
            $stmt = $this->conn->prepare("DELETE FROM endereco WHERE idCliente=?");
            $resEndereco =$stmt->execute([$id]);
            if($resEndereco &&  $resCliente){
                return true; 
            }else{
                return false;
            }
        } catch (PDOException $e) {
             error_log("Erro ao excluir cliente: " . $e->getMessage());
    
             return false;
        }
    }
    
}
