<!-- delete.php -->

<?php
require 'idol_menu.php';

// データベースに接続
$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516809-final', 'LAA1516809', 'Pass1222');

// 削除があった場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idolId = $_POST['idol_id']; // 削除対象のアイドルID

    // アイドルを削除
    $idolSql = $pdo->prepare('DELETE FROM idol WHERE idol_id = ?');
    $idolSql->execute([$idolId]);

    // 削除が成功した場合のメッセージを表示
    if ($idolSql) {
        echo 'アイドル情報が正常に削除されました。';
    } else {
        echo 'エラーが発生しました。';
    }
}

// アイドル一覧を取得
$sql = $pdo->query('SELECT idol.idol_id, idol.idol_name, groupp.group_name 
                    FROM idol 
                    LEFT JOIN groupp ON idol.group_id = groupp.group_id');

// アイドル一覧を表示
echo '<table>';
echo '<p><tr><th>アイドルID</th><th>アイドル名</th><th>グループ</th></tr></p>';
foreach ($sql as $row) {
    echo '<tr>';
    echo '<td>', $row['idol_id'], '</td>';
    echo '<td>', $row['idol_name'], '</td>';
    echo '<td>', $row['group_name'], '</td>';
    echo '</tr>';
}
echo '</table>';
?>

<hr>

<form action="delete.php" method="post">
    <p><label for="idol_id">アイドルID:</label>
    <input type="text" name="idol_id" required></p>

    <input type="submit" value="削除">
</form>
