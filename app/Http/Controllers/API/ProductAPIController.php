<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductAPIController extends Controller
{
    // get all data product
    public function index(Request $request)
    {
        // logika custom header
        // $ah = AuthController::header;
        // $res1 = $request->header('X-PARTNER-ID');
        // $res2 = $request->header('X-EXTERNAL-ID');
        // $res3 = $request->header('X-SIGNATURE');

        // if (
        //     $res1 === $ah['X-PARTNER-ID'] &&
        //     $res2 === $ah['X-EXTERNAL-ID'] &&
        //     $res3 === $ah['X-SIGNATURE-ID']
        // ) {
        //     $products = Product::all();
        //     return response()->json([
        //         'status' => 'success',
        //         'data' => $products
        //     ], Response::HTTP_OK);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'Header ada yang kosong'
        //     ], Response::HTTP_UNAUTHORIZED);
        // }

        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'data' => $products
        ], Response::HTTP_OK);
    }

    // add product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        // logika untuk pemindahan data image
        $input = $request->all();
        if ($image = $request->file('image')) {
            $tagetPath = 'images/';
            $product_img = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($tagetPath, $product_img);
            $input['image'] = "$product_img";
        }
        Product::create($input);
        $data = [
            'status' => Response::HTTP_OK,
            'message' => 'Data berhasil ditambahkan',
            'data' => $input
        ];
        return response()->json($data);
    }

    // get data product by id
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            $data = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Data tidak ditemukan',
            ];
        } else {
            $data = [
                'status' => Response::HTTP_OK,
                'message' => 'Data berhasil ditemukan',
                'data' => $product
            ];
        }
        return response()->json($data);
    }

    // update data product by id
    public function update(Request $request, $id)
    {
        // cari data
        $product = Product::find($id);

        $request->validate([
            'name' => 'string|max:255',
            'price' => 'integer',
        ]);
        $input = $request->all();
        // logika update
        if ($image = $request->file('image')) {
            $tagetPath = 'images/';
            unlink($tagetPath . $product->image);
            $product_img = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($tagetPath, $product_img);
            $input['image'] = "$product_img";
        } else {
            unset($input['image']);
        }

        $product->update($input);
        $data = [
            'status' => Response::HTTP_OK,
            'message' => 'Data berhasil diupdate',
            'data' => $input
        ];
        return response()->json($data);
    }

    // destroy product
    public function destroy($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            $data = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Data tidak ditemukan',
            ];
        } else {
            // $tagetPath = 'images/';
            // unlink($tagetPath . $product->image);
            $product->delete();
            $data = [
                'status' => Response::HTTP_OK,
                'message' => 'Data berhasil dihapus',
            ];
        }

        return response()->json($data);
    }
}
