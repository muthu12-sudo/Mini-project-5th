<!DOCTYPE html>
<html>
<head>
<title>Connecting  MYSQL  Server</title>
<style type="text/css">
#chart-container {
    width:900px;
    margin: auto;    
	border:orange 4px solid;
    box-shadow: 5px 5px grey;  
    padding: 4px; 

}
table,tr,td{
    text-align: center;
    border-collapse: collapse;
}
th{
    background-color: rgba(153,204,255,0.7)
}
</style>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="Chart.min.js"></script>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demodb";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$query="SELECT * FROM cricket ";
$result=mysqli_query($conn,$query)or die("query failed:".mysql_error());

//Table
echo "<h1><center>Cricket Database</center></h1>";
echo"<center><table width='600px' cellpadding='8' border='1'>";
echo"<tr>";
echo"<th>Name</th><th>No of Wickets</th>";
echo"</tr>";
while($row=mysqli_fetch_array($result))
{
echo"<tr>";
echo"<td>",$row['name'],"</td><td>",$row['wicket'],"</td>";
echo"</tr>";
}
echo "</table> </center>";
?>

<!--Chart-->
<br>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

<!--Script From Chart.js-->
    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var player_name = [];
                    var no_wicket = [];

                    for (var i in data) {
                        player_name.push(data[i].name);
                        no_wicket.push(data[i].wicket);
                    }

                    var chartdata = {
                        labels: player_name,
                        datasets: [
                            {
                                label: 'Wickets',
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                hoverBackgroundColor: 'rgba(255, 255, 0, 0.6)',
                                data: no_wicket,
                            }]  

                    };
                   var options={
                        scales:{
                            yAxes:[{
                                ticks:{
                                    beginAtZero:true,
                                    min:0,
                                    max:10
                                }
                            }]
                        }
                    };
                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options:options
                    });
                });
            }
        }
        </script>
</body>
</html>