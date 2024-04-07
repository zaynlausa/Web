<?php

include 'connect.php';

$a = $_POST['username'];
$b = $_POST['password'];
$c = $_POST['email'];
$d = $_POST['fname'];
$e = $_POST['mname'];
$f = $_POST['lname'];
$g = $_POST['phonenum'];
$h = $_POST['region1'];
$i = $_POST['province1'];
$j = $_POST['city1'];
$k = $_POST['barangay'];
$l = $_POST['secret_ques'];
$m = $_POST['answer'];

// Prepare INSERT statement
$stmt = $db->prepare("INSERT INTO students (username, pwd, email, first_name, middle_name, last_name, phone_num, region, province, city, barangay, secret_question, answer) VALUES (:a, MD5(:b), :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m)");

// Bind parameters
$stmt->bindParam(':a', $a);
$stmt->bindParam(':b', $b);
$stmt->bindParam(':c', $c);
$stmt->bindParam(':d', $d);
$stmt->bindParam(':e', $e);
$stmt->bindParam(':f', $f);
$stmt->bindParam(':g', $g);
$stmt->bindParam(':h', $h);
$stmt->bindParam(':i', $i);
$stmt->bindParam(':j', $j);
$stmt->bindParam(':k', $k);
$stmt->bindParam(':l', $l);
$stmt->bindParam(':m', $m);








// Execute statement
try{
  $stmt->execute();
  
  header('Location: ../index.php?msg=Account Created Succesfully');
  exit();
}catch(PDOException){
  header('Location: ../register.php?message=Account Already Created');
  exit();
}


?>