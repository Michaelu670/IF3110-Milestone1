<?php

class Database
{
    private $host = HOST;
    private $db_name = DB_NAME;
    private $user = USER;
    private $password = PASSWORD;
    private $port = PORT;

    private $db_connection;
    private $db_statement;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name;
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->db_connection = new PDO($dsn, $this->user, $this->password, $option);
        } catch (PDOException) {
            throw new LoggedException('Bad Gateway', 502);
        }
    }

    public function query($query)
    {
        try
        {
            $this->db_statement = $this->db_connection->prepare($query);
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function bind($param, $value, $type = null)
    {
        if(is_null($type))
        {
            switch(true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        try
        {
            $this->db_statement->bindValue($param, $value, $type);
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function execute()
    {
        try
        {
            $this->db_statement->execute();
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function fetch()
    {
        try
        {
            $this->execute();
            return $this->db_statement->fetch(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }
    
    public function fetchAssoc()
    {
        try
        {
            $this->execute();
            return $this->db_statement->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function fetchAll()
    {
        try
        {
            $this->execute();
            return $this->db_statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function rowCount()
    {
        try
        {
            return $this->db_statement->rowCount();
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function lastInsertId()
    {
        try
        {
            return $this->db_connection->lastInsertId();
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function beginTransaction()
    {
        try
        {
            return $this->db_connection->beginTransaction();
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function endTransaction()
    {
        try
        {
            return $this->db_connection->commit();
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function cancelTransaction()
    {
        try
        {
            return $this->db_connection->rollBack();
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function debugDumpParams()
    {
        try
        {
            return $this->db_statement->debugDumpParams();
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function closeConnection()
    {
        try
        {
            $this->db_connection = null;
        }
        catch (PDOException $e)
        {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function getDbConnection()
    {
        return $this->db_connection;
    }

    public function getDbStatement()
    {
        return $this->db_statement;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getDbName()
    {
        return $this->db_name;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setDbConnection($db_connection)
    {
        $this->db_connection = $db_connection;
    }

    public function setDbStatement($db_statement)
    {
        $this->db_statement = $db_statement;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function setDbName($db_name)
    {
        $this->db_name = $db_name;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function __destruct()
    {
        $this->closeConnection();
    }
}