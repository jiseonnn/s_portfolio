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
	//만약 쿠키가 
	$cookie_time = 600; // 10분
	setcookie('cookie', 'true', time() + $cookie_time, "/");
}
?>

<!DOCTYPE HTML>
<!--
	Road Trip by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
--><html><head><title>Road Trip by TEMPLATED</title><meta charset="utf-8"><meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="assets/css/main.css"></head><body>

		<!-- Header -->
			<header id="header"><div class="logo"><a href="/index login.php">by Stealth</a></div>
				<a href="#menu"><span>Menu</span></a>
			</header><!-- Nav --><nav id="menu"><ul class="links"><li><a href="/index login.php">Home</a></li>
					<li><a href="/board/board.php">게시판</a></li>
					<li><a href="/update/update.php">회원정보</a></li>
					<li><a href="/logout/logout.php">로그아웃</a></li>
				</ul></nav><!-- Banner --><!--
			Note: To show a background image, set the "data-bg" attribute below
			to the full filename of your image. This is used in each section to set
			the background image.
		--><section id="banner" class="bg-img" data-bg="banner.jpg"><div class="inner">
					<header><h1>ITSCHOOL</h1>
					</header></div>
				<a href="#" class="more">Learn More</a>
			</section><!-- One --><section id="one" class="wrapper post bg-img" data-bg="banner2.jpg"><div class="inner">
					<article class="box"><header><h2>Nibh non lobortis mus nibh</h2>
							<p>01.01.2017</p>
						</header><div class="content">
							<p>Scelerisque enim mi curae erat ultricies lobortis donec velit in per cum consectetur purus a enim platea vestibulum lacinia et elit ante scelerisque vestibulum. At urna condimentum sed vulputate a duis in senectus ullamcorper lacus cubilia consectetur odio proin sociosqu a parturient nam ac blandit praesent aptent. Eros dignissim mus mauris a natoque ad suspendisse nulla a urna in tincidunt tristique enim arcu litora scelerisque eros suspendisse.</p>
						</div>
						<footer><a href="#" class="button alt">Learn More</a>
						</footer></article></div>
				<a href="#" class="more">Learn More</a>
			</section><!-- Two --><section id="two" class="wrapper post bg-img" data-bg="banner5.jpg"><div class="inner">
					<article class="box"><header><h2>Mus elit a ultricies at</h2>
							<p>12.21.2016</p>
						</header><div class="content">
							<p>Scelerisque enim mi curae erat ultricies lobortis donec velit in per cum consectetur purus a enim platea vestibulum lacinia et elit ante scelerisque vestibulum. At urna condimentum sed vulputate a duis in senectus ullamcorper lacus cubilia consectetur odio proin sociosqu a parturient nam ac blandit praesent aptent. Eros dignissim mus mauris a natoque ad suspendisse nulla a urna in tincidunt tristique enim arcu litora scelerisque eros suspendisse.</p>
						</div>
						<footer><a href="#" class="button alt">Learn More</a>
						</footer></article></div>
				<a href="#" class="more">Learn More</a>
			</section>

			<footer id="footer">
				<div class="inner">


			</footer><div class="copyright">
			Site made with: <a href="#">Templated</a>
		</div>
		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script><script src="/assets/js/jquery.scrolly.min.js"></script><script src="/assets/js/jquery.scrollex.min.js"></script><script src="/assets/js/skel.min.js"></script><script src="assets/js/util.js"></script><script src="assets/js/main.js"></script></body></html>
