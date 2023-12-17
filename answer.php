<!DOCTYPE html>
<html>
    <head></head>
    <title>ONLINE EXAMINATION</title>
    </head>
    <body >
        <h1>ONLINE QUIZ</h1>
        <form action="result.php" method="post">
        <table>
            <?php
            $conn=mysqli_connect("localhost","root","root","lms");
            $qry="select * from quiz";
            $res=mysqli_query($conn,$qry);
            while($row=mysqli_fetch_array($res))
            {
                $a=$a+1;
                $s='s'.$a;
                $b='b'.$a;
                // echo max($row[qno]);
                echo"<tr><td>$row[qno]";
                echo" $row[question]";
                echo"<tr><td><input type=radio name=$s value= $row[option1]>$row[option1]";
                echo"<tr><td><input type=radio name=$s value= $row[option2]>$row[option2]";
                echo"<tr><td><input type=radio name=$s value= $row[option3]>$row[option3]";
                echo"<tr><td><input type=radio name=$s value= $row[option4]>$row[option4]";
                echo"<tr><td><input type=hidden name=$b value= $row[answer]></tr>";
            }
             ?>
             <tr><td><input type="submit" value="submit"> </tr></td></table>
                                </form>
                                <hr><color="red" size="30">
                                </html>
