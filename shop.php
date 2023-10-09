<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
ini_set('display_errors', '0');

?>
<?php
$servername = "L20101-054";
$username = "root";
$password = "12345";
$database = "mydatabase";

// 創建與資料庫的連接
$conn = new mysqli($servername, $username, $password, $database);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接資料庫失敗: " . $conn->connect_error);
}

// 獲取當前用戶的點數
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT points FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $points = $row['points'];
    } else {
        $points = 0; // 如果沒有找到該用戶，點數設置為 0
    }
} else {
    $points = 0; // 如果未登入，點數設置為 0
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>你的網頁標題</title>
</head>
<body>
    <!-- 你的網頁內容 -->

    <div style="position: fixed; bottom: 0; right: 0; background-color: #f2f2f2; padding: 10px;">
        用戶點數：<?php echo $points; ?>
    </div>
</body>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>抽獎活動</title>
<style>
	*{
            padding:0px;
            margin:0px;
        }
        
        .sl{
            white-space: nowrap;
            word-break: keep-all;
            text-overflow: ellipsis;
        }
        #big{
            width:950px;
            height:416px;
            margin:10px auto;
            overflow: hidden;
        }
        #big>.box{
            width:298px;
            height:410px;
            float: left;
            position: relative;
            overflow: hidden;
            border:1px solid #ccc;
            margin-left:19px;
        }
        #big>.box:first-child{
            margin-left:0px;
        }
        #big>.box>.pic{
            width:298px;
            height:300px;
            overflow: hidden;
        }
        #big>.box>.pic>img{
            transition: all 500ms;
        }
        #big>.box:hover>.pic>img{
            transform: scale(1.5);
        }
        #big>.box>.mask{
            height:300px;
            width:298px;
            position: absolute;
            left:-298px;
            top:0px;
            background:rgba(0,0,0,0.3);
            transition: all 600ms;
            color:#fff;
        }
        #big>.box>.mask>h2{
            font-size: 18px;
            margin:80px 0px 10px 10px;
        }
        #big>.box>.mask>p{
            font-size: 12px;
            margin:0px 0px 10px 10px;
        }
        #big>.box:hover>.mask{
            left:0px;
        }
        #big>.box>.title>h2{
            margin:10px auto;
            width:288px;
            height:20px;
            line-height: 20px;
            font-size: 14px;
            color:#333;
            overflow: hidden;
            font-weight: normal;
        }
        #big>.box>.title>h2>span{
            display: inline-block;
            width:10px;
            height:10px;
            vertical-align: middle;
            background: url('giftbox.png') no-repeat;
            background-size:cover;
            margin-right:5px;
        }
        #big>.box>.title>h3{
            width:288px;
            height:20px;
            margin:0px auto;
            font-size: 12px;
            color:#666;
            font-weight: 400;
        }
        #big>.box>.title>h3>i{
            width:12px;
            height:16px;
            display: inline-block;
            background:url('img/tu1.jpg') no-repeat;
            vertical-align: middle;
        }
        #big>.box>.title>h3>span{
            color:#f00;
            margin:0 5px 0 5px;
        }
        #big>.box>.title>.price{
            width:298px;
            height:50px;
            background:#e61414;
        }
        #big>.box>.title>.price>.zx_pr>span{
            font-size: 20px;
        }
        #big>.box>.title>.price>.zx_pr{
            width:83px;
            height:50px;
            line-height: 50px;
            float: left;
            margin-left:2px;
            vertical-align: bottom;
            font-size:38px;
            color:#fff;
        }
        
        #big>.box>.title>.price>.xl_yp{
            width:145px;
            height:41px;
            float: left;
            margin:4px 0 0 8px;
            font-size: 12px;
            color:#fff;
        }
        #big>.box>.title>.price>.xl_yp>p>span{
            margin-left:4px;
            width:72px;
            height:17px;
            display: inline-block;
            line-height: 17px;
            text-align: center;
            border-radius: 10px;
            background:#ffb369;
        }
        #big>.box>.title>.price>.xl_yp>p:nth-child(2){
            width:80px;
            height:20px;
            line-height: 20px;
            text-align: center;
            border-radius: 1px;
            margin-top:5px;
            background:rgba(0,0,0,0.2);
        }
        #big>.box>.title>.price>.xl_yp>p:nth-child(2)>strong{
            margin-right: 5px;
            font-size: 14px;
        }
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

		.win{
			padding-left: 300px;
			padding-right: 40px;
		}

