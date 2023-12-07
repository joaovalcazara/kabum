# kabum
# 1- Crie uma pasta KABUM e nela, clone o projeto
# 2- Crie o banco de dados com o nome kabum, caso precise, configure ele na pasta back/config/database.php
# 3 - Crie as tabelas no banco (Pergutei onde mandar o bd, mas não obtive respostas via e-mail) 
# TABELA DE CLIENTE
# CREATE TABLE `kabum`.`cliente` (
# `idCliente` INT NOT NULL AUTO_INCREMENT,
#  `Nome` VARCHAR(45) NULL,
#  `Data_Nascimento` DATE NULL,
#  `Cpf` VARCHAR(45) NULL,
#  `Rg` VARCHAR(45) NULL,
#  `Telefone` VARCHAR(45) NULL,
# `idUsuario` INT NOT NULL,
#  PRIMARY KEY (`idCliente`));
#
# TABELA DE USUARIO
# CREATE TABLE `kabum`.`usuario` (
#  `idUsuario` INT NOT NULL AUTO_INCREMENT,
#  `Nome` VARCHAR(45) NULL,
#  `Email` VARCHAR(255) NOT NULL,
#  `Senha` VARCHAR(255) NOT NULL,
#  PRIMARY KEY (`idUsuario`));
#
# TABELA DE ENDERECOS
# CREATE TABLE `kabum`.`endereco` (
#  `idEndereco` INT NOT NULL AUTO_INCREMENT,
#  `idCliente` INT NOT NULL,
#  `Logradouro` VARCHAR(255) NULL,
#  `Numero` INT NULL,
#  `Complemento` VARCHAR(255) NULL,
#  `Bairro` VARCHAR(255) NULL,
#  `Cidade` VARCHAR(255) NULL,
#  `Estado` VARCHAR(255) NULL,
#  `Cep` VARCHAR(255) NULL, 
#  PRIMARY KEY (`idEndereco`));
#
# 4- abra o xampp e de start no apache
# 5- agora abra o bash (no caminho do projeto), entre em cd front e execute npm install
# 6- dentro da pasta front, tem o .env (retirei do gitignore) veja se o caminho está correto para o back/api
# 6- feito isso, de apenas um "npm run dev" para iniciar o projeto

