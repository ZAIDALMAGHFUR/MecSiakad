<?php

namespace App\Http\Controllers\Admin;

use App\Models\selectedktms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectedKtmController extends Controller
{
    public function index()
    {
        return view('dashboard.master.ktm.index');
    }

    public function ktmsatu()
    {
        return view('dashboard.master.ktm.1');
    }

    public function ktmdua()
    {
        return view('dashboard.master.ktm.ktmdua');
    }

    public function ktmtiga()
    {
        return view('dashboard.master.ktm.ktmtiga');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'ktm_selected' => 'required',
        ]);

        $data = selectedktms::find(1);
        $data->update([
            'ktm_selected' => $request->ktm_selected,
        ]);


        return redirect()->route('ktm')->with([
            'success' => 'Data berhasil diubah',
            'alert-type' => 'success'
        ]);

    }
}
