<?php include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
    if(!$conn){
      die("Connection failed: ".mysqli_connect_error());
    }
?>
<?php
$id = $_POST['id'];
$pw = empty($_POST['passwd']) ? '' : md5($_POST['passwd']);
$name = $_POST['name'];
$birth = $_POST['birth'];

//수정 서버측 검증
if(empty($id) || empty($pw) || empty($name) || empty($birth)){
  echo "<script>
    alert('모든 칸을 입력해주세요.');
    history.back();
  </script> ";
  exit();
}
//수정

$sql = "INSERT INTO cus_for(id, passwd, name, birth) ";
$sql = $sql." VALUES('$id', '$pw', '$name', '$birth')";

$result = mysqli_query($conn, $sql);


if(mysqli_affected_rows($conn) > 0){
  echo "<script>
        alert('회원가입이 되었습니다.');
        self.location.href='/index.html';
        </script>";
} else {
  echo "<script>
        alert('회원가입에 실패하였습니다.');
        self.location.href='signup.html';
        </script>";
}

mysqli_close($conn);

?>