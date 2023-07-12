<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user.profile.index');
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
    public function update(Request $request)
    {
        try {
            $rules = [
                'nama' => 'required',
                'bidang' => 'required',
                'jabatan' => 'required',
                'username' => 'required|unique:users,username,' . $request->id,
            ];

            $validatedData = $request->validate($rules);

            User::where('id', $request->id)->update($validatedData);

            return redirect()->route('profile.index')->with('success', "Profile berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('profile.index')->with('failed', 'Profile gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function resetPasswordUser(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $rules = [
                'password' => 'required|min:5|max:255',
                'passbaru' => 'required|min:5|max:255',
                'konfpass' => 'required|min:5|max:255'
            ];

            if (Hash::check($request->password, $user->password)) {
                if ($request->passbaru == $request->konfpass) {
                    $validatedData = $request->validate($rules);
                    $validatedData['password'] = Hash::make($validatedData['passbaru']);

                    $user->update($validatedData);
                    return redirect()->route('profile.index')->with('success', 'Password berhasil diubah!');
                } else {
                    return back()->with('failed', 'Konfirmasi password tidak sesuai!');
                }
            } else {
                return back()->with('failed', 'Password lama Anda salah!');
            }
        } catch (\Exception $e) {
            return back()->with('failed', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
