<?php

session_start();
  if(!isset($_SESSION["login"])){
    header("Location:login.blade.php");
    exit;
  }
  $nisn = $_SESSION["username"];
//   echo $nisn;
//   echo "<br>";
  
  $tanggal = $_POST["tanggal"];
  echo $tanggal;
  echo "<br>";

  $kegiatan = $_POST["kegiatan"];
  echo $kegiatan;
  echo "<br>";


 $update_id = $_POST['id'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8000/api/update_jurnal/'.$update_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PATCH',
  CURLOPT_POSTFIELDS => 
  // array(
  //   'nisn'=> $nisn,
  //   'tanggal'=> $tanggal,
  //   'kegiatan'=> $kegiatan,
  //  'dokumentasi'=> $dokumentasi,
  // ),
  '',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); 

curl_close($curl);
$result = json_decode($response);
echo "<pre>";
print_r($result);
echo "</pre>";
