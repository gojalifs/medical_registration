<?php

namespace App\Http\Controllers;

use App\Models\BannerPromo;
use Exception;
use File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $data = BannerPromo::where('deleted_at', '=', null)->get();
        foreach ($data as $value) {
            $value->path = Storage::url($value['path']);
        }
        
        return view('admin.promo')->with([
            'banners'   => $data,
            'sidebar'   => $this->menu,
        ]);
    }

    public function data(): JsonResponse
    {
        try {
            $data = BannerPromo::where('deleted_at', '=', null)->get();
            $result = [];

            foreach ($data as $value) {
                array_push($result, [
                    'id' => $value['id'],
                    'path' => Storage::url($value['path'])
                ]);
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Sukses mendapatkan data banner promo',
                    'data' => $result
                ]
            );
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Log::debug($e->getTraceAsString());

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal mendapatkan data',
                    'code' => $e->getCode()
                ]
            );
        }
    }

    public function store(Request $request)
    {
        $file = $request->file('image');
        // if (isset($file)) {
        $path = $request->file('image')->store('banners');
        $path = Storage::putFile('banners', $request->file('image'));
        // } else{
        //     Log::debug('ddd');
        //     return;
        // }

        $banner = new BannerPromo();
        $banner->path = $path;

        $banner->save();

        return redirect()->back()->with(['success' => 'Berhasil menambahkan banner promo']);
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;

            $banner = BannerPromo::find($id);
            $banner->delete();

            return response()->json([
                'success' => 'Berhasil menghapus banner promo'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal menghapuus. Kode error ' . $th->getCode()
            ], 400);
        }
    }
}
