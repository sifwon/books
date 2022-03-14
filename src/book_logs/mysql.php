<?php
require __DIR__ . '/escape.php';

//ライブラリの読み込み
require __DIR__ . '/../vendor/autoload.php';
//データベースの読み込み


function dbConnect(){
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
    return $link;
}


    function createBook_log($links){
        $book_logs = [];
        $sql = 'select * from review';
        $results = mysqli_query($links,$sql);
        while($book_log = mysqli_fetch_assoc($results)){
            $book_logs[] = $book_log;
            //echo $book_log['title'] . PHP_EOL;
        }
        //var_export($book_logs);
        mysqli_free_result($results);
        return $book_logs;
    }

    $links = dbConnect();
    $book_logs = createBook_log($links);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <title>読書ログ</title>
    <a href="create.php" class="btn btn-primary m-3">読書ログを登録</a>
</head>
<body>
    <div class="container">
        <h2>読書ログの登録</h2>
        <a href="lists.php" class="btn btn-primary mt-4 mb-4">読書ログを登録する</a>
        <main>
            <?php if(count($book_logs) > 0):?>
                <?php foreach($book_logs as $book_log):?>
                    <section class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h2 class="card-title h4 text-dark mb-3">
                                <?php echo escape($book_log['title'])?>
                            </h2>
                            <div class="small mb-3">
                                著者名: <?php echo escape($book_log['author']) ?> &nbsp; / &nbsp;
                                読書状況: <?php echo escape($book_log['status']) ?> &nbsp; / &nbsp;
                                評価(1~５の整数): <?php echo escape($book_log['score'])?>点
                            </div>
                            <p>
                            <?php echo nl2br(escape($book_log['thoughts']), false )?>
                            </p>
                        </div>
                    </section>
                <?php endforeach; ?>
            <?php else : ?>
                <p>会社情報がまだ登録されていません</p>
            <?php endif ; ?>

            <!--
            <section>
                <h2>Re:ゼロから始める異世界生活</h2>
                <div>アニメ放送された年 : 2016年 | 作者 : 長月達平</div>
            </section>
            <section>
                <h2>呪術廻戦</h2>
                <div>アニメ放送された年 : 2020年 | 作者 : 芥見下々</div>
            </section>
            -->
        </main>
    </div>
</body>
</html>
