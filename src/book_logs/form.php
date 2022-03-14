<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書ログ</title>
    <a href="create.php">読書ログ</a>
</head>
<body>
    <h2>読書ログの登録</h2>
    <form action="create.php" method="POST" autocomplete="off">
        <div>
            <label for="title">書籍名</label>
            <input type="text" id="title" name="title">
        </div>
        <div>
            <label for="author">著者名</label>
            <input type="text" id="author" name="author">
        </div>
        <div>
            <label for="status">読書状況</label>
            <input type="text" id="status" name="status">
        </div>
        <div>
            <label for="score">評価(5点満点の整数)</label>
            <input type="text" id="score" name="score">
        </div>
        <div>
            <label for="thoughts">感想</label>
            <input type="text" id="thoughts" name="thoughts">
        </div>
        <button type="submit">登録する</button>
    </form>
</body>
</html>