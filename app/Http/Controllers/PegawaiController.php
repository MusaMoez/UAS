<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::orderBy('created_at', 'DESC')->paginate(10);
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.add');
    }

    public function save(Request $request)
    {
    //VALIDASI DATA
    $this->validate($request, [
        'kode_pegawai' => 'required|string',
        'nama_pegawai' => 'required|string',
        'phone' => 'required|max:13', //maximum karakter 13 digit
        'address' => 'required|string',
        //unique berarti email ditable pegawais tidak boleh sama
        'email' => 'required|email|string|unique:pegawais,email' // format yag diterima harus email
    ]);

    try {
        $pegawai = Pegawai::create([
            'kode_pegawai' => $request->kode_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email
        ]);
        return redirect('/pegawai')->with(['success' => 'Data telah disimpan']);
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id){
    $pegawai = Pegawai::find($id);
    return view('pegawai.edit', compact('pegawai'));
        }

    public function update(Request $request, $id)
{
    $this->validate($request, [
        'kode_pegawai' => 'required|string',
        'nama_pegawai' => 'required|string',
        'phone' => 'required|max:13',
        'address' => 'required|string',
        'email' => 'required|email|string|exists:pegawais,email'
    ]);

    try {
        $pegawai = Pegawai::find($id);
        $pegawai->update([
            'kode_pegawai' => $request->kode_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        return redirect('/pegawai')->with(['success' => 'Data telah diperbaharui']);
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect()->back()->with(['success' => '<strong>' . $pegawai->name . '</strong> Telah dihapus']);
    }
}
