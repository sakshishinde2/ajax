<?php

$myPDO = new PDO('sqlite:demo_sqlite.db');

if (!$myPDO) {
    echo "Connection failed!";
}else{
    //echo "connection successful";

}

//*get data in json format
$results= $myPDO->query("SELECT * FROM clients");  
if ($results !== null) {
//create an array
    $emparray = array();
    while($row = $results->fetch(PDO::FETCH_ASSOC)){

        $emparray[] = $row;
    }
    echo json_encode($emparray);
}  

?>