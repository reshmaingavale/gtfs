<?php

//1] UNZIP the ZIP file

system ('unzip google_transit.zip');
//2] give permission to text files
chmod("routes.txt",0755);
chmod("agency.txt",0755);
chmod("calendar.txt",0755);
chmod("calendar_dates.txt",0755);
chmod("stops.txt",0755);
chmod("stop_times.txt",0755);
chmod("transfers.txt",0755);
chmod("trips.txt",0755);
//3] INSERT TEXT  FILES DATA INTO DATABASE
$con=mysql_connect("localhost","root","");
mysql_select_db("tta-cms",$con);

$row = 1;
if (($handle = fopen("routes.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";

        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";

        }
        echo "rows:".$row."<br>";
        if($row > 1){
            $sql='insert into routes (tta_routes_id,short_name,long_name,description,type,route_url) values ("'.$data[0].'","'.$data[2].'","'.$data[3].'","'.$data[4].'",'.$data[5].',"'.$data[6].'")';
            echo $sql;
            mysql_query($sql,$con);
        }
        $row++;

    }
    fclose($handle);
}

$row = 1;
if (($handle = fopen("stops.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;

        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";

        }
        echo "rows:".$row."<br>";
        if($row > 1){
            $sql='insert into stops (stop_id,lat,lang,zone_id,stop_url) values ('.$data[0].','.$data[4].','.$data[5].',"'.$data[6].'","'.$data[7].'")';

            mysql_query($sql,$con);
        }
        $row++;
    }
    fclose($handle);
}


$row = 1;
if (($handle = fopen("stop_times.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";

        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";

        }
        echo "rows:".$row."<br>";
        if($row > 1){
        $sql='insert into stop_timings (trip_id,arrival_time,departure_time,stop_id,stop_sequence,head_sign,pick_up_type,drop_off_type) values ("'.$data[0].'","'.$data[1].'","'.$data[2].'",'.$data[3].','.$data[4].',"'.$data[5].'",'.$data[6].','.$data[7].')';

        mysql_query($sql,$con);
        }
        $row++;
    }
    fclose($handle);
}

$row = 1;
if (($handle = fopen("trips.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";

        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";

        }
        echo "rows:".$row."<br>";
        if($row > 1){
            $sql='insert into trip (route_id,trip_id,service_id,headsign,direction_id) values ("'.$data[0].'","'.$data[2].'","'.$data[1].'","'.$data[3].'",'.$data[4].')';
        echo $sql;
        mysql_query($sql,$con);
        }
        $row++;
    }
    fclose($handle);
}

$row = 1;
if (($handle = fopen("calendar.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";

        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";

        }
        echo "rows:".$row."<br>";
        if($row > 1){
        $sql='insert into services (service_id,avail_monday,avail_tuesday,avail_wednesday,avail_thursday,avail_friday,avail_saturday,avail_sunday) values ("'.$data[0].'","'.$data[1].'","'.$data[2].'",'.$data[3].','.$data[4].',"'.$data[5].'","'.$data[6].'",'.$data[7].')';
        mysql_query($sql,$con);
        }
        $row++;
    }
    fclose($handle);
}

$row = 1;
if (($handle = fopen("calendar_dates.txt", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";

        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
        echo "rows:".$row."<br>";
        if($row > 1){
             $sql='insert into services_exception (service_id,has_exception) values ("'.$data[0].'","'.$data[2].'")';
        mysql_query($sql,$con);
        }
        $row++;
    }
    fclose($handle);
}
?>