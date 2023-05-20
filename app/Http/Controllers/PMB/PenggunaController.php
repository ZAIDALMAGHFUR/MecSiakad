<?php

namespace App\Http\Controllers\PMB;

use App\Models\User;
use App\Models\ProfileUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenggunaController extends Controller
{
    public function index()
    {
        
        $user = User::where('roles_id', '4')->get();
        return view('dashboard.master.pengguna.index', compact('user',));
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }

    public function deleteAll()
    {
        $users = User::where('roles_id', 4)->get();
        
        foreach ($users as $user) {
            $user->pendaftarans()->delete();
            $user->pengumumen()->delete();
            $user->delete();
        }
    
        return redirect()->back()->with([
            'success' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
    
    
}
