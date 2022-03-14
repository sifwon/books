<?php
function validate($book_log){
    $errors = [];
    if(!strlen($book_log['title'])){
        $errors['title'] = '書籍名を入力してください';
    }elseif($book_log['title'] > 255){
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    if(!strlen($book_log['author'])){
        $errors['author'] = '著者名を入力してください';
    }elseif($book_log['author'] > 255){
        $errors['author'] = '著者名は255文字以内で入力してください';
    }

    if(!strlen($book_log['status'])){
        $errors['status'] = '読書状況を入力してください';
    }elseif($book_log['status'] > 255){
        $errors['status'] = '読書状況は255文字以内で入力してください';
    }

    if(!strlen($book_log['score'])){
        $errors['score'] = '評価を入力してください';
    }elseif($book_log['score'] > 255){
        $errors['score'] = '評価は255文字以内で入力してください';
    }

    if(!strlen($book_log['thoughts'])){
        $errors['thoughts'] = '感想を入力してください';
    }elseif($book_log['thoughts'] > 255){
        $errors['thoughts'] = '感想は255文字以内で入力してください';
    }
    return $errors;
}
function createRegister($link,$book_log){
    $sql = <<<ADD
        insert into review(
            title,
            author,
            status,
            score,
            thoughts
        )values(
            "{$book_log['title']}",
            "{$book_log['author']}",
            "{$book_log['status']}",
            "{$book_log['score']}",
            "{$book_log['thoughts']}"
        )
    ADD;
    mysqli_query($link,$sql);
}
//HTTPメソッドがPOSTなら登録された内容を変数に格納する
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $book_log = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'score' => $_POST['score'],
        'thoughts' => $_POST['thoughts']
    ];
}
//バリデーション処理は後でする
$errors = validate($book_log);
//データベースへの接続
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbHost = $_ENV['DB_HOST'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassWord = $_ENV['DB_PASSWORD'];
$dbDatabase = $_ENV['DB_DATABASE'];
$link = mysqli_connect($dbHost,$dbUsername,$dbPassWord,$dbDatabase);
if(!$link){
    echo 'データベースの接続に失敗しました' . PHP_EOL;
    echo mysqli_connect_error($link);
    exit;
}else{
    echo 'データベースの接続に成功しました' . PHP_EOL;
}
//バリデーションのエラーがなければ
//データベースにデータを登録する

if(!count($errors)){
    createRegister($link,$book_log);
    mysqli_close($link);
    header("Location: index.php");
}
/*
createRegister($link,$book_log);
mysqli_close($link);
header("Location: index.php");
*/

/*
HTTPメソッドがPOSTなら
登録された内容を変数に格納する
バリデーションをする
データベースに接続する
データベースにデータを登録する
データベースとの接続を切断する
リダイレクト処理
*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>読書ログ</title>
    <a href="index.php">読書ログ</a>
</head>
<body>
    <h2>読書ログの登録</h2>
    <form action="creates.php" method="POST" autocomplete="off">
    <?php if (count($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
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
