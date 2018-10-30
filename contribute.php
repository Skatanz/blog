<?PHP

require 'Class/DB_CONNECT.php';
require 'Class/Article.php';

session_start ();

$db = new DB_CONNECT();
$article = new Article($db);

if ( isset($_POST['contribute']) ) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $message = $article->contribute($title, $content);

}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブログタイトル</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- JS tinymce -->
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "#editor", // id="editor"の場所にTinyMCEを適用
            language: "ja",   // 言語 = 日本語
            height: 300,      // 高さ = 300px
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
    <div>
        <h1>投稿画面</h1>
    </div>
</header>

<body>
    <div>
        <div>
            <p><?PHP echo $message ?></p>
        </div>

        <div>
            <form action="" method ="post">
                <p>タイトル</p>
                    <input type="text" value="" name="title">
                    <br>
                <p>内容</p>
                    <textarea id="editor" rows ="8" cols="40" value="" name="content"></textarea>
                    <br>
                <input type="submit" name="contribute" value="投稿する">
            </form>
        </div>
    </div>
</body>

<footer>
    <div>
        <a href="/manage.php">管理画面へ戻る</a>
        <a href="/index.php">ログアウト</a>
    </div>
</footer>

</html>