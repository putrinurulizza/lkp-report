<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\detailKegiatan;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatans = Kegiatan::with('detailkegiatans')->get();
        $details = detailKegiatan::with('kegiatans')->get();
        return view(
            'dashboard.kegiatan.index',
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
        try {
            $validatedData = $request->validate([
                'id_user' => 'required',
                'tanggal' => 'required'
            ]);

            Kegiatan::create($validatedData);

            $kegiatanTerbaru = Kegiatan::latest()->first();
            $idKegiatanTerbaru = $kegiatanTerbaru->id;

            $request->validate([
                'kegiatan' => 'required|array',
                'kegiatan.*' => 'required|string',
                'hasil' => 'nullable|array',
                'hasil.*' => 'nullable|string',
            ]);

            $kegiatan = $request->input('kegiatan');
            $hasilKegiatan = $request->input('hasil');

            // Menyimpan data kegiatan ke database
            foreach ($kegiatan as $index => $namaKegiatan) {
                $hasil = $hasilKegiatan[$index] ?? null;

                detailKegiatan::create([
                    'id_kegiatan' => $idKegiatanTerbaru,
                    'kegiatan' => $namaKegiatan,
                    'hasil' => $hasil,
                ]);
            }

            return redirect()->route('kegiatan.index')->with('success', 'Kegiatan baru berhasil ditambahkan!.');
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('home.index')->with('failed', 'Kegiatan gagal ditambahkan' . ' - ' . $exception->getMessage());
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
            ];

            $validatedData = $request->validate($rules);
            Kegiatan::where('id', $kegiatan->id)->update($validatedData);

            $kegiatanTerbaru = Kegiatan::latest()->first();
            $idKegiatanTerbaru = $kegiatanTerbaru->id;
            //dd($idKegiatanTerbaru);

            $rules2 = [
                'kegiatan' => 'required',
                'hasil' => 'required'
            ];

            $validatedData = $request->validate($rules2);
            dd($validatedData);
            detailKegiatan::where('id_kegiatan', $idKegiatanTerbaru)->update($validatedData);

            return redirect()->route('kegiatan.index')->with('success', "Data kegiatan $kegiatan->kegiatan berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('kegiatan.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Kegiatan $kegiatan)
    {
        try {
            $kegiatans = detailKegiatan::where('id_kegiatan', $kegiatan->id)->get();

            for($i = 0; $i < count($kegiatans); $i++){
                detailKegiatan::destroy($kegiatans[$i]->id);
            }

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
