<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Resources\BarangResource;


class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return response()->json([
            "status" => true,
            "data" => $barangs,
            "message" => "sukses"
            ]);
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        if (! $barang){
            return response()->json([
                "status" => false,
                'data' => $barang,
                "message" => "Gagal"
            ]);
        }
        return response()->json([
            "status" => true,
            'data' => $barang,
            "message" => "Sukses"
        ]);
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'nama' => 'required|unique:barangs',
        'stok' => 'required|integer|min:0',
    ]);
 
    $barang = Barang::create($request->all());
    return response()->json([
        "status" => true,
        'data' => $barang,
        "message" => "Sukses"
    ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'unique:barangs',
            'stok' => 'required|integer|min:0',
        ]);


        $barang = Barang::find($id);

        if(! $barang){
            return response()->json([
                "message" => "Data tidak ada"]
            );
        }

        $barang->update($request->all());

        return response()->json([
            "status" => true,
            'data' => $barang,
            "message" => "Update berhasil"
        ]);
    }

    public function destroy($id)
    {
        $barang = Barang::findorFail($id);
        $barang->delete();

        return response()->json([
            "status" => true,
            'data' => $barang,
            "message" => "Hapus berhasil"
        ]);
    }
}
