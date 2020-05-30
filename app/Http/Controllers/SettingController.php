<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Toko_setting;
class SettingController extends Controller
{
    public function index(){
        $data = [
            'website'=>website(),
            'logo'=>logo(),
            'nama_toko'=>namaToko(),
            'alamat'=>alamat(),
            'email'=>email(),
            'no_hp'=>no_hp(),
            'nama_bank'=>nama_bank(),
            'no_rekening'=>no_rekening(),
            'nama_rekening'=>nama_rekening(),
            'struk_salam_hormat'=>struk_salam_hormat()            
        ];
        return view('pages.setting.index',compact('data'));
    }
    public function update(Request $request){
        $request->validate([
            'logo'=>[
                'mimes:png','max:10000'
            ],
            'website'=>'required|min:4',
            'nama_toko' =>'required|min:2',
            'alamat'=>'required|min:3',
            'email'=>'required|email',
            'no_hp'=>'required|min:7',
            'nama_bank'=>'required|min:2',
            'nama_rekening'=>'required|min:3',
            'no_rekening'=>'required|min:3',
            'struk_salam_hormat'=>'required|min:4'
        ]);
        if($request->logo){
            $logo = $request->file('logo');
            $newName = rand() . '.' . $logo->getClientOriginalExtension();
            Toko_setting::setLogo($newName);
            $logo->move(public_path('asset_toko'),$newName);
        }
        Toko_setting::setWebsite($request->website);
        Toko_setting::setNamaToko($request->nama_toko);
        Toko_setting::setAlamat($request->alamat);
        Toko_setting::setEmail($request->email);
        Toko_setting::setNoHP($request->no_hp);
        Toko_setting::setNamaBank($request->nama_bank);
        Toko_setting::setNamaRekening($request->nama_rekening);
        Toko_setting::setNoRekening($request->no_rekening);
        Toko_setting::setSalamHormat($request->struk_salam_hormat);
        session()->flash('message', 'Pengaturan toko berhasil diperbarui');
        return redirect()->back()->with('status', 'success');

    }
}
