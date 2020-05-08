<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('jabatan')->get();
        return view("pages.pegawai.index", compact('pegawai'));
    }
    public function create()
    {
        $jabatan = Jabatan::all();
        return view("pages.pegawai.create", compact('jabatan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required|min:9',
            'alamat' => 'required|min:10',
            'jabatan_id' => 'required'
        ]);
        $pegawai = new Pegawai();
        $pegawai->nama = $request->nama;
        $pegawai->no_telp = $request->no_telp;
        $pegawai->alamat = $request->alamat;
        $pegawai->jabatan_id = $request->jabatan_id;
        if ($request->email) {
            $pegawai->email = $request->email;
        }
        if ($pegawai->save()) {
            session()->flash('message', 'Data berhasil disimpan!');
            return redirect()->route('pegawai.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan!');
            return redirect()->route('pegawai.index')->with('status', 'danger');
        }
    }
    public function edit($id)
    {
        $jabatan = Jabatan::all();
        $pegawai = Pegawai::findOrFail($id);
        return view("pages.pegawai.edit", compact('jabatan', 'pegawai'));
    }
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required|min:9',
            'alamat' => 'required|min:10',
            'jabatan_id' => 'required'
        ]);
        $pegawai->nama = $request->nama;
        $pegawai->no_telp = $request->no_telp;
        $pegawai->alamat = $request->alamat;
        $pegawai->jabatan_id = $request->jabatan_id;
        if ($request->email) {
            $pegawai->email = $request->email;
        }
        if ($pegawai->update()) {
            session()->flash('message', 'Data berhasil diubah!');
            return redirect()->route('pegawai.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal diubah!');
            return redirect()->route('pegawai.index')->with('status', 'danger');
        }
    }
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $relasi = Pegawai::with('gaji')->find($id);
        if (count($relasi->gaji) < 1) {
            if ($pegawai->delete()) {
                session()->flash('message', 'Data berhasil dihapus!');
                return redirect()->route('pegawai.index')->with('status', 'success');
            } else {
                session()->flash('message', 'Data gagal dihapus!');
                return redirect()->route('pegawai.index')->with('status', 'danger');
            }
        } else {
            session()->flash('message', 'Data gagal dihapus!');
            return redirect()->route('pegawai.index')->with('status', 'danger');
        }
    }
}
