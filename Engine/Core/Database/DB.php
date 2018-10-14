<?php
namespace Engine\Core\Database;

class DB
{
    private static $instance;
    private $link;
    private  static $database;

    public function __construct()
    {
        $this->connect();
        $this->link = $this->connect();
    }

    /**
     * check if the database is connected
     * pattern singleton
     * @return \PDO
     */
    public static function connect(){
        if(self::$instance === null){
            self::$instance = self::connectdb();
        }
        return self::$instance;
    }

    /**
     * the database connection
     * @return \PDO
     */
    private static function connectdb(){
        static $db;
        self::$database = require_once ROOT_DIR . '\configs\database.php';
        $default = self::$database['default'];

        if($db == null){
            $db = new \PDO(
                self::$database['connections'][$default]['driver'] .
                ':host=' . self::$database['connections'][$default]['host'] .
                ';port=' . self::$database['connections'][$default]['port'] .
                ';dbname=' . self::$database['connections'][$default]['database'] ,
//                ';charset=' . self::$database['connections'][$default]['charset'],
                self::$database['connections'][$default]['username'],
                self::$database['connections'][$default]['password']
            );
            $db->exec("SET NAMES UTF8");
            $db->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        }
        return $db;
    }

    public function execute($sql, $values = [])
    {
        $sth = $this->link->prepare($sql);
        return $sth->execute($values);
    }

    public function fetch($sql, $value)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute((array) $value);
        $result = $sth->fetch(\PDO::FETCH_OBJ);

        return $result;

    }

    public function fetchAll($sql, $values = [])
    {
        $sth = $this->link->prepare($sql);
        $sth->execute($values);
        $result = $sth->fetchAll(\PDO::FETCH_OBJ);

        if(!$result)
        {
            return $result = [];
        }

        return $result;
    }

    public function getLastId()
    {
        $id = $this->link->lastInsertId();
        return $id;
    }
}

?>