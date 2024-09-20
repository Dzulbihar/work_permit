<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool2;

class Tool2Controller extends Controller
{

    public function save(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|array|min:1', // Pastikan setidaknya ada satu item dalam array
            'name.*' => 'in:Helm,Kacamata,Goggle,Tameng_Muka,Kop_Las,Masker_Kain,Masker_Kimia,Earplug_Earmuff,Sarung_Tangan_Katun,Sarung_Tangan_Karet,Sarung_Tangan_Kulit,Sarung_Tangan_Las,Sabuk_Keselamatan,Full_Body_Harness,Pelampung,Tali_Pelindung,Sepatu_Keselamatan,Sapatu_Boots,Tabung_Pernapasan,Apron,Lainnya,Pemadam_Api,Safety_cone_line,Rambu_Tanda_Keselamatan,LOTO,Radio_Telekomunikasi,Jaring_Tali_Keselamatan',
        ]);

        // Gabungkan array name menjadi string dengan tanda koma
        $validated['name'] = implode(',', $request->name);
        
        $validated['job_id'] = $id;
        $validated['status'] = 'Y';

        Tool2::create($validated);

        return redirect ('/job/detail/'. $id)->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'nullable|array', // Membolehkan kosong
            'name.*' => 'in:Helm,Kacamata,Goggle,Tameng_Muka,Kop_Las,Masker_Kain,Masker_Kimia,Earplug_Earmuff,Sarung_Tangan_Katun,Sarung_Tangan_Karet,Sarung_Tangan_Kulit,Sarung_Tangan_Las,Sabuk_Keselamatan,Full_Body_Harness,Pelampung,Tali_Pelindung,Sepatu_Keselamatan,Sapatu_Boots,Tabung_Pernapasan,Apron,Lainnya,Pemadam_Api,Safety_cone_line,Rambu_Tanda_Keselamatan,LOTO,Radio_Telekomunikasi,Jaring_Tali_Keselamatan', // Tetap validasi nilai-nilai yang dipilih jika ada
        ]);


        // Temukan tool2 berdasarkan id
        $tool2 = Tool2::where('job_id', $id)->first();

        // Pastikan data tool2 ditemukan
        if (!$tool2) {
            return redirect()->back()->withErrors('Data alat tidak ditemukan.');
        }

        // Proses data untuk name (array dari checkbox)
        if ($request->has('name')) {
            // Ubah array menjadi string yang dipisahkan dengan koma
            $name = implode(',', $request->name);
        } else {
            // Jika tidak ada checkbox yang dicentang, simpan sebagai string kosong
            $name = '';
        }

        // Update data tool2
        $tool2->update([
            'name' => $name, // Simpan name sebagai string
        ]);

        // Redirect setelah berhasil mengupdate data
        return redirect('/job/detail/' . $id)->with('success', 'Data berhasil disimpan');
    }

}
