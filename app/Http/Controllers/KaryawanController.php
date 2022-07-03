<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexKedai()
    {
        $karyawan = DB::select('select * from karyawan where type_id = :type_id', ['type_id' => 3]);
        return view('owner.karyawanKedai', [
            'karyawan'=>$karyawan
        ]);
    }
    public function indexProduksi()
    {
        $karyawan = DB::select('select * from karyawan where type_id = :type_id', ['type_id' => 2]);
    	return view('owner.karyawanproduksi', [
            'karyawan'=>$karyawan
        ]);
    }

    public function indexKedaiHome()
    {
        $karyawan = DB::select('select * from karyawan where type_id = :type_id', ['type_id' => 3]);
    	return view('kedai.karyawanKedaiHome', [
            'karyawan'=>$karyawan
        ]);
    }
    public function indexProduksiHome()
    {
        $karyawan = DB::select('select * from karyawan where type_id = :type_id', ['type_id' => 2]);
    	return view('produksi.karyawanProduksiHome', [
            'karyawan'=>$karyawan
        ]);
    }

    public function indexKedaiDetail($id)
    {
        $karyawan = Karyawan::with('status')->findOrFail($id);
        return view('owner.kedaiDetail', [
            'karyawan'=>$karyawan
        ]);
    }
    public function indexProduksiDetail($id)
    {
        $karyawan = Karyawan::with('status')->findOrFail($id);
    	return view('owner.produksiDetail', [
            'karyawan'=>$karyawan
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createKedai()
    {
        return view('owner.karyawanKedaiTambah');
    }
    public function createProduksi()
    {
        return view('owner.karyawanProduksiTambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeKedai(Request $request)
    {
        $this->validate($request,[
    		'namaKaryawan' => 'required',
    		'noTelepon' => 'required|string|min:10|max:13|unique:karyawan,noTelepon',
    		'alamat' => 'required',
    		'idStatus' => 'required',
    		'type_id' => 'required',[
                'required' => 'Masukkan isian dengan sesuai.',
                'unique' => 'No Telepon '.$request->noTelepon.' sudah terdaftar.'
            ]
    	]);
 
        Karyawan::create([
    		'namaKaryawan' => $request->namaKaryawan,
    		'noTelepon' => $request->noTelepon,
    		'alamat' => $request->alamat,
    		'idStatus' => $request->idStatus,
            'type_id' => $request->type_id
    	]);

        Alert::success('Sukses!', 'Data berhasil disimpan')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
    	return redirect('/karyawanKedai ');
    }
    public function storeProduksi(Request $request)
    {
        $this->validate($request,[
    		'namaKaryawan' => 'required',
    		'noTelepon' => 'required|string|min:10|max:13|unique:karyawan,noTelepon',
    		'alamat' => 'required',
    		'idStatus' => 'required',
            'type_id' => 'required'],[
                'required' => 'Masukkan isian dengan sesuai.',
                'unique' => 'No Telepon '.$request->noTelepon.' sudah terdaftar.'
            ]);
 
        Karyawan::create([
    		'namaKaryawan' => $request->namaKaryawan,
    		'noTelepon' => $request->noTelepon,
    		'alamat' => $request->alamat,
    		'idStatus' => $request->idStatus,
            'type_id' => $request->type_id
    	]);
        
        Alert::success('Sukses!', 'Data berhasil disimpan')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
    	return redirect('/karyawanProduksi ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function editKedai($id)
    {
        $karyawan = Karyawan::with('status')->findOrFail($id);
        return view('owner.karyawanKedaiEdit', ['karyawan' => $karyawan]);
    }
    public function editProduksi($id)
    {
        $karyawan = Karyawan::with('status')->findOrFail($id);
        return view('owner.karyawanProduksiEdit', ['karyawan' => $karyawan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function updateKedai($id, Request $request)
    {
        $this->validate($request,[
            'namaKaryawan' => 'required',
    		'noTelepon' => 'required|string|min:10|max:13|unique:karyawan,noTelepon, ' . $id,
    		'alamat' => 'required',
    		'idStatus' => 'required',
    		'type_id' => 'required',[
                'required' => 'Masukkan isian dengan sesuai.',
                'unique' => 'No Telepon '.$request->noTelepon.' sudah terdaftar.'
            ]
        ]);

        $status;
        if ($request->idStatus == 'Aktif'){
            $status = 1;
        } else if ($request->idStatus == 'Tidak Aktif') {
            $status = 2;
        }

         $karyawan = Karyawan::find($id);
         $karyawan->namaKaryawan = $request->namaKaryawan;
         $karyawan->noTelepon = $request->noTelepon;
         $karyawan->alamat = $request->alamat;
         $karyawan->idStatus = $status;
         $karyawan->type_id = $request->type_id;
         $karyawan->save();
         
         Alert::success('Sukses!', 'Data berhasil disimpan')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
         return redirect('/karyawanKedai');
    }

    public function updateProduksi($id, Request $request)
    {
        $this->validate($request,[
    		'namaKaryawan' => 'required',
    		'noTelepon' => 'required|string|min:10|max:13|unique:karyawan,noTelepon, ' . $id,
    		'alamat' => 'required',
    		'idStatus' => 'required',
            'type_id' => 'required',[
                'required' => 'Masukkan isian dengan sesuai.',
                'unique' => 'No Telepon '.$request->noTelepon.' sudah terdaftar.'
            ]
         ]);
         
         $status;
         if ($request->idStatus == 'Aktif'){
             $status = 1;
         } else if ($request->idStatus == 'Tidak Aktif') {
             $status = 2;
         }

         $karyawan = Karyawan::find($id);
         $karyawan->namaKaryawan = $request->namaKaryawan;
         $karyawan->noTelepon = $request->noTelepon;
         $karyawan->alamat = $request->alamat;
         $karyawan->idStatus = $status;
         $karyawan->type_id = $request->type_id;
         $karyawan->save();

         Alert::success('Sukses!', 'Data berhasil disimpan')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
         return redirect('/karyawanProduksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $karyawan = Karyawan::find($id);
        // $karyawan->delete();
        // return redirect('/karyawanKedai');
    }
    
}
