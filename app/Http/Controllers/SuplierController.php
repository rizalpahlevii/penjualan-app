<?php

namespace App\Http\Controllers;

use App\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suplier = Suplier::orderBy("created_at", "DESC")->paginate(10);
        return view("pages.suplier.index", compact('suplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.suplier.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:4',
            'no_hp' => 'required|min:10',
            'kota' => 'required|min:5',
            'alamat' => 'required|min:10',
        ]);
        $suplier = new Suplier();
        $suplier->nama = $request->nama;
        $suplier->no_hp = $request->no_hp;
        $suplier->kota = $request->kota;
        $suplier->alamat = $request->alamat;
        if ($request->website) {
            $suplier->website = $request->website;
        }
        if ($request->email) {
            $suplier->email = $request->email;
        }
        if ($suplier->save()) {
            session()->flash('message', 'Data berhasil disimpan!');
            return redirect()->route('suplier.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan!');
            return redirect()->route('suplier.index')->with('status', 'danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suplier = Suplier::findOrFail($id);
        return view("pages.suplier.edit", compact('suplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:4',
            'no_hp' => 'required|min:10',
            'kota' => 'required|min:5',
            'alamat' => 'required|min:10',
        ]);
        $suplier =  Suplier::find($id);
        $suplier->nama = $request->nama;
        $suplier->no_hp = $request->no_hp;
        $suplier->kota = $request->kota;
        $suplier->alamat = $request->alamat;
        if ($request->website) {
            $suplier->website = $request->website;
        }
        if ($request->email) {
            $suplier->email = $request->email;
        }
        if ($suplier->save()) {
            session()->flash('message', 'Data berhasil diubah!');
            return redirect()->route('suplier.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal diubah!');
            return redirect()->route('suplier.index')->with('status', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suplier = Suplier::find($id);
        $relasiHutang = Suplier::with('hutang')->find($id);
        $relasiPembelian = Suplier::with('pembelian')->find($id);
        if (count($relasiHutang->hutang) < 1 && count($relasiPembelian->pembelian) < 1) {
            if ($suplier->delete()) {
                session()->flash('message', 'Data berhasil dihapus!');
                return redirect()->route('suplier.index')->with('status', 'success');
            } else {
                session()->flash('message', 'Data gagal dihapus!');
                return redirect()->route('suplier.index')->with('status', 'danger');
            }
        } else {
            session()->flash('message', 'Data gagal dihapus!');
            return redirect()->route('suplier.index')->with('status', 'danger');
        }
    }
}
