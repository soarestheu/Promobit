<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductTag;
use App\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::all();
        for($i=0; $i<count($product); $i++){
            $tagProduto = ProductTag::where('product_id', $product[$i]->id)->get();
            foreach($tagProduto as $index => $tp){
                $tag[$index] = Tag::find($tp->tag_id);
                $product[$i]->tag = $tag;
            }
        }
        return $product;
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
        $product = new Product();
        $product->name = $request->name;

        if($product->save()){
            for($i=0; $i<count($request->tags); $i++){
                $productTag = new ProductTag();
                $productTag->product_id = $product->id;
                $productTag->tag_id = $request->tags[$i];
                $productTag->save();
            }
            return response()->json(["success" => "Produto criado com sucesso"]);
        }else{
            return response()->json(["error" => "Erro ao criar produto."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $product->tag = ProductTag::where('product_id', $id)->get();
        
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $data = $request->only('name');
        $product = Product::where('id', $id)->update($data);
        if($product) {
            ProductTag::where('product_id', $id)->delete();
            for($i=0; $i<count($request->tag); $i++){
                $productTag = new ProductTag();
                $productTag->product_id = $id;
                $productTag->tag_id = $request->tag[$i];
                $productTag->save();
            }
            return response()->json(["success" => "Produto atualizado com sucesso"]);
        }else{
            return response()->json(["error" => "Erro ao atualizar produto"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(ProductTag::where("product_id", $id)->delete()){
            if( Product::where('id', $id)->delete() ){
                return response()->json(["success" => "Produto deletado com sucesso"]);
            }else{
                return response()->json(["error" => "Erro ao deletar produto"]);
            }
        }
        
    }

    public function verifyTag(Request $request)
    {
        return $request->idProd."  -> ". $request->idTag;
        if($request->idProd ==2 && $request->idTag == 1){
            return true;
        }else{
            return false;
        }
    }


        
}
