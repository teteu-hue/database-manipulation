<?php

namespace Connection;

use Exception;

/**
 * Classe responsavel por prover metodos necessarios para manipular transacoes.
 */
final class Transaction
{
    private static $conn;

    private function __construct(){}

    /**
     * Abre uma conexão no banco de dados
     * 
     * @param $database -> nome do banco de dados.
     */
    public static function open($database)
    {
        if(!empty(self::$conn)){
            throw new Exception("A connection is already open!");
        }
        self::$conn = TConnection::open($database);
        self::$conn->beginTransaction();
    }

    /**
     * Busca pela conexão
     * 
     * @return PDO;
     */
    public static function get()
    {
        return self::$conn;
    }

    /**
     * Desfaz todas as alterações feitas na transação.
     */
    public static function rollback()
    {
        if(self::$conn) {
            self::$conn->rollback();
            self::$conn = null;
        }
    }

    /**
     * Fecha a conexão com o banco de dados e commita as alterações no banco.
     */
    public static function close()
    {
        if(self::$conn) {
            self::$conn->commit();
            self::$conn = null;
        }
    }
}