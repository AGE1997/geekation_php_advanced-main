<?php
// require('../pdo_connect.php');

use JetBrains\PhpStorm\ArrayShape;

require_once(ROOT_PATH .'Models/Db.php');

class Contact extends Db
{
    public function __construct($dbh = null)
    {
        parent::__construct($dbh);
    }

    public function findAll($mode = 'input'):Array
    {
        $sql = 'SELECT id, name, kana, tel, email, body FROM contacts';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        return $result;
    }

    public function insert($post)
    {
        foreach ($post as $key => $value) {
            $_POST[$key] = $value;
        }
        $this->dbh->beginTransaction();
        try {
              // SQL文を準備します。
            $sql = 'INSERT INTO contacts (name, kana, tel, email, body) VALUE (:name, :kana, :tel, :email, :body)';
            $stmt = $this->dbh->prepare($sql);

            $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
            $stmt->bindValue(':kana', $_POST['kana'], PDO::PARAM_STR);
            $stmt->bindValue(':tel', $_POST['tel'], PDO::PARAM_STR);
            $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->bindValue(':body', $_POST['body'], PDO::PARAM_STR);
            $stmt->execute();
            $this->dbh->commit();
            $result = $stmt->fetchColumn();
            return $result;
        } catch (PDOException $e) {
            // エラーが発生した時はロールバック
            $this->dbh->rollBack();
            echo $e;
        }
        // INSERTされたデータを確認します
        $sql = 'SELECT * FROM contacts';
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
    }

    public function findById($id = 0):Array
    {
        // SQL文を準備します。
        $sql = 'SELECT * FROM contacts WHERE id = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        // SQL文の実行
        $stmt->execute();

        // SQL文の結果を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '詳細ページがありません。';
            exit;
        }
        return $result;
    }

    public function update($post)
    {
        // var_dump($post);
        foreach ($post as $key => $value) {
            $_POST[$key] = $value;
        }
        $this->dbh->beginTransaction();
        try {
      // SQL文を準備します。「:id」「:name」がプレースホルダーです。
            var_dump($_POST['name']);
            $sql = 'UPDATE contacts SET name = :name, kana = :kana, tel = :tel, email = :email, body = :body
            WHERE id=:id';
            $stmt = $this->dbh->prepare($sql);

            $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
            $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
            $stmt->bindValue(':kana', $_POST['kana'], PDO::PARAM_STR);
            $stmt->bindValue(':tel', $_POST['tel'], PDO::PARAM_STR);
            $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->bindValue(':body', $_POST['body'], PDO::PARAM_STR);
            var_dump($stmt);
            $stmt->execute();
            $this->dbh->commit();
            $result = $stmt->fetchColumn();
            // var_dump($result);
            return $result;
        } catch (PDOException $e) {
            // エラーが発生した時はロールバック
            $this->dbh->rollBack();
            echo $e;
        }

        // UPDATEされたデータを確認します
        $sql = 'SELECT * FROM contacts';
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id = 0):Array
    {
        // SQL文を準備します。
        $sql = 'DELETE FROM contacts WHERE id=:id';
        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        // SQL文の実行
        $stmt->execute();

        // DELETEされたデータを確認します
        $sql = 'SELECT * FROM contacts';
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        return $result;
    }
}
