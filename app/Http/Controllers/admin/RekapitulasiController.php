<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Servicecenter, Diag, Record};
use App\Http\Resources\Tahunlb1Resource;
use Illuminate\Support\Facades\DB;

class RekapitulasiController extends Controller
{
    public function yearlb1($year)
    {
        $diags = Diag::simplePaginate(10);
        foreach ($diags as $diag):
            $id = $diag->id;

            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',5)->where('umurtahun', '<=', 9)->where('pasien', 'Lama')->get();
            $countdiag[$id]['5-9']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['5-9']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',5)->where('umurtahun', '<=', 9)->where('pasien', 'Lama')->get();
            $countdiag[$id]['5-9']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['5-9']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',5)->where('umurtahun', '<=', 9)->where('pasien', 'Baru')->get();
            $countdiag[$id]['5-9']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['5-9']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',5)->where('umurtahun', '<=', 9)->where('pasien', 'Baru')->get();
            $countdiag[$id]['5-9']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['5-9']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',10)->where('umurtahun', '<=', 14)->where('pasien', 'Lama')->get();
            $countdiag[$id]['10-14']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['10-14']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',10)->where('umurtahun', '<=', 14)->where('pasien', 'Lama')->get();
            $countdiag[$id]['10-14']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['10-14']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',10)->where('umurtahun', '<=', 14)->where('pasien', 'Baru')->get();
            $countdiag[$id]['10-14']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['10-14']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',10)->where('umurtahun', '<=', 14)->where('pasien', 'Baru')->get();
            $countdiag[$id]['10-14']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['10-14']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',15)->where('umurtahun', '<=', 19)->where('pasien', 'Lama')->get();
            $countdiag[$id]['15-19']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['15-19']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',15)->where('umurtahun', '<=', 19)->where('pasien', 'Lama')->get();
            $countdiag[$id]['15-19']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['15-19']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',15)->where('umurtahun', '<=', 19)->where('pasien', 'Baru')->get();
            $countdiag[$id]['15-19']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['15-19']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',15)->where('umurtahun', '<=', 19)->where('pasien', 'Baru')->get();
            $countdiag[$id]['15-19']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['15-19']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',20)->where('umurtahun', '<=', 44)->where('pasien', 'Lama')->get();
            $countdiag[$id]['20-44']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['20-44']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',20)->where('umurtahun', '<=', 44)->where('pasien', 'Lama')->get();
            $countdiag[$id]['20-44']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['20-44']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',20)->where('umurtahun', '<=', 44)->where('pasien', 'Baru')->get();
            $countdiag[$id]['20-44']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['20-44']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',20)->where('umurtahun', '<=', 44)->where('pasien', 'Baru')->get();
            $countdiag[$id]['20-44']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['20-44']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',45)->where('umurtahun', '<=', 54)->where('pasien', 'Lama')->get();
            $countdiag[$id]['45-54']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['45-54']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',45)->where('umurtahun', '<=', 54)->where('pasien', 'Lama')->get();
            $countdiag[$id]['45-54']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['45-54']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',45)->where('umurtahun', '<=', 54)->where('pasien', 'Baru')->get();
            $countdiag[$id]['45-54']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['45-54']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',45)->where('umurtahun', '<=', 54)->where('pasien', 'Baru')->get();
            $countdiag[$id]['45-54']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['45-54']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',55)->where('umurtahun', '<=', 59)->where('pasien', 'Lama')->get();
            $countdiag[$id]['55-59']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['55-59']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',55)->where('umurtahun', '<=', 59)->where('pasien', 'Lama')->get();
            $countdiag[$id]['55-59']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['55-59']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',55)->where('umurtahun', '<=', 59)->where('pasien', 'Baru')->get();
            $countdiag[$id]['55-59']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['55-59']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',55)->where('umurtahun', '<=', 59)->where('pasien', 'Baru')->get();
            $countdiag[$id]['55-59']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['55-59']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',60)->where('umurtahun', '<=', 69)->where('pasien', 'Lama')->get();
            $countdiag[$id]['60-69']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['60-69']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',60)->where('umurtahun', '<=', 69)->where('pasien', 'Lama')->get();
            $countdiag[$id]['60-69']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['60-69']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',60)->where('umurtahun', '<=', 69)->where('pasien', 'Baru')->get();
            $countdiag[$id]['60-69']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['60-69']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',60)->where('umurtahun', '<=', 69)->where('pasien', 'Baru')->get();
            $countdiag[$id]['60-69']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['60-69']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',70)->where('pasien', 'Lama')->get();
            $countdiag[$id]['>70']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['>70']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',70)->where('pasien', 'Lama')->get();
            $countdiag[$id]['>70']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['>70']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',70)->where('pasien', 'Baru')->get();
            $countdiag[$id]['>70']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['>70']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('umurtahun','>=',70)->where('pasien', 'Baru')->get();
            $countdiag[$id]['>70']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['>70']['baru']['pr'] ++ ;
                endif;
            endforeach;

            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('pasien', 'Lama')->get();
            $countdiag[$id]['lama']['lk'] = 0;
            foreach($counts as $count):
                if($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('pasien', 'Lama')->get();
            $countdiag[$id]['lama']['pr'] = 0;
            foreach($counts as $count):
                if($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('pasien', 'baru')->get();
            $countdiag[$id]['baru']['lk'] = 0;
            foreach($counts as $count):
                if($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->where('pasien', 'baru')->get();
            $countdiag[$id]['baru']['pr'] = 0;
            foreach($counts as $count):
                if($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['baru']['pr'] ++ ;
                endif;
            endforeach;
            
        endforeach;

        
        return view('admin.rekapitulasi.yearlb1', [
            'year' => $year,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'diags' => $diags,
            'countdiag' => $countdiag,
            'count' => Record::whereYear('tanggalkunjungan', $year)->count()
        ]);
    }

    public function yearlb2($year)
    {
        return view('admin.rekapitulasi.yearlb2', [
            'year' => $year,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get()
        ]);
    }

    public function yearlb3($year)
    {
        return view('admin.rekapitulasi.yearlb3', [
            'year' => $year,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get()
        ]);
    }
    
// =============================================================================

    public function monthlb1($year,$month)
    {
        $diags = Diag::simplePaginate(10);
        foreach ($diags as $diag):
            $id = $diag->id;

            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',5)->where('umurtahun', '<=', 9)->where('pasien', 'Lama')->get();
            $countdiag[$id]['5-9']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['5-9']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',5)->where('umurtahun', '<=', 9)->where('pasien', 'Lama')->get();
            $countdiag[$id]['5-9']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['5-9']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',5)->where('umurtahun', '<=', 9)->where('pasien', 'Baru')->get();
            $countdiag[$id]['5-9']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['5-9']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',5)->where('umurtahun', '<=', 9)->where('pasien', 'Baru')->get();
            $countdiag[$id]['5-9']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['5-9']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',10)->where('umurtahun', '<=', 14)->where('pasien', 'Lama')->get();
            $countdiag[$id]['10-14']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['10-14']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',10)->where('umurtahun', '<=', 14)->where('pasien', 'Lama')->get();
            $countdiag[$id]['10-14']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['10-14']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',10)->where('umurtahun', '<=', 14)->where('pasien', 'Baru')->get();
            $countdiag[$id]['10-14']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['10-14']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',10)->where('umurtahun', '<=', 14)->where('pasien', 'Baru')->get();
            $countdiag[$id]['10-14']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['10-14']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',15)->where('umurtahun', '<=', 19)->where('pasien', 'Lama')->get();
            $countdiag[$id]['15-19']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['15-19']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',15)->where('umurtahun', '<=', 19)->where('pasien', 'Lama')->get();
            $countdiag[$id]['15-19']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['15-19']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',15)->where('umurtahun', '<=', 19)->where('pasien', 'Baru')->get();
            $countdiag[$id]['15-19']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['15-19']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',15)->where('umurtahun', '<=', 19)->where('pasien', 'Baru')->get();
            $countdiag[$id]['15-19']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['15-19']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',20)->where('umurtahun', '<=', 44)->where('pasien', 'Lama')->get();
            $countdiag[$id]['20-44']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['20-44']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',20)->where('umurtahun', '<=', 44)->where('pasien', 'Lama')->get();
            $countdiag[$id]['20-44']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['20-44']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',20)->where('umurtahun', '<=', 44)->where('pasien', 'Baru')->get();
            $countdiag[$id]['20-44']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['20-44']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',20)->where('umurtahun', '<=', 44)->where('pasien', 'Baru')->get();
            $countdiag[$id]['20-44']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['20-44']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',45)->where('umurtahun', '<=', 54)->where('pasien', 'Lama')->get();
            $countdiag[$id]['45-54']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['45-54']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',45)->where('umurtahun', '<=', 54)->where('pasien', 'Lama')->get();
            $countdiag[$id]['45-54']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['45-54']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',45)->where('umurtahun', '<=', 54)->where('pasien', 'Baru')->get();
            $countdiag[$id]['45-54']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['45-54']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',45)->where('umurtahun', '<=', 54)->where('pasien', 'Baru')->get();
            $countdiag[$id]['45-54']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['45-54']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',55)->where('umurtahun', '<=', 59)->where('pasien', 'Lama')->get();
            $countdiag[$id]['55-59']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['55-59']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',55)->where('umurtahun', '<=', 59)->where('pasien', 'Lama')->get();
            $countdiag[$id]['55-59']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['55-59']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',55)->where('umurtahun', '<=', 59)->where('pasien', 'Baru')->get();
            $countdiag[$id]['55-59']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['55-59']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',55)->where('umurtahun', '<=', 59)->where('pasien', 'Baru')->get();
            $countdiag[$id]['55-59']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['55-59']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',60)->where('umurtahun', '<=', 69)->where('pasien', 'Lama')->get();
            $countdiag[$id]['60-69']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['60-69']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',60)->where('umurtahun', '<=', 69)->where('pasien', 'Lama')->get();
            $countdiag[$id]['60-69']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['60-69']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',60)->where('umurtahun', '<=', 69)->where('pasien', 'Baru')->get();
            $countdiag[$id]['60-69']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['60-69']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',60)->where('umurtahun', '<=', 69)->where('pasien', 'Baru')->get();
            $countdiag[$id]['60-69']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['60-69']['baru']['pr'] ++ ;
                endif;
            endforeach;
            
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',70)->where('pasien', 'Lama')->get();
            $countdiag[$id]['>70']['lama']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['>70']['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',70)->where('pasien', 'Lama')->get();
            $countdiag[$id]['>70']['lama']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['>70']['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',70)->where('pasien', 'Baru')->get();
            $countdiag[$id]['>70']['baru']['lk'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['>70']['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('umurtahun','>=',70)->where('pasien', 'Baru')->get();
            $countdiag[$id]['>70']['baru']['pr'] = 0;
            foreach ($counts as $count):
                if ($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['>70']['baru']['pr'] ++ ;
                endif;
            endforeach;

            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('pasien', 'Lama')->get();
            $countdiag[$id]['lama']['lk'] = 0;
            foreach($counts as $count):
                if($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['lama']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('pasien', 'Lama')->get();
            $countdiag[$id]['lama']['pr'] = 0;
            foreach($counts as $count):
                if($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['lama']['pr'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('pasien', 'baru')->get();
            $countdiag[$id]['baru']['lk'] = 0;
            foreach($counts as $count):
                if($count->patient->jeniskelamin == 'Laki-laki'):
                    $countdiag[$id]['baru']['lk'] ++ ;
                endif;
            endforeach;
            $counts = Record::where('diag_id', $diag->id)->whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->where('pasien', 'baru')->get();
            $countdiag[$id]['baru']['pr'] = 0;
            foreach($counts as $count):
                if($count->patient->jeniskelamin == 'Perempuan'):
                    $countdiag[$id]['baru']['pr'] ++ ;
                endif;
            endforeach;
            
        endforeach;

        return view('admin.rekapitulasi.monthlb1', [
            'year' => $year,
            'month' => $month,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'diags' => $diags,
            'countdiag' => $countdiag,
            'count' => Record::whereYear('tanggalkunjungan', $year)->whereMonth('tanggalkunjungan', $month)->count()
        ]);
    }
    public function monthlb2($year,$month)
    {
        return view('admin.rekapitulasi.monthlb2', [
            'year' => $year,
            'month' => $month,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get()
        ]);
    }
    public function monthlb3($year,$month)
    {
        return view('admin.rekapitulasi.monthlb3', [
            'year' => $year,
            'month' => $month,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get()
        ]);
    }
// ==================================================================================

public function toptenyear($year)
    {
        return response()->json([
            DB::table('records')
            ->whereYear('tanggalkunjungan', '=', $year)
            ->select('diag_id', DB::raw('count(*) as total'))
            ->groupBy('diag_id')
            ->limit(10)
            ->orderBy('total', 'desc')
            ->get()
        ]);
    }
    public function toptenmonth($year, $month)
    {
        return response()->json([
            DB::table('records')
            ->whereYear('tanggalkunjungan', '=', $year)
            ->whereMonth('tanggalkunjungan', '=', $month)
            ->select('diag_id', DB::raw('count(*) as total'))
            ->groupBy('diag_id')
            ->limit(10)
            ->orderBy('total', 'desc')
            ->get()
        ]);
    }

    public function yeartopten($year)
    {
        return view('admin.rekapitulasi.yeartopten', [
            'year' => $year,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'toptens' => DB::table('records')
                        ->whereYear('tanggalkunjungan', '=', $year)
                        ->select('diag_id', DB::raw('count(*) as total'))
                        ->groupBy('diag_id')
                        ->limit(10)
                        ->orderBy('total', 'desc')
                        ->get()
        ]);
    }

    public function monthtopten($year, $month)
    {
        return view('admin.rekapitulasi.monthtopten', [
            'year' => $year,
            'month' => $month,
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get(),
            'toptens' => DB::table('records')
                        ->whereYear('tanggalkunjungan', '=', $year)
                        ->whereMonth('tanggalkunjungan', '=', $month)
                        ->select('diag_id', DB::raw('count(*) as total'))
                        ->groupBy('diag_id')
                        ->limit(10)
                        ->orderBy('total', 'desc')
                        ->get()
        ]);
    }

// ==================================================================================
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
