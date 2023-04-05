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
        $users = User::where('roles_id', 4)->get(); 
        return view('dashboard.master.pengguna.index', compact('users',));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $profileUser = ProfileUsers::where('users_id', $id)->first();
        $profileUser->delete();
        
        return redirect()->back()->with([
            'success', 'Data berhasil dihapus',
            'alert-type' => 'success'
        ]);
    }
    
}
