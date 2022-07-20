<?php
require_once(ROOT_PATH .'database.php');

class Db {
    protected $dbh;

    public function __construct($dbh = null) {
        if (!$dbh) {
            try {
                $this -> dbh = new PDO(
                    'mysql:dbname='.DB_NAME.
                    ';host='.DB_HOST,DB_USER,DB_PASSWD
                );
                $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "接続成功\n";
            } catch (PDOException $e) {
                echo "接続失敗: " . $e->getMessage() . "\n";
                exit();
            }
        } else {
                $this -> dbh = $dbh;
        }
    }
    public function get_db_handler()
    {
        return $this->dbh;
    }
    public function begin_transaction()
    {
        $this->dbh->beginTransaction();
    }

    public function commit()
    {
        $this->dbh->commit();
    }

    public function rollback()
    {
        $this->dbh->rollback();
    }
}
