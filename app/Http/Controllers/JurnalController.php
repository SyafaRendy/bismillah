<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurnal;
use App\Http\Requests\ImageStoreRequest;
use CURLFILE;

class JurnalController extends Controller
{
    public function create(Request $request){   
    $nisn = request()->session()->get('username');
    $tanggal = $_POST["tanggal"];
    $kegiatan = $_POST["kegiatan"];
    $dokumentasi = $_FILES["dokumentasi"];
  
    $path = realpath($dokumentasi['tmp_name']);

    // echo "<pre>";
    // print_r($path);
    // echo "</pre>";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8000/api/create_jurnal',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('nisn' => $nisn,'tanggal' => $tanggal,'kegiatan' => $kegiatan,'dokumentasi'=> new CURLFILE($dokumentasi['tmp_name'])),
        CURLOPT_HTTPHEADER => array(
          'Accept: application/json'
        ),
      ));

    $response = curl_exec($curl);
    $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); 

    curl_close($curl);
    $result = json_decode($response);
    echo "<pre>";
    print_r($result);
    echo "</pre>";

    if($response_code == 200){   
      return redirect()->to('http://localhost:8010/get_jurnal');
        //print_r("data berhasil masuk");
      }else{
          //header('Location: login.html'); 
          print_r("data gagal diinputkan");
          } 
        }

    public function update(Request $request, $id){

        $jurnal= jurnal::find($id);
        $jurnal->nisn=$request->nisn;
        $jurnal->tanggal=$request->tanggal;
        $jurnal->kegiatan=$request->kegiatan;
        $jurnal->dokumentasi=$request->dokumentasi;
        $jurnal->save();

        return "Data Jurnal Terupdate";
    }

    public function delete($id){
        $jurnal= jurnal::find($id);
        $jurnal->delete();

        return "Data Terhapus";
    }

    public function detail($id){
        $jurnal= jurnal::find($id);
        return $jurnal;
    }

    public function index(){

      $nisn = request()->session()->get('username');
        
      $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:8000/api/get_jurnal/'.$nisn,
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

    return view('jurnal', compact('result'));
      
        }

}
