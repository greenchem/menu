<?php

namespace App\Http\Controllers\Api\MenuSys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

// Model
use App\Objects\Product;
use App\Objects\Menu;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where('menu_id', $request->input('menu_id'))->get();

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Is the Menu published, if so, you cannot create product.
        if (Menu::find($request->input('menu_id'))->period->status == 'visible') {
            return response()->josn(['status' => 2]); // forbidden
        } else {
            $product = new Product;
            $product->menu_id = $request->input('menu_id');
            $product->name = $request->input('name');
            $product->unit_type = $request->input('unit_type');
            $product->inventory = $request->input('inventory');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            $product->save();

            return response()->json([
                'product_id' => $product->getAttribute('id'),
                'status' => 0
            ]);
        }
    }

    /**
     * Show the form for creating a list of new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createList(Request $request)
    {
        // Is the Menu published, if so, you cannot create product.
        if (Menu::find($request->input('menu_id'))->period->status == 'visible') {
            return response()->josn(['status' => 2]); // forbidden
        } else {
            $products = json_decode($request->input('products'), true);

            foreach ($products as $product) {
                Product::create( array_only($product, [
                    'menu_id',
                    'name',
                    'unit_type',
                    'inventory',
                    'price',
                    'description'
                ]));
            }

            return response()->json($products);
        }
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
        $product = Product::find($id);

        // Is the product published, if so, it cannot be updated.
        if ($product->menu->period->status == 'visible') {
            return response()->json(['status' => 2]); // forbidden
        } else {
            $product->name = $request->input('name');
            $product->unit_type = $request->input('unit_type');
            $product->inventory = $request->input('inventory');
            $product->price = $request->input('price'); // 上線後不可更動
            $product->description = $request->input('description');
            $product->save();

            return response()->json(['status' => 0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        // Check the product is published or not.
        if ($product->menu->period->status == 'visible') {
            return response()->json(['status' => 2]);
        } else {
            $product->delete();

            return response()->json(['status' => 0]);
        }
    }

    /**
     * Remove a list of resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroyList(Request $request)
    {
        $menu = Menu::find($request->input('menu_id'));

        if ($menu->period->status == 'visible') {
            return response()->json(['status' => 2]);
        } else {
            $menu->products()->detach();

            return response()->json(['status' => 0]);
        }
    }
}
