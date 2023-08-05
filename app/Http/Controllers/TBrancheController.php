<?php

namespace App\Http\Controllers;

use App\Models\TBranche;
use Illuminate\Http\Request;

class TBrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
                # code...
        $fields = $request->validate([ 'BranchName' => 'required|string|unique:t_branches,BranchName']);
        $branche = TBranche::create(['BranchName' => $fields['BranchName']]);
        $response = ['message' => "Save",];  
        return response($response,201);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function getAllBranch()
    {
                //
                $branche = TBranche::all();
                $response = [
                    'branch' => $branche,
                ];  
                return response($response,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TBranche $tBranche)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TBranche $tBranche)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TBranche $tBranche)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TBranche $tBranche)
    {
        //
    }
}
