<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; // 1

class ProductControllerBS extends Controller

{
    public function index()
    {
        $views = Product::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('views.index', compact('views')); // 3
        
    }
    public function create()
    {
        return view('views.create');
    }
    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ]);

        try {
            $view = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            ]);
            return redirect('/view')->with(['success' => '<strong>' . $view->title . '</strong> Telah disimpan']);
        } catch(\Exception $e) {
            
            return redirect('/view/new')->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $view = Product::find($id); // Query ke database untuk mengambil data dengan id yang diterima
        return view('views.edit', compact('view'));
    }
    public function update(Request $request, $id)
    {
    $view = Product::find($id); // QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
    //KEMUDIAN MENGUPDATE DATA TERSEBUT
    $view->update([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock
    ]);
    //LALU DIARAHKAN KE HALAMAN /product DENGAN FLASH MESSAGE SUCCESS
    return redirect('/views')->with(['success' => '<strong>' . $view->title . '</strong> Diperbaharui']);
    }

    public function destroy($id)
    {
    $view = Product::find($id); //QUERY KEDATABASE UNTUK MENGAMBIL DATA BERDASARKAN ID
    $view->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
    return redirect('/view')->with(['success' => '</strong>' . $view->title . '</strong> Dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }
}
