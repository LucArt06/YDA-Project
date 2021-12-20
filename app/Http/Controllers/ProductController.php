<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductController as ResourcesProductController;

use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourcesProductController::collection(Product::all());
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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'type' => 'required',
            'category' => 'required',
        ], [
            'name.required' => "Vous devez saisir un nom.",
            'description.required' => "Vous devez saisir une description.",
            'image.required' => "Vous devez télécharger une image.",
            'image.image' => "Le fichier téléchargé n'est pas une image (format accepté: .png .jpg)",
            'type.required' => "Aucun type selectionné.",
            'category.required' => "Aucune catégorie selectionné."
        ]);

        $file = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->file('image')->store('/public'),
            'type' => $request->type,
            'category' => $request->category,
        ];

        product::create($file);

        return response()->json([
            "success" => true,
            "message" => "yes",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::where('id', $id)->get();
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
    }
}
