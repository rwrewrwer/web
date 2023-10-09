<?php
session_start();
if (isset($_SESSION['username'])) {
    $username1 = $_SESSION['username'];

    // 處理點數扣款操作
$servername = "L20101-054";
$username = "root";
$password = "12345";
$database = "mydatabase";

    // 創建與 mydatabase 的連接
    $conn = new mysqli($servername, $username, $password, $database);

    // 檢查連接是否成功
    if ($conn->connect_error) {
        die("連接資料庫失敗: " . $conn->connect_error);
    }

    // 獲取當前用戶的點數
    $sql = "SELECT points FROM users WHERE username = '$username1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $points = $row['points'];

        if ($points >= 500) {
            // 扣除點數
            $newPoints = $points - 500;

            // 更新用戶點數
            $updateSql = "UPDATE users SET points = $newPoints WHERE username = '$username1'";
            $conn->query($updateSql);

            // 關閉與 mydatabase 的連接
            $conn->close();

          
           $_SESSION['goods'] = $_POST['goods'];

            // 轉跳到處理購買結果的頁面
            header("Location: process_purchase.php");
            exit();
        } else {
            // 關閉與 mydatabase 的連接
            $conn->close();

            // 點數不足，轉跳回購物頁面
            header("Location: shop.php?error=insufficient_points");
            exit();
        }
    } else {
        // 關閉與 mydatabase 的連接
        $conn->close();

        // 找不到用戶，轉跳回購物頁面
        header("Location: shop.php?error=user_not_found");
        exit();
    }
} else {
    // 未登入，轉跳回購物頁面
    header("Location: shop.php?error=not_logged_in");
    exit();
}
?>
