<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <title>註冊</title>
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
			<div class = "c" ><b></b></div>
			<div class = "b" ><img src = "user.png" height = "10" width = "10"><a href="login.php" style="text-decoration: none">&nbsp;登入</a></div>
			<div class = "b" ><img src = "question.png" height = "10" width = "10"><a href="register.php" style="text-decoration: none">&nbsp;註冊</a></div>
			
		</div>
		<div class = "d"></div>
		<div>
			<div><h2>註冊</h2></div>
			<div><form action="register_1.php" method="POST">
        	<div align = "center"><label for="username">名稱 : </label>
        	<input type="text" id="username" name="username" required><br><br></div>
        
        	<div align = "center"><label for="password">密碼 : </label>
        	<input type="password" id="password" name="password" required><br><br></div>
				
			<div align = "center"><label for="email">郵箱 : </label>
        	<input type="email" id="email" name="email" required><br><br></div>
        	<input type="submit" value="註冊">

    		</form>
			</div>
		</div>
	</center>
</body>
</html>
