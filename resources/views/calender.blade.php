@extends("master")
<?php
  $year = date("Y");
  $calender_url = 'http://ergast.com/api/f1/' . urlencode($year) .urlencode('.json');       //URL going to json of current season

  $calender_json = file_get_contents($calender_url);                                        //saving the contents of the json
  $calender_array = json_decode($calender_json, true);                                      //save it as an array
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
                <td width = 33% align = "left" rowspan = '99'><ul> <li><a href="homepage">Homepage</a></li>
                                                                   <li><a href="championschip">Championship</a></li>
                                                                   <li><a href="highlights">Highlights</a></li>
                                                                   <li><a href="howToWin">How to win</a></li>
                                                                   <li><a href="driverInfo">Driver info</a></li>
                                                                   <li><a href="teamInfo">Team info</a></li>
                                                              </ul>
                </td>
            </tr>
            <?php
                if (!empty($calender_array)) {                                                      //only when there is something in the array
                    foreach ($calender_array['MRData']['RaceTable']['Races'] as $item) {            //for each race in the folder racetable in the folder mrdata
                        $name = $item['Circuit']['circuitName'];                                    //get data out of the substructure's
                        $location = $item['Circuit']['Location']['locality'];
                        $country = $item['Circuit']['Location']['country'];
                        $time = $item['time'];
                        $date = $item['date'];
                        $title = $item['Circuit']['url'];

                        //api for getting the picture of wikipedia
                            //getting the wikiID from api 1
                        $wikiid_json_url = 'https://en.wikipedia.org/w/api.php?action=query&formatversion=2&prop=pageimages%7Cpageterms&titles='.urlencode($name).'&format=json';
                        $wikiid_json = file_get_contents($wikiid_json_url);                                        //saving the contents of the json
                        $wikiid_array = json_decode($wikiid_json, true);                                            //save it as an array
                        $wikiid = $wikiid_array['query']['pages'][0]['pageid'];

                            //getting the picture from api 2
                        $picture_json_url = 'https://en.wikipedia.org/w/api.php?action=query&titles='.urlencode($name).'&prop=pageimages&format=json&pithumbsize=200';
                        $picture_json = file_get_contents($picture_json_url);                                        //saving the contents of the json
                        $picture_array = json_decode($picture_json, true);
                        if(isset($picture_array['query']['pages'][$wikiid]['thumbnail'])){
                            $wikipicture_url = $picture_array['query']['pages'][$wikiid]['thumbnail']['source'];
                        }else{
                            $wikipicture_url = "Sorry, picture not found";
                        }
                        ///////////
                        echo "<tr><td><img height='100%' alt='Sorry, picture not found' src=".$wikipicture_url."><p>".$name."</p><p>".$country.", ".$location."</p><p>".$date.", ".$time."</p></td></tr>"; //print out in tabel form
                    }
                }
            ?>
        </table>
    </body>
</html>
