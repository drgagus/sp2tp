<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employe, User};
use Illuminate\Support\Facades\{Auth, Hash};

class LoginController extends Controller
{
    public function formlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $attr = request()->validate([
            'username' => 'required|max:20',
            'password' => 'required|max:20'
        ]);

        $username = $request->username;
        $password = $request->password;
        $cekuser = User::where('username',$username)->first();
        if ($cekuser):
            $cekuser = User::where('username',$username)->first();
            if(Hash::check($request->password, $cekuser->password)):
                if($cekuser->position == 'adminsp2tp'):
                    Auth::attempt($attr);
                    return redirect()->route('admin.dashboard')->with('status', 'selamat datang admin'); 
                else:
                    if ($cekuser->servicecenteruser):
                        if ($cekuser->servicecenteruser->servicecenter_id == 1):
                            Auth::attempt($attr);
                            return redirect()->route('puskesmas.dashboard')->with('status', 'selamat datang '.$cekuser->employe->nama);
                        else:
                            Auth::attempt($attr);
                            return redirect()->route('pustu.dashboard')->with('status', 'selamat datang '.$cekuser->employe->nama);
                        endif;
                    else:
                        return redirect()->route('login')->with('status', 'akses dilarang');
                    endif;
                endif;
            else:
                return redirect()->route('login')->with('status', 'password salah');
            endif;
        else:
            return redirect()->route('login')->with('status', 'username salah');
        endif;
    }
}
