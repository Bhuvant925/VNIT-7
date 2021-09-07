<?php
    require_once('make_connection.php');

    if(isset($_POST['search']))
    {
        $symbol = strtolower($_POST['symbol']);
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        if($from_date < $to_date)
        {
            $sql = "SELECT DISTINCT date,open,high,low,close FROM `{$symbol}` WHERE date >='$from_date' AND date <='$to_date'  ";
            $result = $conn->query($sql);
            
            if(!$result)
            {
                echo 'Error';
            }
            $result_array = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $result_array[] = $row; 
            }
            //echo json_encode($result_array);
            echo "<script>
                var table = ".json_encode($result_array)."
            </script>";
            mysqli_close($conn);
            header('Location:chart.php');
        }
        else
        {
            echo 'NOT SUCCESSFUL' .mysqli_error($conn);
        }
    }
?>