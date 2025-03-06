<?php

namespace App\Exports;

use App\Models\RequestHiring;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RequestsExport implements WithMapping, WithHeadings,FromQuery
{
    protected $id;
    public function __construct($id=null)
    {
        // dd(request('IDS'));
        // dd($id);

        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */ public function query()
    {
        if($this->id!="null"){
            $requests=RequestHiring::query()->where('id',$this->id);
            // dd($this->id);

            // dd($requests);
            return $requests;

        }else{
            $requests=RequestHiring::query();
            if(request('IDS')){
                $requests=$requests->whereIn('id',explode(',',request('IDS')));
            }
            // dd($this->id);
            return $requests;
        }

    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function map($request) : array {
        // dd($request);
        return [
            $request->email,
            $request->position->name?? '__' ,
            $request->level->name?? '__' ,
            $request->full_name?? '__' ,
            $request->applied?? '__' ,
            $request->phone?? '__' ,
            $request->gender?? '__' ,
            $request->live_in_cairo?? '__' ,
            $request->address?? '__' ,
            $request->getFirstMediaUrl('requests_personal_images')?? '__' ,
            $request->college?? '__' ,
            $request->degree?? '__' ,
            $request->work_style?? '__' ,
            $request->employment?? '__' ,
            $request->experience?$request->experience.'year': '__' ,
            $request->getFirstMediaUrl('requests_personal_cvs')?? '__' ,
            $request->start_date?? '__' ,
            $request->employed?? '__' ,
            $request->company_name?? '__' ,
            $request->currant_position?? '__' ,
            $request->currant_salary?? '__' ,
            $request->expected_salary?? '__' ,
            $request->projects_links?? '__' ,
            $request->birth_date?? '__' ,
            $request->skillset?? '__' ,
            $request->experience_essay?? '__' ,
            $request->have_laptop?? '__' ,
            $request->laptop_brand?? '__' ,
            $request->created_at?$request->created_at->format('Y-m-d H:i:s'):'',

        ] ;
    }
    public function headings() : array {
        return [
            __('Email'),
            __('Position'),
            __('Level'),
            __('Full Name'),
            __('Applied'),
            __('Phone'),
            __('Gender'),
            __('Live In Cairo'),
            __('Address'),
            __('Personal Photo'),
            __('College'),
            __('Degree'),
            __('Work Style'),
            __('Employment'),
            __('Experience'),
            __('CV'),
            __('Start Date'),
            __('Employed'),
            __('Company Name'),
            __('Currant Position'),
            __('Currant Salary'),
            __('Expected Salary'),
            __('Projects Links'),
            __('Birth Date'),
            __('Skillset'),
            __('Experience Essay'),
            __('Have Laptop'),
            __('Laptop Brand'),
            __('Created At'),



        ] ;
    }
}
