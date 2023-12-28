<?php

namespace App\Http\Controllers;

use App\DataTables\RequestHiringDataTable;
use App\Exports\RequestsExport;
use App\Models\Level;
use App\Models\Position;
use App\Models\RequestHiring;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RequestHiringController extends Controller
{
    public function index(RequestHiringDataTable $datatable){
        // dd(4);
        // $request=RequestHiring::find(1)->position->name;
        // dd($request);
      return  $datatable->render('Dashboard.dashboard.requests.index');
    }
    public function getone()
    {
        return view('Dashboard\dashboard\positions\media');
    }


    public function one(Request $request)
    {
        // $this->validateLevel($request);


        $request_hiring=RequestHiring::create(['email'=>'d@d.com','full_name'=>'mmm','applied'=>'yes','phone'=>'56875655','gender'=>'male','birth_date'=>now(),'live_in_cairo'=>'yes','address'=>'dcvbvb','college'=>'fdcb','degree'=>'hgfdv','work_style'=>'office','employment'=>'full_time','experience'=>'1','start_date'=>now(),'employed'=>'no']);
        $request_hiring->addMediaFromRequest('image')->toMediaCollection('requests_personal_images');

        $request_hiring->addMediaFromRequest('cv')->toMediaCollection('requests_personal_cvs');


     }






    public function create()
    {
        $positions=Position::pluck('name', 'id');
        $levels=Level::pluck('name', 'id');
        return view('Dashboard.dashboard.requests.create_edit',['positions'=>$positions,'levels'=>$levels]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validateLevel($request);


        $request_hiring=RequestHiring::create(array_merge($request->only(['email','position_id','level_id','full_name','applied','phone','gender','birth_date','live_in_cairo','address','college','degree','work_style','employment','experience','start_date','employed','company_name','currant_position','currant_salary','expected_salary','projects_links','skillset','experience_essay','have_laptop','laptop_brand'])));
        $request_hiring->addMediaFromRequest('image')->toMediaCollection('requests_personal_images');
        $request_hiring->addMediaFromRequest('cv')->toMediaCollection('requests_personal_cvs');
        $image_url=$request_hiring->getFirstMediaUrl('requests_personal_images');
        $cv_url=$request_hiring->getFirstMediaUrl('requests_personal_cvs');
        $request_hiring->personal_photo=$image_url;
        $request_hiring->cv=$cv_url;
        $request_hiring->save();


        return redirect(route('requests.index'))->with('success',' added successfully');
     }

    /**
     * Display the specified resource.
     */
    public function show(RequestHiring $request)
    {
        return view('Dashboard.dashboard.requests.show',compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestHiring  $request)
    {
        $positions=Position::pluck('name', 'id');
        $levels=Level::pluck('name', 'id');
        return view('Dashboard.dashboard.requests.create_edit',['request'=>$request,'positions'=>$positions,'levels'=>$levels]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestHiring $request_hiring)
    {
        $updateData = array_merge($request->only('email','position_id','level_id','full_name','applied','phone','gender','birth_date','live_in_cairo','address','college','degree','work_style','employment','experience','start_date','employed','company_name','currant_position','currant_salary','expected_salary','projects_links','skillset','experience_essay','have_laptop','laptop_brand'));
        $imageAttr=[];
        if($request->file('image')){
            $request_hiring->delete('requests_personal_images');
            $request_hiring->addMediaFromRequest('image')->toMediaCollection('requests_personal_images');
            $image_url=$request_hiring->getFirstMediaUrl('requests_personal_images');
            $imageAttr=$image_url;
            $updateData=array_merge($updateData,$imageAttr);
        }
        $cvAttr=[];
        if($request->file('cv')){
            $request_hiring->delete('requests_personal_cvs');
            $request_hiring->addMediaFromRequest('cv')->toMediaCollection('requests_personal_cvs');
            $cv_url=$request_hiring->getFirstMediaUrl('requests_personal_cvs');
            $cvAttr=$cv_url;
            $updateData=array_merge($updateData,$cvAttr);
        }
        $request_hiring->update($updateData);
    return redirect(route('requests.index'))->with('success', 'Updated successfully');

    }



    public function destroy(RequestHiring $request)
    {
        $request->deleted_by=auth()->id();
        $request->save();
        $request->delete();
        return response()->json(['success'=>true,'message'=>__('Delete Successfully')]);
    }

    public function export(Request $request){
        switch ($request->export_type){
            case'csv':
                if($request->id){
                    return Excel::download(new RequestsExport($request->id),'Request'.time().'.csv',\Maatwebsite\Excel\Excel::CSV);
                }
                return Excel::download(new RequestsExport,'Requests'.time().'.csv',\Maatwebsite\Excel\Excel::CSV);
                break;
            case'excel':
                if($request->id){
                    return Excel::download(new RequestsExport($request->id),'Request'.time().'.xlsx',\Maatwebsite\Excel\Excel::XLSX);
                }
                return Excel::download(new RequestsExport,'Requests'.time().'.xlsx',\Maatwebsite\Excel\Excel::XLSX);
                break;
        }
    }

}
