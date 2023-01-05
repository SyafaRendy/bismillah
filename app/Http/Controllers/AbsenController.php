<?php

namespace App\Http\Controllers;
use App\Models\absen;

use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function createHadir(Request $request){
      $keterangan = $_POST["keterangan"];
      $tanggal = $_POST["tanggal"];
      
      $nisn = request()->session()->get('username');
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8000/api/create_absen',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('nisn' => $nisn,'tanggal' => $tanggal,'keterangan' => $keterangan),
        CURLOPT_HTTPHEADER => array(
          'Accept: application/json'
        ),
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      $result = json_decode($response);

      return view('formjurnal');
    }

    public function create_tdkhadir(Request $request){
      $keterangan = $_POST["keterangan"];
      $tanggal = $_POST["tanggal"];
      $alasan = $_POST["alasan"];
      $nisn = request()->session()->get('username');
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8000/api/create_absen',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('nisn' => $nisn,'tanggal' => $tanggal,'keterangan' => $keterangan,'alasan' => $alasan),
        CURLOPT_HTTPHEADER => array(
          'Accept: application/json'
        ),
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      $result = json_decode($response);

      return view('formjurnal');
    }

    public function detail($nisn){
        $absen= absen::find($nisn);
        return $absen;
    }

    public function index(){
      $nisn = request()->session()->get('username');

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8000/api/detail_absen/'.$nisn,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS => array(),
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json'
  ),
));


$response = curl_exec($curl);

curl_close($curl);
$result = json_decode($response);

return view('absensi', compact('result'));
    }
}
