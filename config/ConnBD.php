<?php 

class ConnDB
{
    private string $host = '144.22.157.228';
    private string $dbname = 'Alpha';
    private string $user = 'Alpha';
    private string $password = 'Alpha';
    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:{$this->host};dbname={$this->dbname}";

        try{
            $this->conn = new PDO($dsn, $this->user, $this->password);
            //$pdo = new PDO( "sqlsrv:server=DESKTOP-POF56EJ\SQLEXPRESS; Database = Alpha", "", ""); 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        } catch (PDOException $e){
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            die();
        }
    }

    public function getConn()
    {
        return $this->conn;
    }
} 