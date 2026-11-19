<?php

class Database
{
    private const HOST = 'localhost';
    private const DB_NAME = 'empresa_db';
    private const USER = 'root';
    private const PASSWORD = '';

    public static function conectar(): PDO
    {
        $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

        return new PDO($dsn, self::USER, self::PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
}
