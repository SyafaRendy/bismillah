<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|max:25',
            'password' => 'required|confirmed',
            'level' => 'required|max:25'
        ]);

        $user = new user([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level' => $request->level
        ]);
        $user->save();
        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      request()->session()->put('username', $request->input('username'));
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'localhost:8000/api/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('username' => $username,'password' => $password),
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
  
  if($result -> level=='siswa') {
     // Mendapatkan data dari controller "Controller"
     return redirect()->to('http://localhost:8010/get_user');

     // Menampilkan data di halaman user

    // return view('profile');
  }else {
    return view('profileguru');
}

// print_r("masuk login");
}else{
     return view('login');
    // print_r("salah login");
    } 
        }

    public function getUser(Request $request){

      $username = request()->session()->get('username');

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8000/api/get_profile/'.$username,
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
      $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); 

      curl_close($curl);
      $data = json_decode($response, true);

    // return response()->json([
    //     'status' => 'success',
    //     'data' => $data
    // ]);

      
      // echo "<pre>";
      // print_r($result);
      // echo "</pre>";
      // return view('profile', compact('data'));
      return view('profile', [
        'data' => $data
    ]);
          }

          public function getUserguru(Request $request){

            $username = request()->session()->get('username');
      
            $curl = curl_init();
      
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://localhost:8000/api/get_profileguru/'.$username,
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
            $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
      
            curl_close($curl);
            $data = json_decode($response, true);
      
          // return response()->json([
          //     'status' => 'success',
          //     'data' => $data
          // ]);
      
            
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            // return view('profile', compact('data'));
            return view('profileguru', [
              'data' => $data
          ]);
                }

      }
