<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        $title = $request->title;
        $description = $request->description;
        $cost = $request->cost;
        $path = $request->file('img')->store('public/img');
        // public/img/test.jpg
        $path = str_replace('public', 'storage', $path);
        $product = new Good();
        $product->title = $title;
        $product->description = $description;
        $product->cost = $cost;
        $product->img = $path;
        $product->save();
        return redirect()->intended('/');
    }
    public function showProduct(){
        $products = Good::all(); // Получаем все товары из базы данных
        return view('pages.shop', ['products'=>$products]); // Передаём массив товаров на шаблон
    }
    public function showSingleProduct(Request $request){
        $id = $request->id; // Получаем id товара из URL
        $product = Good::where('id', $id)->first(); // Достаём товар по его id из базы данных
        return view('pages.shopSingle', ['product'=>$product]); // Передаём товар в шаблон
    }

}
