<?php
session_start();

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

// 檢查是否提交了登入表單
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // 在此處檢查用戶輸入的帳號和密碼是否正確
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // 登入成功，將用戶名稱儲存到 Session 中
        $_SESSION['username'] = $username;
        header("Location: website.php");
    } else {
        echo "登入失敗";
 echo '<meta http-equiv="refresh" content="5;url=website.php">';
    }
}

$conn->close();
?>
