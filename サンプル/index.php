<?php
require_once(ROOT_PATH .'Controllers/PlayerController.php');
$player = new PlayerController();
$params = $player->index();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>オブジェクト指向</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    <h1>オブジェクト指向の練習プログラム</h1>
    <hr>
    <section>
        <h2>選手一覧</h2>
        <table>
        <tr>
            <th>No</th>
            <th>国</th>
            <th>背番号</th>
            <th>ポジション</th>
            <th>名前</th>
            <th>所属</th>
            <th>誕生日</th>
            <th>身長</th>
            <th>体重</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($params['players'] as $player): ?>
        <tr>
            <td><?=$player['id'] ?></td>
            <td><?=$player['country_name'] ?></td>
            <td><?=$player['uniform_num'] ?></td>
            <td><?=$player['position'] ?></td>
            <td><?=$player['player_name'] ?></td>
            <td><?=$player['club'] ?></td>
            <td><?=$player['birth'] ?></td>
            <td><?=$player['height'] ?>cm</td>
            <td><?=$player['weight'] ?>kg</td>
            <td class='actions'>
                <a href="view.php?id=<?=$player['id'] ?>">詳細</a>
                <a href="edit.php?id=<?=$player['id'] ?>">編集</a>
                <a href="delete.php?id=<?=$player['id'] ?>&page=<?=$params['page'] ?>" onclick="return confirm('<?=$player['id'] ?>を削除します。よろしいですか？')">削除</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
        <div class='paging'>
        <?php 
        for($i=0;$i<=$params['pages'];$i++) {
            if(isset($_GET['page']) && $_GET['page'] == $i) {
                echo $i+1;
            } else {
                echo "<a href='?page=".$i."'>".($i+1)."</a>";
            }
        }
        ?>
        </div>
    </section>

</body>
</html>