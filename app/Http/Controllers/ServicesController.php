<?php

namespace App\Http\Controllers;
use App\Models\sections;
use App\Models\services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $sections = sections::all();
         $services = services::all();
        return view('services.services',compact('sections','services'));
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
        $validation = $request->validate([

            'name' => 'required|unique:services|max:255',

        ],[
            'name.required' =>'يرجي ادخال اسم الخدمه',
            'name.unique' =>'اسم الخدمه مسجل مسبقا',
        ]);

        services::create([
            'name' => $request->name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'تم اضافة الخدمه بنجاح ');
        return redirect('/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, services $services)
    {
        $id = sections::where('section_name', $request->section_name)->first()->id;

        $validatedData = $request->validate([

            'name' => 'required|max:255|unique:services,name,'.$request->serv_id,
            'description' => 'required'
        ],[
            'name.required'  =>'يرجي ادخال اسم الخدمه',
            'name.unique' =>'اسم الخدمه موجود مسبقا',
            'description.required' =>'يرجي ادخال البيان',
        ]);


        $services = services::find($request->serv_id);

        $services->update([
        'name' => $request->name,
        'description' => $request->description,
        'section_id' => $id,
        ]);

        session()->flash('Edit', 'تم تعديل الخدمه بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\services  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $services = services::findOrFail($request->serv_id);
        $services->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect('/services');
    }
}
