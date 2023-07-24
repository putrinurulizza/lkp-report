<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Models\detailKegiatan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Kegiatan;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bulanIni = Carbon::now()->format('m');
        $kegiatans = Kegiatan::with('detailkegiatans')->whereMonth('tanggal', $bulanIni)->get();
        $details = detailKegiatan::with('kegiatans')->get();
        return view(
            'dashboard.laporan.index',
        )->with(compact('kegiatans', 'details'));
    }

    public function exportExcel()
    {
        return Excel::download(new ExcelExport, 'kegiatans.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
