<?php
session_start();
if( !isset( $_SESSION['u_id']) ) {
    $_SESSION['error'] = "You must login to the system";
    header("location:index.php");
}
include "inc_db.php";
//print_r( $_REQUEST );
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="Style.css">
</head>

<body>

    <h1>Add special event</h1>
    <button onclick="location.href='root.php'">Home</button>
    <table>
        <tr>
            <td colspan="2">
                <?php
                if( isset( $_SESSION['message'] )) {
                    echo $_SESSION['message'];
                    unset( $_SESSION['message'] );
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <div id="calender"></div>
            </td>
            <td>
                <form action="add_special_event_handle.php" method="post" id="main_form" style="visibility: hidden">
                    <table id='special_event_form'>
                        <tr>
                            <td>Dog name:</td>
                            <td>
                                <select name="d_id">
                                    <?php
                                    $u_id = $_SESSION['u_id'];
                                    $select = "SELECT dog.* FROM `u_d` inner join dog on u_d.d_id=dog.d_id where u_d.u_id=$u_id";
                                    $result = $conn->query( $select );
                                    while ($row = $result->fetch_array( MYSQLI_ASSOC )) { ?>
                                        <option value="<?php echo $row['d_id']; ?>">
                                            <?php echo $row['d_name']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Description:
                            </td>
                            <td><input id='desc' name='description' type='text'></td>
                        </tr>
                        <tr>
                            <td>Date:</td>
                            <td><input type="text" name="dt" id="dt" value=""></td>
                        </tr>
                        <tr>
                            <td>Start time:</td>
                            <td><input id='starttime' name='starthour' type='text' placeholder="For example 12:00, 16:15 etc..."></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input onclick="deleteCalender(currentdate)" name="Reset1" type="button" value="Delete" >
                                <input name="Submit2" type="submit" value="SAVE">
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>


    <br><br>



    <?php
    // שולפים את כל המידע של האירועים המיוחדים מהמסד נתונים
    $select = "SELECT `s_id`, DATE(`s_datetime`) AS dt, `s_desc`, TIME(`s_datetime`) AS starttime FROM `s_event` WHERE s_dog_id=1";
    $result = $conn->query( $select );
    // בשלב הבא בונים את ה data באותו הפורמט שהיה בקובץ טקסט
    $data = [ 'cal' => [] ];
    while ( $row = $result->fetch_array( MYSQLI_ASSOC ) ) {
        $s_desc = json_decode( $row['s_desc'] ); // from json to array (json_decode eqv to JSON.parse )
        $event = ['dt' => $row['dt'], 'desc' => $s_desc->desc, 'starttime' => $row['starttime'] ];
        array_push( $data['cal'], $event  );
    }

    $data = json_encode( $data );
    ?>
    <script>

        mymonth = thisMonth();
        month = CalCreatData(mymonth);		// Current month
        CalMonthShow(month,"calender",mymonth);
        str1='<?php echo $data ?>';

        loadL(str1)
    </script>
</div>
</body>
</html>