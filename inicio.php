<?php
    session_start();
    if($_SESSION["nombreusuario"]){   
        include "Vista/header.php";
        include "Vista/inicio.html";
        include "Vista/footer.html";     
    }else{
    header("Location:login.html");    
        
    }
   

?>