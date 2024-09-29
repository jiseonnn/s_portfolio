<?php
  @session_start();
  header("Content-Type: text/html; charset=UTF-8");
  include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; 
 
  //수정
  if (isset($_SESSION['ss_id']) || isset($_SESSION['ss_num'])) {
    session_unset();
    session_destroy();
  }
  //수정

 $user_id = (isset($_POST['id']) and $_POST['id'] !='') ? $_POST['id'] : '';
 $user_pw = (isset($_POST['pw']) and $_POST['pw'] !='') ? $_POST['pw'] : '';

 if($user_id == ''){
   echo "<script>
          alert('아이디를 입력하세요');
          history.go(-1);
        </script>";
    exit();
 }

 if($user_pw == ''){
    echo "<script>
          alert('비밀번호를 입력하세요');
          history.go(-1);
          </script>";
     exit();     
 }


 //id가 중복될 경우 사용자가 passwd가 일치해도 못 들어가는경우가 mysqli_num_rows로 인해 발생 if문으로 userid와 passwd가 일치하면 sql 정보를 가져와야함
 $sql = "SELECT * FROM cus_for WHERE id = '$user_id' ";
 $result = mysqli_query($conn, $sql);
 $user_pw = md5($user_pw);       //위로 옮겨야 id와 pw일치하는거 찾을 수 있음
 

 if(mysqli_num_rows($result) == 1){
    $row=mysqli_fetch_assoc($result);
  }else if(mysqli_num_rows($result) > 1) {
    $sql = "SELECT * FROM cus_for WHERE id = '$user_id' && passwd ='$user_pw' ";
    $result = mysqli_query($conn, $sql);  
    if(mysqli_num_rows($result) >= 1){
      $row=mysqli_fetch_assoc($result);
    }
  }
  
  $id = $row['id'];
  $pw = $row['passwd'];   
  $num = $row['num'];

 if($user_id == $id && $user_pw == $pw){
  session_start();

  $_SESSION['ss_id'] = $id;
  //수정
  $_SESSION['ss_num'] = $num;
  $cookie_time = 600; // 10분
  setcookie('cookie', 'true', time() + $cookie_time, "/");
  //수정


  echo "<script>
        alert('로그인 성공');
        self.location.href='/index login.php';
      </script>";
 }else{
  echo "<script>
        alert('로그인 실패');
        self.location.href='login.php';
      </script>";
 }
?>