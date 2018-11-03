<?PHP

// ライブラリの読み込み
require_once "/FeedWriter/Item.php";
require_once "/FeedWriter/Feed.php";
require_once "/FeedWriter/ATOM.php";

// デフォルトのタイムゾーンをセット
date_default_timezone_set("Asia/Tokyo");

$feed = new ATOM();

$feed->setTitle('SIB');
$feed->setAtomLink('https://deblogs.herokuapp.com/');
$feed->setDate(new DateTime());

foreach ($contents as $content) {
    // アイテム情報初期化
    $item = $feed->createNewItem();

    // アイテム情報セット
    // タイトル、更新日時セット
    $item->setTitle($content['title']);
    $item->setDate(strtotime($content['created_at']));
    
    // カスタム情報セット
    $item->setLink("https://deblogs.herokuapp.com/kiji.php?id=".$content['id']);
    
    // 作成者情報セット
    $item->setAuthor("Yamada");
    
    // アイテム追加
    $feed->addItem($item);
}

// フィード生成
$xml = $feed->generateFeed();

// ファイル出力（保存）
$filePath = '/var/www/xml/feed/atom.xml';
file_put_contents($filePath, $xml);


?>