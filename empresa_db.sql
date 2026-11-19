CREATE DATABASE empresa_db
USE empresa_db

CREATE TABLE funcionarios
(
    id INT NOT NULL PRIMARY KEY,
    nome [VARCHAR](100) NOT NULL,
    email [VARCHAR](150) NOT NULL,
    tipoFuncionario [VARCHAR](50) NOT NULL,
    salario DECIMAL(10,2) NOT NULL
);