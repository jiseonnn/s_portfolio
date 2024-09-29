
<?php
  session_start();
  $ch = $_SESSION['ss_id'];
  include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; 
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시물 수정</title>
</head>
<body>
  <?php
    $no=$_POST['no'];
    $title=$_POST['title'];
    $essay=$_POST['essay'];
    $author=$_POST['author'];

    $URL = '/board/board.php';
    
    if($ch == $author){
      $sql = "update bor_tion set title='$title', essay='$essay' where no=$no ";
      $result=mysqli_query($conn, $sql);
      if($result){
        echo "<script>
          alert('수정 하였습니다');
          location.replace('$URL');
        </script>";
        exit();
      }else{
        echo "<script>
          alert('수정되지 않았습니다');
          history.go(-1);
        </script>";
        exit();
      }
    }else{
      echo "<script>
      alert('권한이 없습니다');
      location.replace('$URL');
      </script>";
      exit();
    }
    mysqli_close($conn);
  ?>
