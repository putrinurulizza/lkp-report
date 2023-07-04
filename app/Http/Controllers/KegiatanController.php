<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatans = Kegiatan::with('detailkegiatans')->get();
        return view(
            'dashboard.kegiatan.index',
            [
                'kegiatans' => $kegiatans
            ]
            );
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
        try {
            $validatedData = $request->validate([
                'id_user' => 'required',
                'kegiatan' => 'required',
                'hasil' => 'required',
                'tanggal' => 'required|date'
            ]);

            Kegiatan::create($validatedData);

            return redirect()->route('kegiatan.index')->with('success', 'Kegiatan baru berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('kegiatan.index')->with('failed', 'Kegiatan gagal ditambahkan' . ' - ' . $exception->getMessage());
        }
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
    public function update(Request $request, Kegiatan $kegiatan)
    {
        try {
            $rules = [
                'tanggal' => 'required|date',
                'kegiatan' => 'required',
                'hasil' => 'required'
            ];

            $validatedData = $request->validate($rules);

            Kegiatan::where('id', $kegiatan->id)->update($validatedData);

            return redirect()->route('kegiatan.index')->with('success', "Data kegiatan $kegiatan->kegiatan berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('kegiatan.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        try {
            Kegiatan::destroy($kegiatan->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('kegiatan.index')->with('failed', "Kegiatan $kegiatan->kegiatan tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }
        return redirect()->route('kegiatan.index')->with('success', "Kategori $kegiatan->kegiatan berhasil dihapus!");
    }
}
