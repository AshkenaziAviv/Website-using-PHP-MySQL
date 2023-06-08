<?php
session_start();
include "inc_db.php";

// בהתחלה ה id של הכלב שווה ל null
$d_id = null;
// אם יש לאותו משתמש כלב שמשוייך אליך
if( isset( $_SESSION['d_id'] )) {
    $d_id = $_SESSION['d_id'];
}

?>

<!DOCTYPE>
<html dir="rtl">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP include call</title>
    <?php
    if( isset( $d_id )) {
        $sql1 = "SELECT user.u_pname, user.u_fname, `l_datetime`, e_event.e_desc FROM `log` 
             INNER JOIN user ON log.l_user_id=user.u_id 
             INNER JOIN e_event ON log.l_event=e_event.e_id 
             WHERE l_dog_id=$d_id
             ORDER BY log.l_datetime DESC";
        $tableResult = $conn->query($sql1);
    ?>
    <script type="text/javascript" src="loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['table']});
        google.charts.setOnLoadCallback(drawTable);

        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'שם המטפל');
            data.addColumn('string', 'סוג הטיפול');
            data.addColumn('string', 'תאריך ושעה');
            data.addRows([
                <?php
                while ($row = $tableResult->fetch_assoc()) { ?>
                ['<?php echo $row['u_pname'] . ' ' . $row['u_fname']?>', '<?php echo $row['e_desc']; ?>', "<?php echo $row['l_datetime']; ?>"],
                <?php
                }
                ?>
            ]);

            var table = new google.visualization.Table(document.getElementById('table_div'));

            table.draw(data, {showRowNumber: true, width: '80%'});
        }
    </script>
    <?php
    }
    if(isset( $_REQUEST['d_id'])) {
    $d_id = $_REQUEST['d_id'];
    $sql = "SELECT l_dog_id, `l_user_id`, COUNT(`l_user_id`) AS numberOfActivities, user.u_pname, user.u_fname FROM `log` 
        INNER JOIN user ON log.l_user_id=user.u_id 
        WHERE (l_event=1 OR l_event=3 OR l_event=4) AND l_dog_id=$d_id
        GROUP BY l_user_id";
    $chartResult = $conn->query($sql);
    ?>
    <script type="text/javascript">
        google.charts.load("current", {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["שם מטפל", "מספר פעילויות"],
                <?php
                while ($row = $chartResult->fetch_assoc() ) { ?>
                ["<?php echo $row['u_pname'] . ' ' . $row['u_fname'];?>", <?php echo $row['numberOfActivities']; ?>],
                <?php
                }
                ?>

            ]);

            var view = new google.visualization.DataView(data);
            var options = {
                title: "מספר הפעילויות פר בן משפחה",
                width: 600,
                height: 400,
                bar: {groupWidth: "80%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("column_chart"));
            chart.draw(view, options);
        }
    </script>
    <?php
    }
    ?>
</head>
<body style="font-family:Arial">
<h1>דו"ח פעילויות לפי נושא</h1>
<div id="table_div"></div>
<h1> גרף פעילויות</h1>
    <?php
    $u_id = $_SESSION['u_id'];
    $sql = "SELECT dog.* FROM `u_d` INNER JOIN dog ON u_d.d_id=dog.d_id WHERE u_d.u_id=$u_id";
    $result = $conn->query( $sql );
    ?>
    <?php
    $u_id = $_SESSION['u_id'];
    $sql = "SELECT dog.* FROM `u_d` INNER JOIN dog ON u_d.d_id=dog.d_id WHERE u_d.u_id=$u_id";
    $result = $conn->query( $sql );
    ?>

    <form action="q2.php" method="post">
        <table>
            <tr>
                <td>שם הכלב:</td>
                <td>
                    <select name="d_id">
                        <?php
                        while( $dog = $result->fetch_assoc() ) {
                            if( isset( $d_id ) && $d_id == $dog['d_id'] ) {
                                echo '<option value="' . $dog['d_id'] . '" selected="selected">' . $dog['d_name'] . '</option>';
                            }else {
                                echo '<option value="' . $dog['d_id'] . '">' . $dog['d_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <button type="submit">הצג גרף</button>
                </td>
            </tr>
        </table>
    </form>
    <div id="column_chart" style="width: 900px; height: 300px;"></div>
</body>
</html>
