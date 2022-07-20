<?php
session_start();

require_once(ROOT_PATH .'Models/Db.php');
require_once(ROOT_PATH .'Controllers/ContactController.php');
$contact = new ContactController();
$params = $contact->show();
// var_dump($params);
// var_dump($_POST);
$mode = 'update';

// エラー内容
$errors = [];
if (isset($_POST['cancel']) && $_POST['cancel']) {
    header("Location:/contact.php");
    $_SESSION['name'] = "";
    $_SESSION['kana'] = "";
    $_SESSION['tel'] = "";
    $_SESSION['email'] = "";
    $_SESSION['body'] = "";
} elseif (isset($_POST['update']) && $_POST['update']) {
    // 編集データをチェック
    if (isset($_POST)) {
        // id
        $_SESSION['id'] = htmlspecialchars($_POST['id'], ENT_QUOTES);
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
        $mode = 'update';
    } else {
        $contact->update($_SESSION);
        // var_dump($_SESSION);
        $_SESSION = array();
        header("Location:/contact.php");
    }
} else {
// 使用する変数を初期化
    $_SESSION['name'] = "";
    $_SESSION['kana'] = "";
    $_SESSION['tel'] = "";
    $_SESSION['email'] = "";
    $_SESSION['body'] = "";
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
</head>
<body>
  <?php if ($mode == 'update') { ?>
    <!--更新画面 -->
    <div class="main">
      <div class="contact-form">
        <h1 class="section-title">お問い合わせ内容の詳細</h1>
        <?php if (isset($errors)) : ?>
        <ul>
              <?php foreach ($errors as $msg) : ?>
              <li style="color:red;"><?php echo $msg ?></li>
              <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php foreach ($params as $show) : ?>
        <form action="" method="POST">
          <input type="hidden" name="id" value="<?php echo $show['id'] ?>">

          <label for="name">氏名</label>
          <input id="name" type="text" name="name" value="<?php echo $show['name'] ?>">

          <label for="kana">フリガナ</label>
          <input id="kana" type="text" name="kana" value="<?php echo $show['kana'] ?>">

          <label for="tel">電話番号</label>
          <input id="tel" type="tel" name="tel" value="<?php echo $show['tel'] ?>">

          <label for="email">メールアドレス</label>
          <input id="email" type="text" name="email" value="<?php echo $show['email'] ?>">

          <label for="body">お問い合わせ内容</label>
          <textarea id="body" name="body" value="" cols="40" rows="8"><?php echo $show['body'] ?></textarea>
          
          <p>上記の内容でよろしいですか？</p>
          <input id="submit" type="submit" name="cancel" value="キャンセル">
          <input id="submit" type="submit" name="update" value="更新">
        </form>
        <?php endforeach; ?>
      </div>
    </div>
  <?php } ?>
</body>
</html>