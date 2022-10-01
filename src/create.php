<?php

require_once __DIR__ . '/lib/mysqli.php';

function createReview($link, $review)
{
    $sql = <<<EOT
INSERT INTO reviews (
        title,
        author,
        status,
        score,
        summary
) VALUES (
    "{$review['title']}",
    "{$review['author']}",
    "{$review['status']}",
    "{$review['score']}",
    "{$review['summary']}"
)
EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to create review');
        echo 'Debugging error: ' . mysqli_error($link) . PHP_EOL;
    }
}

function validate($review)
{
    $errors = [];

    // 書籍名が正しく入力されているかチェック
    if (!strlen($review['title'])) {
        $errors['title'] = '書籍名を入力してください';
    } elseif (strlen($review['title']) > 255) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    // 著者名が正しく入力されているかチェック
    if (!strlen($review['author'])) {
        $errors['author'] = '著者名を入力してください';
    } elseif (strlen($review['author']) > 100) {
        $errors['author'] = '著者名は100文字以内で入力してください';
    }

    // 読書状況が正しく入力されているかチェック
    if (!in_array($review['status'], ["未読", "読書中", "読了"], true)) {
        $errors['status'] = '読書状況は「未読」「読んでる」「読了」のいずれかを入力してください';
    }

    // 評価が正しく入力されているかチェック
    if ($review['score'] < 1 || $review['score'] > 5) {
        $errors['score'] = '評価は1〜5の整数を入力してください';
    }

    // 感想が正しく入力されているかチェック
    if (!strlen($review['summary'])) {
        $errors['summary'] = '感想を入力してください';
    } elseif (strlen($review['summary']) > 1000) {
        $errors['summary'] = '感想は1000文字以内で入力してください';
    }

    return $errors;
}

//HTTPメソッドがポストだったら
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = array_key_exists("status", $_POST);
    if (!$result) {
        $_POST['status'] = '';
    }

    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'score' => $_POST['score'],
        'summary' => $_POST['summary'],
    ];

    // $reviews =
    //バリデーションする
    $errors = validate($review);
    if (!count($errors)) {
        //データベースに接続する
        $link = dbConnect();
        // データベースにデータを登録する
        createReview($link, $review);
        // データベースとの接続を切断する
        mysqli_close($link);
        header("Location: index.php");
    }
}

$title = '読書ログ登録';
// ここを修正
$content = __DIR__ . "/views/new.php";
include __DIR__ . '/views/layout.php';
