<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Common\Company;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $fileName = '';
        $company = Company::find($request['id']);

        if ($request->hasFile('logo_img')) {
            $file = $request->file('logo_img');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($company->logo_img) {
                Storage::delete('public/images/' . $company->logo_img);
            }
        } else {
            $fileName = $request->company_photo;
        }

        $companyData = [
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'logo_img' => $fileName
        ];

      //  dd($companyData);

        $company->update($companyData);

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
