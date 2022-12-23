<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tahun = $request->tahun;
        $data = json_decode(file_get_contents('https://tes-web.landa.id/intermediate/menu'));

        $data2 = json_decode(file_get_contents('https://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun));

        // total keseluruhan
        $tt = 0;

        $tm = 0; //total kategori makanan
        $tmn = 0; //total kategori minuman

        if ($tahun) {

            // total keseluruhan
            foreach ($data2 as $all) {
                $tt += $all->total;
            }

            //hitung total penjualan kategori makanan
            foreach ($data2 as $totalmakanan) {
                foreach ($data as $food) {
                    if ($food->menu == $totalmakanan->menu) {
                        if ($food->kategori == 'makanan') {
                            $tm += $totalmakanan->total;
                        }
                    }
                }
            }

            //hitung total penjualan kategori minuman
            foreach ($data2 as $totalminuman) {
                foreach ($data as $beverage) {
                    if ($beverage->menu == $totalminuman->menu) {
                        if ($beverage->kategori == 'minuman') {
                            $tmn += $totalminuman->total;
                        }
                    }
                }
            }

            // total kategori makanan tiap bulan
            foreach ($data2 as $makantiapbulan) {
                for ($i = 1; $i <= 12; $i++) {
                    $makan[$i] = 0;
                }
            }

            // total kategori makanan tiap bulan
            foreach ($data2 as $totalmakanan) {
                foreach ($data as $makanan) {
                    if ($makanan->menu == $totalmakanan->menu) {
                        if ($makanan->kategori == 'makanan') {
                            $n = date('n', strtotime($totalmakanan->tanggal));
                            $makan[$n] += $totalmakanan->total;
                        }
                    }
                }
            }

            // total kategori minuman tiap bulan
            foreach ($data2 as $minumtiapbulan) {
                for ($i = 1; $i <= 12; $i++) {
                    $minum[$i] = 0;
                }
            }

            // total kategori minuman tiap bulan
            foreach ($data2 as $totalminuman) {
                foreach ($data as $beverage) {
                    if ($beverage->menu == $totalminuman->menu) {
                        if ($beverage->kategori == 'minuman') {
                            $n = date('n', strtotime($totalminuman->tanggal));
                            $minum[$n] += $totalminuman->total;
                        }
                    }
                }
            }

            // total setiap menu dalam satu bulan
            foreach ($data as $d) {
                $d->menu;

                for ($i = 1; $i <= 12; $i++) {
                    $result[$d->menu][$i] = 0;
                }
            }

            // total setiap menu dalam satu bulan
            foreach ($data2 as $dt) {
                $m = date('n', strtotime($dt->tanggal));
                $result[$dt->menu][$m] += $dt->total;
            }

            // total tiap menu
            foreach ($data as $menu) {
                $totalmenu[$menu->menu] = 0;
            }

            // total tiap menu
            foreach ($data2 as $totaltk) {
                $totalmenu[$totaltk->menu] += $totaltk->total;
            }

            // total semua menu dalam satu bulan
            foreach ($data2 as $d2) {
                for ($i = 1; $i <= 12; $i++) {
                    $hasil[$i] = 0;
                }
            }

            // total semua menu dalam satu bulan
            foreach ($data2 as $month) {
                $mth = date('n', strtotime($month->tanggal));
                $hasil[$mth] += $month->total;
            }

            return view('welcome', compact('data', 'data2', 'result', 'hasil', 'totalmenu', 'tt', 'tahun', 'tm', 'tmn', 'minum', 'makan'));
        } else {
            return redirect('/');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
