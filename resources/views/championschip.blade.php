@extends("master")

<?php
  $year = date("Y");
  $championship_url = 'https://ergast.com/api/f1/' . urlencode($year) .'/driverStandings.json';       //URL going to json of current season

  $championship_json = file_get_contents($championship_url);                                        //saving the contents of the json
  $championship_array = json_decode($championship_json, true);                                      //save it as an array

  $teamchampionship_url = 'http://ergast.com/api/f1/'. urlencode($year) .'/constructorstandings.json';
  $teamchampionship_json = file_get_contents($teamchampionship_url);                                        //saving the contents of the json
  $teamchampionship_array = json_decode($teamchampionship_json, true);                                      //save it as an array
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
                <td width = 33%><h1>Drivers chamionship</h2></td>
                <td width = 33%><h1>Teams chamionship</h2></td>
            </tr>
             <?php

                $iteration_number = 0;
                $teamchampionship_array_simplyfy = $teamchampionship_array['MRData']['StandingsTable']['StandingsLists'][0]['ConstructorStandings'];
                foreach($teamchampionship_array_simplyfy as $teamarray){
                    $teamname = $teamarray['Constructor']['name'];
                    $teamnameArray[$iteration_number] = $teamarray['Constructor']['name'];
                    $teampos[$iteration_number] = $teamarray['position'];
                    $teampoints[$iteration_number] = $teamarray['points'];
                    $teamnationality[$iteration_number] = $teamarray['Constructor']['nationality'];
                    /*//wikitest
                    $wikiurl = $teamarray['Constructor']['url'];
                    $placeInStr = strpos($wikiurl, "wiki/");
                    //$wikiname = urlencode(substr($wikiurl, $placeInStr+5, -1));
                    $wikiname = str_replace("_", " ", substr($wikiurl, $placeInStr+5, null));
                    echo $wikiname;
                    //*/
                    //api for getting the picture of wikipedia
                        //getting the wikiID from api 1
                        $wikiid_json_url = 'https://en.wikipedia.org/w/api.php?action=query&formatversion=2&prop=pageimages%7Cpageterms&titles='.urlencode($teamname).'&format=json';
                        $wikiid_json = file_get_contents($wikiid_json_url);                                        //saving the contents of the json
                        $wikiid_array = json_decode($wikiid_json, true);                                            //save it as an array
                        $wikiid = $wikiid_array['query']['pages'][0]['pageid'];

                        //getting the picture from api 2
                        $picture_json_url = 'https://en.wikipedia.org/w/api.php?action=query&titles='.urlencode($teamname).'&prop=pageimages&format=json&pithumbsize=200';
                        $picture_json = file_get_contents($picture_json_url);                                        //saving the contents of the json
                        $picture_array = json_decode($picture_json, true);
                        if(isset($picture_array['query']['pages'][$wikiid]['thumbnail'])){
                            $teamwikipicture_url[$iteration_number] = $picture_array['query']['pages'][$wikiid]['thumbnail']['source'];
                        }else{
                            $teamwikipicture_url[$iteration_number] = "Sorry, picture not found";
                        }
                    $iteration_number=$iteration_number+1;
                }
                $iteration_number = 0;
                if (!empty($championship_array)) {                                                      //only when there is something in the array
                    foreach ($championship_array['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] as $item) {            //for each race in the folder racetable in the folder mrdata
                        $position = $item['position'];
                        $drivername1 = $item['Driver']['givenName'];
                        $drivername2 = $item['Driver']['familyName'];
                        $drivernumber = $item['Driver']['permanentNumber'];
                        $teamname = $item['Constructors'][0]['name'];
                        $wins = $item['wins'];
                        $points = $item['points'];

                        //api for getting the picture of wikipedia
                            //getting the wikiID from api 1
                        $wikiid_json_url = 'https://en.wikipedia.org/w/api.php?action=query&formatversion=2&prop=pageimages%7Cpageterms&titles='.urlencode($drivername1).urlencode(" ").urlencode($drivername2).'&format=json';
                        $wikiid_json = file_get_contents($wikiid_json_url);                                        //saving the contents of the json
                        $wikiid_array = json_decode($wikiid_json, true);                                            //save it as an array
                        $wikiid = $wikiid_array['query']['pages'][0]['pageid'];

                            //getting the picture from api 2
                        $picture_json_url = 'https://en.wikipedia.org/w/api.php?action=query&titles='.urlencode($drivername1).urlencode(" ").urlencode($drivername2).'&prop=pageimages&format=json&pithumbsize=200';
                        $picture_json = file_get_contents($picture_json_url);                                        //saving the contents of the json
                        $picture_array = json_decode($picture_json, true);
                        if(isset($picture_array['query']['pages'][$wikiid]['thumbnail'])){
                            $wikipicture_url = $picture_array['query']['pages'][$wikiid]['thumbnail']['source'];
                        }else{
                            $wikipicture_url = "Sorry, picture not found";
                        }

                        //echo "<tr><td><img height='100%' alt='Sorry, picture not found' src=".$wikipicture_url."><h1>".$position."</h1><h2>".$drivername1. " ". $drivername2.", ".$drivernumber."</h2><h3>".$teamname."</h3><p> amount of points: ".$points."</p></td></tr>";

                        echo "<tr>";
                            if($iteration_number < count($teamchampionship_array_simplyfy)){
                                echo "<td><img height='100%' alt='Sorry, picture not found' src=" . $wikipicture_url . "><h1>" . $position . "</h1><h2>" . $drivername1 . " " . $drivername2 . ", " . $drivernumber . "</h2><h3>" . $teamname . "</h3><p> amount of points: " . $points . "</p></td>"//drivers
                                ."<td><img height='100%' alt='Sorry, picture not found' src=" . $teamwikipicture_url[$iteration_number] . "><h1>" . $teampos[$iteration_number] . "</h1><h2>". $teamnameArray[$iteration_number] . "</h2><h3>". $teamnationality[$iteration_number]. "</h3><p>amount of points: ". $teampoints[$iteration_number]."</p></td>";//teams
                             }else{
                                echo "<td><img height='100%' alt='Sorry, picture not found' src=" . $wikipicture_url . "><h1>" . $position . "</h1><h2>" . $drivername1 . " " . $drivername2 . ", " . $drivernumber . "</h2><h3>" . $teamname . "</h3><p> amount of points: " . $points . "</p></td>";//drivers
                             }
                        echo"</tr>";
                        $iteration_number=$iteration_number+1;
                    }
                }
             ?>
        </table>
    </body>
</html>
