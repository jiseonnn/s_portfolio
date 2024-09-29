<?php include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; ?>

<?php
//세션 존재하는지 확인
@session_start();
header("Content-Type: text/html; charset=UTF-8");

$id = $_POST['id'];
$pw = md5($_POST['passwd']);
$name = $_POST['name'];
$birth = $_POST['birth'];
$s_num = $_SESSION['ss_num'];


//수정 부분
//사용자의 비밀번호와 일치하는지 확인 비밀번호 변경은 추가?? 코드 추가
$num_sql = "select passwd from cus_for where num = '$s_num' ";
$result = mysqli_query($conn, $num_sql);
if(!$result){
  echo "<script>
    alert ('정보가 없습니다');
    history.back();
  </scirpt>";
  exit();
}
$row = mysqli_fetch_array($result);
$c_pw = $row['passwd'];


if($pw == $c_pw){
  $sql = "UPDATE cus_for SET passwd='$pw', name = '$name', birth='$birth' WHERE id='$id'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_affected_rows($conn) > 0){
    echo"<script>
          alert('회원 정보가 성공적으로 수정되었습니다.');
          self.location.href='/index login.php'; //수정페이지로 이동
          </script>";
  }else {
    echo"<script>
        alert('회원 정보 수정이 실패하였습니다.');
        self.location.href='/update/update.php';
        </script>";
  }   
}else{
  echo "<script>
    alert('비밀번호가 일치 하지않습니다');
    history.back();
  </script>";
}



mysqli_close($conn);

?>