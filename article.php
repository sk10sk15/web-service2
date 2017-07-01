<?php
  require_once('./functions.php');
  session_start();

  // URLに含まれている記事のIDを取得
  $id = $_GET['id'];
  // DB接続
  $pdo = connectDB();
  // 以下4行、記事をDBから取得し、変数$articleに格納
  $sql = 'SELECT * FROM articles_p WHERE id = :id';
  $statement = $pdo->prepare($sql);
  $statement->execute([':id' => $_GET['id']]);
  $article = $statement->fetch();

  $user_id = $article['user_id'];
  $sql = 'SELECT * FROM users_p WHERE id = :user_id';
  //これが一番難しい
  $statement = $pdo->prepare($sql);
  $statement->execute([':user_id' => $user_id]);
  $result = $statement->fetch();
?>
<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title><?php echo h($article['title']); ?></title>
    <link rel="stylesheet" href="./my.css">
</head>
<body>
<div>
  <div id="all">


    <?php
      $message = "戻る";
      // リファラ値がなければ<a>タグを挿入しない
    if (empty($_SERVER['HTTP_REFERER'])) {
      echo $message;
    }
    // リファラ値があれば<a>タグ内へ
    else {
      echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">' . $message . "</a>";
    }
    ?>

    <h1>
      <u>
        <?php echo h($article['title']); ?>
      </u>
    </h1>
    <br>
    <br>
    <h3><?php echo h($article['body']); ?></h3>
    <br>
    <br>
    <br>
    <p>
        by <?php echo h($result['username']); ?>
    </p>

    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-size="large" data-hashtags="Ecstacy">ツイート</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</div>
</body>
</html>
