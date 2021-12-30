@extends("master")

<!DOCTYPE html>

<?php
    $user="";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Formula Fast</title>
    </head>
    <body>
        <table id = "table" style="width:100%">
            <tr>
                <th><img src="F1logo.jpg" alt="F1 logo" width="100%" id="mainLogo"></th>
                <th colspan = "2" > <h1>Formula fast</h1></th>
            </tr>
            <tr>
                <td width = 33% align = "left" rowspan = '4'><ul> <li><a href="homepage">Homepage</a></li>
                                                                  <li><a href="championschip">Championship</a></li>
                                                                  <li><a href="howToWin">How to win</a></li>
                                                                  <li><a href="driverInfo">Driver info</a></li>
                                                                  <li><a href="teamInfo">Team info</a></li>
                                                                  <li><a href="calender">Calendar</a></li>
                                                                  </ul>
                </td>
            </tr>
            <tr>
                <td width=33%>
                    <form method="post">
                    @method('GET')
                    Username: <input type="text" name="username">
                    First name: <input type="text" name="first_name">
                    Last name: <input type="text" name="last_name">
                    Password: <input type="text" name="password">
                    Age: <input type="text" name="age">
                    <input type="submit" name="button1" value="Create account"/>
                    </form>
                    <?php
                        if(isset($_POST['button1'])) {
                            if($_POST['username'] != "" || $_POST['first_name'] != "" || $_POST['last_name'] || $_POST['password'] != "" || $_POST['age'] != ""){
                                $pythondb_url = "http://127.0.0.1:5000/api/users";
                                $pythondb_json = file_get_contents($pythondb_url);                                        //saving the contents of the json
                                $pythondb_array = json_decode($pythondb_json, true);
                                $createAcc = 1;
                                foreach($pythondb_array as $item){
                                  if($item['username'] == $_POST['username']){
                                    $createAcc = 0 ;
                                  }
                                }
                                if($createAcc == 0){
                                    echo "username taken";
                                }else{
                                    $curl = curl_init();

                                    curl_setopt_array($curl, array(
                                      CURLOPT_URL => 'http://127.0.0.1:5000/api/users',
                                      CURLOPT_RETURNTRANSFER => true,
                                      CURLOPT_ENCODING => '',
                                      CURLOPT_MAXREDIRS => 10,
                                      CURLOPT_TIMEOUT => 0,
                                      CURLOPT_FOLLOWLOCATION => true,
                                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                      CURLOPT_CUSTOMREQUEST => 'POST',
                                      CURLOPT_POSTFIELDS =>'{
                                        "username": "'.$_POST['username'].'",
                                        "password": "'.$_POST['password'].'",
                                        "first_name": "'.$_POST['first_name'].'",
                                        "last_name": "'.$_POST['last_name'].'",
                                        "age" : '. $_POST['age'] .'
                                    }',
                                      CURLOPT_HTTPHEADER => array(
                                        'Content-Type: application/json'
                                      ),
                                    ));

                                    $response = curl_exec($curl);

                                    curl_close($curl);
                                    echo "account created";
                                    $user= $_POST['username'];
                                }
                            }
                        }
                    ?>
                </td>
                <td>
                    <form method="post">
                    @method('GET')
                    Username: <input type="text" name="login_username">
                    Password: <input type="text" name="login_password">
                    <input type="submit" name="button2"
                    value="Log in"/>
                    </form>
                    <?php
                        if(isset($_POST['button2'])) {
                            if($_POST['login_username'] != "" || $_POST['login_password'] != ""){
                                $pythondb_url = "http://127.0.0.1:5000/api/users";
                                $pythondb_json = file_get_contents($pythondb_url);                                        //saving the contents of the json
                                $pythondb_array = json_decode($pythondb_json, true);
                                foreach($pythondb_array as $item){
                                  if($item['username'] == $_POST['login_username']){
                                    if($item['password']== $_POST['login_password']){
                                        $user = $item['username'];
                                    }
                                  }
                                }
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        echo "<h2>logged in as: " . $user . "</h2>"
                    ?>
                    <form method="post">
                        @method('GET')
                        <input type="submit" name="button3"
                        value="Log out"/>
                    </form>
                    <?php
                        if(isset($_POST['button3'])) {
                            $user = "";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>comment</td>
            </tr>
        </table>
    </body>
</html>
