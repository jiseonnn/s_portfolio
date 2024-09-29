<?php
    //기본접속
    $ftp_server="192.168.1.239";
    $ftp_user="stealth0";
    $ftp_pass="stealth0";
    $ftp_port=21;
    $ftp_remote_file="./";
    

    $ftp=ftp_connect($ftp_server,$ftp_port) or die ("Couldn't connect to $ftp_server");
?>