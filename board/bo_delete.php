<?php
    include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; 
    session_start();
?>

<?php
    $no=$_GET['no'];
    $ch = $_SESSION['ss_id'];
    $sql = "select * from bor_tion where no=$no";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 0){
        echo "<script>alert('게시물이 없습니다');
        self.location.href='/board/board.php';
        </script>";
        exit();
    }
    $row =mysqli_fetch_array($result);
    $name = $row['author'];
    if($ch == $name){
        $sql ="delete from bor_tion where no=$no ";
        $result= mysqli_query($conn, $sql);
        if($result){
            echo "<script>alert('삭제 되었습니다')</script>";
        }else{
            echo "<script>alert('삭제되지 않았습니다')</script>";
        }
    }else{
        echo "<script>alert('권한이 없습니다')</script>";
    }
    mysqli_close($conn);

    $URL = '/board/board.php';
    echo "<script>
    self.location.href='$URL';
    </script>";

?>