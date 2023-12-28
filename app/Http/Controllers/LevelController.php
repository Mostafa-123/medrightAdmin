<?php

namespace App\Http\Controllers;

use App\DataTables\LevelsDataTable;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LevelsDataTable $dataTable){
        return $dataTable->render('Dashboard.dashboard.levels.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.dashboard.levels.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateLevel($request);


        $level=Level::create(array_merge($request->only(['name'])));

        return redirect(route('levels.index'))->with('success',' added successfully');
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level  $level)
    {
        return view('Dashboard.dashboard.levels.create_edit',compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Level $level)
    {
        $updateData = array_merge($request->only('name'));
        $level->update($updateData);
    return redirect(route('levels.index'))->with('success', 'Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        $level->deleted_by=auth()->id();
        $level->save();
        $level->delete();
        return response()->json(['success'=>true,'message'=>__('Delete Successfully')]);
    }


    public function validateLevel($request){
        $valid['name']=['required','string','unique:website.levels'];
        return $request->validate($valid);
    }
}