</style>
</head>
<body>
	<center>
		<div class = "a">
			<div class = "win">
				<img src = "win.png" alt = "The World" height = "50" width = "50"/>
			</div>
			<div class = "c" ><b></b></div>
			<div class = "b" ><b><a href="website.php" style="text-decoration: none">首頁</a></b></div>
			<div class = "b" ><b><a href="shop.php" style="text-decoration: none">商品兌換</a></b></div>
			<div class = "c" ><b></b></div>
			 <?php if(isset($_SESSION['username'])): ?>
        <div class="c"><b><?php echo $_SESSION['username']; ?></b></div>
        <div class="b"><b><a href="logout.php" style="text-decoration: none">登出</a></b></div>
    <?php else: ?>
        <div class="c"><b></b></div>
        <div class="b"><b><a href="login.php" style="text-decoration: none">登入</a></b></div>
        <div class="b"><b><a href="register.php" style="text-decoration: none">註冊</a></b></div>
    <?php endif; ?>
		</div>
<div style="position: fixed; bottom: 0; right: 0; background-color: #f2f2f2; padding: 10px;">
        用戶點數：<?php echo $points; ?>
    </div>
	 <div id="big">
				<div class="box">
					<div class="pic"><img src="123.jpg" alt="" title=""/></div>
					<div class="mask">
						<h2>Dyson V12 Detect Slim™</h2>
						<p>Total Clean無線吸塵器</p>
					</div>
					<div class="title">
						<h2 class="sl"><span></span>&nbsp;Dyson 強勁輕量智能無線吸塵器</h2>
						<h3 class="sl"><i></i><span>商品數量為 : 10 台</span>根據環境，自動調整吸力</h3>
						<div class="price">
							<br>
							<div class="xl_yp">
								<p>抽獎人數為:<span>2143人</span></p>
								
							</div>
							

<form method="post" action="deduct_points.php">
  <input type="hidden" name="goods" value="dyson">
  <input type="submit" value="購買">
</form>

							
						</div>
					</div>
				</div>
				<div class="box">
					<div class="pic"><img src="456.jpg" alt="" title=""/></div>
					<div class="mask">
						<h2>Iphone 14 Pro</h2>
						<p>精心設計，成就種種不一樣。</p>
					</div>
					<div class="title">
						<h2 class="sl"><span></span>&nbsp;Iphone 14 Pro 256GB</h2>
						<h3 class="sl"><i></i><span>商品數量為 : 2 台</span>Pro。凌駕超越。</h3>
						<div class="price">
							<br>
							<div class="xl_yp">
								<p>抽獎人數為:<span>15640人</span></p>
								
							</div>
							<form method="post" action="deduct_points.php">
  <input type="hidden" name="goods" value="phone">
  <input type="submit" value="購買">
</form>
						</div>
					</div>
				</div>
				<div class="box">
					<div class="pic"><img src="789.jpg" alt="" title=""/></div>
					<div class="mask">
						<h2>星巴克</h2>
						<p>任品項買一送一</p>
					</div>
					<div class="title">
						<h2 class="sl"><span></span>&nbsp;STARBUCKS</h2>
						<h3 class="sl"><i></i><span>商品數量為 : 3000 張</span>買一送一券</h3>
						<div class="price">
							<br>
							<div class="xl_yp">
								<p>抽獎人數為:<span>7869人</span></p>
								
							</div>
							<form method="post" action="deduct_points.php">
  <input type="hidden" name="goods" value="star">
  <input type="submit" value="購買">
</form>
							
						</div>
					</div>
				</div>
				</div>
		</center>
	</body>
</html>