<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\DetailProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;

class DetailProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProduksiStockKopi()
    {
        $produk = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*', DB::raw('MAX(updated_at) as last_updated'), 'produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->groupBy('produk.namaProduk')
            ->get();

        return view('produksi.produksiStockKopi', 
        ['produk'=>$produk
    ]);
    }

    public function indexOwnerStockKopi()
    {
        $produk = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*', DB::raw('MAX(updated_at) as last_updated'), 'produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->groupBy('produk.namaProduk')
            ->get();
    
        return view('owner.ownerStockKopi', [
            'produk'=>$produk
        ]);
    }
    public function indexKedaiStockKopi()
    {
        $produk = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*', DB::raw('MAX(updated_at) as last_updated'), 'produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->groupBy('produk.namaProduk')
            ->get();
        
        return view('kedai.kedaiStockKopi', [
            'produk'=>$produk
        ]);
    }

    public function indexProduksiStockKopiDetail($namaProduk)
    {
        $produk = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*', 'produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->where('produk.namaProduk', '=',  ['namaProduk' => $namaProduk])
            ->groupBy('kategori.kategori')
            ->get();
        
        $price_biji = DB::select('SELECT DISTINCT(detail_produk.hargaPer100Gram) as last_price from detail_produk join produk on produk.id=detail_produk.idProduk where idKategori=1 and namaProduk="'.$namaProduk.'"');
        $price_bubuk = DB::select('SELECT DISTINCT(detail_produk.hargaPer100Gram) as last_price from detail_produk join produk on produk.id=detail_produk.idProduk where idKategori=2 and namaProduk="'.$namaProduk.'"');

        $last_price_biji = [];
        $last_price_bubuk = [];
        
        foreach ($price_biji as $p) {
            $last_price_biji[] = $p->last_price;
        }

        foreach ($price_bubuk as $p) {
            $last_price_bubuk[] = $p->last_price;
        }

        $last_price_biji = array_slice($last_price_biji, -1);
        $last_price_bubuk = array_slice($last_price_bubuk, -1);

        return view('produksi.produksiStockKopiDetail', ['produk'=>$produk], compact('last_price_biji', 'last_price_bubuk'));
    }

    public function indexOwnerStockKopiDetail($namaProduk)
    {
    	
        $produk = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*', 'produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->where('produk.namaProduk', '=',  ['namaProduk' => $namaProduk])
            ->groupBy('kategori.kategori')
            ->get();
    
        $price_biji = DB::select('SELECT DISTINCT(detail_produk.hargaPer100Gram) as last_price from detail_produk join produk on produk.id=detail_produk.idProduk where idKategori=1 and namaProduk="'.$namaProduk.'"');
        $price_bubuk = DB::select('SELECT DISTINCT(detail_produk.hargaPer100Gram) as last_price from detail_produk join produk on produk.id=detail_produk.idProduk where idKategori=2 and namaProduk="'.$namaProduk.'"');
    
        $last_price_biji = [];
        $last_price_bubuk = [];
        
        foreach ($price_biji as $p) {
            $last_price_biji[] = $p->last_price;
        }

        foreach ($price_bubuk as $p) {
            $last_price_bubuk[] = $p->last_price;
        }

        $last_price_biji = array_slice($last_price_biji, -1);
        $last_price_bubuk = array_slice($last_price_bubuk, -1);

        return view('owner.ownerStockKopiDetail', ['produk'=>$produk], compact('last_price_biji', 'last_price_bubuk'));
    }
    
    public function indexKedaiStockKopiDetail($namaProduk)
    {
    	
        $produk = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*','produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->where('produk.namaProduk', '=',  ['namaProduk' => $namaProduk])
            ->groupBy('kategori.kategori')
            ->get();
    
        $price_biji = DB::select('SELECT DISTINCT(detail_produk.hargaPer100Gram) as last_price from detail_produk join produk on produk.id=detail_produk.idProduk where idKategori=1 and namaProduk="'.$namaProduk.'"');
        $price_bubuk = DB::select('SELECT DISTINCT(detail_produk.hargaPer100Gram) as last_price from detail_produk join produk on produk.id=detail_produk.idProduk where idKategori=2 and namaProduk="'.$namaProduk.'"');
        
        $last_price_biji = [];
        $last_price_bubuk = [];
        
        foreach ($price_biji as $p) {
            $last_price_biji[] = $p->last_price;
        }

        foreach ($price_bubuk as $p) {
            $last_price_bubuk[] = $p->last_price;
        }

        $last_price_biji = array_slice($last_price_biji, -1);
        $last_price_bubuk = array_slice($last_price_bubuk, -1);

        return view('kedai.KedaiStockKopiDetail', ['produk'=>$produk], compact('last_price_biji', 'last_price_bubuk'));
    }

    public function indexKedaiStockKopiDashboard()
    {
        $data_penjualan = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*', DB::raw('MAX(updated_at) as last_updated'), 'produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->groupBy('produk.namaProduk')
            ->get();
        
        $produk = DB::table('detail_produk')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"), DB::raw('SUM(jumlahStok) as total_stok'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();

        $mounth = [];
        $stok = [];

        foreach ($produk as $p) {
            $mounth[] = $p->bulan;
            $stok[] = $p->total_stok;
        }

        $mounth_in_dashboard = array_slice($mounth, -5);
        $stok_in_dashboard = array_slice($stok, -5);

        return view('kedai.kedaiHome', compact('data_penjualan', 'produk', 'mounth_in_dashboard', 'stok_in_dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStockKopi()
    {
        $produk = DB::select('SELECT DISTINCT(namaProduk) from produk');

    	return view('produksi.stockKopiTambah', [
            'produk'=>$produk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStockKopi(Request $request)
    {
        $this->validate($request,[
    		'namaProduk' => 'required|string|unique:produk,namaProduk',
    		'jumlahStok' => 'integer',
    		'kategori' => 'required'],[
                'unique' => 'Produk '. $request->namaProduk .' sudah ada. Silahkan ubah stok melalui menu Edit',
            ]
        );

        $produk = DB::select('SELECT COUNT(DISTINCT(namaProduk)) as jumlah_id from produk');

        Produk::create([
            'namaProduk' => $request->namaProduk
        ]);

        foreach ($produk as $p){
            if($request->kategori == 1){
                DetailProduk::create([
                    'idProduk' => $p->jumlah_id + 1,
                    'idKategori' => $request->kategori,
                    'jumlahStok' => $request->jumlahStok,
                    'hargaPer100Gram' => $request->hargaPer100Gram
                ]);
                DetailProduk::create([
                    'idProduk' => $p->jumlah_id + 1,
                    'idKategori' => 2,
                    'jumlahStok' => 0,
                    'hargaPer100Gram' => 0
                ]);
            } else if ($request->kategori == 2){
                DetailProduk::create([
                    'idProduk' => $p->jumlah_id + 1,
                    'idKategori' => $request->kategori,
                    'jumlahStok' => $request->jumlahStok,
                    'hargaPer100Gram' => $request->hargaPer100Gram
                ]);
                DetailProduk::create([
                    'idProduk' => $p->jumlah_id + 1,
                    'idKategori' => 1,
                    'jumlahStok' => 0,
                    'hargaPer100Gram' => 0
                ]);
            }
        }

        Alert::success('Sukses!', 'Data berhasil disimpan')->showConfirmButton($btnText = 'OK', $btnColor = '#4CAF50');
        return redirect('/produksiStockKopi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function editStockKopi($namaProduk, $kategori)
    {
        $produk = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*', 'produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->where([
                ['produk.namaProduk', '=',  ['namaProduk' => $namaProduk]],
                ['kategori.kategori', '=',  ['kategori' => $kategori]]
            ])
            ->groupBy('kategori.kategori')
            ->get();
            
        $price_biji = DB::select('SELECT DISTINCT(detail_produk.hargaPer100Gram) as last_price from detail_produk join produk on produk.id=detail_produk.idProduk where idKategori=1 and namaProduk="'.$namaProduk.'"');
        $price_bubuk = DB::select('SELECT DISTINCT(detail_produk.hargaPer100Gram) as last_price from detail_produk join produk on produk.id=detail_produk.idProduk where idKategori=2 and namaProduk="'.$namaProduk.'"');
        
        $last_price_biji = [];
        $last_price_bubuk = [];
        
        foreach ($price_biji as $p) {
            $last_price_biji[] = $p->last_price;
        }

        foreach ($price_bubuk as $p) {
            $last_price_bubuk[] = $p->last_price;
        }

        $last_price_biji = array_slice($last_price_biji, -1);
        $last_price_bubuk = array_slice($last_price_bubuk, -1);

        return view('produksi.stockKopiEdit', ['produk' => $produk], compact('last_price_biji', 'last_price_bubuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */

    public function updateStockKopi($namaProduk, $kategori, $jumlahStok, $hargaPer100Gram, Request $request)
    {
        $this->validate($request,[
            'idProduk',
            'jumlahStok' => 'integer',
            'idKategori',
            'hargaPer100Gram' => 'integer'
        ]);
        
        $produk = DB::table('detail_produk')
            ->join('produk', 'idProduk', '=', 'produk.id')
            ->join('kategori', 'idKategori', '=', 'kategori.id')
            ->select('detail_produk.*','detail_produk.hargaPer100Gram as hargaPer100Gram', 'produk.namaProduk as namaProduk', 'kategori.kategori as kategori', DB::raw('SUM(jumlahStok) as total_stok'))
            ->where([
                ['produk.namaProduk', '=',  ['namaProduk' => $namaProduk]],
                ['kategori.kategori', '=',  ['kategori' => $kategori]]
            ])
            ->groupBy('kategori.kategori')
            ->get();
        
        foreach ($produk as $p){
            DetailProduk::create([
                'idProduk' => $p->idProduk,
                'jumlahStok' => $jumlahStok - $p->total_stok,
                'idKategori' => $p->idKategori,
                'hargaPer100Gram' => $request->hargaPer100Gram
            ]);

            Alert::success('Sukses!', 'Data berhasil disimpan')->showConfirmButton($btnText = 'OK', $btnColor = '#198754');
            return redirect("/produksiStockKopi/detail/$p->namaProduk");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }

}
