<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Common\Company;
use Illuminate\Support\Facades\Session;
use Auth;
use Hash;

class HomeController extends Controller
{
    public $company_id;
    public $user_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->company_id = Auth::user()->company_id;
            $this->user_id = Auth::id();

            return $next($request);
        });
    }

    public function templateSettings()
    {
        $company_info = Company::query()
        ->where('status',true)
        ->get();
        
        //dd($company_info);

    	return view('templateSettings',compact('company_info'));
    }

    public function editSettings(Request $request)
    {
        $request->validate([
             'name' => 'required',
             'address' => 'required',
        ]);

        Company::find($request['id'])->update($request->all());
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {

        //dd($request->all());

         $request->validate([
             'current_password' => 'required',
             'password' => 'required|min:6|max:12|string|confirmed',
             'password_confirmation' => 'required',
        ]);

         $user = Auth::user();

         //dd($user);

         if(Hash::check($request->current_password, $user->password)){

            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('changePassword')->with(['success' => "password Update Successfully"]);
         }else{
            return redirect()->route('changePassword')->with(['error' => "password Update Failed"]);
         }
    }
}
