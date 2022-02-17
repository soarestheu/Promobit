<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductTag;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tag = Tag::all();
        for($i=0; $i<count($tag); $i++){
            $tag[$i]->product = $this->getProductByTag($tag[$i]->id);;
        }
        
        return $tag;
    }

    public function getProductByTag($tagId)
    {
        $tagProduto = ProductTag::where('tag_id', $tagId)->get();
        for($i=0; $i<count($tagProduto); $i++){
            $product[] = Product::where('id', $tagProduto[$i]->product_id)->select('name')->get();
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
        //
        $tag = new Tag();
        $tag->name = $request->name;
        if($tag->save()){
            return response()->json(["success" => "Tag criada com sucesso"]);
        }else{
            return response()->json(["error" => "Erro ao criar tag"]);
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
        //
        $tag = Tag::find($id);

        return $tag;
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
        $data = $request->only('nome');
        $tag = Tag::where('id', $id)->update($data);
        if($tag){
            return response()->json(["success" => "Tag atualizada com sucesso"]);
        }else{
            return response()->json(["error" => "Erro ao atualizar Tag"]);
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
        //
        if( Tag::where('id', $id)->delete() ){
            return response()->json(["success" => "Tag deletada com sucesso"]);
        }else{
            return response()->json(["error" => "Erro ao deletar Tag"]);
        }
    }
}
