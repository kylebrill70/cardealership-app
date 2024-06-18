<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salesmodel;
use App\Models\Partsales;
use Illuminate\Support\Facades\DB;

class Sales extends Controller
{
    public function salesIndex(){
    $mostSoldProduct = $this->getMostSoldProduct();
    $totalSalesAmount = $this->getTotalSalesAmount();
    $leastSoldProduct = $this->getLeastSoldProduct();
    $partsMostsold=$this->partsMostsold();
    $partsTotalsale=$this->partsTotalsale();
    $partsLeast=$this->partsLeast();

    return view('sales.sales', compact('mostSoldProduct', 'totalSalesAmount', 'leastSoldProduct','partsMostsold','partsTotalsale','partsLeast'));
    }

    private function getMostSoldProduct()
    {
        return Salesmodel::select('product_name')
            ->groupBy('product_name')
            ->orderByRaw('COUNT(*) DESC')
            ->first();
    }
    private function getTotalSalesAmount()
    {
        return Salesmodel::sum(DB::raw('quantity * price'));
    }
    private function getLeastSoldProduct()
    {
        return Salesmodel::select('product_name')
            ->groupBy('product_name')
            ->orderByRaw('COUNT(*) ASC')
            ->first();
    }
    private function partsMostsold(){
        return Partsales::select('product_name')
            ->groupBy('product_name')
            ->orderByRaw('COUNT(*) DESC')
            ->first();
    }
    private function partsTotalsale(){
        return Partsales::sum(DB::raw('quantity * price'));
    }
    private function partsLeast(){
        return Partsales::select('product_name')
            ->groupBy('product_name')
            ->orderByRaw('COUNT(*) ASC')
            ->first();
    }

}
