<?php
  $send=(int)$_GET['sender'];
  $rec=(int)$_GET['reciever'];
  $credit=(int)$_GET['credit'];
  $server='localhost';
  $pass='';
  $user='root';
  $db='bob';
  $conn=new mysqli($server, $user,$pass,$db);
  $sql='';
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM sample";
  $result = $conn->query($sql);
  $credits=array();
  $i=0;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $names[$i]=$row["Name"];
      $credits[$i]=(int)$row["Credits"];
      $i=$i+1;

    }
  }
  $credits[$send]-=$credit;
  if($credits[$send]<0){
    echo "<h1>Insufficent Credits</h2>";
  }
  else{
    $sql="UPDATE sample set Credits='$credits[$send]' WHERE Name='$names[$send]'";
    $reslut=$conn->query($sql);
    $credits[$rec]+=$credit;
    $sql="UPDATE sample set Credits='$credits[$rec]' WHERE Name='$names[$rec]'";
    $reslut=$conn->query($sql);
  }
?>
<meta http-equiv="refresh" content="2;URL='http://localhost/project/home.php'" />
