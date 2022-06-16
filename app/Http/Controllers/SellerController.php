<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SellerController extends Controller
{
    public function SellerIndex(){
        return view('seller.seller_login');
    } //END METHOD

    public function SellerDashboard(){
        return view('seller.index');
    }  //END METHOD


    public function SellerLogin(Request $request){
       
            $check = $request->all(); // لو طبعتها حتطلع array
            if(Auth::guard('seller')->attempt([
                'email' => $check['email'], // 'email' >> email in database >> sellers table
                'password' => $check['password']
            ])){
                return redirect()->route('seller.dashboard')->with('error','Seller Login Successfully');
            }else{
                return back()->with('error','Invaild Email Or Password');
            }
         
    }// End method


    public function SellerLogout(){
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login_from')->with('error','Seller Logout Successfully');
    } // End Method


    



}
