<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ProductRepository;
use App\Models\Product;
use Auth;

class ProductController extends Controller
{

  public function __construct(ProductRepository $products)
  {
    $this->middleware('auth');
    $this->products = $products;
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $products = $this->products->team_products(Auth::user()->team_id);

    return view('products.index', [
      'product' => new Product,
      'products' => $products,
    ]);

  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

    $this->validate($request, [
      'category' => 'required',
      'description' => 'required',
      'cost' => 'required',
      'sell_price' => 'required'
    ]);

    $product = new Product;
    $product->team_id = Auth::user()->team_id;
    $product->category = $request->category;
    $product->description = $request->description;
    $product->cost = $request->cost;
    $product->sell_price = $request->sell_price;
    $product->save();
    return redirect()->route('product.index');


  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $product = Product::findOrFail($id);

    return view('products.edit', [
      'product' => $product,
    ]);
  }


  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $product = Product::findOrFail($id);

    $product->description = $request->description;
    $product->category = $request->category;
    $product->cost = $request->cost;
    $product->sell_price = $request->sell_price;
    $product->on_hand = $request->on_hand;
    $product->on_order = $request->on_order;

    if ($request->is_retired) {
      $product->is_retired = 1;
    }

    $product->save();

    return redirect()->route('product.index');
  }

  public function update_inventory(Request $request, $id)
  {
    $product = Product::findOrFail($id);

    $product->on_hand = $request->on_hand;
    $product->on_order = $request->on_order;

    $product->save();
    return redirect()->route('product.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $product = Product::findOrFail($id);
    $product->delete();
    return redirect()->route('product.index');
  }

  public function retire($id)
  {
    $product = Product::findOrFail($id);
    $product->is_retired = True;
    $product->save();

    return redirect()->route('product.index');
  }

  public function get_sell_price(Request $request)
  {
    $product = Product::findOrFail($request->id);
    return $product->sell_price;
  }
}
