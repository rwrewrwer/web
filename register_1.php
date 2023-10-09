<?php
$servername = "L20101-054";
$username = "root";
$password = "12345";
$database = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("連接資料庫失敗: " . $conn->connect_error);
}

// 檢查是否提交了註冊表單
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    // 檢查帳號唯一性
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 帳號已存在，顯示錯誤訊息
        echo "該帳號已被使用，請選擇其他帳號";
        echo '<meta http-equiv="refresh" content="5;url=index.php">';
        echo '將在5秒後跳轉到主頁面。如果沒有自動跳轉，請點擊<a href="website.php">這裡</a>。';
        exit();
    } else {
        // 帳號唯一，插入新帳號到資料庫
        $insertSql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        $insertResult = $conn->query($insertSql);

        if ($insertResult) {
            // 註冊成功，執行跳轉或顯示成功訊息
            echo "註冊成功！";
            echo '<meta http-equiv="refresh" content="5;url=website.php">';
            echo '將在5秒後跳轉到主頁面。如果沒有自動跳轉，請點擊<a href="website.php">這裡</a>。';
        } else {
            // 註冊失敗，顯示錯誤訊息
            echo "註冊失敗，請稍後再試";
	 echo '<meta http-equiv="refresh" content="5;url=website.php">';
        }
    }
}

$conn->close();
?>
