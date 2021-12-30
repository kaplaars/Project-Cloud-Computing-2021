@extends("master")
<?php
   //getting the userinfo
   $pythondb_url = "http://127.0.0.1:5000/api/users";
   $pythondb_json = file_get_contents($pythondb_url);                                        //saving the contents of the json
   $pythondb_array = json_decode($pythondb_json, true);
   foreach($pythondb_array as $item){
    foreach($item as $thing){
        echo $thing;
    }
   }
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
            <th><img src="F1logo.jpg" alt="F1 logo" width="100%" id="mainLogo"></th>
            <th colspan = "2" > <h1>Formula fast</h1></th>
          </tr>
          <tr>
            <td width = 33% align = "center"><h1><a href="highlights">Highlights</a></h1></td>
            <td width = 33% align = "center"><h1><a href="championschip">Championship</a></h1></td>
            <td width = 33% align = "center"><h1><a href="howToWin">How to take the lead</a></h1></td>
          </tr>
          <tr>
            <td><ul><li>hier gaat de comment sectie komen </li></ul></td>
            <td><ul><li>hier gaat een api de huidige kampioenschap data halen </li>
                    <li>API 1 pulls the championship data, who stands where and other information from a DB</li>
                    <li>API 2 gets the wikipedia_ID using the name(API 1) of the driver/team and next the thumbnail</li>
                </ul></td>
            <td><ul><li>API 4 calculates what needs to happen in order for P2 to take the championship lead</li></td>
          </tr>
          <tr>
            <td align = "center"><h1><a href="driverInfo">Driver info</a></h1></td>
            <td align = "center"><h1><a href="teamInfo">Team info</a></h1></td>
            <td align = "center"><h1><a href="calender">Calendar</a></h1></td>
          </tr>
          <tr>
            <td><ul><li>API3 gets the latest twitter posts of the current F1 drivers</li></ul></td>
            <td><ul><li>API3 gets the latest twitter posts of the current F1 teams</li></ul></td>
            <td><ul><li>See the full race calendar</li>
                    <li>API 1 pulls the racetracks name, date, country and location from a DB</li>
                    <li>API 2 gets the wikipedia_ID using the name(API 1) of the track and next the thumbnail</li>
                </ul></td>
          </tr>
          <tr>
            <td align = "center"><h1><a href="chanceToWin">Chance to win</a></h1></td>
            <td>
                <h1>API's used</h1>
            </td>
          </tr>
          <tr>
            <td><p><li>hier houd een database bij hoe groot de kans is dat een coureur op een positie finished</li></ul</p></td>
            <td>
                <ol>
                    <li>https://ergast.com/mrd/ :: Everything about formula one.</li>
                    <li>https://en.wikipedia.org/w/api.php :: For getting the wikipediaID of drivers and tracks and it's thumbnail.</li>
                    <li>https://developer.twitter.com/en/portal/dashboard :: Twitter API for pulling the latest tweet of each driver.</li>
                    <li>Self delovped python REST API :: by giving the names and points of 2 drivers, a 2D-array will be created, showing who will take the lead for each possible finishing order</li>
                    <li></li>
                </ol>
            </td>
          </tr>
        </table>
    </body>
</html>
