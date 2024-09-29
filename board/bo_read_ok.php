<?php
 @session_start();
 header("Content-Type: text/html; charset=UTF-8");
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
            alert('세션이 만료되었습니다. 다시 로그인해 주세요.');
            self.location.href = '/login/login.php';
          </script>";
    exit();
}else if(isset($_COOKIE['cookie'])){
	//페이지 이동마다 쿠키 만들어 주기 그래야 연장
	$cookie_time = 600; // 10분
	setcookie('cookie', 'true', time() + $cookie_time, "/");
}
?>

<?php
  include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; 
?>
<!DOCTYPE HTML>
<!--
	Road Trip by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
--><html><head><title>by Stealth</title><meta charset="utf-8"><meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="/assets/css/main.css"></head><body class="subpage">

		<!-- Header -->
		<header id="header"><div class="logo"><a href="/index login.php">by Stealth</a></div>
				<a href="#menu"><span>Menu</span></a>
			</header><!-- Nav --><nav id="menu"><ul class="links"><li><a href="/index login.php">Home</a></li>
			<li><a href="/board/board.php">게시판</a></li>
			<li><a href="/update/update.php">회원정보</a></li>
			<li><a href="/logout/logout.php">로그아웃</a></li>
		</ul></nav><!-- Main --><div id="main" class="container">
		<style>
		a{
			text-decoration: none;	
		}
		.in_container{
			margin:50px 0px;
			min-height: 800px;
			font-size: 25px;
			min-width : 700px;
		}
		h1{
			font-size:40px;
			padding: 40px 10px;
		}
		.empty{
			height:20px;
		} 
		.a_form{
			display: flex;
			flex-direction: column;
			gap: 10px;	
		}
		.line{
			border: 1px solid rgba(144, 144, 144, 0.25);;
		}
		.form-group{
			display: flex;
			justify-content:center;
			align-items: center;
			height : 70px;
		}	
		.form-group label {
			display : flex;
			align-items : center;
			justify-content : center;
			width: 13%;
			height:100%; 
			margin:0;
			text-align: center;
		}
		.read{
			width: 100%;
			overflow-y: auto;
		}
		.h_read{
			height:500px;
			display : flex;
			justify-content : flex-start;
			align-items:flex-start;
		}
		.h_read .read{
			padding : 15px 0px; 
		}
		.form-buttons {
			display: flex;
			justify-content:center;
			align-items: center; 
			margin-top: 40px;
			gap : 50px;
		}


	</style>
	<body>
      <?php
          $no=$_GET['no'];
          $sql="select * from bor_tion where no='$no' ";
          $result= mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
		        ?>
			<div class="in_container">
				<div class="empty"></div>
				<h1><?= $row['title']; ?></h1>
				<div class="a_form">
					<div class="line"></div>
					<div class="form-group">
						<label for="author">작성자</label>
						<div class="read"><?= $row['author']; ?></div>
					</div>
					<div class="line"></div>
					<div class="form-group">
						<label for="title">제목 </label>
						<div class="read"><?= $row['title']; ?></div>
					</div>
					<div class="line"></div>
					<div class="form-group h_read">
						<label for="essay">내용</label>
						<div class="read"><?= nl2br($row['essay']); ?></div>
					</div>
					<div class="line"></div>
						<div class="form-group">
							<label for="title">첨부파일</label>
								<div class="read">
									<?php
										include $_SERVER['DOCUMENT_ROOT']."/lftp.php"; 
										// if(!$ftp){	echo"통신 안됨";  }
										// $tmp_na = urlencode($row['no'].$row['file_name']);
										$tmp_na = $row['no'].$row['file_name'];
										$ftp_remote_file=$ftp_remote_file.$tmp_na;
										// echo "<script>alert('$ftp_remote_file')</script>";
										// $ftp_remote_file=$ftp_remote_file.$row['no'];
										// echo "$ftp_remote_file";

										$local_file="../upload/".$row['file_name'];
										// $local_file="../upload/".$tmp_na;
										// echo "<script>alert('$local_file')</script>";
										// echo "<script>alert('$local_file')</script>";
										// echo "<script>alert('$tmp_na')</script>";
										// echo "$local_file";
										if(@ftp_login($ftp, $ftp_user,$ftp_pass)){
											// echo "$ftp";
											
											if(ftp_get($ftp,$local_file,$ftp_remote_file,FTP_BINARY)){
											
											}else{
												// echo "<script>alert('title에 띄어쓰기!')</script>";
											}
										}else{
											echo "관리자에게 문의";
										}
										// echo "<p>로컬 파일 경로 : $local_file</p>";
										ftp_close($ftp);
									?>
									<a href=<?= $local_file; ?> download><?= $row['file_name']; ?></a>
									
								</div>
							</div>
						</div>
						<div class="line"></div>
					</div>
				<div class="form-buttons">
					<form action="bo_update.php?no='<?= $row['no']; ?>'" method="POST">
						<input type="submit" value="수정하기" class="button alt">	
					</form>
					<form class="delete_btn" method="GET" action="bo_delete.php">
						<input type="hidden" name="no" value="<?= $row['no']; ?>">
						<input type="submit" value="삭제하기" class="button alt">
					</form>
				</div>
			</div>
		</body>


		<!-- Scripts -->
		<script src="/assets/js/jquery.min.js"></script><script src="/assets/js/jquery.scrolly.min.js"></script><script src="/assets/js/jquery.scrollex.min.js"></script><script src="/assets/js/skel.min.js"></script><script src="/assets/js/util.js"></script><script src="/assets/js/main.js"></script></body></html>

