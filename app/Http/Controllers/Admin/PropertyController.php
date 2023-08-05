<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Option;
use App\Models\Picture;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.properties.index',[
                'properties' => Property::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = new Property();

        $property->fill([
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'Montpellier',
            'postal_code' => 34000,
            'sold' => false,
        ]);

        return view('Admin.properties.form',[
            'property'=>$property,
            'options'=> Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyFormRequest $request)
    {
        $property= Property::create($request->validated());
        $property->options()->sync($request->validated('options'));//synchronisation des données validé et recuperation de la clé option
        $property->attachFiles($request->validated('pictures'));//pour attacher les fichier d'image
        return to_route('admin.property.index')->with('success', 'le bien a bien été crée');
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view ('admin.properties.form',[
            'property' => $property,
            'options'=> Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyFormRequest $request,Property $property)
    {
       
        $property->update($request->validated());
        $property->options()->sync($request->validated('options')); //synchronisation des données validé et recuperation de la clé option
       $property->attachFiles($request->validated('pictures'));//pour attacher les fichier d'image
        return to_route('admin.property.index')->with('success', 'le bien a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        Picture::destroy($property->pictures()->pluck('id'));
        $property->delete();
        return to_route('admin.property.index')->with('success', 'le bien a bien été supprimé');
    }
}
