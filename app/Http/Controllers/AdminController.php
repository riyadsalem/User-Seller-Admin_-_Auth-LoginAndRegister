<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function Index(){
        return view('admin.admin_login');
    } // End method

    public function Dashboard(){
        return view('admin.index');
    } // End method

    public function Login(Request $request){

     //   dd($request->all()); // طريقة من خلالها بيتم اخراج بيانات الي انا دخلتهم وبدي اضيفهم لل Database > token , email , password 
    
     // الفكرة هنا اني بدي اصحي الحارس علشان يشوف هل انا موجود ولا لا علشان لما اجخل يحرسني 

     $check = $request->all();
     if(Auth::guard('admin')->attempt([
         'email' => $check['email'], // 'email' >> email in database >> admin table
         'password' => $check['password']
     ])){
         return redirect()->route('admin.dashboard')->with('error','Admin Login Successfully');
     }else{
         return back()->with('error','Invaild Email Or Password');
     }

    
    }// End method

    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_from')->with('error','Admin Logout Successfully');
    } // End Method

    public function AdminRegister(){
        return view('admin.admin_register');
    } // End Method

    public function AdminRegisterCreate(Request $request){

      //  dd($request->all()); // test

      Admin::insert([
          'name' => $request -> name,
          'email' => $request -> email,
          'password' => Hash::make($request -> password),
          'created_at' => Carbon::now(),
      ]);
      return redirect()->route('login_from')->with('error','Admin Created Successfully');


    } // End Method


}
