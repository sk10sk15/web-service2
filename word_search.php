<?php
  require_once('./functions.php');
  session_start();




//送られた値を変数に格納

//未入力の項目があるか
    if (isset($_GET['word'])) {
    	$word = $_GET['word'];
      $pdo = connectDB();
  $sql = "SELECT * FROM articles_p where tag LIKE '%" . $word . "%'";
  $statement = $pdo->prepare($sql);
      $statement->execute();

  // $articles 連想配列に指定した記事が複数入っている状態↓
  $articles = $statement->fetchAll();

    }



?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>探す</title>
	<link rel="stylesheet" href="./my.css">
</head>
<body>
	<div id="all">
<a href="./mypage.php"><img src="exta.png"></a>
      <br>
      <p>あなたのネガティヴな感情をぶつけてください。</p>
      <br>
  <form action="" method="get">
          <p>探す
              <input type="text" name="word">
          </p>
<input type="submit" value="送信">
    </form>

<h3><a href="mypage.php">戻る</a></h3>

         <?php foreach($articles as $article): ?>
           <tr>
             <td><?php echo h($article['id']);?></td>
             <td><a href="./article.php?id=<?php echo $article['id']; ?>"><?php echo h($article['title']); ?></a></td>
           </tr>
         <?php endforeach; ?>
  </div>

</body>
</html>
