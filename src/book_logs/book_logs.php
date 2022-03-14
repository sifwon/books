<?php
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
function validate($reviews){
    if(!mb_strlen($reviews['title'])){
        echo '書籍名を入力してください' . PHP_EOL;
        exit;
    }
    if(!mb_strlen($reviews['author'])){
        echo '著者名を入力してください' . PHP_EOL;
        exit;
    }
    if(!mb_strlen($reviews['status'])){
        echo '読書状況を入力してください' . PHP_EOL;
        exit;
    }
    if($reviews['score'] < 1 || $reviews['score'] > 5){
        echo '評価(5点満点の整数)を入力してください' . PHP_EOL;
        exit;
    }
    if(!mb_strlen($reviews['thoughts'])){
        echo '感想を入力してください' . PHP_EOL;
        exit;
    }
    return;
}
while(true){
    echo '読書ログサービス' . PHP_EOL;
    echo '1.読書ログを登録する' . PHP_EOL;
    echo '2.読書ログを表示する' . PHP_EOL;
    echo '3.プログラムを終了する' . PHP_EOL;
    echo '数字を入力してください(1.2.3)';
    $int = trim(fgets(STDIN));
    if($int === '1'){
        $reviews = [];
        echo '読書ログを登録します' . PHP_EOL;
        echo '書籍名: ';
        $reviews['title'] = trim(fgets(STDIN));
        echo '著者名: ';
        $reviews['author'] = trim(fgets(STDIN));
        echo '読書状況(未読,読書中,読書終了): ';
        $reviews['status'] = trim(fgets(STDIN));
        echo '評価(5点満点の整数): ';
        $reviews['score'] = (int)trim(fgets(STDIN));
        echo '感想: ';
        $reviews['thoughts'] = trim(fgets(STDIN));
        $validated = validate($reviews);
        $sql = <<<ADD
            insert into review(
                title,
                author,
                status,
                score,
                thoughts
            )values(
                "{$reviews['title']}",
                "{$reviews['author']}",
                "{$reviews['status']}",
                "{$reviews['score']}",
                "{$reviews['thoughts']}"
            )
        ADD;
        mysqli_query($link,$sql);
    }elseif($int === '2'){
        echo '読書ログを表示します' . PHP_EOL;
        $mysql = 'select * from review';
        $result = mysqli_query($link,$mysql);
        while($book_log = mysqli_fetch_assoc($result)){
            echo '書籍名: ' . $book_log['title'] . PHP_EOL;
            echo '著者名: ' . $book_log['author'] . PHP_EOL;
            echo '読書: ' . $book_log['status'] . PHP_EOL;
            echo '評価: ' . $book_log['score'] . PHP_EOL;
            echo '感想: ' . $book_log['thoughts'] . PHP_EOL;
            echo '-------------------' . PHP_EOL;
        }
    }elseif($int === '3'){
        mysqli_close($link);
        echo 'データベースの接続を解除しました' . PHP_EOL;
        break;
    }
}