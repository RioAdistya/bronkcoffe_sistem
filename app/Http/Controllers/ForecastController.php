<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\DetailProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;

class ForecastController extends Controller
{
    public function indexOwnerBijiKopiDashboard() {

        $total_penjualan = DB::table('detail_penjualan')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas) as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
            ->join('produk', 'detail_penjualan.idProduk', '=', 'produk.id')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();

        $biji_kopi = DB::table('detail_bahan_baku')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas)*1000 as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
            ->join('bahan_baku', 'detail_bahan_baku.idBahan', '=', 'bahan_baku.id')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();

        $mounth_sales = [];
        $stok_sales = [];

        foreach ($total_penjualan as $penjualan) {
            $mounth_sales[] = $penjualan->periode;
            $stok_sales[] = $penjualan->total;
        }

        $mounth_sales_in_dashboard = array_slice($mounth_sales, -5);
        $stok_sales_in_dashboard = array_slice($stok_sales, -5);

        $mounth_coffee = [];
        $stok_coffee = [];

        foreach ($biji_kopi as $biji) {
            $mounth_coffee[] = $biji->periode;
            $stok_coffee[] = $biji->total;
        }

        $mounth_coffee_in_dashboard = array_slice($mounth_coffee, -5);
        $stok_coffee_in_dashboard = array_slice($stok_coffee, -5);

        $data_debit = DB::table('detail_penjualan')
            ->select(DB::raw("DATE_FORMAT(created_at, '%M - %Y') as periode"), DB::raw('kuantitas*hargaPer100Gram as total_debit'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();
        
        $data_kredit = DB::table('detail_bahan_baku')
            ->select(DB::raw("DATE_FORMAT(created_at, '%M - %Y') as periode"), DB::raw('kuantitas*hargaSatuan as total_kredit'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();

        $all_debit = [];
        
        foreach($data_debit as $debit){
            $all_debit[] = $debit->total_debit;
        }
        
        return view('owner.home', compact('mounth_sales_in_dashboard', 'stok_sales_in_dashboard', 'mounth_coffee_in_dashboard', 'stok_coffee_in_dashboard','all_debit','data_debit','data_kredit'));
    }

    public function exponentialSmoothing($periode, $dataset)
    {
        // Adaptive Response Rate Single Exponential Smoothing
        // F[periode ke-t] = (alpha[t] * X[t]) + ((1 - alpha[t]) * F[t])
        $X = $dataset; // dataset
        $F = []; // peramalan
        $e = []; // error/kesalahan
        $E = []; // error dihaluskan
        $AE = []; //error absolut
        $alpha = []; // konstanta smoothing
        $beta = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9]; // range alpha
        $PE = []; // persentase error
        $MAPE = []; // rata rata kesalahan

        // perhitungan peramalan menggunakan nilai beta mulai dari 0.1 sampai 0.9
        for($i = 0; $i < count($beta); $i++) {
            // inisialisasi
            $F[$i][0] = $e[$i][0] = $E[$i][0] = $AE[$i][0] = $alpha[$i][0] = $PE[$i][0] = 0;
            $F[$i][1] = $X[0];
            $alpha[$i][1] = $beta[$i];

            for($j = 1; $j < count($periode); $j++){
                // perhitungan peramalan untuk periode berikutnya
                $F[$i][$j + 1] = ($alpha[$i][$j] * $X[$j]) + ((1 - $alpha[$i][$j]) * $F[$i][$j]);

                // menghitung selisih antara nilai aktual dengan hasil peramalan
                $e[$i][$j] = $X[$j] - $F[$i][$j]; 

                // menghitung nilai kesalahan peramalan yang dihaluskan
                $E[$i][$j] = ($beta[$i] * $e[$i][$j]) + ((1 - $beta[$i]) * $E[$i][$j - 1]);

                // menghitung nilai kesalahan absolut peramalan yang dihaluskan
                $AE[$i][$j] = ($beta[$i] * abs($e[$i][$j])) + ((1 - $beta[$i]) * $AE[$i][$j - 1]);

                // menghitung nilai alpha untuk periode berikutnya
                $alpha[$i][$j + 1] = $E[$i][$j] == 0 ? $beta[$i] : abs($E[$i][$j] / $AE[$i][$j]);

                // menghitung nilai kesalahan persentase peramalan
                $PE[$i][$j] = $X[$j] == 0 ? 0 : abs((($X[$j] - $F[$i][$j]) / $X[$j]) * 100);
            }

            // menghitung rata-rata kesalahan peramalan
            $MAPE[$i] = array_sum($PE[$i])/(count($periode) - 1);
        }
        
        // mendapatkan index beta dengan nilai mape terkecil
        $bestBetaIndex = array_search(min($MAPE), $MAPE);

        // menyatukan semua hasil perhitungan dan menginputkan hasil peramalan periode berikutnya
        $result = [];
        for ($i = 0; $i <= count($periode); $i++) {
            $result[$i] = round($F[$bestBetaIndex][$i]);
        }
        
        // masukkan hasil, beta, dan mape tebaik ke array
        $final = [
            'result' => $result,
            'last' => end($result),
            'mape' => $MAPE[$bestBetaIndex],
        ];
        
        return $final;
    }

    public function indexForecastPasar($pick_produk, $pick_kategori, $tahun) {

        $produk = DB::select('SELECT DISTINCT(namaProduk) from produk');
        $kategori = DB::select('SELECT DISTINCT(kategori) from kategori');
        // total sales orders grouped by month
        if($tahun=="Keseluruhan"){
            $stok_kopi = DB::table('detail_penjualan')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas) as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
                ->join('produk', 'detail_penjualan.idProduk', '=', 'produk.id')
                ->join('kategori', 'detail_penjualan.idKategori', '=', 'kategori.id')
                ->where([
                    ['produk.namaProduk', '=', $pick_produk],
                    ['kategori.kategori', '=', $pick_kategori]
                ])
                ->groupBy('produk.namaProduk',DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
                ->orderBy('created_at','asc')
                ->get();
    
            // all periode of sales
            $periode = DB::table('detail_penjualan')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"))
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
        } else{
            $stok_kopi = DB::table('detail_penjualan')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas) as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
                ->join('produk', 'detail_penjualan.idProduk', '=', 'produk.id')
                ->join('kategori', 'detail_penjualan.idKategori', '=', 'kategori.id')
                ->where([
                    ['produk.namaProduk', '=', $pick_produk],
                    ['kategori.kategori', '=', $pick_kategori],
                    [DB::raw("DATE_FORMAT(created_at, '%Y')"), "=", $tahun]
                ])
                ->groupBy('produk.namaProduk',DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();

            // all periode of sales
            $periode = DB::table('detail_penjualan')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"))
                ->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), "=", $tahun)
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
        }

        // check if product have sales
        $allStok = 0;
        $monthStok = [];
        foreach($stok_kopi as $data) {
            $allStok += $data->total;
            $monthStok[] = $data->periode;
        }
        if($allStok <= 0) {
            return back()->with('error', 'Produk masih belum pernah terjual!');
        }
        if(count($monthStok) <= 1) {
            return back()->with('error', 'Produk minimal harus terjual dalam 2 bulan!');
        }

        // sales per month for dataset
        $dataset = [];
        for($i=0; $i<count($periode); $i++) {
            for($j=0; $j<count($stok_kopi); $j++) {
                if($periode[$i]->periode == $stok_kopi[$j]->periode){
                    $dataset[$i] = intval($stok_kopi[$j]->total);
                    break;
                }else{
                    $dataset[$i] = 0;
                }
            }
        }
        
        // get periodes to array
        $month = [];
        for ($i = 0; $i <= count($periode); $i++) {
            if ($i < count($periode)) {
                $month[$i] = $periode[$i]->periode;
            }
            else {
                $nextMonth = date('Y-m', strtotime("+1 month", strtotime(date($periode[$i-1]->periode))));
                $month[$i] = $nextMonth;
            }
        }
        
        // result
        $exponentialSmoothing = $this->exponentialSmoothing($periode, $dataset);

        $forecast = $exponentialSmoothing['result'];
        $last = $exponentialSmoothing['last'];
        $mape = round($exponentialSmoothing['mape']);

        // year
        $yearsQuery = DB::table('detail_penjualan')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();

        $years = [];
        
        foreach ($yearsQuery as $data) {
            $years[] = $data->tahun;
        }
        
        $produkURL = $pick_produk;
        $kategoriURL = $pick_kategori;
        $yearURL = $tahun;
        $years = array_unique($years);
        rsort(($years));

        return view('owner.ownerPrediksiPasar', compact('produk','kategori','stok_kopi','years', 'yearURL','produkURL','kategoriURL','month','dataset','forecast','last','mape'));
    }

    // Forcast Pasar
    public function indexForecastBijiKopi($tahun) {
        // total sales orders grouped by month
        $bijiStr = "Biji Kopi";
        if($tahun=="Keseluruhan"){
            $biji_kopi = DB::table('detail_bahan_baku')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas)*1000 as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
                ->join('bahan_baku', 'detail_bahan_baku.idBahan', '=', 'bahan_baku.id')
                ->where('bahan_baku.namaBahan', 'like', '%'.$bijiStr.'%')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
    
            // all periode of sales
            $periode = DB::table('detail_bahan_baku')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"))
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
        } else{
            $biji_kopi = DB::table('detail_bahan_baku')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas)*1000 as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
                ->join('bahan_baku', 'detail_bahan_baku.idBahan', '=', 'bahan_baku.id')
                ->where([
                    ['bahan_baku.namaBahan', 'like', '%'.$bijiStr.'%'],
                    [DB::raw("DATE_FORMAT(created_at, '%Y')"), "=", $tahun]
                ])
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();

            // all periode of sales
            $periode = DB::table('detail_bahan_baku')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"))
                ->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), "=", $tahun)
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
        }

        // check if product have sales
        $allSales = 0;
        $monthSales = [];
        foreach($biji_kopi as $data) {
            $allSales += $data->total;
            $monthSales[] = $data->periode;
        }
        if($allSales <= 0) {
            return back()->with('error', 'Produk masih belum pernah terjual!');
        }
        if(count($monthSales) <= 1) {
            return back()->with('error', 'Produk minimal harus terjual dalam 2 bulan!');
        }

        // sales per month for dataset
        $dataset = [];
        for($i=0; $i<count($periode); $i++) {
            for($j=0; $j<count($biji_kopi); $j++) {
                if($periode[$i]->periode == $biji_kopi[$j]->periode){
                    $dataset[$i] = intval($biji_kopi[$j]->total);
                    break;
                }else{
                    $dataset[$i] = 0;
                }
            }
        }
        
        // get periodes to array
        $month = [];
        for ($i = 0; $i <= count($periode); $i++) {
            if ($i < count($periode)) {
                $month[$i] = $periode[$i]->periode;
            }
            else {
                $nextMonth = date('Y-m', strtotime("+1 month", strtotime(date($periode[$i-1]->periode))));
                $month[$i] = $nextMonth;
            }
        }
        
        // result
        $exponentialSmoothing = $this->exponentialSmoothing($periode, $dataset);

        $forecast = $exponentialSmoothing['result'];
        $last = $exponentialSmoothing['last'];
        $mape = round($exponentialSmoothing['mape']);

        // year
        $yearsQuery = DB::table('detail_bahan_baku')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();

        $years = [];
        
        foreach ($yearsQuery as $data) {
            $years[] = $data->tahun;
        }
        
        $yearURL = $tahun;
        $years = array_unique($years);
        rsort(($years));

        return view('owner.ownerPrediksiStok', compact('biji_kopi','years', 'yearURL', 'month','dataset','forecast','last','mape'));
    }  
    
    // Forcast Pasar Kedai
    public function indexForecastPasarKedai($pick_produk, $pick_kategori, $tahun) {
        $produk = DB::select('SELECT DISTINCT(namaProduk) from produk');
        $kategori = DB::select('SELECT DISTINCT(kategori) from kategori');
        // total sales orders grouped by month
        if($tahun=="Keseluruhan"){
            $stok_kopi = DB::table('detail_penjualan')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas) as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
                ->join('produk', 'detail_penjualan.idProduk', '=', 'produk.id')
                ->join('kategori', 'detail_penjualan.idKategori', '=', 'kategori.id')
                ->where([
                    ['produk.namaProduk', '=', $pick_produk],
                    ['kategori.kategori', '=', $pick_kategori]
                    ])
                ->groupBy('produk.namaProduk',DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
                ->orderBy('created_at','asc')
                ->get();
    
            // all periode of sales
            $periode = DB::table('detail_penjualan')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"))
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
        } else{
            $stok_kopi = DB::table('detail_penjualan')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas) as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
                ->join('produk', 'detail_penjualan.idProduk', '=', 'produk.id')
                ->join('kategori', 'detail_penjualan.idKategori', '=', 'kategori.id')
                ->where([
                    ['produk.namaProduk', '=', $pick_produk],
                    ['kategori.kategori', '=', $pick_kategori],
                    [DB::raw("DATE_FORMAT(created_at, '%Y')"), "=", $tahun]
                ])
                ->groupBy('produk.namaProduk',DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();

            // all periode of sales
            $periode = DB::table('detail_penjualan')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"))
                ->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), "=", $tahun)
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
        }

        // check if product have sales
        $allStok = 0;
        $monthStok = [];
        foreach($stok_kopi as $data) {
            $allStok += $data->total;
            $monthStok[] = $data->periode;
        }
        if($allStok <= 0) {
            return back()->with('error', 'Produk masih belum pernah terjual!');
        }
        if(count($monthStok) <= 1) {
            return back()->with('error', 'Produk minimal harus terjual dalam 2 bulan!');
        }

        // sales per month for dataset
        $dataset = [];
        for($i=0; $i<count($periode); $i++) {
            for($j=0; $j<count($stok_kopi); $j++) {
                if($periode[$i]->periode == $stok_kopi[$j]->periode){
                    $dataset[$i] = intval($stok_kopi[$j]->total);
                    break;
                }else{
                    $dataset[$i] = 0;
                }
            }
        }
        
        // get periodes to array
        $month = [];
        for ($i = 0; $i <= count($periode); $i++) {
            if ($i < count($periode)) {
                $month[$i] = $periode[$i]->periode;
            }
            else {
                $nextMonth = date('Y-m', strtotime("+1 month", strtotime(date($periode[$i-1]->periode))));
                $month[$i] = $nextMonth;
            }
        }
        
        // result
        $exponentialSmoothing = $this->exponentialSmoothing($periode, $dataset);

        $forecast = $exponentialSmoothing['result'];
        $last = $exponentialSmoothing['last'];
        $mape = round($exponentialSmoothing['mape']);

        // year
        $yearsQuery = DB::table('detail_penjualan')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();

        $years = [];
        
        foreach ($yearsQuery as $data) {
            $years[] = $data->tahun;
        }
        
        $produkURL = $pick_produk;
        $kategoriURL = $pick_kategori;
        $yearURL = $tahun;
        $years = array_unique($years);
        rsort(($years));

        return view('kedai.kedaiPrediksiPasar', compact('produk','kategori','stok_kopi','years', 'yearURL','produkURL','kategoriURL', 'month','dataset','forecast','last','mape'));
    }    

    // Forecast Stok Produksi
    public function indexForecastBijiKopiProduksi($tahun) {
        $bijiStr = "Biji Kopi";
        if($tahun=="Keseluruhan"){
            $biji_kopi = DB::table('detail_bahan_baku')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas)*1000 as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
                ->join('bahan_baku', 'detail_bahan_baku.idBahan', '=', 'bahan_baku.id')
                ->where('bahan_baku.namaBahan', 'like', '%'.$bijiStr.'%')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
    
            // all periode of sales
            $periode = DB::table('detail_bahan_baku')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"))
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
        } else{
            $biji_kopi = DB::table('detail_bahan_baku')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"), DB::raw('SUM(kuantitas)*1000 as total'), DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
                ->join('bahan_baku', 'detail_bahan_baku.idBahan', '=', 'bahan_baku.id')
                ->where([
                    ['bahan_baku.namaBahan', 'like', '%'.$bijiStr.'%'],
                    [DB::raw("DATE_FORMAT(created_at, '%Y')"), "=", $tahun]
                ])
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();

            // all periode of sales
            $periode = DB::table('detail_bahan_baku')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as periode"))
                ->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), "=", $tahun)
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
                ->orderBy('created_at','asc')
                ->get();
        }

        // check if product have sales
        $allSales = 0;
        $monthSales = [];
        foreach($biji_kopi as $data) {
            $allSales += $data->total;
            $monthSales[] = $data->periode;
        }
        if($allSales <= 0) {
            return back()->with('error', 'Produk masih belum pernah terjual!');
        }
        if(count($monthSales) <= 1) {
            return back()->with('error', 'Produk minimal harus terjual dalam 2 bulan!');
        }

        // sales per month for dataset
        $dataset = [];
        for($i=0; $i<count($periode); $i++) {
            for($j=0; $j<count($biji_kopi); $j++) {
                if($periode[$i]->periode == $biji_kopi[$j]->periode){
                    $dataset[$i] = intval($biji_kopi[$j]->total);
                    break;
                }else{
                    $dataset[$i] = 0;
                }
            }
        }
        
        // get periodes to array
        $month = [];
        for ($i = 0; $i <= count($periode); $i++) {
            if ($i < count($periode)) {
                $month[$i] = $periode[$i]->periode;
            }
            else {
                $nextMonth = date('Y-m', strtotime("+1 month", strtotime(date($periode[$i-1]->periode))));
                $month[$i] = $nextMonth;
            }
        }
        
        // result
        $exponentialSmoothing = $this->exponentialSmoothing($periode, $dataset);

        $forecast = $exponentialSmoothing['result'];
        $last = $exponentialSmoothing['last'];
        $mape = round($exponentialSmoothing['mape']);

        // year
        $yearsQuery = DB::table('detail_bahan_baku')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y') as tahun"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m'), DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at','asc')
            ->get();

        $years = [];
        
        foreach ($yearsQuery as $data) {
            $years[] = $data->tahun;
        }
        
        $yearURL = $tahun;
        $years = array_unique($years);
        rsort(($years));

        return view('produksi.produksiPrediksiStok', compact('biji_kopi','years', 'yearURL', 'month','dataset','forecast','last','mape'));
    }  
}
