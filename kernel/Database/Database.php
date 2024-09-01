<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{
    private \PDO $pdo;


    public function __construct(
        private ConfigInterface $config
    )
    {


        $this->connect();

    }

    public function first(string $table, array $conditions = []): ?array
    {
        $where = '';

        if (count($conditions) > 0) {

            $where = 'WHERE ' . implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }


        $sql = "SELECT * FROM $table $where LIMIT 1";


        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);


        $result = $stmt->fetch(\PDO::FETCH_ASSOC);


        return $result ?: null;
    }


    public function insert(string $table, array $data): int|false
    {
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch(\PDOException){
            return false;
        }

        return (int) $this->pdo->lastInsertId();
    }

    private function connect(): void
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');

        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');

        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new \PDO(
                "$driver:host=$host;port=$port;dbname=$database;charset=$charset",
                $username,
                $password
            );
        } catch(\PDOException $exception){
            exit("Database connection failed : {$exception->getMessage()}");
        }

    }

    /**
     * @param string $table
     * @param array $conditions
     * @return mixed
     */
    public function get(string $table, array $conditions = [])
    {
        $where = '';

        if (count($conditions) > 0) {

            $where = 'WHERE ' . implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }


        $sql = "SELECT * FROM $table $where";


        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($conditions);


        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        return $result ?: null;
    }
}