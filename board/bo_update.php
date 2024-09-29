<?php
 session_start();
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
            alert('만료되었습니다. 다시 로그인해 주세요.');
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
<?php
$ch = $_SESSION['ss_id'];
$no=$_GET['no'];
$sql = "select * from bor_tion where no=$no ";
$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) == 0){
		echo "<script>alert('게시물을 찾을 수 없습니다.');
		history.go(-1);
		</script>";
		exit();
	}
$row = mysqli_fetch_array($result);
$author = $row['author'];
	if($ch != $author){
		echo "<script>alert('권한이 없습니다.');
		history.go(-1);
		</script>";
		exit();
	}
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
			text-decoration : none;
		}
		.in_container{
			margin:50px 0px;
			min-height: 800px;
		}
		h1{
			font-size:30px;
			padding: 40px 0px;
		}
		.empty{
			height:20px;
		} 
		.a_form{
			display: flex;
			flex-direction: column;
			gap: 10px;	
		}
		.form-group{
			display: flex;
			justify-content:center;
			align-items: center;
			margin-bottom: 15px; 
		}
		
		.form-group label {
			width: 80px;
			margin-top : 5px;
			margin-right: 10px;
			text-align: center;
		}	

		.form-buttons {
			display: flex;
			flex-direction: column;
			align-items: center; 
			margin-top: 20px;
		}
		.button.alt {
			width: 250px;
			margin-bottom: 30px; 
		}
		</style>
		<body>
      
			<div class="in_container">
				<div class="empty"></div>
				<h1>게시글 수정</h1>
				<hr>

				<form action="bo_update_ok.php" method="POST">
          <input type="hidden" name="no" value="<?= $row['no']; ?>">
					<div class="a_form">
						<div class="form-group">
							<label for="author">작성자</label>
							<input type="text" name="author" value="<?= $row['author']; ?>" readonly> 
						</div>
						<div class="form-group">
							<label for="title">제목</label>
							<input type="text" name="title"  value="<?= $row['title']; ?>" required>
						</div>
						<div class="form-group">
							<label for="essay">내용</label>
							<textarea id="essay" name="essay" rows="10" required><?= $row['essay']; ?></textarea>
						</div>
						<div class="form-group">
							<label for="file">파일첨부</label>
							<input type="text" name="file" value="<?= $row['file_name']; ?>">
						</div>
					</div>
					<div class="form-buttons">
						<input type="submit" value="수정하기" class="button alt">
						<input type="reset" value="초기화" class="button alt">
					</div>
				</form>
			</div>
		</body>


		<!-- Scripts -->
		<script src="/assets/js/jquery.min.js"></script><script src="/assets/js/jquery.scrolly.min.js"></script><script src="/assets/js/jquery.scrollex.min.js"></script><script src="/assets/js/skel.min.js"></script><script src="/assets/js/util.js"></script><script src="/assets/js/main.js"></script></body></html>

