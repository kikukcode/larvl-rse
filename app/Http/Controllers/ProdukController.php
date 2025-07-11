<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Request handler untuk menampilkan semua produk
    public function index()
    {

        $products = [
            [
                'id' => 1,
                'name' => 'Produk 1',
                'price' => 10000,
            ],
            [
                'id' => 2,
                'name' => 'Produk 2',
                'price' => 20000,
            ],
            [
                'id' => 3,
                'name' => 'Produk 3',
                'price' => 30000,
            ],

        ];
        $products = collect($products)->map(function ($item) {
            return (object) $item;
        });
        $data = [
            'title' => 'Daftar Produk',
            'products' => $products

        ];
        return view('welcome', $data);
    }

    // Request handler untuk detail produk
    public function show($id)
    {
        return 'Ini detail produk dengan ID: ' . $id;
    }

    // Request handler untuk menyimpan produk baru
    public function store(Request $request)
    {
        $namaProduk = $request->input('nama');
        return 'Produk "' . $namaProduk . '" berhasil disimpan!';
    }

}
