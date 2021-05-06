<?php

namespace App\db;

use PDO;
use PDOException;
use PDOStatement;

/**
 * Class Database
 * @package App\db
 */
class Database
{
    /**
     * Host Conexão c o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco
     * @var string
     */
    const NAME = "vagas";

    /**
     * Usuario do banco
     * @var string
     */
    const USER = "root";

    /**
     * senha do banco
     * @var string
     */
    const PASS = "830314";

    /**
     * Nome da tabela
     * @var string
     */
    private $table;

    /**
     * Instancia PDO
     * @var PDO
     */
    private $connection;

    /**
     * Database constructor.
     * @param null $table
     */
    public function __construct ( $table = null )
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     *Método responsavel por criar uma conexão com o banco de dados
     */
    private function setConnection ()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';dbname=' . self::NAME,
                self::USER,
                self::PASS
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Métodos responsavel por executar queries dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute ( string $query, array $params = [] ): PDOStatement
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Métodos responsavel por inserir dados no banco
     * @param array $values
     * @return integer
     */
    public function insert ( array $values ): int
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        $this->execute($query, array_values($values));
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select ( $where = null, $order = null, $limit = null, $fields = '*' ): PDOStatement
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;
        return $this->execute($query);
    }

    /**
     * @param $where
     * @param $values
     * @return bool
     */
    public function update ( $where, $values ): bool
    {
        $fields = array_keys($values);
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;
        $this->execute($query, array_values($values));
        return true;
    }

    /**
     * @param $where
     * @return bool
     */
    public function delete ( $where ): bool
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        $this->execute($query);
        return true;
    }
}