<head>
    <!-- 他の head 要素 -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<?php require 'idol_menu.php'; ?>

<form action="list.php" method="post">
    <p>アイドル検索
    <input type="text" name="keyword">
    <input type="submit" value="検索">
    <p>グループ検索
    <input type="text" name="keyword">
    <input type="submit" value="検索"></p>
</form>
<hr>

<?php
echo '<table>';
echo '<tr><th>番号</th><th>アイドル名</th><th>グループ</th><th>';
$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516809-final', 'LAA1516809', 'Pass1222');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['keyword'])) {
    $keyword = '%' . $_POST['keyword'] . '%';
    $sql = $pdo->prepare('SELECT idol.idol_id, idol.idol_name, groupp.group_name 
                          FROM idol 
                          LEFT JOIN groupp ON idol.group_id = groupp.group_id 
                          WHERE idol.idol_name LIKE ? OR groupp.group_name LIKE ?');
    $sql->execute([$keyword, $keyword]);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $pdo->prepare('SELECT idol.idol_id, idol.idol_name, groupp.group_name 
                          FROM idol 
                          LEFT JOIN groupp ON idol.group_id = groupp.group_id 
                          WHERE idol.idol_id = ?');
    $sql->execute([$id]);
} else {
    $sql = $pdo->query('SELECT idol.idol_id, idol.idol_name, groupp.group_name 
                        FROM idol 
                        LEFT JOIN groupp ON idol.group_id = groupp.group_id');
}

foreach ($sql as $row) {
    $idolId = $row['idol_id'];
    echo '<tr>';
    echo '<td>', $idolId, '</td>';
    echo '<td>';
    echo '<a href="idol_detail.php?id=', $idolId, '">', $row['idol_name'], '</a>';
    echo '</td>';
    echo '<td>', $row['group_name'], '</td>';
    echo '</tr>';
}
echo '</table>';
?>

