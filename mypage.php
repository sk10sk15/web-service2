<?php
  require_once('./functions.php');
  session_start();

  // ログインしていなかったら、ログイン画面にリダイレクトする
  redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];

$pdo = connectDB();
  $sql = "SELECT * FROM articles_p ORDER BY id";
  $statement = $pdo->prepare($sql);
    $statement->execute([
      ':target_user_id' => $id,
    ]);;

  // $articles 連想配列に指定した記事が複数入っている状態↓
  $articles = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title><?php echo $username; ?>mypage</title>
  <link rel="stylesheet" href="./my.css">
</head>
<body>

<div id="all">

  <a href="./mypage.php"><img src="exta.png"></a>

  <ul>
    <div class="box1">
      <a href="./new_article.php"><font size="4">ポエムを投稿してみる</font></a>
     <br>   <br>
     <p>こちらにポエムを投稿することによって、他のユーザーがあなたのポエムを閲覧することができます。</p>
     <p>あなたの言葉の力で、人を幸せにしてみましょう。</p>
    </div>
    <div class="box1">
    <a href="./word_search.php"><font size="4">ポエムを探す</font></a>
       <br>   <br>
    <p>自分または他のユーザーが投稿したポエムを閲覧することができます。</p>
    <p>嫌なことがあったら、素直に書き込んでみてください。</p>
    <p>何か見つかるかもしれませんね。</p>
      </div>
   </ul>

  <br>
  <br>

  <br>

<li><a href="./logout.php">ログアウト</a></li>
</div>
</body>
</html>
