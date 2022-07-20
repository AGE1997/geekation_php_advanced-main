<?php
require_once(ROOT_PATH . 'Models/ContactModel.php');

class ContactController
{
    private $request;   // リクエストパラメータ(GET,POST)
    private $Contact;    // Playerモデル

    public function __construct()
    {
      // リクエストパラメータの取得
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

      // モデルオブジェクトの生成
        $this->Contact = new Contact();
      // 別モデルと連携
        $dbh = $this->Contact->get_db_handler();
    }

    public function create($post)
    {
        $contacts = $this->Contact->insert($post);
    }

    public function index()
    {
        $mode = 'input';
        if (isset($this->request['get']['mode'])) {
            $mode = $this->request['get']['mode'];
        }

        $contacts = $this->Contact->findAll($mode);
        $params = [
            'contacts' => $contacts,
            'mode' => $mode
        ];
        // var_dump($params);
        return $params;
    }

    public function show()
    {
        if (empty($this->request['get']['id'])) {
            echo '指定のパラメータが不正です。このページは表示できません。';
            exit;
        }
        $contacts = $this->Contact->findById($this->request['get']['id']);
        $params = [
          'contacts' => $contacts
        ];
        return $params;
    }

    public function update($post)
    {
        var_dump($post);
        $contacts = $this->Contact->update($post);
        // var_dump($contacts);
    }
    
    public function contactDelete()
    {
        if (empty($this->request['post']['id'])) {
            echo '指定のパラメータが不正です。このページは表示できません。';
            exit;
        }
        $contacts = $this->Contact->delete($this->request['post']['id']);
        return $contacts;
    }
}
