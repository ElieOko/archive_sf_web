<?php

namespace App\Http\Controllers;

use App\Models\Tdirectory;
use Illuminate\Http\Request;

class TdirectoryController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([ 'DirectoryName' => 'required|string|unique:tdirectories,DirectoryName','parentId' => 'string']);
        $branche = Tdirectory::create(['DirectoryName' => $fields['DirectoryName'],'parentId'=>$fields['parentId']]);
        $response = ['message' => "Save",];  
        return response($response,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Tdirectory $tdirectory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tdirectory $tdirectory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tdirectory $tdirectory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tdirectory $tdirectory)
    {
        //
    }
}
