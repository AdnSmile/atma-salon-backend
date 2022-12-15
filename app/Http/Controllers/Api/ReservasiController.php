<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{
    // index
    public function index()
    {
        $reservasi = Reservasi::all();

        if(count($reservasi) > 0){
            
            return response()->json([
                'success' => true,
                'message' => 'Daftar Data Reservasi',
                'data' => $reservasi
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada data reservasi',
            'data' => null
        ], 404);
    }

    public function indexById(Request $request, $id_user)
    {
        $reservasi = Reservasi::where('id_user', $id_user)->get();
        // $reservasi = Reservasi::all();

        if(count($reservasi) > 0){
            
            return response()->json([
                'success' => true,
                'message' => 'Daftar Data Reservasi',
                'data' => $reservasi
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada data reservasi',
            'data' => null
        ], 404);
    }

    // store
    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'id_user' => 'required',
            'model_rambut' => 'required',
            'tanggal' => 'required',
            'catatan' => 'required',
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $reservasi = Reservasi::create($storeData);
        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil',
            'data' => $reservasi
        ], 200);
    }

    // show
    public function show($id)
    {
        $reservasi = Reservasi::find($id);

        if(!is_null($reservasi)){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Reservasi',
                'data' => $reservasi
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Reservasi tidak ditemukan',
            'data' => ''
        ], 404);
    }

    // update
    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::find($id);

        if(is_null($reservasi)){
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak ditemukan',
                'data' => ''
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'id_user' => 'required',
            'model_rambut' => 'required',
            'tanggal' => 'required',
            'catatan' => 'required',
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $reservasi->id_user = $updateData['id_user'];
        $reservasi->model_rambut = $updateData['model_rambut'];
        $reservasi->tanggal = $updateData['tanggal'];
        $reservasi->catatan = $updateData['catatan'];
        $reservasi->save();

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil diupdate',
            'data' => $reservasi
        ], 200);
    }

    // destroy
    public function destroy($id)
    {
        $reservasi = Reservasi::find($id);

        if(is_null($reservasi)){
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak ditemukan',
                'data' => null
            ], 404);
        }

        $reservasi->delete();
        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dihapus',
            'data' => $reservasi
        ], 200);
    }
}