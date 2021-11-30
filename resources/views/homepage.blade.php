@extends("master")

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
            <td width = 33% align = "center"><h1><a href="highlights">Highlights</a></h1></td>
            <td width = 33% align = "center"><h1><a href="championschip">Championship</a></h1></td>
            <td width = 33% align = "center"><h1><a href="howToWin">How to win</a></h1></td>
          </tr>
          <tr>
            <td><ul><li>hier gaat de comment sectie komen </li></ul></td>
            <td><ul><li>hier gaat een api de huidige kampioenschap data halen </li></ul></td>
            <td><ul><li>hier gaat een api berekenen wat er nog gedaan moet worden om te winnen</li>
                    <li>hier houd een database bij hoe groot de kans is dat een coureur op een positie finished</li></ul</td>
          </tr>
          <tr>
            <td align = "center"><h1><a href="driverInfo">Driver info</a></h1></td>
            <td align = "center"><h1><a href="teamInfo">Team info</a></h1></td>
            <td align = "center"><h1><a href="calender">Calendar</a></h1></td>
          </tr>
          <tr>
            <td><ul><li>See the latest news of your favorite racer</li></ul></td>
            <td><ul><li>See the latest news of your favorite team</li></ul></td>
            <td><ul><li>See the full race calendar</li></ul></td>
          </tr>
        </table>
    </body>
</html>
