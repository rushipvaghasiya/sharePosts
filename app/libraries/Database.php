<?php
class Database
{
    private $user = USER;
    private $pass = PASS;
    private $host = HOST;
    private $dbname = DBNAME;

    private $dbh;
    private $stmt;
    private $err;


    public function __construct()
    {
        try {
            $DSN = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            $this->dbh = new PDO($DSN, $this->user, $this->pass, $options);


        } catch (PDOException $e) {
            $this->err = $e->getMessage();
            echo $this->err;
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function bind($params, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {

                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_Bool;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($params, $value, $type);
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}
?>