<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>アイドル管理</h1>
    <input type="button" name="itirann" value="一覧" onclick="redirectTo('list.php')">
    <input type="button" name="touroku" value="登録" onclick="redirectTo('register.php')">
    <input type="button" name="kousinn" value="更新" onclick="redirectTo('update.php')">
    <input type="button" name="sakujyo" value="削除" onclick="redirectTo('delete.php')">

    <script>
        // 遷移関数
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
