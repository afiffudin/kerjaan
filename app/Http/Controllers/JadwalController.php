<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    // CREATE
    public function create(Request $r)
    {
        $pict = $r->file('Tiket_Pesawat');
        $path = public_path('/public/foto/');
        $img = rand() . "." . $pict->getClientOriginalExtension();
        $pict->move($path, $img);
        DB::table('jadwal')->insert([
            'PIC' => $r->PIC,
            'atlit' => $r->atlit,
            'Tiket_Pesawat' => $img,
            'Tanggal_keberangkatan' => $r->Tanggal_keberangkatan,
            'Tanggal_kepulangan' => $r->Tanggal_kepulangan,
            'Penginapan' => $r->Penginapan,
            'no_kamar' => $r->no_kamar,
            'no_booking' => $r->no_booking,
            'Tempat_Pertandingan' => $r->Tempat_Pertandingan,
            'Inventaris_mobil' => $r->Inventaris_mobil

        ]);
        return redirect('/lihat-jadwal');
    }
    // READ
    public function read()
    {
        $jadwal_r = DB::table('jadwal')->get();
        return view('lihatjadwal', ['lihatjadwal' => $jadwal_r]);
    }
    // UPDATE
    public function redirect_update($id)
    {
        $atlet_u = DB::table('jadwal')->get()->where("id", $id);
        $atlet = DB::table('data_master_atlet')->get();
        return view('pages/editjadwal', ['lihatjadwal' => $atlet_u, 'atlet' => $atlet]);
    }
    public function update(Request $r)
    {
        $this->validate($r, [
            'PIC' => 'required',
            'atlit' => 'required',
            'Tiket_Pesawat' => 'required',
            'Tanggal_keberangkatan' => 'required',
            'Tanggal_kepulangan' => 'required',
            'Penginapan' => 'required',
            'No_kamar' => 'required',
            'No_booking' => 'required',
            'Tempat_Pertandingan' => 'required',
            'Inventaris_mobil' => 'required'


        ]);
        DB::table('jadwal')->where('id', $r->id)->update([
            'PIC' => $r->PIC,
            'atlit' => $r->atlit,
            'Tiket_Pesawat' => $img,
            'Tanggal_keberangkatan' => $r->Tanggal_keberangkatan,
            'Tanggal_kepulangan' => $r->Tanggal_kepulangan,
            'Penginapan' => $r->Penginapan,
            'No_kamar' => $r->No_kamar,
            'No_booking' => $r->No_booking,
            'Tempat_Pertandingan' => $r->Tempat_Pertandingan,
            'Inventaris_mobil' => $r->Inventaris_mobil
        ]);
        return redirect('/jadwal-pertandingan');
    }
    // DELETE
    public function delete($id)
    {
        DB::table('jadwal')->where('id', $id)->delete();
        return redirect('/lihat-jadwal');
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $cabor = DB::table('jadwal')
            ->where('id', 'like', "%" . $cari . "%")
            ->paginate();
        return view('lihatjadwal', ['jadwal' => $cabor]);
    }
}
