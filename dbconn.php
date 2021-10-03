<?php
//fetch.php
if(isset($_POST["query"]))
{
 //$connect = mysqli_connect("localhost", "root", "", "demo");
 $myPDO = new PDO('sqlite:demo_sqlite.db');

 //$request = mysqli_real_escape_string($connect, $_POST["query"]);
 $request =$_POST["query"];

 $query = "
  SELECT * FROM clients 
  WHERE username LIKE '%".$request."%' 
  OR ntrip_id LIKE '%".$request."%' 
 ";
 //$result = mysqli_query($connect, $query);
 $results=$myPDO->query($query);

 $data =array();
 $html = '';
 $html .= '
  <table class="table table-bordered table-striped">
   <tr>
    <th>Name</th>
    <th>NTRIP Id</th>
    <th>GPS status</th>
   </tr>
  ';
 //if(mysqli_num_rows($result) > 0)
 if($results !== FALSE)
 {
    $data1=$results->fetchAll(); 
    $row_count=count($data1);
    if($row_count > 0){
  //while($row = mysqli_fetch_array($result))
  foreach($data1 as $row)
  {
   $data[] = $row["username"];
   $data[] = $row["ntrip_id"];
   $data[] = $row["GPS_status"];
   $html .= '
   <tr>
    <td>'.$row["username"].'</td>
    <td>'.$row["ntrip_id"].'</td>
    <td>'.$row["GPS_status"].'</td>
   </tr>
   ';
  }
  }
 }
 else
 {
  $data = 'No Data Found';
  $html .= '
   <tr>
    <td colspan="3">No Data Found</td>
   </tr>
   ';
 }
 $html .= '</table>';
 if(isset($_POST['typehead_search']))
 {
  echo $html;
 }
 else
 {
  //$data = array_unique($data);
  echo json_encode($data);
  
 }
}

?>
