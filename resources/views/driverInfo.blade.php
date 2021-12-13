@extends("master")

<?php
  $year = date("Y");
  $championship_url = 'https://ergast.com/api/f1/' . urlencode($year) .'/driverStandings.json';       //URL going to json of current season

  $championship_json = file_get_contents($championship_url);                                        //saving the contents of the json
  $championship_array = json_decode($championship_json, true);                                      //save it as an array
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formula Fast</title>
    </head>
    <body>
        <table id = "table" style="width:100%">
            <tr>
                <th><img src="F1logo.jpg" alt="F1 logo" width="100%" ></th>
                <th colspan = "2" > <h1>Formula fast</h1></th>
            </tr>
            <tr>
                <td width = 33% align = "left" rowspan = '99'><ul><li><a href="homepage">Homepage</a></li>
                                                                  <li><a href="highlights">Highlights</a></li>
                                                                  <li><a href="howToWin">How to win</a></li>
                                                                  <li><a href="driverInfo">Driver info</a></li>
                                                                  <li><a href="teamInfo">Team info</a></li>
                                                                  <li><a href="calender">Calendar</a></li>
                                                             </ul>
                </td>

             <?php
               require_once('C:\xampp\Project2021\resources\views\TwitterAPIExchange.php');
               /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
               $settings = array(
                   'oauth_access_token' => "2221956523-InqWqQyvin08948QshFIbhlgYC6KQjo8XG769mA",
                   'oauth_access_token_secret' => "p3yRAuort6UWoRx57ZcH68lc4F1KUULeHeKTe8dUiHlFW",
                   'consumer_key' => "tS856CtF6XeBs3gOJO0SFhwFW",
                   'consumer_secret' => "M1RRL5eCXJS5EVKKqFMWLvsRyBte1G1noo7ajKsL4kV1zJEWNp"
               );
               $twitternames=array('max33verstappen','LewisHamilton', 'ValtteriBottas', 'SChecoPerez', 'Charles_Leclerc', 'Carlossainz55', 'LandoNorris', 'danielricciardo', 'PierreGASLY', 'yukitsunoda07', 'alex_albon', 'GuanyuZhou24', 'GeorgeRussell63', 'NicholasLatifi', 'SchumacherMick', 'nikita_mazepin', 'lance_stroll', 'alo_oficial', 'OconEsteban');
               foreach ($twitternames as $item) {
               $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
               $requestMethod = "GET";
               $user = $item;
               $count = 100;

               if (isset($_GET['user'])) { $user = $_GET['user']; }
               if (isset($_GET['count'])) { $count = $_GET['count'];}

               $getfield = "?screen_name=$user&count=$count";
               $twitter = new TwitterAPIExchange($settings);
               $string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),$assoc = TRUE);

               if(isset($string["errors"][0]["message"])) {
                   echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";
                   exit();
               }

               echo '<tr>';
                       echo "<td>";
                       echo "<h1>". $string[0]['user']['name']."<h1/>";
                       echo "<h3>@". $string[0]['user']['screen_name']."</h3>";
                       echo "<p>".substr($string[0]['created_at'],0,16)."</p>";
                       echo "<p style = 'background-color:white; color:black; border:5px solid #00ACEE;'>". $string[0]['text']."</p>";
                       echo "</td>";
               echo '</tr>';
               }
               ?>
            </tr>
        </table>
    </body>
</html>
