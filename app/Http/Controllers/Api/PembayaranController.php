<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::all();

        if(count($pembayaran) > 0){
            
            return response()->json([
                'success' => true,
                'message' => 'Daftar Data Pembayaran',
                'data' => $pembayaran
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada data pembayaran',
            'data' => null
        ], 404);
    }

    public function indexById(Request $request, $id_user)
    {
        $pembayaran = Pembayaran::where('id_user', $id_user)->get();

        if(count($pembayaran) > 0){
            
            return response()->json([
                'success' => true,
                'message' => 'Daftar Data Pembayaran',
                'data' => $pembayaran
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada data pembayaran',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'id_user' => 'required',
            'total_transaksi' => 'required',
            'uang' => 'required|numeric|gte:total_transaksi',
            'tanggal' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pembayaran = Pembayaran::create($storeData);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran Berhasil',
            'data' => $pembayaran
        ], 200);
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::find($id);

        if(is_null($pembayaran)){
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Pembayaran',
            'data' => $pembayaran
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::find($id);

        if(is_null($pembayaran)){
            return response()->json([
                'success' => false,
                'message' => 'pembayaran tidak ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'id_user' => 'required',
            'total_transaksi' => 'required',
            'uang' => 'required|numeric|gte:total_transaksi',
            'tanggal' => 'required',
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $pembayaran->id_user = $updateData['id_user'];
        $pembayaran->total_transaksi = $updateData['total_transaksi'];
        $pembayaran->uang = $updateData['uang'];
        $pembayaran->tanggal = $updateData['tanggal'];
        $pembayaran->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diupdate',
            'data' => $pembayaran
        ], 200);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        if(is_null($pembayaran)){
            return response()->json([
                'success' => false,
                'message' => 'pembayaran tidak ditemukan',
                'data' => null
            ], 404);
        }

        $pembayaran->delete();
        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dihapus',
            'data' => $pembayaran
        ], 200);
    }
}