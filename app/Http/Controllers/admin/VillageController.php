<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Servicecenter, Patient};

class VillageController extends Controller
{
    public function index()
    {
        return view('admin.data.desa.index', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'desa' => 'required|max:100'
        ]);

        Village::create([
            'desa' => $request->desa
        ]);
        return redirect()->route('admin.village')->with('status', 'Nama Desa/Kelurahan berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.data.desa.edit', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'village' => Village::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $village = Village::findOrFail($id) ;
        $request->validate([
            'desa' => 'required|max:100'
        ]);

        Village::where('id', $id)->update([
            'desa' => $request->desa
        ]);
        return redirect()->route('admin.village')->with('status', 'Nama Desa/Kelurahan berhasil diubah');
    }

    public function destroy($id)
    {
        $patient = Patient::where('village_id', $id)->count();
        if ($patient):
            return redirect()->route('admin.village')->with('gagal', 'Desa/Kelurahan tidak dapat dihapus');
        else:
            $village = Village::findOrfail($id);
            $village;
            return redirect()->route('admin.village')->with('status', 'Desa/Kelurahan berhasil dihapus');
        endif;
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
