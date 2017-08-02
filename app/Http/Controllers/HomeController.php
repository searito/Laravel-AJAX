<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();

        return view('prueba', compact('products'));
    }


    public function viewProduct(Request $request, $id){
        if ($request->ajax()) {
            $product = Product::find($id);

            return response()->json([
                'nombre'        =>  $product->name,
                'deshort'       =>  $product->short,
                'descomplete'   =>  $product->description
            ]);
        }
    }


    public function storageProduct(Request $request){
      
        if ($request->ajax()) {
            $product = new Product($request->all());
            $product->save();

            $productsTotal = Product::all()->count();

            return response()->json([
                'totalProducts' => $productsTotal,
                'notification' => 'El Producto ' . $product->name . ' Ha Sido Agregado A La Lista'
            ]);
        }
    }


    public function editProduct(Request $request, $id){
        if ($request->ajax()) {
            $product = Product::find($id);

            return response()->json([
                #'message' => 'Producto # ' . $product->id . ' - ' . $product->name
                'codigo'      =>  $product->id,
                'name'        =>  $product->name,
                'corto'       =>  $product->short,
                'description' =>  $product->description
            ]);
        }
    }


    public function updateProduct(Request $request , $id){
        if ($request->ajax()) {
            $product = Product::find($id);
            
            $product->fill($request->all());
            $product->save();

            return response()->json([
                'estado' => 'Los Datos De '. $product->name . ' Han Sido Actualizados...'
            ]);
        }
    }


    public function destroyProduct(Request $request, $id){
        if ($request->ajax()) {
            $product = Product::find($id);
            $product->delete();

            $productsTotal = Product::all()->count();

            return response()->json([
                'total' => $productsTotal,
                'message' => $product->name . ' Fué Eliminado Correctamente'
            ]);
        }
    }
}
