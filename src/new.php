<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書ログ</title>
    <a href="create.php">読書ログ</a>
</head>
<body>
    <form action="create.php" method="create.php">
        <div>
            <label for="title">書籍名</label>
            <input type="text" id="title">
        </div>
        <div>
            <label for="author">著者名</label>
            <input type="text" id="author">
        </div>
        <div>
            <label for="status">読書状況</label>
            <input type="text" id="status">
        </div>
        <div>
            <label for="score">評価(5点満点の整数)</label>
            <input type="text" id="score">
        </div>
        <div>
            <label for="thoughts">感想</label>
            <input type="text" id="thoughts">
        </div>
        <button type="submit">登録する</button>
    </form>
</body>
</html>