<?php

namespace App\Http\Controllers;

use App\Models\detailKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index');
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
            ]);

            $validatedData['tanggal'] = date('Y-m-d');

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

        // try {
        //     $validatedData = $request->validate([
        //         'id_user' => 'required',
        //         'kegiatan' => 'required',
        //         'hasil' => 'required',
        //     ]);

        //     $validatedData['tanggal'] = date('Y-m-d');

        //     Kegiatan::create($validatedData);

        //     return redirect()->route('kegiatan.index')->with('success', 'Kegiatan baru berhasil ditambahkan!');
        // } catch (\Illuminate\Validation\ValidationException $exception) {
        //     return redirect()->route('home.index')->with('failed', 'Kegiatan gagal ditambahkan' . ' - ' . $exception->getMessage());
        // }
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
