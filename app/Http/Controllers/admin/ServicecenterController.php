<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village, Servicecenter, Servicecenteruser, User, Record};

class ServicecenterController extends Controller
{
    public function index()
    {
        $servicecenters = Servicecenter::get();
        if (count($servicecenters)):
            foreach ($servicecenters as $servicecenter):
                $id = $servicecenter->id;
                $servicecenterusers[$id] = Servicecenteruser::where('servicecenter_id', $servicecenter->id)->get();
            endforeach;
        else:
            $servicecenterusers=[];
        endif;

        return view('admin.data.tempatpelayanan.index', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => $servicecenters,
            'users' => User::where('employe_id', '!=', null)->get(),
            'servicecenterusers' => $servicecenterusers
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'tempatpelayanan' => 'required|max:100'
        ]);

        Servicecenter::create([
            'tempatpelayanan' => $request->tempatpelayanan
        ]);
        return redirect()->route('admin.servicecenter')->with('status', 'Tempat pelayanan berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $servicecenter = Servicecenter::findOrFail($id);
        $servicecenters = Servicecenter::get();
        if (count($servicecenters)):
            foreach ($servicecenters as $servicecenter):
                $id = $servicecenter->id;
                $servicecenterusers[$id] = Servicecenteruser::where('servicecenter_id', $servicecenter->id)->get();
            endforeach;
        else:
            $servicecenterusers=[];
        endif;

        return view('admin.data.tempatpelayanan.edit', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenter' => $servicecenter,
            'servicecenters' => $servicecenters,
            'users' => User::where('id', '>', 2)->get(),
            'servicecenterusers' => $servicecenterusers
        ]);
    }

    public function update(Request $request, $id)
    {
        $servicecenter = Servicecenter::findOrFail($id);
        $request->validate([
            'tempatpelayanan' => 'required|max:100'
        ]);

        Servicecenter::where('id',$id)->update([
            'tempatpelayanan' => $request->tempatpelayanan
        ]);
        return redirect()->route('admin.servicecenter')->with('status', 'Tempat pelayanan berhasil diubah');
    }

    public function destroy($id)
    {
        $servicecenter = Servicecenter::where('id', $id)->firstOrFail();
        $records = Record::where('servicecenter_id', $id)->count();
        if ($records):
            return redirect()->route('admin.servicecenter')->with('gagal', $servicecenter->tempatpelayanan.' tidak dapat dihapus');
        else:
            $servicecenterusers = Servicecenteruser::where('servicecenter_id', $id)->get();
                foreach($servicecenterusers as $user):
                    User::where('id', $user->user_id)->update([
                        'sp2tp' => null
                    ]);
                    $user->delete();
                endforeach;
            $deleteservicecenter = $servicecenter->delete();
            return redirect()->route('admin.servicecenter')->with('status', $servicecenter->tempatpelayanan.' berhasil dihapus');
        endif;
    }

    public function adduser(Request $request, $tempatpelayanan)
    {
        $servicecenter = Servicecenter::findOrFail($tempatpelayanan);

        $request->validate([
            'user_id' => 'required|unique:servicecenterusers'
        ]);

        User::where('id', $request->user_id)->update([
            'sp2tp' => 2
        ]);
        
        Servicecenteruser::create([
            'servicecenter_id' => $servicecenter->id,
            'user_id' => $request->user_id,
        ]);
        return redirect()->route('admin.servicecenter')->with('status', 'User berhasil ditambahkan');
        
    }

    public function deleteuser($tempatpelayanan, $user)
    {
        $user = Servicecenteruser::where('servicecenter_id', $tempatpelayanan)->where('user_id', $user)->firstOrFail();
        $hapus = $user->delete();
        User::where('id',$user->user_id)->update([
            'sp2tp' => null
        ]);
        return redirect()->route('admin.servicecenter')->with('status', 'User berhasil dihapus');
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
