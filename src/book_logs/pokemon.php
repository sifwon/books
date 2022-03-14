<?php
//composerのbasic usegeに書いてある
require __DIR__ . '/../vendor/autoload.php';
function validate($review){
    $errors = [];
    if(!mb_strlen($review['name'])){
        $errors['name'] = 'ポケモンの名前を入力してください';
    }elseif(mb_strlen($review['name']) > 255){
        $errors['name'] = 'ポケモンの名前を255文字以内で入力してください';
    }

    if(!mb_strlen($review['personality'])){
        $errors['personality'] = '性格を入力してください';
    }elseif(mb_strlen($review['personality']) > 255){
        $errors['personality'] = '性格を255文字以内で入力してください';
    }

    if(!mb_strlen($review['characteristic'])){
        $errors['characteristic'] = '特性を入力してください';
    }elseif(mb_strlen($review['characteristic']) > 255){
        $errors['characteristic'] = '特性は255文字以内で入力してください';
    }

    if(!mb_strlen($review['belongings'])){
        $errors['belongings'] = '持ち物を入力してください';
    }elseif(mb_strlen($review['belongings']) > 255){
        $errors['belongings'] = '持ち物は255文字以内で入力してください';
    }

    if(!mb_strlen($review['effort_value'])){
        $errors['effort_value'] = '努力値を入力してください';
    }elseif(mb_strlen($review['effort_value']) > 255){
        $errors['effort_value'] = '努力値は255文字以内で入力してください';
    }

    if(!mb_strlen($review['move'])){
        $errors['move'] = '技構成を入力してください';
    }elseif(mb_strlen($review['move']) > 255){
        $errors['move'] = '技構成は255文字以内で入力してください';
    }
    return $errors;
}
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$db_Host = $_ENV['DB_HOST'];
$db_Username = $_ENV['DB_USERNAME'];
$db_Password = $_ENV['DB_PASSWORD'];
$db_Database = $_ENV['DB_DATABASE'];
$link = mysqli_connect("$db_Host","$db_Username","$db_Password","$db_Database");
if(!$link){
    echo 'データベースの接続に失敗しました' . PHP_EOL;
}else{
    echo 'データベースの接続に成功しました' . PHP_EOL;
}
while(true){
    echo 'ポケモン育成用データベース' . PHP_EOL;
    echo '1.ポケモンの情報を登録する: ' . PHP_EOL;
    echo '2.ポケモンの情報を表示する: ' . PHP_EOL;
    echo '3.プログラムを終了する: ' . PHP_EOL;
    echo '数字を入力してください(1,2,3) ';
    $int = trim(fgets(STDIN));
    if($int === '1'){
        $review = [];
        echo 'ポケモンを登録します' . PHP_EOL;
        echo 'ポケモンの名前: ';
        $review['name'] = trim(fgets(STDIN));
        echo '性格: ';
        $review['personality'] = trim(fgets(STDIN));
        echo '特性: ';
        $review['characteristic'] = trim(fgets(STDIN));
        echo '持ち物: ';
        $review['belongings'] = trim(fgets(STDIN));
        echo '努力値: ';
        $review['effort_value'] = trim(fgets(STDIN));
        echo '技構成: ';
        $review['move'] = trim(fgets(STDIN));

        $validated = validate($review);
        if(count($validated) > 0){
            foreach($validated as $error){
                echo $error . PHP_EOL;
            }
            return;
        }
        $sql = <<<ADD
        insert into pokemon(
            name,
            personality,
            characteristic,
            belongings,
            effort_value,
            move
        )values(
            "{$review['name']}",
            "{$review['personality']}",
            "{$review['characteristic']}",
            "{$review['belongings']}",
            "{$review['effort_value']}",
            "{$review['move']}"
        )
        ADD;
        mysqli_query($link,$sql);
    }elseif($int === '2'){
        echo 'ポケモンのデータを表示します' . PHP_EOL;
        $sql = 'select * from pokemon';
        $pokemon = mysqli_query($link,$sql);
        while($reviews = mysqli_fetch_assoc($pokemon)){
            echo 'ポケモンの名前: ' . $reviews['name'] .PHP_EOL;
            echo '性格: ' . $reviews['personality'] .PHP_EOL;
            echo '特性: ' . $reviews['characteristic'] .PHP_EOL;
            echo '持ち物: ' . $reviews['belongings'] .PHP_EOL;
            echo '努力値: ' . $reviews['effort_value'] .PHP_EOL;
            echo '技構成: ' . $reviews['move'] .PHP_EOL;
            echo '---------------' . PHP_EOL;
        }
    }elseif($int === '3'){
        mysqli_close($link);
        echo 'データベースとの接続を終了します' . PHP_EOL;
        break;
    }
}