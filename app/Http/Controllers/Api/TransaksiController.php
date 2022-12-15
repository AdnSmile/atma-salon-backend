<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        if(count($transaksi) > 0){
            
            return response()->json([
                'success' => true,
                'message' => 'Daftar Data Transaksi',
                'data' => $transaksi
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada data transaksi',
            'data' => null
        ], 404);
    }

    public function indexById(Request $request, $id_user)
    {
        $transaksi = Transaksi::where('id_user', $id_user)->get();
        
        if(count($transaksi) > 0){
            
            return response()->json([
                'success' => true,
                'message' => 'Daftar Data Transaksi',
                'data' => $transaksi
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada data transaksi',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'id_user' => 'required',
            'model_rambut' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $transaksi = Transaksi::create($storeData);
        return response()->json([
            'success' => true,
            'message' => 'Tambah Transaksi berhasil',
            'data' => $transaksi
        ], 200);
    }

    public function show($id)
    {
        $transaksi = Transaksi::find($id);

        if(!is_null($transaksi)){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Transaksi',
                'data' => $transaksi
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Transaksi tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        if(is_null($transaksi)){
            return response()->json([
                'success' => false,
                'message' => 'transaksi tidak ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'id_user' => 'required',
            'model_rambut' => 'required',
            'harga' => 'required',
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $transaksi->id_user = $updateData['id_user'];
        $transaksi->model_rambut = $updateData['model_rambut'];
        $transaksi->harga = $updateData['harga'];
        $transaksi->save();

        return response()->json([
            'success' => true,
            'message' => 'Update Transaksi berhasil',
            'data' => $transaksi
        ], 200);
    }

    public function deleteTransaksi($id_user, Request $request)
    {
        $transaksi = Transaksi::where('id_user', $id_user)->get();

        if (count($transaksi) > 0) {
            foreach ($transaksi as $key => $value) {
                $value->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dihapus',

            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada data transaksi',
            'data' => null
        ], 404);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        
        if(is_null($transaksi)){
            return response()->json([
                'success' => false,
                'message' => 'transaksi tidak ditemukan',
                'data' => null
            ], 404);
        }

        $transaksi->delete();
        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dihapus',
            'data' => $transaksi
        ], 200);
    }
}