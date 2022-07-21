<?php
session_start();

require_once(ROOT_PATH .'Controllers/ContactController.php');
$contact = new ContactController();
$params = $contact->index();
$mode = 'input';
// エラー内容
$errors = [];
if (isset($_POST['cancel']) && $_POST['cancel']) {
  // 何もしない
} elseif (isset($_POST['confirm']) && $_POST['confirm']) {
    // 送信データをチェック
    if (isset($_POST)) {
        // 氏名
        if (empty($_POST['name'])) {
            $errors[] = '氏名を入力してください。';
        } elseif (mb_strlen($_POST['name']) > 10 && !preg_match('/^[a-zA-Zａ-ｚＡ-Ｚぁ-んァ-ヶ一-龠]+$/u', $_POST['name'])) {
            $errors[] = '記号、数字を含めず10文字以内で入力してください。';
        }
        $_SESSION['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);
        // フリガナ
        if (empty($_POST['kana'])) {
            $errors[] = 'フリガナを入力してください。';
        } elseif (mb_strlen($_POST['kana']) > 10 && !preg_match('/^[ァ-ヶ一]+$/u', $_POST['kana'])) {
            $errors[] = '10文字以内のカタカナで入力してください。';
        }
        $_SESSION['kana'] = htmlspecialchars($_POST['kana'], ENT_QUOTES);
        // 電話番号
        if (!preg_match('/\A[0-9]{10,11}\z/', $_POST['tel'])) {
            $errors[] = '数字で入力してください。';
        }
        $_SESSION['tel'] = htmlspecialchars($_POST['tel'], ENT_QUOTES);
        // メールアドレス
        if (empty($_POST['email'])) {
            $errors[] = 'メールアドレスを入力してください。';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = '@を含めxxx@xxxで入力してください。';
        }
        $_SESSION['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);
        // お問い合わせ内容
        if (empty($_POST['body'])) {
            $errors[] = 'お問い合わせ内容を入力してください。';
        }
        $_SESSION['body'] = htmlspecialchars($_POST['body'], ENT_QUOTES);
    }
    if ($errors) {
        $mode = 'input';
    } else {
        $mode = 'confirm';
    }
} elseif (isset($_POST['send']) && $_POST['send']) {
    $contact->create($_SESSION);
    $_SESSION = array();
    $mode = 'send';
} else {
// 使用する変数を初期化
    $_SESSION['name'] = "";
    $_SESSION['kana'] = "";
    $_SESSION['tel'] = "";
    $_SESSION['email'] = "";
    $_SESSION['body'] = "";
}

if (isset($_POST['id']) && $_POST['id']) {
    $contact->contactDelete();
    header("Location:/contact.php");
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Casteria</title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/contact.css">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <script defer src="../js/contact.js"></script>
    <script defer src="../js/delete_alert.js"></script>
</head>
<body>
  <?php if ($mode == 'input') { ?>
    <!--入力画面 -->
    <div class="main">
      <div class="contact-form">
        <h1 class="section-title">お問い合わせ</h1>
        <?php if (isset($errors)) : ?>
        <ul>
              <?php foreach ($errors as $msg) : ?>
              <li style="color:red;"><?php echo $msg ?></li>
              <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <form action="" method="POST">
          <label for="name">氏名</label>
          <input id="name" type="text" name="name" value="<?php echo $_SESSION['name'] ?>">

          <label for="kana">フリガナ</label>
          <input id="kana" type="text" name="kana" value="<?php echo $_SESSION['kana'] ?>">

          <label for="tel">電話番号</label>
          <input id="tel" type="tel" name="tel" value="<?php echo $_SESSION['tel'] ?>">

          <label for="email">メールアドレス</label>
          <input id="email" type="text" name="email" value="<?php echo $_SESSION['email'] ?>">

          <label for="body">お問い合わせ内容</label>
          <textarea id="body" name="body" value="" cols="40" rows="8"><?php echo $_SESSION['body'] ?></textarea>

          <input id="submit" type="submit" name="confirm" value="送信">
        </form>
      </div>
    </div>
    <div class="main">
      <div class="contact-table">
        <hr>
        <section>
            <h2>過去のお問い合わせ一覧</h2>
            <table border="1">
              <tr>
                <th>氏名</th>
                <th>フリガナ</th>
                <th>電話番号</th>
                <th>メールアドレス</th>
                <th>お問い合わせ内容</th>
                <th>編集</th>
                <th>削除</th>
              </tr>
              <?php foreach ($params['contacts'] as $contact) : ?>
              <tr>
                <td><?=$contact['name'] ?></td>
                <td><?=$contact['kana'] ?></td>
                <td><?=$contact['tel'] ?></td>
                <td><?=$contact['email'] ?></td>
                <td><?=$contact['body'] ?></td>
                <form action="/contact_update.php" method="GET">
                  <td>
                    <button id="update" type="submit" value="<?=$contact['id'] ?>" name="id">編集</button>
                  </td>
                </form>
                <form action="" method="POST">
                  <td>
                    <button id="delete" type="submit" value="<?=$contact['id'] ?>" name="id" onclick="return confirmDelete()">削除</button>
                  </td>
                </form>
                
              </tr>
              <?php endforeach; ?>
            </table>
        </section>
      </div>
    </div>
  <?php } elseif ($mode == 'confirm') { ?>
    <!--確認画面 -->
    <div class="main">
    <div class="contact-form">
      <h1 class="section-title">お問い合わせ内容の確認</h1>
      <form action="" method="POST">
        <label for="name">氏名</label><br>
        <?php echo $_SESSION['name'] ?><br>
        
        <label for="kana">フリガナ</label><br>
        <?php echo $_SESSION['kana'] ?><br>

        <label for="tel">電話番号</label><br>
        <?php echo $_SESSION['tel'] ?><br>

        <label for="email">メールアドレス</label><br>
        <?php echo $_SESSION['email'] ?><br>

        <label for="body">お問い合わせ内容</label><br>
        <?php echo nl2br($_SESSION['body']) ?><br>

        <input id="submit" type="submit" name="cancel" value="キャンセル">
        <input id="submit" type="submit" name="send" value="送信">
      </form>
    </div>
    </div>
  <?php } else { ?>
    <!--完了画面 -->
    <p>
      お問い合わせ内容を送信しました。<br>
      ありがとうございました。
    </p>
    <a href="/">トップへ</a>
  <?php } ?>
</body>
</html>