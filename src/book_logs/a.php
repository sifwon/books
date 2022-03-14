<?php
    function dbConnect(){
        $link = mysqli_connect("db","book_log","pass","book_log");
        if(!$link){
            echo 'データベースの接続に失敗しました' . PHP_EOL;
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
    <title>読書ログ</title>
    <a href="create.php">読書ログ</a>
</head>
<body>
    <h2>読書ログの登録</h2>
    <a href="lists.php">読書ログを登録する</a>
    <main>
        <?php foreach($book_logs as $book_log):?>
            <section>
                <h2>
                    <?php echo $book_log['title']?>
                </h2>
                <div>
                    作者名: <?php echo $book_log['author']; ?> &nbsp; | &nbsp; 感想: <?php echo $book_log['thoughts'] ?>
                </div>
            </section>
        <?php endforeach; ?>

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
</body>
</html>
