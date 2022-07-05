<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Common\Company;
use Illuminate\Support\Facades\Session;
use Auth;

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
}
