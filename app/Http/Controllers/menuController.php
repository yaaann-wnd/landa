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
        $data = json_decode(file_get_contents('http://tes-web.landa.id/intermediate/menu'));

        $data2 = json_decode(file_get_contents('http://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun));
        $tt = 0;

        foreach ($data2 as $all) {
            $tt += $all->total;
        }

        foreach ($data as $d) {
            $d->menu;

            for ($i=1; $i <= 12 ; $i++) { 
                $result[$d->menu][$i] = 0;
            }
        }

        
        foreach ($data2 as $dt) {
            $bulan = date('n', strtotime($dt->tanggal));
            $result[$dt->menu][$bulan] += $dt->total;
        }
        
        foreach ($data2 as $d2) {
            for ($i = 1; $i <= 12; $i++) {
                $hasil[$i] = 0;
            }
        }

        // MENGHITUNG JUMLAH TOTAL PERBULAN
        foreach ($data2 as $month) {
            $mth = date('n', strtotime($month->tanggal));
            $hasil[$mth] += $month->total;
        }

        foreach ($data as $menu) {
            $totalmenu[$menu->menu] = 0;
        }

        // MENGHITUNG TOTAL TIAP MENU
        foreach ($data2 as $totaltk) {
            $totalmenu[$totaltk->menu] += $totaltk->total;
        }

        foreach ($data as $eachmenu) {
            $totalmenu[$eachmenu->menu] = 0;
        }

        // MENGHITUNG TOTAL TIAP MENU
        foreach ($data2 as $tttrans) {
            $totalmenu[$tttrans->menu] += $tttrans->total;
        }

        return view('welcome', compact('data', 'data2', 'result', 'hasil', 'totalmenu', 'tt'));
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