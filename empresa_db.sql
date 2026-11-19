CREATE DATABASE IF NOT EXISTS empresa_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE empresa_db;

CREATE TABLE IF NOT EXISTS funcionarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    tipoFuncionario VARCHAR(50) NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id)
);