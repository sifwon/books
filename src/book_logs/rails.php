<?php
$link = mysqli_connect("db","book_log","pass","book_log");
if(!$link){
    echo 'データベースの接続に失敗しました' . PHP_EOL;
}elseif($link){
    echo 'データベースの接続に成功しました' . PHP_EOL;
}
while(true){
    echo '数値を入力してください(1,2,3)' . PHP_EOL;
    echo '1.データを登録します' . PHP_EOL;
    echo '2.データを表示します' . PHP_EOL;
    echo '3.プログラムを終了します ';

    $int = trim(fgets(STDIN));
    if($int === '1'){
        $log = [];
        echo 'データを登録します' . PHP_EOL;
        echo 'タイトル: ';
        $log['title'] = trim(fgets(STDIN));
        echo '著者名: ';
        $log['author'] = trim(fgets(STDIN));
        echo '読書状況: ';
        $log['status'] = trim(fgets(STDIN));
        echo '評価: ';
        $log['score'] = trim(fgets(STDIN));
        echo '感想: ';
        $log['thoughts'] = trim(fgets(STDIN));

        $sql = <<<ADD
            insert into rails(
                title,
                author,
                status,
                score,
                thoughts
            )values(
                "{$log['title']}",
                "{$log['author']}",
                "{$log['status']}",
                "{$log['score']}",
                "{$log['thoughts']}"
            )
        ADD;
        $links = mysqli_query($link,$sql);

    }elseif($int === '2'){
        echo 'データを表示します' . PHP_EOL;
        $sql = 'select * from review';
        $rails = mysqli_query($link,$sql);
        while($display = mysqli_fetch_assoc($rails)){
            echo 'タイトル: ' . $display['title'] . PHP_EOL;
            echo '著者名: ' . $display['author'] . PHP_EOL;
            echo '読書状況: ' . $display['status'] . PHP_EOL;
            echo '評価: ' . $display['score'] . PHP_EOL;
            echo '感想: ' . $display['thoughts'] . PHP_EOL;
            echo '------------------------' . PHP_EOL;
        }
    }elseif($int === '3'){
        echo 'プログラムを終了します' . PHP_EOL;
        break;
    }
}