<?php

namespace App\Http\Controllers;

use App\DataTables\pagesDataTable;
use App\Models\Page;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class PageController extends Controller
{
    use EditorTrait;



    public function getAllPagesList(Request $request)
    {
        // dd(1);
        $pages = Page::where('name', 'like', '%' . $request->input('q')  . '%')
            ->pluck('name', 'id')
            ->map(function ($text, $id) {
                return (object) ['text' => $text, 'id' => $id];
            })
            ->toArray();

        $data = array_values($pages);

        return $data;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(pagesDataTable $dataTable)
    {
        // $page = Page::where('id', 3)->first();
        // $gjs = $page->getTranslations('gjs_data', [app()->getLocale()]);
        // dd($gjs);
       // dd(1);
        return $dataTable->render('Dashboard.dashboard.pages.index');
    }
    public function editor(Request $request, Page $page)
    {
        session()->put('EDITOR_LANGUAGE',$request->lang??'en');
        return $this->show_gjs_editor($request, $page);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $parents = Page::pluck('name', 'id');
        $statuses=['active','unactive','draft'];
        return view('Dashboard.dashboard.pages.create_edit',['statuses'=>$statuses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validatePages($request);

        $page=Page::create(array_merge($request->only(['parent_id','slug','sort','status','header_style','meta_description','meta_title','meta_keywords']),
        ['created_by'=>Auth::user()->id,
        'name' => [
            'en' => $request->name,
            'ar' => $request->name_ar
         ],
    ]));



        //
        return redirect(route('pages.index'))->with('success',' added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
{
    $parents = Page::where('id', '!=', $page->id)->pluck('name', 'id');
    $statuses = ['active', 'unactive', 'draft'];

    return view('Dashboard.dashboard.pages.create_edit', [
        'page' => $page,
        'parents' => $parents,
        'statuses' => $statuses,
    ]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
    $updateData = array_merge($request->only('parent_id','slug','sort','status','header_style','meta_description','meta_title','meta_keywords'),
    ['updated_by'=>Auth::user()->id,
    'name' => [
        'en' => $request->name,
        'ar' => $request->name_ar
     ],
]);
    $page->update($updateData);
    return redirect(route('pages.index'))->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        // dd(1);
        $page->deleted_by=auth()->id();
        $page->save();
        $page->delete();
        return response()->json(['success'=>true,'message'=>__('Delete Successfully')]);
    }
    public function validatePages($request){
        $valid=[
            'name'=>'required',
            'slug' => 'required|regex:/^[^\s]+$/|unique:website.pages,slug',
            'sort'=>'required|integer',
            'status'=>'required',
        ];
        $messages = [
            'slug.regex' => 'The slug must not contain spaces.',
        ];
        return $request->validate($valid,$messages);
    }
}
