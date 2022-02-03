<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Patient, Servicecenter};

class PatientController extends Controller
{
    public function index()
    {
        return view('admin.pasien.index', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'patients' => Patient::simplePaginate(7),
        ]);
    }
    
    public function search(Request $request)
    {
        if ($request->nama == null):
            $nama= 'all';
        else:
            $nama = $request->nama;
        endif;
        if ($request->nik == null):
            $nik= 'all';
        else:
            $nik = $request->nik;
        endif;
        if ($request->desa == null):
            $desa= 'all';
        else:
            $desa = $request->desa;
        endif;
        
        return redirect()->route('admin.patient.result', ['nama'=>$nama, 'nik'=>$nik, 'desa'=>$desa]);
    }

    public function result($nama, $nik, $desa)
    {
        if ($nama == 'all'):
            if ($nik == 'all'):
                if ($desa == 'all'):
                    $patients = Patient::simplePaginate(7);
                else:
                    $patients = Patient::where('village_id', $desa)->simplePaginate(7);
                endif;
            else:
                if ($desa == 'all'):
                    $patients = Patient::where('nik', $nik)->simplePaginate(7);
                else:
                    $patients = Patient::where('nik', $nik)->where('village_id', $desa)->simplePaginate(7);
                endif;
            endif;
        else:
            if ($nik == 'all'):
                if ($desa == 'all'):
                    $patients = Patient::where('nama', 'like', '%'.$nama.'%')->simplePaginate(7);
                else:
                    $patients = Patient::where('nama', 'like', '%'.$nama.'%')->where('village_id', $desa)->simplePaginate(7);
                endif;
            else:
                if ($desa == 'all'):
                    $patients = Patient::where('nama', 'like', '%'.$nama.'%')->orwhere('nik', $nik)->simplePaginate(7);
                else:
                    $patients = Patient::where('nama', 'like', '%'.$nama.'%')->orwhere('nik', $nik)->where('village_id', $desa)->simplePaginate(7);
                endif;
            endif;
        endif;

        return view('admin.pasien.index', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'patients' => $patients,
        ]);
    }
    
    public function village($id)
    {
        return view('admin.pasien.desa', [
            'bulan' => $this->namabulan(),
            'patients' => Patient::where('village_id', $id)->simplePaginate(10),
            'villages' => Village::get(),
            'village' => Village::findOrFail($id),
            'servicecenters' => Servicecenter::get(),
            'count' => Patient::where('village_id', $id)->count()
        ]);
    }

    public function create()
    {
        return view('admin.pasien.create', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'jeniskelamin' => 'required',
            'tanggallahir' => 'required',
            'village_id' => 'required'
        ]);

        $patient = Patient::create([
            'norm' => $request->norm,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jeniskelamin' => $request->jeniskelamin,
            'tanggallahir' => $request->tanggallahir,
            'village_id' => $request->village_id,
            'kategoripasien' => $request->kategoripasien,
            'nojkn' => $request->nojkn,
            'catatan' => $request->catatan
        ]);
        return redirect()->route('admin.patient.create')->with('status', $request->nama.' berhasil ditambahkan');
    }

    public function show($id)
    {
        return view('admin.pasien.show', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'patient' => Patient::findOrFail($id),
            'servicecenters' => Servicecenter::get()
        ]);
    }

    public function edit($id)
    {
        return view('admin.pasien.edit', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'patient' => Patient::findOrFail($id),
            'servicecenters' => Servicecenter::get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'jeniskelamin' => 'required',
            'tanggallahir' => 'required',
            'village_id' => 'required'
        ]);

        $patient = Patient::where('id',$id)->update([
            'norm' => $request->norm,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jeniskelamin' => $request->jeniskelamin,
            'tanggallahir' => $request->tanggallahir,
            'village_id' => $request->village_id,
            'kategoripasien' => $request->kategoripasien,
            'nojkn' => $request->nojkn,
            'catatan' => $request->catatan
        ]);
        return redirect()->route('admin.patient', ['id' => $id])->with('status', 'Data pasien berhasil disimpan');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('admin.patient.village', ['desa' => $patient->village_id])->with('status', $patient->nama.' berhasil dihapus');
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
