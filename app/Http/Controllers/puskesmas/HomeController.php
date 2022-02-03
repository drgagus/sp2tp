<?php

namespace App\Http\Controllers\puskesmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Servicecenter, Patient};

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $bulan = [
            '1' => 'Januari', 
            '2' => 'Februari', 
            '3' => 'Maret', 
            '4' => 'April',
            '5' => 'Mei', 
            '6' => 'Juni',
            '7' => 'Juli', 
            '8' => 'Agustus', 
            '9' => 'September', 
            '10' => 'Oktober', 
            '11' => 'November', 
            '12' => 'Desember'
        ];
        return view('puskesmas.dashboard', [
            'countpatient' => Patient::count(),
            'bulan' => $bulan,
            'villages' => Village::get()
        ]);
    }
}
