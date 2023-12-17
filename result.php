
<?php
      $m=0;
    for($i=1;$i<=4;$i++)
    {
     $s=$_POST['s'.$i];
    $b=$_POST['b'.$i];
    if($s==$b)
     $m=$m+1;
     }
  echo "$s1";
  echo"<h1><center>Your mark is:$m</h1></center>";
    ?>