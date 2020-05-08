<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::all();
        return view("pages.jabatan.index", compact('jabatan'));
    }
    public function create()
    {
        return view("pages.jabatan.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gaji_pokok' => 'required|integer',
            'lain_lain' => 'required|integer',
            'deskripsi' => 'required|min:8'
        ]);
        $jabatan = new Jabatan();
        $jabatan->nama = $request->nama;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->lain_lain = $request->lain_lain;
        $jabatan->deskripsi = $request->deskripsi;
        if ($jabatan->save()) {
            session()->flash('message', 'Data berhasil disimpan!');
            return redirect()->route('jabatan.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan!');
            return redirect()->route('jabatan.index')->with('status', 'danger');
        }
    }
    public function edit($id)
    {
        $jabatan = Jabatan::find($id);
        return view("pages.jabatan.edit", compact('jabatan'));
    }
    public function update(Request $request, Jabatan $jabatan)
    {

        $request->validate([
            'nama' => 'required',
            'gaji_pokok' => 'required|integer',
            'lain_lain' => 'required|integer',
            'deskripsi' => 'required|min:8'
        ]);
        $jabatan->nama = $request->nama;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->lain_lain = $request->lain_lain;
        $jabatan->deskripsi = $request->deskripsi;
        if ($jabatan->update()) {
            session()->flash('message', 'Data berhasil diubah!');
            return redirect()->route('jabatan.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal diubah!');
            return redirect()->route('jabatan.index')->with('status', 'danger');
        }
    }
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $relasi = Jabatan::with('pegawai')->find($id);
        if (count($relasi->pegawai) < 1) {
            if ($jabatan->delete()) {
                session()->flash('message', 'Data berhasil dihapus!');
                return redirect()->route('jabatan.index')->with('status', 'success');
            } else {
                session()->flash('message', 'Data gagal dihapus!');
                return redirect()->route('jabatan.index')->with('status', 'danger');
            }
        } else {
            session()->flash('message', 'Data gagal dihapus!');
            return redirect()->route('jabatan.index')->with('status', 'danger');
        }
    }
}
