<?php
session_start();
if (isset($_SESSION['username'])) {
    $username1 = $_SESSION['username'];

    // 處理購買結果
$servername = "L20101-054";
$username = "root";
$password = "12345";
$database = "market";

// 創建與資料庫的連接
$conn = new mysqli($servername, $username, $password, $database);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接資料庫失敗: " . $conn->connect_error);
}

// 確認 `market` 資料表是否存在，如果不存在則創建它
$checkTableSql = "SHOW TABLES LIKE 'market'";
$result = $conn->query($checkTableSql);
if ($result->num_rows === 0) {
    // `market` 資料表不存在，創建它
    $createTableSql = "CREATE TABLE market (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        number VARCHAR(255) NOT NULL,
        goods VARCHAR(255) NOT NULL
    )";
    $conn->query($createTableSql);
}

// 繼續執行插入操作

$goods = $_SESSION['goods'];

$numberSql = "SELECT MAX(number) AS max_number FROM market";
$result = $conn->query($numberSql);
$username = $_SESSION['username'];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentNumber = $row['max_number'];
    $number = $currentNumber + 1;
} else {
    $number = 1;
}
$insertSql = "INSERT INTO market (username, number, goods) VALUES ('$username', '$number', '$goods')";
$conn->query($insertSql);

// 購買成功，可以進行其他操作或返回相應頁面
echo "購買成功！";

$conn->close();


    // 購買成功，轉跳回購物頁面
    header("Location: shop.php");
    exit();
} else {
    // 未登入，轉跳回購物頁面
    header("Location: shop.php?error=not_logged_in");
    exit();
}
?>
