<?php

namespace App\Http\Controllers\puskesmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\NakesResource;
use App\Models\{Village, Patient, Servicecenter, Servicesubunit, Servicesubunituser, User, Diag, Record};
use Illuminate\Support\Facades\{Auth, DB};


class RecordController extends Controller
{
    public function index($tahun, $bulan)
    {
        return view('puskesmas.kunjungan.index', [
            'records'=> Record::where('servicecenter_id',1)->whereYear('tanggalkunjungan', $tahun)->whereMonth('tanggalkunjungan', $bulan)->orderBy('tanggalkunjungan', 'desc')->simplePaginate(10),
            'total'=> count(Record::where('servicecenter_id',1)->whereYear('tanggalkunjungan', $tahun)->whereMonth('tanggalkunjungan', $bulan)->orderBy('tanggalkunjungan', 'desc')->get()),
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'year' => $tahun,
            'month' => $bulan
        ]);
    }

    public function create($id)
    {
        $patient = Patient::findOrFail($id);
        return view('puskesmas.kunjungan.create', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'patient' => $patient,
            'usia' => $this->usia($patient->tanggallahir, now())
        ]);
    }

    public function store(Request $request, $id)
    {
        $patient=Patient::findOrFail($id);
        $masuk = $request->validate([
            'tanggalkunjungan' => 'required',
            'pasien' => 'required',
            'servicesubunit' => 'required',
            'employe' => 'required',
            'diag' => 'required'
        ]);
        $usia = $this->usia($patient->tanggallahir, $request->tanggalkunjungan);
        $record = Record::create([
            'tanggalkunjungan' => $request->tanggalkunjungan,
            'patient_id' => $id,
            'umurtahun' => $usia['tahun'],
            'umurbulan' => $usia['bulan'],
            'umurhari' => $usia['hari'],
            'pasien' => $request->pasien,
            'servicecenter_id' => 1,
            'servicesubunit_id' => $request->servicesubunit,
            'employe_id' => $request->employe,
            'diag_id' => $request->diag,
            'catatan' => $request->catatan,
        ]);
        return response()->json([
            'pesan' => 'Kunjungan berhasil ditambahkan', 
            'nama' => $record->patient->nama, 
            'poli' => $record->servicesubunit->poli,
            'diagnosa' => $record->diag->diagnosa,
            'tahun' => (int)date('Y', strtotime($request->tanggalkunjungan)),
            'bulan' => (int)date('m', strtotime($request->tanggalkunjungan))
            ]);
    }

    public function show($id)
    {
        return response()->json([
            'record' => Record::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        $record = Record::findOrFail($id);
        $patient = Patient::findOrFail($record->patient_id);
        return view('puskesmas.kunjungan.edit', [
            'record' => $record,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'patient' => $patient
        ]);
    }

    public function update(Request $request, $id)
    {
        $record = Record::findOrFail($id);
        $patient=Patient::findOrFail($record->patient_id);
        $masuk = $request->validate([
            'tanggalkunjungan' => 'required',
            'pasien' => 'required',
            'servicesubunit' => 'required',
            'employe' => 'required',
            'diag' => 'required'
        ]);
        $usia = $this->usia($patient->tanggallahir, $request->tanggalkunjungan);
        Record::where('id',$id)->update([
            'tanggalkunjungan' => $request->tanggalkunjungan,
            'patient_id' => $patient->id,
            'umurtahun' => $usia['tahun'],
            'umurbulan' => $usia['bulan'],
            'umurhari' => $usia['hari'],
            'pasien' => $request->pasien,
            'servicecenter_id' => 1,
            'servicesubunit_id' => $request->servicesubunit,
            'employe_id' => $request->employe,
            'diag_id' => $request->diag,
            'catatan' => $request->catatan,
        ]);
        return response()->json([
            'pesan' => 'Kunjungan berhasil diubah', 
            'nama' => $record->patient->nama, 
            'poli' => $record->servicesubunit->poli,
            'diagnosa' => $record->diag->diagnosa,
            'tahun' => (int)date('Y', strtotime($request->tanggalkunjungan)),
            'bulan' => (int)date('m', strtotime($request->tanggalkunjungan))
            ]);
    }

    public function destroy($id)
    {
        $record = Record::where('id',$id)->where('servicecenter_id', Auth::user()->servicecenteruser->servicecenter_id)->firstOrFail();
        $record->delete();
        return redirect()->route('puskesmas.record.yearmonth', ['tahun'=>(int)date('Y', strtotime($record->tanggalkunjungan)), 'bulan'=>(int)date('m', strtotime($record->tanggalkunjungan))])->with('status', 'Kunjungan '.$record->patient->nama.' berhasil dihapus');
    }

    public function getdiag()
    {
        return response()->json([
            'diagnosa' => Diag::get(['id','kode', 'diagnosa'])
        ]);
    }

    public function poli()
    {
        return response()->json([
            'poli' => Servicesubunit::get(['id','poli'])
        ]);
    }

    public function nakes($id)
    {
        return response()->json([
            'dokter' => DB::table('servicesubunitusers')
            ->where('servicesubunit_id', '=', $id)
            ->rightJoin('employes', 'servicesubunitusers.employe_id', '=', 'employes.id')
            ->select('employe_id','nama')
            ->get()
        ]);
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
