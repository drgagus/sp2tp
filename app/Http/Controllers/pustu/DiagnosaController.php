<?php

namespace App\Http\Controllers\pustu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Servicecenter, Diag};

class DiagnosaController extends Controller
{
    public function diagnosa()
    {
        return view('pustu.diagnosa.index', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get()
        ]);
    }
    
    public function getdiag()
    {
        return response()->json([
            'diagnosa' => Diag::get(['id','kode','diagnosa'])
        ]);
    }

    public function getdiagbykey($diagnosa)
    {
        return response()->json([
            'diagnosa' => Diag::where('diagnosa', 'like', '%'.$diagnosa.'%')->orwhere('kode', 'like', '%'.$diagnosa.'%')->get(['id','kode','diagnosa'])
        ]);
    }

    public function namabulan()
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
        return $bulan ;
    }
}
