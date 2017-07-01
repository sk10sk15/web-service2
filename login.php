<?php
  require_once('./functions.php');
  session_start();
// ここまでは GET POST に関わらず動作する

/*
 * 普通にアクセスした場合: GETリクエスト
 * 登録フォームからSubmitした場合: POSTリクエスト
 */
// POSTリクエストの場合
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // 送られた値を取得
  $username = $_POST['username'];
  $passwd = $_POST['passwd']; //パスワード比較の際に暗号化

  // 入力値チェック： 未入力の項目があるか
  if (empty($username) || empty($passwd)){
    $_SESSION["error"] = "入力されてない項目があります";
    header("Location: login.php");
    return;
  }

  // DB に接続
  $pdo = connectDB();

  // ポストされた username を使って DB のエントリを呼び出す
  $sql = "SELECT * FROM users_p WHERE username = :username";
  $statement = $pdo->prepare($sql);
  $statement->execute([
    ':username' => $username,
  ]);
  // $user 連想配列にユーザの情報が入ってくる
  $user = $statement->fetch();

  // ユーザーが取得できなかったら、それは入力されたusernameが間違っている
  if (!$user) {
    $_SESSION["error"] = "ユーザ名に誤りがあります。";
    header("Location: login.php");
    return;
  }
  // パスワードとパスワード確認が一致しているか
  // データベースに入っている暗号化されたパスワードと同じ Solt を利用して暗号化
  // 暗号化されたパスワード同士を比較して，完全一致しない場合にはエラー
  if (crypt($passwd, $user['passwd']) !== $user['passwd']) {
    $_SESSION["error"] = "パスワードに誤りがあります。";
    header("Location: login.php");
    return;
  }

  // ログイン処理
  // ユーザー情報をセッションに格納する
  $_SESSION["user"]["id"] = $user['id'];
  $_SESSION["user"]["username"] = $user['username'];

  $_SESSION["success"] = "ログインしました。";
  header("Location: mypage.php");

// 次の行の括弧は，POSTリクエストの場合の処理の終わり
}
// ここから後は，POSTでは無かった場合も実行される
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>ログイン</title>
	<link rel="stylesheet" href="./my.css">
</head>
<body>
	<div id="all">
  <!-- セッション変数(successやerror)に値が入っている場合の処理
  ログインに成功した．または失敗した理由を表示 -->
    <!-- Success Message -->
    <?php if(!empty($_SESSION['success'])): ?>
        <div class="alert alert-success" role="success">
          <!-- メッセージを表示 -->
            <pre><?php echo $_SESSION['success']; ?></pre>
          <!-- セッション変数 succcess の値を空に -->
            <?php $_SESSION['success'] = null; ?>
        </div>
    <?php endif; ?>
    <!-- Error Message -->
    <?php if(!empty($_SESSION['error'])): ?>
        <div>
          <!-- メッセージを表示 -->
            <pre><?php echo $_SESSION['error']; ?></pre>
          <!-- セッション変数 succcess の値を空に -->
            <?php $_SESSION['error'] = null; ?>
        </div>
    <?php endif; ?>

  <!-- 他のページからGETでアクセスした場合は，以下のみが表示される． -->
      <a href="./index.php"><img src="exta.png"></a>
    <h2>ログイン</h2>

        <form action="" method="post">
            <div>
                <label for="username-input">ユーザー名</label>
                <input type="text" name="username" id="username-input" placeholder="">
            </div>
            <div>
                <label for="password-input">パスワード</label>
                <input type="password" name="passwd" id="password-input" placeholder="">
            </div>
            <input type="submit" value="ログイン">
        </form>
</body>
</html>
