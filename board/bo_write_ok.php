<?php
    header("Content-Type: text/html; charset=UTF-8");
    include $_SERVER['DOCUMENT_ROOT']."/dbconn.php"; 
    
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }

    $author=$_POST['author'];
    $title=$_POST['title'];
    $essay=$_POST['essay'];

    // 파일이 선택된 경우에만 업로드 처리
        if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] == 0 && $_FILES['userfile']['size'] > 10){
            $filename=$_FILES['userfile']['name'];
            $filetmp=$_FILES['userfile']['tmp_name'];
            include $_SERVER['DOCUMENT_ROOT']."/lftp.php"; 
            $result2 = @ftp_login($ftp, $ftp_user,$ftp_pass);
            
            if($result2){ //로그인 성공하면 true, 실패 시 false
                //FTP 로그인 됬으면 서버에 파일 전송과 게시판 작성
                $sql = "insert into bor_tion(title,author,essay,file_name) values('$title','$author','$essay','$filename') ";
                $result = mysqli_query($conn, $sql);
                $sql = "select * from bor_tion order by no desc limit 1;";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $filename=$row['no'].$filename;
                // $enco = urlencode($filename);
                // echo "<script>alert('$enco')</script>";
                // $filename=$row['no'];
                // $ftp_remote_file=$ftp_remote_file.$enco;
                $ftp_remote_file=$ftp_remote_file.$filename;
                $result3 = ftp_put($ftp,$ftp_remote_file,$filetmp, FTP_BINARY);
                if($result3 && $result){ //파일 전송 결과로 성공 시 true, 실패하면 false 
                    echo "<script>
                    alert('파일 업로드와 게시글 작성 성공');
                    </script>";
                }else if (!$result3 && $result ){   //파일 업로드 실패시 게시판만 작성
                    $sql = "insert into bor_tion(title,author,essay) values('$title','$author','$essay') ";
                    $result = mysqli_query($conn,$sql);
                    echo "<script>
                    alert('파일이 전송에 실패하였습니다.\\n게시글만 작성됩니다.');
                    </script>";
                }else{
                    echo "<script>
                    alert('게시글 작성과 파일 전송이 실패하였습니다.');
                    history.go(-1)
                    </script>";
                }

            }
        }else if(!isset($_FILES['userifle'])){ 
            // 그 외(파일이 없을 경우 게시판만 작성)   
           $sql = "insert into bor_tion(title,author,essay) values('$title','$author','$essay') ";
           $result = mysqli_query($conn,$sql);
           echo "<script>
               alert('게시글 작성되었습니다.');
               </script>";
        }else{            
           echo "<script>
           alert('관리자에게 문의주세요.');
           history.go(-1);
           </script>";
            //UPLOAD_ERR_OK를 사용해서 업로드 실패되었을때.       
        }
        $URL = '/board/board.php';
        echo "<script>
        location.replace('$URL');
        </script>";
        ftp_close($ftp);
        mysqli_close($conn);
        
?>
