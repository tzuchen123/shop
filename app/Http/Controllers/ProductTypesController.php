<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;

class ProductTypesController extends Controller
{
    public function index()
    {
        $types = ProductType::all();
        // dd($products);

        return view('admin.product_types.index', compact("types"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.product_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $requsetData = $request->all();

        ProductType::create($requsetData);

        return redirect('/admin/product_types');
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


        $type = ProductType::find($id);

        return view('admin.product_types.edit', compact("type"));
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

        $type = ProductType::find($id);


        $requsetData = $request->all();
        // dd( $requsetData);


        $type->update($requsetData);

        return redirect('/admin/product_types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductType::destroy($id);

        return redirect('/admin/product_types');
    }
}
