<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'dashboard.user.index',
            [
                'users' => User::all()
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
                'nama' => 'required|max:255',
                'jabatan' => 'required|max:255',
                'bidang' => 'required|max:255',
                'username' => 'required|unique:users',
                'password' => 'required|min:5|max:255',
                'is_admin' => 'required',
            ]);
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);

            return redirect()->route('user.index')->with('success', 'User baru berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('user.index')->with('failed', $exception->getMessage());
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
    public function update(Request $request, User $user)
    {
        try {
            $rules = [
                'nama' => 'required',
                'jabatan' => 'required',
                'bidang' => 'required',
                'username' => 'required|unique:users',
                'is_admin' => 'required'
            ];

            $validatedData = $request->validate($rules);

            User::where('id', $user->id)->update($validatedData);

            return redirect()->route('user.index')->with('success', "Data user $user->nama berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('user.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            User::destroy($user->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('user.index')->with('failed', "User $user->nama tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }
        return redirect()->route('user.index')->with('success', "User $user->nama berhasil dihapus!");
    }

    // public function resetPasswordAdmin(Request $request)
    // {
    //     $rules = [
    //         'password' => 'required|min:5|max:255',
    //     ];

    //     if ($request->password == $request->password2) {
    //         $validatedData = $request->validate($rules);
    //         $validatedData['password'] = Hash::make($validatedData['password']);

    //         User::where('id', $request->id)->update($validatedData);
    //     } else {
    //         return back()->with('failed', 'Konfirmasi password tidak sesuai');
    //     }

    //     return redirect('/dashboard/user/list-user')->with('success', 'Password berhasil direset!');
    // }
}
