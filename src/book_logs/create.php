<?php
require __DIR__ . '/../vendor/autoload.php';

function createDb($link,$book_log){
    $sql = <<<ADD
        insert into review(
            title,
            author,
            status,
            score,
            thoughts
        )value(
            "{$book_log['title']}",
            "{$book_log['author']}",
            "{$book_log['status']}",
            "{$book_log['score']}",
            "{$book_log['thoughts']}"
        );
    ADD;
    mysqli_query($link,$sql);
}
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbHost = $_ENV['DB_HOST'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbDatabase = $_ENV['DB_DATABASE'];
$link = mysqli_connect("$dbHost","$dbUsername","$dbPassword","$dbDatabase");
if(!$link){
    echo 'データベースの接続に失敗しました' . PHP_EOL;
}else{
    echo 'データベースの接続に成功しました' . PHP_EOL;
}
$errors = [];
function validate($book_log){
    $errors = [];
    if(!mb_strlen($book_log['title'])){
        $errors['title'] = '書籍名を入力してください' . PHP_EOL;
    }elseif(mb_strlen($book_log['title']) > 255){
        $errors['title'] = '書籍名を255文字以内で入力してください' . PHP_EOL;
    }

    if(!mb_strlen($book_log['author'])){
        $errors['author'] = '著者名を入力してください' . PHP_EOL;
    }elseif(mb_strlen($book_log['author']) > 255){
        $errors['author'] = '著者名を255文字以内で入力してください' . PHP_EOL;
    }

    if(!mb_strlen($book_log['status'])){
        $errors['status'] = '読書状況を入力してください' . PHP_EOL;
    }elseif(mb_strlen($book_log['status']) > 255){
        $errors['status'] = '読書状況を255文字以内で入力してください' . PHP_EOL;
    }

    if(!mb_strlen($book_log['score'])){
        $errors['score'] = '評価を入力してください' . PHP_EOL;
    }elseif(mb_strlen($book_log['score']) > 255){
        $errors['score'] = '評価を255文字以内で入力してください' . PHP_EOL;
    }

    if(!mb_strlen($book_log['thoughts'])){
        $errors['thoughts'] = '感想を入力してください' . PHP_EOL;
    }elseif(mb_strlen($book_log['thoughts']) > 255){
        $errors['thoughts'] = '感想を255文字以内で入力してください' . PHP_EOL;
    }

    return $errors;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $book_log = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'score' => $_POST['score'],
        'thoughts' => $_POST['thoughts']
    ];
    $errors = validate($book_log);
    if(!count($errors)){
        var_export($book_log);
        //バリデーションをする
        createDb($link,$book_log);
        header("Location: mysql.php");
    }
}

$book_log = [
    'title' => '',
    'author' => '',
    'status' => '',
    'score' => '',
    'thoughts' => ''
];

//受け取った値がpostメソッドなら変数に代入する
//バリデーション処理をする
//データベースに接続する
//データベースに登録する
//データベースの接続を解除する

//requireメソッドでの呼び出し
require_once 'list.php';

?>
