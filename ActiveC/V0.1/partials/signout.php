<?php

    //session_start();
   // unset($_SESSION['loggedin']);
   // $_SESSION['loggedin'] = 0;
    //session_write_close();
session_destroy();
session_start();
echo("<a id='re_route' href ='#/login'>
        <script>
             document.getElementById(\"re_route\").click();
                        alert('successfully logout.');
             console.log('from signout : ".$_SESSION['username']."');
         </script>
     </a>");

?>
