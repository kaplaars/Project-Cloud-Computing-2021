@extends("master")

<?php
  $year = date("Y");
  $positions_array = array();
  $iterationnmbr=0;

  $championship_url = 'https://ergast.com/api/f1/' . urlencode($year) .'/driverStandings.json';
  $championship_json = file_get_contents($championship_url);                                        //saving the contents of the json
  $championship_array = json_decode($championship_json, true);                                      //save it as an array


  if (!empty($championship_array)) {
    foreach ($championship_array['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] as $item) {
        $drivername2 = $item['Driver']['familyName'];
        $positions_array[$iterationnmbr] = $drivername2;
        $points_array[$iterationnmbr] = $item['points'];
        $iterationnmbr = $iterationnmbr+1;
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
                <th><img src="F1logo.jpg" alt="F1 logo" width="100%" ></th>
                <th colspan = "99" > <h1>Formula fast</h1></th>
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
                    echo "<td colspan = '99'><h1>How can " . $positions_array[1] ." beat  ". $positions_array[0] . "</h2></td>";

                    $python_url = "http://127.0.0.1:5000/" . urlencode($points_array[0]) ."/". urlencode($positions_array[0]) ."/". urlencode($points_array[1] ."/". urlencode($positions_array[1]));
                    //API/site test code //$python_url = "http://127.0.0.1:5000/" . urlencode(100) ."/". urlencode($positions_array[0]) ."/". urlencode(100) ."/". urlencode($positions_array[1]);
                    $python_json = file_get_contents($python_url);                                        //saving the contents of the json
                    $python_array = json_decode($python_json, true);                                      //save it as an array

                    if (!empty($python_array)) {
                        echo "<tr><td></td><td colspan = '99'><h1>Finishing position of " . $positions_array[1] . "</h1></td></tr>";
                        echo "<tr><td rowspan = '99'><h1>Finishing position of " . $positions_array[0] . "</h1></td></tr>";
                        echo "<tr>";
                        echo "<td></td>";
                        $number = 1;
                        foreach ($python_array['matrix'] as $item){
                            echo "<td>" . $number . "</td>";
                            $number++;
                        }
                        echo "</tr>";
                        $number = 1;
                        foreach ($python_array['matrix'] as $item){
                            echo "<tr>";
                            echo "<td>". $number . "</td>";
                            $number++;
                            foreach($item as $name){
                                if($name != "-1"){
                                    echo "<td>";
                                    echo $name;
                                    echo "</td>";
                                }else{
                                    echo "<td background-color: white>";
                                    echo "";
                                    echo "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    }
                ?>
            </tr>

        </table>
    </body>
</html>
