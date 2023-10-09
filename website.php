<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首頁</title>
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
			        header("Location: admin.php");
			        exit;
			    }
			    
			    // 顯示使用者名稱和登出按鈕
			    echo '<div class="b"><img src="user.png" height="10" width="10">' . $_SESSION['username'] . '</div>';
			    echo '<div class="b"><img src="logout.png" height="10" width="10"><a href="logout.php" style="text-decoration: none">&nbsp;登出</a></div>';
			} else {
			    // 顯示登入和註冊按鈕
			    echo '<div class="b"><img src="user.png" height="10" width="10"><a href="login.php" style="text-decoration: none">&nbsp;登入</a></div>';
			    echo '<div class="b"><img src="question.png" height="10" width="10"><a href="register.php" style="text-decoration: none">&nbsp;註冊</a></div>';
			}
			?>
		</div>
		<div>
			<div class="d">
				<table style="background-image:url(get.png); width:850px; height:600px;">
					<tr>
						<td class="e">
							<b>給予您身體上的健康</b><br><br>
							<b>以及擁有豐厚的獎勵</b><br><br>
							<b>這樣您還不心動嗎</b><br>
						</td>
						<td class="f">
							<b>抽獎送好禮</b><br><br>
							<b>累積點數</b><br><br>
							<b>送獎品</b><br>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</center>
</body>
</html>
