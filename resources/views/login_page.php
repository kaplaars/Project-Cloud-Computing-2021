<h1>Create account</h1>
                    <?php
                    // define variables and set to empty values
                    $usernameErr = $first_nameErr = $last_nameErr = $passwordErr = $ageErr = "";
                    $username = $first_name = $last_name = $password = $age = "";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      if (empty($_POST["username"])) {
                        $usernameErr = "User name is required";
                      } else {
                        $username = test_input($_POST["username"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                          $usernameErr = "Only letters and white space allowed";
                        }
                      }

                      if (empty($_POST["first_name"])) {
                        $first_nameErr = "First name is required";
                      } else {
                        $first_name = test_input($_POST["first_name"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$first_name)) {
                            $first_nameErr = "Only letters and white space allowed";
                        }
                      }

                      if (empty($_POST["last_name"])) {
                        $last_name = "";
                      } else {
                        $last_name = test_input($_POST["last_name"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$last_name)) {
                            $last_nameErr = "Only letters and white space allowed";
                        }
                      }
                      if (empty($_POST["password"])) {
                        $password = "";
                      } else {
                        $password = test_input($_POST["password"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$password)) {
                            $passwordErr = "Only letters and white space allowed";
                        }
                      }
                      if (empty($_POST["age"])) {
                        $age = "";
                      } else {
                        $age = test_input($_POST["age"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$age)) {
                            $ageErr = "Only letters and white space allowed";
                        }
                      }
                    }

                    function test_input($data) {
                      $data = trim($data);
                      $data = stripslashes($data);
                      $data = htmlspecialchars($data);
                      return $data;
                    }
                    ?>

                    <p><span class="error">* required field</span></p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    @method('GET')
                      Username: <input type="text" name="username" value="<?php echo $username;?>">
                      <span class="error">* <?php echo $usernameErr;?></span>
                      <br><br>
                      First name: <input type="text" name="first_name" value="<?php echo $first_name;?>">
                      <span class="error">* <?php echo $first_nameErr;?></span>
                      <br><br>
                      Last name: <input type="text" name="last_name" value="<?php echo $last_name;?>">
                      <span class="error">* <?php echo $last_nameErr;?></span>
                      <br><br>
                      Password: <input type="text" name="password" value="<?php echo $password;?>">
                      <span class="error">* <?php echo $password;?></span>
                      <br><br>
                      Age: <input type="text" name="age" value="<?php echo $age;?>">
                      <span class="error">* <?php echo $age;?></span>
                      <br><br>
                      <input type="submit" name="submit" value="Create account">
                    </form>

                    <?php
                        if($username != "" || $first_name != "" || $last_name || $password != "" || $age != ""){
                            $pythondb_url = "http://127.0.0.1:5000/api/users";
                            $pythondb_json = file_get_contents($pythondb_url);                                        //saving the contents of the json
                            $pythondb_array = json_decode($pythondb_json, true);
                            $createAcc = 1;
                            foreach($pythondb_array as $item){
                              if($item['username'] == $username){
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
                                    "username": "'.$username.'",
                                    "password": "'.$password.'",
                                    "first_name": "'.$first_name.'",
                                    "last_name": "'.$last_name.'",
                                    "age" : '. $age .'
                                }',
                                  CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                  ),
                                ));

                                $response = curl_exec($curl);

                                curl_close($curl);
                                echo "account created";
                                $user= $username;
                            }
                        }
                    ?>
                </td>
                <td width=33%>
                    <h1>Log in</h1>
                    <?php
                    // define variables and set to empty values
                    $loginusernameErr = $loginpasswordErr = "";
                    $loginusername =$loginpassword = "";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      if (empty($_POST["loginusername"])) {
                        $loginusernameErr = "User name is required";
                      } else {
                        $loginusername = test_input($_POST["loginusername"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$loginusername)) {
                          $loginusernameErr = "Only letters and white space allowed";
                        }
                      }

                      if (empty($_POST["loginpassword"])) {
                        $loginpassword = "";
                      } else {
                        $loginpassword = test_input($_POST["loginpassword"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$loginpassword)) {
                            $loginpasswordErr = "Only letters and white space allowed";
                        }
                      }
                    }
                    ?>

                    <p><span class="error">* required field</span></p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    @method('GET')
                      Username: <input type="text" name="loginusername" value="<?php echo $loginusername;?>">
                      <span class="error">* <?php echo $loginusernameErr;?></span>
                      <br><br>
                      Password: <input type="text" name="loginpassword" value="<?php echo $loginpassword;?>">
                      <span class="error">* <?php echo $loginpassword;?></span>
                      <br><br>
                      <input type="submit" name="submit" value="Log in">
                    </form>

                    <?php
                        if($loginusername != "" || $loginpassword != ""){
                            $pythondb_url = "http://127.0.0.1:5000/api/users";
                            $pythondb_json = file_get_contents($pythondb_url);                                        //saving the contents of the json
                            $pythondb_array = json_decode($pythondb_json, true);
                            foreach($pythondb_array as $item){
                              if($item['username'] == $loginusername){
                                if($item['password']== $loginpassword){
                                    $user = $username;
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
                        if($user == ""){
                            echo "please login if u want to post";
                        }else{
                            echo "logged in as " . $user;
                        }
                    ?>
                </td>
