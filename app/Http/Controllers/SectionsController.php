<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Models\services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();           //sellect all colloms from section table
       return view('sections.sections',compact('sections'));  // compact => to path section data to view file
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
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',


        ]);

            sections::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'Created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم اضافة القسم بنجاح ');
            return redirect('/sections');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sections $sections)
    {
       $id = $request->id;

       $validatedData= $request->validate([
        'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
        'description' => 'required',

       ],[

        'section_name.required' =>'يرجي ادخال اسم القسم',
        'section_name.unique' =>'اسم القسم مسجل مسبقا',
        'description.required' =>'يرجي ادخال البيان',

       ]);
       $sections = sections::find($id);
       $sections->update([
           'section_name' => $request->section_name,
           'description' => $request->description,
       ]);
       session()->flash('edit','تم تعديل القسم بنجاج');
       return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id =$request->id;
        $sections = sections::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }

    public function getproducts($id){

        $data = DB::table('services')->where('section_id',$id)->pluck('name','id');
        return Json_encode($data);

    }
}
