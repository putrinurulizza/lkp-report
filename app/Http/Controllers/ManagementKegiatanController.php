<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detailKegiatan;
use App\Models\Kegiatan;

class ManagementKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatans = Kegiatan::with('detailkegiatans')->get();
        $details = detailKegiatan::with('kegiatans')->get();
        return view(
            'dashboard.kegiatan.management.index',
        )->with(compact('kegiatans', 'details'));
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
    public function update(Request $request, detailKegiatan $detail)
    {
        try {
            $rule = [
                'tanggal' => 'required',
            ];

            $details = detailKegiatan::where('id', $request->id)->get();

            $validateData = $request->validate($rule);
            Kegiatan::where('id', $details[0]->id_kegiatan)->update($validateData);

            $rules = [
                'kegiatan' => 'required',
                'hasil' => 'required'
            ];

            $validatedData = $request->validate($rules);

            detailKegiatan::where('id', $request->id)->update($validatedData);
            return redirect()->route('management.index')->with('success', "Data Kegiatan $detail->kegiatan berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('management.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $kegiatan)
    {
        // try {
        //     detailKegiatan::destroy($kegiatan->id);
        // } catch (\Illuminate\Database\QueryException $e) {
        //     if ($e->getCode() == 23000) {
        //         //SQLSTATE[23000]: Integrity constraint violation
        //         return redirect()->route('management.index')->with('failed', "Detail Kegiatan $kegiatan->kegiatan tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
        //     }
        // }
        // return redirect()->route('management.index')->with('success', "Detail Kegiatan $kegiatan->kegiatan berhasil dihapus!");
    }
}
