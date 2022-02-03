<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Village,Servicecenter, User};
use Illuminate\Support\Facades\{Auth, Hash};

class SettingController extends Controller
{
    public function pengaturan()
    {
        return view('auth.setting', [
            'bulan' => $this->namabulan(),
            'villages' => Village::get(),
            'servicecenters' => Servicecenter::get()
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

    public function password(Request $request)
    {
        Request()->validate([
            'old_password' => 'required|min:4|max:20',
            'new_password' => 'required|min:4|max:20|confirmed'
        ]);

        $id = Auth::user()->id;
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $current_password = Auth::user()->password;

        if (Hash::check($old_password, $current_password)):
            if (Hash::check($new_password, $current_password)):
                return redirect()->route('setting')->with('password', 'Password Baru Sama Dengan Password Lama!');
            else:
                user::where('id', $id)->update([
                    'password' => Hash::make($new_password)
                ]);
                return redirect()->route('setting')->with('password', 'Password Berhasil Diganti');
            endif;
        else:
            return redirect()->route('setting')->with('password', 'Password Lama Salah!');
        endif;
    }
    
    public function username(Request $request)
    {
        $request->validate([
            'username' => 'required|min:4|max:20|unique:users',
            'password' => 'required|min:4|max:30'
        ]);
        
        $id = Auth::user()->id;
        $usernamebaru = $request->username;
        $password = $request->password;
        $usernamelama = Auth::user()->username;
        $current_password = Auth::user()->password;

        if ($usernamebaru == $usernamelama):
            return redirect()->route('setting')->with('username', 'Username baru tidak boleh sama dengan username lama');
        else:
            if (Hash::check($password, $current_password)):
                user::where('id', $id)->update([
                    'username' => $usernamebaru
                ]);
                return redirect()->route('setting')->with('username', 'Username berhasil diganti');
            else:
                return redirect()->route('setting')->with('username', 'Password salah');
            endif;
        endif;
    }
}
