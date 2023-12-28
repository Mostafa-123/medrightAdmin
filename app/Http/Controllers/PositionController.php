<?php

namespace App\Http\Controllers;

use App\DataTables\LavelsDataTable;
use App\DataTables\PositionsDataTable;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PositionsDataTable $dataTable){
        return $dataTable->render('Dashboard.dashboard.positions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.dashboard.positions.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateposition($request);


        $position=position::create(array_merge($request->only(['name'])));

        return redirect(route('positions.index'))->with('success',' added successfully');    }

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
    public function edit(position  $position)
    {
        return view('Dashboard.dashboard.positions.create_edit',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $updateData = array_merge($request->only('name'));
        $position->update($updateData);
    return redirect(route('positions.index'))->with('success', 'Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->deleted_by=auth()->id();
        $position->save();
        $position->delete();
        return response()->json(['success'=>true,'message'=>__('Delete Successfully')]);
    }


    public function validateposition($request){
        $valid['name']=['required','string','unique:website.positions'];
        return $request->validate($valid);
    }
}







