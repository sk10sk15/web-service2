<?php
  require_once('./functions.php');
  session_start();

  redirectIfNotLogin();
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];
  $nichiji  = date('Y-m-d H:i:s');
  // POSTリクエストの場合
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST['title'];
    $body = $_POST['body'];
    $tag = $_POST['tag'];

    $pdo = connectDB();
    $sql = "INSERT INTO articles_p (user_id,title,body,created_at,modified_at,tag) VALUES(:user_id, :title,:body,:created_at,:modified_at,:tag)";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
      ':user_id' => $id,
      ':title' => $title,
      ':body' => $body,
      ':created_at' => $nichiji,
      ':modified_at' => $nichiji,
      ':tag' => $tag,
    ]);
    header("Location: mypage.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>ポエム登録</title>
	<link rel="stylesheet" href="./my.css">
</head>
<body>
	<div id="all">
      <a href="./mypage.php"><img src="exta.png"></a>
      <br>
    <h2>ポエム登録</h2>
        <form action="" method="post">
          <p>タイトル:<input type="text" name="title" size="50" maxlength="50" value=""></p>
          <p>内容：<textarea name="body" rows="5" cols="40"></textarea></p>
          <p>タグ：<input type="text" name="tag" size="50" maxlength="50" value=""></p>
          <input type="submit" value="送信">
        </form>
	</div>
    <h3><a href="mypage.php">戻る</a></h3>
</body>
</html>
