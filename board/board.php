
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
	date_default_timezone_set('Asia/Seoul');
	include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; 
 

	$limit = 12;  // 페이지당 게시물 수w
	$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	$start = ($page - 1) * $limit;

	$search = isset($_GET['search']) ? $_GET['search'] : '';

    if (empty($search)) {
        // 검색어가 없으면 전체 게시물 표시
        $sql = "SELECT * FROM bor_tion ORDER BY no DESC LIMIT $start, $limit";
        $total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM bor_tion");
    } else {
        // 검색어가 있으면 해당 검색어에 맞는 게시물만 표시
        $sql = "SELECT * FROM bor_tion WHERE title LIKE '%$search%' ORDER BY no DESC LIMIT $start, $limit";
        $total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM bor_tion WHERE title LIKE '%$search%'");
    }

    $result = mysqli_query($conn, $sql);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_posts = $total_row['total'];
    $total_pages = ceil($total_posts / $limit);

?>





<!DOCTYPE HTML>
<html><head><title>by Stealth</title><meta charset="utf-8"><meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="/assets/css/main.css"></head><body class="subpage">

	<!-- Header -->
	<header id="header"><div class="logo"><a href="/index login.php">by Stealth</a></div>
			<a href="#menu"><span>Menu</span></a>
		</header><!-- Nav --><nav id="menu"><ul class="links"><li><a href="/index login.php">Home</a></li>
			<li><a href="/board/board.php">게시판</a></li>
			<li><a href="/update/update.php">회원정보</a></li>
			<li><a href="/logout/logout.php">로그아웃</a></li>
			</ul></nav><!-- Main --><div id="main" class="container">
	<style>
	/* board_CSS */
	li{
		list-style-type :none;
	}
	a{
		text-decoration:none;
	}
	.boa{
	display	: flex;
	position: relative;
	margin : 20px 0px;
	width: 100%;
	}
	.board_t{
	max-width: 100%;
	min-width: 100%;
	max-height: 1000px;
	min-height: 1000px;
	}

	.board_t h1{
	padding	: 20px;
	font-size: 40px;
	margin : 0px;
	flex-grow: 2;
	}

	.board{
	width: 100%;
	border-collapse:collapse;
	border-bottom: 2px solid black;
	}
	.button.alt.wr{
	border-radius : 5px ;
	position : absolute;
	right : 0px;
	bottom : 0;
	width: 15%;
	}
	
	tr>th.board_th:nth-child(1){
	width: 10%;
	}

	tr>th.board_th:nth-child(4){
	border-right:none;
	}
	.pagination{
		text-decoration : none;
		display: flex;
		justify-content:center;
		align-items: center;
	}
	.bo_search{
		display : flex;
		align-items : center;		
	}
	#board_search{
		display : flex;
		width: 100%;
		gap :10px;
	}
	.sea{
		width : 85%;
	}
	.bnt{
		width: 15%;
		background: black;
	}
	</style>
	<body>
		<div class="board_frame">
			<div class="board_t">
				<div class="boa">
					<h1><a href="#">자유게시판</a></h1>
					
					<form id="board_write-btn" >
						<div>
							<br>
							<ul class="actions"><li><a href="bo_write.php">
							<input value="글쓰기" class="button alt wr"></a></li></ul>
						</div>
					</form>
				</div>
				
				<table class="board">
					<thead class="board_thead">
						<tr>
							<th class="board_th">No</th>
							<th class="board_th">제목</th>
							<th class="board_th">글쓴이</th>
							<th class="board_th">작성시간</th>
						</tr>
					</thead>

					<?php while ($row = mysqli_fetch_array($result)) { ?>
                <tbody>
                    <tr>
                        <td width="10%"><?= $row['no'] ?></td>
                        <td width="60%"><a href="bo_read_ok.php?no=<?= $row['no'] ?>"><?= $row["title"]; ?></a></td>
                        <td width="15%"><?= $row['author'] ?></td>
                        <td width="15%"><?= date('Y-m-d', strtotime($row['time'])); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
          		</table>
			</div> 
            <!-- Pagination -->
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li><a href="board.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php } ?>
                </ul>
            </nav>

			<!-- </div> -->
			<div class=bo_search>
				<form id="board_search" method="GET" action="board.php" >
					<input type="text" class ="sea" name="search" placeholder="검색어 입력">
					<input type="submit" class="bnt" value="검색" class="button alt" >
				</form>
			</div>		
		</div>  
	

	</body>
							
		<hr color=white>
		<!-- Footer -->
			<footer id="footer"><div class="inner">

					
			</footer>
			<!-- <div class="copyright">
			Site made with: <a href="https://templated.co/">Templated</a>
		</div> -->
		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script><script src="/assets/js/jquery.scrolly.min.js"></script><script src="/assets/js/jquery.scrollex.min.js"></script><script src="/assets/js/skel.min.js"></script><script src="/assets/js/util.js"></script><script src="/assets/js/main.js"></script></body></html>
