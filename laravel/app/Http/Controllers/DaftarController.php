<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Profile;

class DaftarController extends Controller
{
    public function simpandaftar(Request $request)
    {
        $password = $request->password;

        // Validasi kekuatan password
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return redirect('/register')->with('sukses', 'Password setidaknya harus 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan karakter spesial.');
        } else {
            if ($request->password === $request->password2) {
                $messages = [
                    'required' => '*kolom wajib diisi ya!!!',
                    'unique' => 'Email sudah terdaftar! Silakan ulangi pendaftaran.',
                ];

                $this->validate($request, [
                    'email' => ['required', 'max:255', Rule::unique('users')->where('email', $request->email)],
                ], $messages);

                // Input pendaftaran sebagai user
                $user = new User();
                $user->role = 'user';
                $user->company = $request->company;
                $user->name = $request->name;
                $user->npwp = $request->npwp;
                $user->nohp = $request->nohp;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();

                // Insert ke tabel profile
                $profileData = $request->all();
                $profileData['user_id'] = $user->id;
                Profile::create($profileData);

                return redirect('/login')->with('sukses', 'Data Pendaftaran Berhasil Dikirim.');
            } else {
                return redirect('/daftar')->with('sukses', 'Password yang Anda masukkan tidak sama! Silakan ulangi kembali.');
            }
        }
    }

    public function profile()
    {
        // Mendapatkan data user yang sedang login
        $user = auth()->user();
        $profile = $user->profile;
        $title = "profile";

        return view('profile.profile', compact('user', 'profile', 'title'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $title = "profile";
        return view('profile.edit', compact('user','title'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validasi input
        $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'npwp' => 'required|string|max:255',
            'nohp' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek jika ada file gambar yang diunggah
        if ($request->hasFile('foto')) {
            // Simpan gambar di folder 'public/images'
            $fotoPath = $request->file('foto')->store('images', 'public');

            // Update foto di tabel profile
            $user->profile->update(['foto' => $fotoPath]);
        }

        // Update data pengguna
        $user->update($request->only('company', 'name', 'npwp', 'nohp', 'email'));

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
