<?php
  $user_id = (isset($_POST['id']) and $_POST['id'] !='') ? $_POST['id'] : '';
  $user_pw = (isset($_POST['passwd']) and $_POST['passwd'] !='') ? md5($_POST['passwd']) : '';

  include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; 

  if (!$conn) {
    die("Connection failed: ".mysqli_connect());
  }

  $sql = "DELETE FROM userinfo WHERE id='$user_id' AND passwd='$user_pw'";
  $result = mysqli_query($conn, $sql);


  if(mysqli_affected_rows($conn) > 0){
    echo "<script>
            alert('회원 정보가 성공적으로 삭제되었습니다.');
            self.location.href='/index.html'; //로그인 페이지로 이동
            </script>";
  }else{
    echo "<script>
            alert('회원 정보 삭제 실패. 아이디와 비밀번호를 다시 확인하세요!');
            self.location.href='/delete/delete.php';
            </script>";
  }

  mysqli_close($conn);
  ?>
  