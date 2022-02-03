<?php

namespace App\Http\Controllers\puskesmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Patient, Servicecenter, Servicesubunit, Record};

class PatientController extends Controller
{
    public function index()
    {
        return view('puskesmas.pasien.index', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'patients' => Patient::simplePaginate(7),
            'count' => Patient::count(),
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
        
        return redirect()->route('puskesmas.patient.result', ['nama'=>$nama, 'nik'=>$nik, 'desa'=>$desa]);
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

        return view('puskesmas.pasien.index', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'patients' => $patients,
            'count' => $patients->count(),
        ]);
    }

    public function village($id)
    {
        return view('puskesmas.pasien.desa', [
            'bulan' => $this->namabulan(),
            'patients' => Patient::where('village_id', $id)->simplePaginate(10),
            'villages' => Village::get(),
            'village' => Village::findOrFail($id),
            'count' => Patient::where('village_id', $id)->count()
        ]);
    }

    public function create()
    {
        return view('puskesmas.pasien.create', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'max:20',
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
        return redirect()->route('puskesmas.record.create', ['id' => $patient->id])->with('status', 'Data pasien berhasil ditambahkan');
    }

    public function show($id)
    {
        return view('puskesmas.pasien.show', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'patient' => Patient::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('puskesmas.pasien.edit', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'patient' => Patient::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'max:20',
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
            'catatan' => $request->catatan,
        ]);
        return redirect()->route('puskesmas.patient', ['id' => $id])->with('status', 'Data pasien berhasil disimpan');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('puskesmas.patient.village', ['desa' => $patient->village_id])->with('status', $patient->nama.' berhasil dihapus');
    }

    public function usia ($tanggallahir, $tanggalkunjungan)
    {
        $tgl_lahir= date('d', strtotime($tanggallahir));
		$bln_lahir= date('m', strtotime($tanggallahir));
		$thn_lahir= date('Y', strtotime($tanggallahir));
    
        $tgl_today = date('d', strtotime($tanggalkunjungan));
		$bln_today= date('m', strtotime($tanggalkunjungan));
		$thn_today = date('Y', strtotime($tanggalkunjungan));

        if ($tgl_today >= $tgl_lahir) {
            $hari = $tgl_today - $tgl_lahir ; 
                if ($bln_today >= $bln_lahir) {
                    $bulan = $bln_today - $bln_lahir ;
                    $tahun = $thn_today - $thn_lahir ;
                }else if ($bln_today < $bln_lahir) {
                    $bulan = ($bln_today + 12 )  - $bln_lahir ;	
                    $tahun = ($thn_today - 1 ) - $thn_lahir ;
                }else{ 
                }
        }else if ($tgl_today < $tgl_lahir) {
            $hari = ($tgl_today + 30 )  - $tgl_lahir ;
                if (($bln_today-1) >= $bln_lahir) {
                    $bulan = ($bln_today-1) - $bln_lahir ;
                    $tahun = $thn_today - $thn_lahir ;
                }else if (($bln_today-1) < $bln_lahir) {
                    $bulan = ($bln_today+11) - $bln_lahir ;
                    $tahun = ($thn_today-1) - $thn_lahir ;
                }else{
                }
        }else{
        }

        $usia = [
                    'tahun' => $tahun, 
                    'bulan' => $bulan, 
                    'hari' => $hari
                ];
        return $usia;
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
