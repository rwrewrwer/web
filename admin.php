<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
ini_set('display_errors', '0');

// 建立與資料庫的連線
$servername = "L20101-054";
$username = "root";
$password = "12345";
$database = "market";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("連線資料庫失敗: " . $conn->connect_error);
}

// 獲取所有不重複的商品名稱
$sql = "SELECT DISTINCT goods FROM market";
$result = $conn->query($sql);
$goodsList = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $goodsList[] = $row['goods'];
    }
}

// 當點擊抽獎按鈕時
if (isset($_POST['draw'])) {
    $selectedGoods = $_POST['selected_goods'];

    // 查找未標記的該商品
    $selectSql = "SELECT * FROM market WHERE goods = '$selectedGoods' AND mark = ''";
    $result = $conn->query($selectSql);
    $winner = null;

    if ($result->num_rows > 0) {
        // 獲取符合條件的所有記錄
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        // 從符合條件的記錄中隨機選擇一個作為中獎者
        $winner = $records[array_rand($records)];

        // 更新該記錄的 mark 欄位
        $id = $winner['id'];
        $updateSql = "UPDATE market SET mark = '已標記' WHERE id = $id";
        $conn->query($updateSql);
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理員頁面</title>
<style>
	.a{
		margin-top: 20px;
		padding-bottom: 20px;
		display: flex;
		justify-content: center;
		align-items: center;
		box-shadow: 0px 4px 5px 0px rgba(191,122,122,0.71);
	}
	.b{
		font-weight: 400;
		background: transparent;
		text-decoration: none;
    	color: inherit;
		display: flex;
		align-content: center;
		padding: 15px;
		padding-right: 50px;
		font-size: 20px;
		text-align: center
	}
	.c{
		margin-left:50px;
	}
	.d{
		margin:50px
	}
	.e{
		padding-top:500px;
		padding-left:0px;
		font-size: 18px;
		color: red;
	}
	.f{
		padding-left:430px;
		font-size: 20px;
		color: red;
		padding-top:120px;
	}
	.win{
		padding-left: 300px;
		padding-right: 40px;
	}
	
</style>
</head>
<body>
	<center>
		<div class="a">
			<div class="win">
				<img src="win.png" alt="The World" height="50" width="50"/>
			</div>
			<div class="c"><b></b></div>
			<div class="b"><b><a href="website.php" style="text-decoration: none">首頁</a></b></div>
			<div class="b"><b><a href="shop.php" style="text-decoration: none">商品兌換</a></b></div>
			<div class="c"><b></b></div>
			<div class="c"><b></b></div>
			<?php
			session_start();
			if (isset($_SESSION['username'])) {
			    // 檢查使用者名稱是否為 admin，如果是則跳轉到 admin.php
			    if ($_SESSION['username'] === 'admin') {
			        echo '<div class="b"><img src="user.png" height="10" width="10">' . $_SESSION['username'] . '</div>';
			        echo '<div class="b"><img src="logout.png" height="10" width="10"><a href="logout.php" style="text-decoration: none">&nbsp;登出</a></div>';
			    } else {
			        header("Location: website.php");
			        exit;
			    }
			} else {
			    header("Location: login.php");
			    exit;
			}
			?>
		</div>
		<div>
			<div class="d">
				<table style="background-image:url(get.png); width:850px; height:600px;">
 <h1>抽獎</h1>
    <form method="POST" action="">
        <select name="selected_goods">
            <?php foreach ($goodsList as $goods): ?>
                <option value="<?php echo $goods; ?>"><?php echo $goods; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="draw" value="抽獎">
    </form>

    <?php if (isset($winner)): ?>
        <h2>中獎者</h2>
        <p>商品名稱：<?php echo $winner['goods']; ?></p>
        <p>用戶名稱：<?php echo $winner['username']; ?></p>
<p>編號：<?php echo $winner['number']; ?></p>
    <?php endif; ?>					
<tr>
						<td class="e">
							<b>這是管理員頁面</b><br><br>
							<b>您可以在這裡進行管理員相關操作</b><br>
						</td>
						<td class="f">
							<!-- 管理員頁面內容 -->
						</td>
					</tr>
				</table>
			</div>
		</div>
	</center>
</body>
</html>
