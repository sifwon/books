<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <title>読書ログ</title>
    <a href="mysql.php" class="btn btn-primary m-3">読書ログ一覧</a>
</head>
<body>
    <div class="container">
        <h2 class="text-dark mt-4 mb-4">読書ログの登録</h2>
        <form action="create.php" method="POST" autocomplete="off">
            <?php if($errors):?>
                <ul class="text-danger">
                <?php foreach($errors as $error):?>
                    <li><?php echo $error;?></li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div>
                <label for="title">書籍名</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div>
                <label for="author">著者名</label>
                <input type="text" id="author" name="author" class="form-control">
            </div>
            <div>
                <label for="status">読書状況(未読,読書中,読書終了)</label>
                <input type="text" id="status" name="status" class="form-control">
            </div>
            <div>
                <label for="score">評価(5点満点の整数)</label>
                <input type="text" id="score" name="score" class="form-control">
            </div>
            <div>
                <label for="thoughts">感想</label>
                <input type="text" id="thoughts" name="thoughts" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-4">登録する</button>
        </form>
    </div>
</body>
</html>