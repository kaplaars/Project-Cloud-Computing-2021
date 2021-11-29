@extends("master")
<?php
  $calender_url = 'http://ergast.com/api/f1/' . urlencode(date("Y")) .urlencode('.json');

  $calender_json = file_get_contents($calender_url);
  $calender_array = json_decode($calender_json, true);
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
                <td width = 33% align = "left" rowspan = '99'><ul> <li>Homepage</li>
                                                                   <li>Championship</li>
                                                                   <li>Highlights</li>
                                                                   <li>How to win</li>
                                                                   <li>Driver info</li>
                                                                   <li>Team info</li>
                                                              </ul>
                </td>
            </tr>
            <?php
                if (!empty($calender_array)) {
                    foreach ($calender_array['MRData']['RaceTable']['Races'] as $item) {
                        $name = $item['Circuit']['circuitName'];
                        $location = $item['Circuit']['Location']['locality'];
                        $country = $item['Circuit']['Location']['country'];
                        $time = $item['time'];
                        $date = $item['date'];
                        echo "<tr><td><p>".$name."</p><p>".$country.", ".$location."</p><p>".$date.", ".$time."</p></tr>.</td>";
                    }
                }
            ?>
        </table>
    </body>
</html>
