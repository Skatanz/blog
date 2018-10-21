<?PHP
require 'function.php';
session_start ();

$_SESSION[ 'id' ] = "";

$db = set_dbData ();

/** @var TYPE_NAME $article */
$article = new Article( $db );

$_get_id = $_GET[ 'id' ];

/** @var TYPE_NAME $content */
$content = $article->get_content ( $_get_id );

$_SESSION[ 'id' ] = $_get_id;
?>


<!DOCTYPE html>
<html lang="ja">

<!-- CSS Bootstrap　-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- JS tinymce -->
<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: "#editor", // id="foo"の場所にTinyMCEを適用
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

<head>
    <meta charset="UTF-8">
    <title> <?php echo $content[0]['title']; ?> </title>
</head>

<header>

</header>

<body>
    <div>
        <form action="/manage.php" method ="post">
            <p>タイトル</p>
                <input type="text" value="<?PHP echo $content[0]['title']; ?>" name="titleUpdate">
                <br>
            <p>内容</p>
                <textarea id="editor" rows ="8" cols="40" value="" name="contentUpdate"><?PHP echo $content[0]['content']; ?></textarea>
                <br>
            <input type="submit" name="update" value="更新する">
            <input type="submit" name="delete" value="削除する">
        </form>
    </div>
</body>

<footer>
    <a href="/index.php">トップページ</a>
</footer>

</html>