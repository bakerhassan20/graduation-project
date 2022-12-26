<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\sections;
use App\Models\services;
use App\Models\CompanyServices;
use App\Models\User;
use App\Http\traits\ImageTrait;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Companies::all();
        $sections = sections::all();
        $services = services::all();
        return view('admin.company.index',compact('companies','sections','services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sections = sections::all();
        $services = services::all();
        $users = User::all();

        return view('admin.company.add_company',compact('sections','services','users'));
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
            'name'=>"required|max:190",
            'section'=>"required",
            'lat'=>"required",
            'lng'=>"required",

        ]);
        Companies::create([
            'name' =>$request->name,
            'user_id' =>$request->user,
            'section_id' =>$request->section,
            'description' =>$request->note,
            'latitude' =>$request->lat,
            'longitude' =>$request->lng,
            'Status' =>1,
        ]);
        if($request->file('pic')){
            $this->validate($request, [
                'pic' => 'required|mimes:jpeg,png,jpg'
                ], [
                    'pic.mimes' => 'صيغة المرفق يجب ان تكون   jpeg , png , jpg',
                ]);

        $Company = Companies::latest()->first();
        $dataimage = $this->insertImage($Company->id,$request->pic,'assets/img/company/');
        $Company->update([
            'img'=> $dataimage,
        ]);
        }
         if($request->service){
            foreach($request->service as $service){
                CompanyServices::create([
                    'company_id' =>$Company->id,
                    'service_id' =>$service,
                ]);
            }
         }

        return redirect()->route('companys.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $company)
    {
       $company = Companies::where('id',$company->id)->firstOrFail();
       $CompanyServices = CompanyServices::where('company_id',$company->id)->get();
       return view('admin.company.show',compact('company','CompanyServices'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
        //
    }
}
