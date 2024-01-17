<!-- register.php -->

<?php
require 'idol_menu.php';

// データベースに接続
$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516809-final', 'LAA1516809', 'Pass1222');

// グループ名を取得
$groupQuery = $pdo->query('SELECT * FROM groupp');
$groups = $groupQuery->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idolName = $_POST['idol_name'];
    $groupId = $_POST['group_id'];

    // もしテキストボックスにグループ名が入力されていれば、新たなグループを作成
    if (!empty($_POST['group_name'])) {
        $groupName = $_POST['group_name'];

        // グループを登録
        $groupSql = $pdo->prepare('INSERT INTO groupp (group_name) VALUES (?)');
        $groupSql->execute([$groupName]);

        // 新しく作成したグループのIDを取得
        $groupId = $pdo->lastInsertId();
    }

    // アイドルを登録
    $idolSql = $pdo->prepare('INSERT INTO idol (idol_name, group_id) VALUES (?, ?)');
    $idolSql->execute([$idolName, $groupId]);

    // 登録が成功した場合の処理
    if ($idolSql) {
        echo 'アイドル情報が正常に登録されました。';
    } else {
        echo 'エラーが発生しました。';
    }
}
?>

<form action="register.php" method="post">
    <p><label for="idol_name">アイドル名:</label>
    <input type="text" name="idol_name" required>

    <label for="group_name">グループ名:</label>
    <input type="text" name="group_name">
    </p>

    <p><label for="group_id">グループ名:</label>
    <select name="group_id" required>
        <?php foreach ($groups as $group): ?>
            <option value="<?php echo $group['group_id']; ?>"><?php echo $group['group_name']; ?></option>
        <?php endforeach; ?>
    </select></p>

    <input type="submit" value="登録">
</form>
