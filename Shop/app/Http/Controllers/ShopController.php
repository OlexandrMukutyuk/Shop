<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoty;
use App\Models\Goods;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){
        $filterValue = $request->input('filter');
        //dd($filterValue);
        $category = Categoty::get();
        if($filterValue == "Cheaper"){
            $goods = Goods::orderBy('cost', 'asc')->get();
        }else if($filterValue == "Expensive"){
            $goods = Goods::orderBy('cost', 'desc')->get();
        }
        else{
            $goods = Goods::get();
        }
        return view('home', ['products' => $goods, 'categorys' => $category]);
    }

    public function category($id, Request $request){
        $category = Categoty::get();
        $filterValue = $request->input('filter');
        $category = Categoty::get();
        if($filterValue == "Cheaper"){
            $product = Goods::where('categoti_id', $id)->orderBy('cost', 'asc')->get();
        }else if($filterValue == "Expensive"){
            $product = Goods::where('categoti_id', $id)->orderBy('cost', 'desc')->get();
        }
        else{
            $product = Goods::where('categoti_id',$id)->get();
        }


        return view('home', ['products' => $product, 'categorys' => $category]);
    }

    public function product($id){
        $product = Goods::find($id);
        return view('users/product', ['product' => $product]);
    }

    public function basket(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Оновлення кількості товару лише для конкретного елементу кошика за його ідентифікатором
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->input('quantity');
        } else {
            $product = Goods::find($id);
            //dd($product);
            $cart[$id] = [
                'name' => $product['name'],
                'cost' => $product['cost'],
                'photo_path' => $product['photo_path'],
                'description' => $product['description'],
                'quantity' => $request->input('quantity'),
            ];
        }

        session()->put('cart', $cart); // Збереження оновленого масиву у сесії
        session()->save();
        return redirect()->back()->with('success', 'Товар успішно доданий до кошика');
    }

    public function basket_update(Request $request, $id){
        $cart = session()->get('cart', []);
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->input('quantity');
        } else {
            return redirect()->back()->with('eror', 'eror');
        }
        session()->put('cart', $cart); // Збереження оновленого масиву у сесії
        session()->save();
        return redirect()->back()->with('success', 'Товар успішно доданий до кошика');
    }

    public function basket_delete($id){
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart); // Збереження оновленого масиву у сесії
        session()->save();
        return redirect()->back()->with('success', 'Успішно видалено');
    }
    public function basket_list(){
        $cart = session()->get('cart', []);
        //dd($cart);
        return view('users/backet', ['carts' => $cart]);
    }

}
