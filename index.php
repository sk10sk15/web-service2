<?php
  require_once('./functions.php');
  session_start();



  // DB接続
  $pdo = connectDB(); // ※ この関数はfunctions.phpに定義してある
  // 全記事(5記事文)を降順に取得するSQL文
  $sql = 'SELECT * FROM articles_p ORDER BY id DESC LIMIT 10';
  // SQLを実行
  $statement = $pdo->query($sql);
  // プレースメントフォルダが無いので，実行の表記が簡単
  $statement->execute();
  // $articles 連想配列に指定した記事が複数入っている状態↓
  $articles = $statement->fetchAll();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title>Ecstacy</title>
  <link rel="stylesheet" href="./my.css">
</head>
<body>
<div id="all">
 <img src="exta.png">
  <b>
  <p>このサイトでは、ポジティブなポエムがたくさん収録されています。</p>
  <p>今のあなたのお気持ちを検索してみてください。</p>
  <p>今よりも前向きになれるような言葉をぜひ探してみてください。</p></b>
    <br><br><br>
  <ul>
    <li><a href="./user_register.php"><font size="5">新規ユーザ登録</font></a></li>
    <br><br><br><br>
    <li><a href="./mypage.php"><font size="5">ログイン</font></a></li>

   </ul>

  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  <br><div class="fb-share-button" data-href="http://cm6ed7g-ahw-app000.c4sa.net/exta/index.php" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fcm6ed7g-ahw-app000.c4sa.net%2Fexta%2Findex.php&amp;src=sdkpreparse">シェア</a></div>
  <br><br>
  <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-hashtags="Ecstacy">ツイート</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</div>

</body>
</html>
