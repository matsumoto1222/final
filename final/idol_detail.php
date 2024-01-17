<head>
    <!-- 他の head 要素 -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<?php
require 'idol_menu.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idolId = $_GET['id'];

    // データベースに接続
    $pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516809-final', 'LAA1516809', 'Pass1222');

    // アイドル情報を取得（INNER JOINを使用）
    $sql = $pdo->prepare('SELECT idol.*, groupp.group_name FROM idol
                         INNER JOIN groupp ON idol.group_id = groupp.group_id
                         WHERE idol.idol_id = ?');
    $sql->execute([$idolId]);

    // アイドル情報と画像を表示
    foreach ($sql as $row) {
        echo '<p>アイドルID: ', $row['idol_id'], '</p>';
        echo '<p>アイドル名: ', $row['idol_name'], '</p>';
        echo '<p>所属グループ: ', $row['group_name'], '</p>';

        // 画像を表示
        echo '<img src="./jpg/', $row['image_filename'], '" alt="アイドル画像">';

    }
} else {
    echo 'アイドルIDが指定されていません。';
}
?>





