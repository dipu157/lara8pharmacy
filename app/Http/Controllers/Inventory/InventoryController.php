<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Medicine\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class InventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->company_id = Auth::user()->company_id;
            $this->user_id = Auth::id();

            return $next($request);
        });
    }


    public function Index()
    {
        $medicine = Medicine::query()
                ->where('company_id', 1)
                ->where('status', true)->get();

        return view('Inventory.medicineStock',compact('medicine'));

    }

    public function shortStockMedicine()
    {
        $medicine = Medicine::query()
                ->where('company_id', 1)
                ->whereColumn('short_stock', '>=','in_stock')
                ->where('status', true)
                ->get();

        // dd($medicine);

        return view('Inventory.medicineShortStock',compact('medicine'));

    }

    public function outStockMedicine()
    {
        $medicine = Medicine::query()
                ->where('company_id', 1)
                ->where('in_stock', '=', 0)
                ->where('status', true)->get();

        //dd($medicine);

        return view('Inventory.medicineOutStock',compact('medicine'));

    }

    public function expiredMedicineList()
    {
        $today = date('Y-m-d');

       // dd($today);

        $medicine = Medicine::query()
                ->where('company_id', 1)
                ->where('expire_date','<', $today)
                ->where('status', true)->get();

               // dd($medicine);

        return view('Inventory.expiredMedicineList',compact('medicine'));

    }

    public function soonExpiredMedicineList()
    {
        $fromDay = Carbon::now()->format('Y-m-d');
        $toDay = Carbon::now()->addMonths(2)->format('Y-m-d');

        $medicine = Medicine::query()
                ->where('company_id', 1)
                ->whereBetween('expire_date',[$fromDay, $toDay])
                ->where('status', true)->get();

               // dd($medicine);

        return view('Inventory.soonExpiredMedicineList',compact('medicine'));

    }
}
