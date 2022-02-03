<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Servicecenter, Servicesubunit, Servicesubunituser, User, Employe, Record};

class ServicesubunitController extends Controller
{
    public function index()
    {
        $servicecenters = Servicecenter::get();
        $servicesubunits = Servicesubunit::get();
        if (count($servicesubunits)):
            foreach ($servicesubunits as $servicesubunit):
                $id = $servicesubunit->id;
                $servicesubunitusers[$id] = Servicesubunituser::where('servicesubunit_id', $servicesubunit->id)->get();
            endforeach;
        else:
            $servicesubunitusers=[];
        endif;

        return view('admin.data.poli.index', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => $servicecenters,
            'servicesubunits' => $servicesubunits,
            'users' => Employe::where('active',1)->orderBy('noduk', 'asc')->get(),
            'servicesubunitusers' => $servicesubunitusers
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'poli' => 'required|max:100'
        ]);

        Servicesubunit::create([
            'poli' => $request->poli
        ]);
        return redirect()->route('admin.servicesubunit')->with('status', 'Poli/sub unit pelayanan berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // dd($servicesubunit = Servicesubunit::findOrFail($id));
        $servicecenters = Servicecenter::get();
        $servicesubunits = Servicesubunit::get();
        $poli = Servicesubunit::findOrFail($id);
        if (count($servicesubunits)):
            foreach ($servicesubunits as $servicesubunit):
                $id = $servicesubunit->id;
                $servicesubunitusers[$id] = Servicesubunituser::where('servicesubunit_id', $servicesubunit->id)->get();
            endforeach;
        else:
            $servicesubunitusers=[];
        endif;

        return view('admin.data.poli.edit', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => $servicecenters,
            'servicesubunits' => $servicesubunits,
            'poli' => $poli,
            'users' => Employe::where('active',1)->orderBy('noduk', 'asc')->get(),
            'servicesubunitusers' => $servicesubunitusers
        ]);
    }

    public function update(Request $request, $id)
    {
        $poli = Servicesubunit::findOrFail($id);
        $request->validate([
            'poli' => 'required|max:100'
        ]);

        Servicesubunit::where('id',$id)->update([
            'poli' => $request->poli
        ]);
        return redirect()->route('admin.servicesubunit')->with('status', 'Poli/sub unit pelayanan berhasil diubah');
    }

    public function destroy($id)
    {
        $servicesubunit = Servicesubunit::where('id', $id)->firstOrFail();
        $records = Record::where('servicesubunit_id', $id)->count();
        if ($records):
            return redirect()->route('admin.servicesubunit')->with('gagal', $servicesubunit->poli.' tidak dapat dihapus');
        else:
            $servicesubunitusers = Servicesubunituser::where('servicesubunit_id', $id)->get();
                foreach($servicesubunitusers as $user):
                    $user->delete();
                endforeach;
            $deleteservicesubunit = $servicesubunit->delete();
            return redirect()->route('admin.servicesubunit')->with('status', $servicesubunit->poli.' berhasil dihapus');
        endif;
    }

    public function adduser(Request $request, $poli)
    {
        $servicesubunit = Servicesubunit::findOrFail($poli);

        $request->validate([
            'employe_id' => 'required'
        ]);
        
        Servicesubunituser::create([
            'servicesubunit_id' => $servicesubunit->id,
            'employe_id' => $request->employe_id,
        ]);
        return redirect()->route('admin.servicesubunit')->with('status', 'User berhasil ditambahkan');
        
    }

    public function deleteuser($poli, $user)
    {
        $user = Servicesubunituser::where('servicesubunit_id', $poli)->where('employe_id', $user)->firstOrFail();
        $hapus = $user->delete();
        return redirect()->route('admin.servicesubunit')->with('status', 'User berhasil dihapus');
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
