<?php
    header('Content-Type: application/json');
    require_once "../php/db_connect.php";
    $databaseConnection =connect_to_db();
    if(!empty($_POST['username']))
    {
        $errMsg = '';
        //username and password sent from Form
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password']));

        if($username == 'Example@example.com')
            $errMsg .= 'You must enter your Username<br>';
        if($password == '688822292')
            $errMsg .= 'You must enter your Password<br>';

        if($errMsg == '')
        {
            $records = $databaseConnection->prepare('SELECT id,username,password FROM  company WHERE username = :username');
            $records->bindParam(':username', $username);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);

            if (count($results) > 0 && $password === $results['password'])
            {
                $data = array('status'=>'success');
                //update company counter enters
                $sql_update="UPDATE company SET counter_enters = counter_enters + 1 WHERE username = '".$username."'";
                $update = $databaseConnection ->prepare($sql_update);
                /*
                echo("<a id='re_route_main' href ='../#/main'></a>
                         <script>                  
                            sessionStorage.setItem('username', '" . $username . "');
                            document.getElementById(\"re_route_main\").click();
                        </script>
                        ");
                exit;*/
            }
            else
            {
                $data = array('status'=>'error', 'msg' => 'Username or Password incorect');
                $errMsg .= 'Username and Password are not found<br>';
                echo("<a id='re_route_login' href ='../#/login'></a>
                        <script>
                            alert('Wrong Password Or User Name.');
                            document.getElementById(\"re_route_login\").click();
                        </script>
                    ");
                exit;
            }
        }
    }
    echo json_encode($data);
?>