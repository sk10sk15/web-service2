<?php

// DB接続
function connectDB()
{
	require_once('./config.php');
	$dsn = "mysql:dbname=$db_name;host=$host";

	try {
		$pdo = new PDO($dsn, $db_user, $db_passwd);
	} catch (PDOException $e) {
		die('DB Connection Faild');
	}
	return $pdo;
}

// ユーザーから入力された文字を安全な文字列に変換する(HTMLエスケープ)
function h($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// ログインしていなかったらログインページへリダイレクトする
function redirectIfNotLogin()
{
    // ログインしてなかったら
    if (!isset($_SESSION['user'])) {
        // ログインページヘリダイレクトする
        header('Location: login.php');
        return;
    }
}

// ログインしているユーザーの情報を取得する
function loginUser()
{
    return $_SESSION['user'];
}
