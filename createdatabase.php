<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername,$username,$password);

    if($conn->error)
    {
        die("Connection failed: " . $conn->error);
    }

    $db = "CREATE DATABASE IF NOT EXISTS stockdb";

    if($conn->query($db))
    {
        //
    }
    else
    {
        echo "Error in creating database: " .$conn->error;
    }

    $conn = new mysqli($servername,$username,$password,'stockdb');


    // Reading the JSON file
    $json = file_get_contents('data.json');

    // Decode the JSON file 
    // json_decode to decode json string
    $json_data = json_decode($json,true);

    // creating table to store data

    foreach($json_data as $data){

        // create tables based on key of the stock
        $table_name = $data['symbol'];
        // create a table if not exists
        $sql_table = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
            close float NOT NULL,
            high float NOT NULL,
            low float NOT NULL,
            open float NOT NULL,
            symbol VARCHAR(255) NOT NULL,
            volume bigint NOT NULL,
            id VARCHAR(255) NOT NULL,
            s_key VARCHAR(255),
            subkey VARCHAR(255) ,
            date DATE ,
            updated bigint NOT NULL,
            changeOverTime float(53),
            marketChangeOverTime float(53) ,
            uClose float NOT NULL,
            uOpen float NOT NULL,
            uHigh float NOT NULL,
            uLow  float NOT NULL,
            uVolume int NOT NULL,
            fOpen float NOT NULL,
            fClose float NOT NULL,
            fHigh float NOT NULL,
            fLow  float NOT NULL,
            fVolume bigint NOT NULL,
            label VARCHAR(64),
            change_of_stock float(53),
            changePercent float)" ;
        
        if($conn->query($sql_table))
        {
            //
        }
        else
        {
            echo "Table Not Created: " .$conn->error;
        }
        
        $close_index = $data['close'];
        $high_index = $data['high'];
        $low_index = $data['low'];
        $open_index = $data['open'];
        $symbol_of_stock = $data['symbol'];
        $volume_of_stock = $data['volume'];
        $id_of_stock = $data['id'];
        $key_of_stock = $data['key'];
        $subkey_of_stock = $data['subkey'];
        $day = $data['date'];
        $update = $data['updated'];
        $change_of_stock = $data['changeOverTime'];
        $market_change = $data['marketChangeOverTime'];
        $u_close = $data['uClose'];
        $u_open = $data['uOpen'];
        $u_high = $data['uHigh'];
        $u_low = $data['uLow'];
        $u_volume = $data['uVolume'];
        $f_open = $data['fOpen'];
        $f_close = $data['fClose'];
        $f_high = $data['fHigh'];
        $f_low = $data['fLow'];
        $f_volume = $data['fVolume'];
        $s_label = $data['label'];
        $s_change = $data['change'];
        $s_changepercent = $data['changePercent'];

        $sql = "INSERT INTO `{$table_name}` VALUES ('$close_index','$high_index','$low_index','$open_index','$symbol_of_stock',
        '$volume_of_stock','$id_of_stock','$key_of_stock','$subkey_of_stock','$day',
        '$update','$change_of_stock','$market_change','$u_close','$u_open',
        '$u_high','$u_low','$u_volume','$f_open','$f_close','$f_high','$f_low',
        '$f_volume','$s_label','$s_change','$s_changepercent')";
        if(mysqli_query($conn,$sql))
        {
            //
        }
        else
        {
            echo "Insertion Failed" .mysqli_error($conn);
        }
        
    }

?>
    