<!-- update.php -->

<?php
require 'idol_menu.php';

// データベースに接続
$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516809-final', 'LAA1516809', 'Pass1222');

// 更新があった場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idolId = $_POST['idol_id']; // 更新対象のアイドルID
    $idolName = $_POST['idol_name'];
    $groupName = $_POST['group_name'];

    // グループを更新
    $groupSql = $pdo->prepare('UPDATE groupp SET group_name = ? WHERE group_id = (SELECT group_id FROM idol WHERE idol_id = ?)');
    $groupSql->execute([$groupName, $idolId]);

    // アイドルを更新
    $idolSql = $pdo->prepare('UPDATE idol SET idol_name = ? WHERE idol_id = ?');
    $idolSql->execute([$idolName, $idolId]);

    // 更新が成功した場合のメッセージを表示
    if ($idolSql && $groupSql) {
        echo 'アイドル情報が正常に更新されました。';
    } else {
        echo 'エラーが発生しました。';
    }
}
?>

<?php
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

<form action="update.php" method="post">
    <p><label for="idol_id">アイドルID:</label>
    <input type="text" name="idol_id" required>

    <label for="idol_name">アイドル名:</label>
    <input type="text" name="idol_name" required>

    <label for="group_name">グループ名:</label>
    <input type="text" name="group_name" required></p>

    <input type="submit" value="更新">
</form>
