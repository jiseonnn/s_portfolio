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
            self.location.href = '/login/login.php';
          </script>";
    exit();
}else if(isset($_COOKIE['cookie'])){
	//페이지 이동마다 쿠키 만들어 주기 그래야 연장
	$cookie_expiration_time = 600; // 10분
	setcookie('cookie', 'true', time() + $cookie_expiration_time, "/");
}
?>

<!DOCTYPE HTML>
<html lang="ko">
<html><head><title>회원 삭제</title>
<meta charset="utf-8">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/assets/css/main.css"></head><body class="subpage">
<link rel="stylesheet" href="/assets/css/login.css"></head><body class="subpage">
<style>
 input.button.alt{
	width: 250px;
 }
</style>
		<!-- Header -->
		<header id="header"><div class="logo"><a href="/index login.php">by Stealth</a></div>
				<a href="#menu"><span>Menu</span></a>
			</header><!-- Nav --><nav id="menu"><ul class="links"><li><a href="/index login.php">Home</a></li>
			<li><a href="/board/board.php">게시판</a></li>
			<li><a href="#">회원정보</a></li>
			<li><a href="/logout/logout.php">로그아웃</a></li>
				</ul></nav><!-- Main --><div id="main" class="container">

		<!-- Footer -->
			<footer id="footer"><div class="inner">

					<h2>회원 삭제</h2>
					<form action="/delete/delete_reserve.php" method="post">

						<div class="container">
							<label for="ID">ID</label>
							<input name="id" id="id" type="text" placeholder="ID"></div>
						<div class="container">
							<label for="passwd">Password</label>
							<input name="passwd" id="passwd" type="password" placeholder="password"></div>
						<ul class="actions"><a href="/delete/delete_reserve.php"><input type="submit" value="DELETE" class="button alt"></a></li>
						</ul></form>
					</div>
					<ul class="icons"><li><a href="#" class="icon round fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon round fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon round fa-instagram"><span class="label">Instagram</span></a></li>
					</ul></div>
			</footer>
			<!-- <div class="copyright">
			Site made with: <a href="https://templated.co/">Templated</a>
		</div> -->
		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script><script src="/assets/js/jquery.scrolly.min.js"></script><script src="/assets/js/jquery.scrollex.min.js"></script><script src="/assets/js/skel.min.js"></script><script src="/assets/js/util.js"></script><script src="/assets/js/main.js"></script></body></html>
