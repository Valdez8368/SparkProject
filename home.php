<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css">

    <title>Credits Transfer</title>
  </head>
  <body>
    <center><h2 style="float:middle">Welcome to the Credit Exchange below are few examples how it's done</h2></center>
    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <select id="from" disabled></select>
        <select id="to"></select>
        <input id="credit"></input>
        <button onclick="move()">Transfer</button>

      </div>

    </div>

    <table style="margin:1em auto;">

    <?php
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
      $names=array();
      $i=0;
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo '<tr><td>'.$row["Name"].'</td><td>'.$row["Mail"].'</td><td>'.$row["Credits"].'</td><td><button id='.$i.' onclick="transfer(this.id)">Transfer</button></td></tr>';
          $names[$i++]=$row["Name"];
        }
      } else {
        echo "nope";
      }
      $i=0;

    ?>
    </table>
  </div>

    <script>
    var ar = <?php echo '["' . implode('", "', $names) . '"]' ?>;
    var modal = document.getElementById('myModal');
    var to=document.getElementById("to");
    var span = document.getElementsByClassName("close")[0];
    var select=document.getElementById("from");
  function transfer(x){
    modal.style.display = "block";
    select.options.length = 0;
    select.options[select.options.length] = new Option(ar[x], x);
    to.options.length = 0;
    for (index in ar){
      if(index!=x)
        to.options[to.options.length]=new Option(ar[index],index);
    }
  }
  function move(){
    var credit=document.getElementById('credit').value;
    var tab="transfer.php/?sender="+select.value+"&reciever="+to.value+"&credit="+credit;
    window.open(tab,"_self");
  }

  span.onclick = function() {
    modal.style.display = "none";
  }


  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
    }
    </script>
