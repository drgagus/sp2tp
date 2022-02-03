<?php

namespace App\Http\Controllers\pustu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Patient, Servicecenter, Servicesubunit, User, Diag, Record};
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function index($tahun, $bulan)
    {
        return view('pustu.kunjungan.index', [
            'records'=> Record::where('servicecenter_id', Auth::user()->servicecenteruser->servicecenter_id)->whereYear('tanggalkunjungan', $tahun)->whereMonth('tanggalkunjungan', $bulan)->orderBy('tanggalkunjungan', 'desc')->simplePaginate(10),
            'total'=> count(Record::where('servicecenter_id', Auth::user()->servicecenteruser->servicecenter_id)->whereYear('tanggalkunjungan', $tahun)->whereMonth('tanggalkunjungan', $bulan)->orderBy('tanggalkunjungan', 'desc')->get()),
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'year' => $tahun,
            'month' => $bulan
        ]);
    }

    public function create($id)
    {
        $patient = Patient::findOrFail($id);
        return view('pustu.kunjungan.create', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicesubunits' => Servicesubunit::get(),
            'diags' => Diag::orderBy('kode', 'asc')->get(),
            'patient' => $patient,
            'usia' => $this->usia($patient->tanggallahir, now())
        ]);
    }

    public function store(Request $request, $id)
    {
        $patient=Patient::findOrFail($id);

        $request->validate([
            'tanggalkunjungan' => 'required',
            'pasien' => 'required',
            'diag_id' => 'required'
        ]);

        $usia = $this->usia($patient->tanggallahir, $request->tanggalkunjungan);
        $record = Record::create([
            'tanggalkunjungan' => $request->tanggalkunjungan,
            'patient_id' => $id,
            'umurtahun' => $usia['tahun'],
            'umurbulan' => $usia['bulan'],
            'umurhari' => $usia['hari'],
            'pasien' => $request->pasien,
            'servicecenter_id' => Auth::user()->servicecenteruser->servicecenter_id,
            'employe_id' => Auth::user()->employe_id,
            'diag_id' => $request->diag_id,
            'catatan' => $request->catatan,
        ]);
        return redirect()->route('pustu.record.yearmonth', ['tahun'=>(int)date('Y', strtotime($request->tanggalkunjungan)), 'bulan'=>(int)date('m', strtotime($request->tanggalkunjungan))])->with('status', 'Kunjungan '.$patient->nama.' berhasil ditambahan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $record = Record::where('id',$id)->where('employe_id', Auth::user()->employe_id)->where('servicecenter_id', Auth::user()->servicecenteruser->servicecenter_id)->firstOrFail();
        $patient = Patient::findOrFail($record->patient_id);
        return view('pustu.kunjungan.edit', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicesubunits' => Servicesubunit::get(),
            'diags' => Diag::orderBy('kode', 'asc')->get(),
            'users' => User::where('id', '>', 2)->get(),
            'record' => $record,
            'patient' => $patient
        ]);
    }

    public function update(Request $request, $id)
    {
        $record=Record::findOrFail($id);

        $request->validate([
            'tanggalkunjungan' => 'required',
            'pasien' => 'required',
            'diag_id' => 'required'
        ]);

        $usia = $this->usia($record->patient->tanggallahir, $request->tanggalkunjungan);
        Record::where('id', $id)->update([
            'tanggalkunjungan' => $request->tanggalkunjungan,
            'patient_id' => $record->patient_id,
            'umurtahun' => $usia['tahun'],
            'umurbulan' => $usia['bulan'],
            'umurhari' => $usia['hari'],
            'pasien' => $request->pasien,
            'servicecenter_id' => Auth::user()->servicecenteruser->servicecenter_id,
            'employe_id' => Auth::user()->employe_id,
            'diag_id' => $request->diag_id,
            'catatan' => $request->catatan,
        ]);
        return redirect()->route('pustu.record.yearmonth', ['tahun'=>(int)date('Y', strtotime($request->tanggalkunjungan)), 'bulan'=>(int)date('m', strtotime($request->tanggalkunjungan))])->with('status', 'Kunjungan '.$record->patient->nama.' berhasil diubah');
    }
    public function destroy($id)
    {
        $record = Record::where('id',$id)->where('employe_id', Auth::user()->employe_id)->where('servicecenter_id', Auth::user()->servicecenteruser->servicecenter_id)->firstOrFail();
        $record->delete();
        return redirect()->route('pustu.record.yearmonth', ['tahun'=>(int)date('Y', strtotime($record->tanggalkunjungan)), 'bulan'=>(int)date('m', strtotime($record->tanggalkunjungan))])->with('status', 'Kunjungan berhasil dihapus');
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
