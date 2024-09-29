<?php
 @session_start();

 if(!isset($_SESSION['ss_id']) or $_SESSION['ss_id'] == ''){
  echo "<script>
         alert('여기는 회원 전용 페이지이므로 로그인 후 접근 가능');
         //history.go(-1);
         self.location.href='/login/login.php';
        </script>";
        exit();
}
?>
<?php
if (!isset($_COOKIE['cookie'])) {
    session_unset();
    session_destroy();
    echo "<script>
            alert('만료되었습니다. 다시 로그인해 주세요.');
            self.location.href = '/login.php';
          </script>";
    exit();
}else if(isset($_COOKIE['cookie'])){
	//페이지 이동마다 쿠키 만들어 주기 그래야 연장
	//만약 쿠키가 
	$cookie_time = 600; // 10분
	setcookie('cookie', 'true', time() + $cookie_time, "/");
}
?>


<!-- 수정 -->
<?php include $_SERVER['DOCUMENT_ROOT']."/dbconn.php";
	$u_id = $_SESSION['ss_num'];
	$sql = "select * from cus_for where num = $u_id ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	if(!$row){
		$id = $_SESSION['ss_id'];
		die("No data found for iD ; ".$id);
	}
?>




<!-- 수정 -->
<!DOCTYPE HTML>
<!--
	Road Trip by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
--><html lang="ko"><head><title>회원정보 수정</title><meta charset="utf-8"><meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"><meta name="viewport" content="width=device-width, initial-scale=1">	<link rel="stylesheet" href="/assets/css/main.css">	<link rel="stylesheet" href="/assets/css/sub.css"></head>
	<body class="subpage">
	<style>
	.cancel {
		font-size: 18px;
		float: right;
	}

	</style>
		<!-- Header -->
		<header id="header"><div class="logo"><a href="/index login.php">by Stealth</a></div>
				<a href="#menu"><span>Menu</span></a>
		</header>
		<!-- Nav --><nav id="menu"><ul class="links"><li><a href="/index login.php">Home</a></li>
			<li><a href="/board/board.php">게시판</a></li>
			<li><a href="/update/update.php">회원정보</a></li>
			<li><a href="/logout/logout.php">로그아웃</a></li>
				</ul></nav>
		<!-- Main -->
		<div id="main" class="container">

					
		<!-- Footer -->
			<footer id="footer">
				<div class="inner">

					<h2>회원정보 수정</h2>

					<form action="/update/update_info.php" name="join" method="post">

						<div class="field">
							<label for="name">ID</label>
							<input name="id" id="id" type="text" value="<?= $row['id']; ?>" required>
						</div>
						<div class="field">
							<label for="name">Password</label>
							<input name="passwd" id="passwd" type="password" placeholder="Enter your Password" required>
						</div>
						<div class="field half first">
							<label for="name">Name</label>
							<input name="name" id="name" type="text" value="<?= $row['name']; ?>" required>
						</div>
						<div class="field half">
							<label for="name">BirthDate</label>
							<input name="birth" id="birth" type="date" value="<?= $row['birth']; ?>" required>
						</div>

						<div class="cancel"><a href="/delete/delete.php">회원탈퇴 페이지로 바로가기</a></div>
						
						<ul class="actions">
							<li><input value="Submit" class="button alt" type="submit"></li>
							<li><input value="Back" class="button alt" type="button" onclick="self.location.href='/index login.php'"></li>
						</ul>
					</form>

					<ul class="icons"><li><a href="#" class="icon round fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon round fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon round fa-instagram"><span class="label">Instagram</span></a></li>
					</ul>
				</div>
		</div>
		</footer>
		<!-- <div class="copyright">
		Site made with: <a href="https://templated.co/">Templated</a>
		</div> -->
		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script><script src="/assets/js/jquery.scrolly.min.js"></script><script src="/assets/js/jquery.scrollex.min.js"></script><script src="/assets/js/skel.min.js"></script><script src="/assets/js/util.js"></script><script src="/assets/js/main.js"></script></body></html>
