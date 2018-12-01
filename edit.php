<?PHP

require 'Class/DB_CONNECT.php';
require 'Class/Article.php';

session_start();

$_SESSION[ 'id' ] = "";

$db = new DB_CONNECT();

$article = new Article($db);

$_get_id = $_GET[ 'id' ];

$content = $article->getContent($_get_id);

$_SESSION[ 'id' ] = $_get_id;
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title> <?php echo $content[0]['title']; ?> </title>

    <!-- CSS Bootstrap　-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <style>
        body {
                background-color:#E7E9DE;
        }
    </style>

    <!-- JS tinymce -->
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "#editor", // id="editor"の場所にTinyMCEを適用
            language: "ja",   // 言語 = 日本語
            height: 500,      // 高さ = 300px
            width: 1000,
            menubar: false,   // メニューバーを隠す
            plugins: "textcolor image link", // 文字色、画像ボタン、リンク用のプラグインを適用
            toolbar: [ // ツールバー(2段)
                // 戻る 進む | フォーマット | 太字 斜体 | 左寄せ 中央寄せ 右寄せ 均等割付 | 箇条書き 段落番号 インデントを減らす インデント
                "undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                // 文字サイズ 文字色 画像 リンク
                "fontsizeselect forecolor image link"
            ],
            statusbar: false, // ステータスバーを隠す
        });
    </script>

</head>
<header>

</header>

<body>
    <div class="container-fluid">
        <form action="/manage.php" method ="post">
            <div class="mt-3">
                <h3>タイトル</h3>
                <input type="text" value="<?PHP echo $content[0]['title']; ?>" name="titleUpdate">
                <br>
            </div>
            <div class="mt-3">
                <h3>内容</h3>
                <textarea id="editor" rows ="8" cols="40" value="" name="contentUpdate"><?PHP echo $content[0]['content']; ?></textarea>
                <br>
            </div>
            <div>
                <input class="btn btn-info" type="submit" name="update" value="更新する">
                <input class="btn btn-info" type="submit" name="delete" value="削除する">
            </div>        
        </form>
    </div>
</body>

<footer>
    <div class="container mt-5 mx-3">
        <a class="btn btn-info" href="<?PHP echo $_SERVER['HTTP_REFERER']; ?> ">戻る</a>
    </div>
</footer>

</html>