<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Patient, Servicecenter, Record};

class RecordController extends Controller
{
    public function index()
    {
        //
    }

    public function servicecenter($year, $month, $tempatpelayanan)
    {
        return view('admin.kunjungan.index', [
            'records'=> Record::whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('servicecenter_id', $tempatpelayanan)->orderBy('tanggalkunjungan', 'desc')->simplePaginate(10),
            'total'=> count(Record::whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('servicecenter_id', $tempatpelayanan)->orderBy('tanggalkunjungan', 'desc')->get()),
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'servicecenter' => Servicecenter::findOrFail($tempatpelayanan),
            'year' => $year,
            'month' => $month
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
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
