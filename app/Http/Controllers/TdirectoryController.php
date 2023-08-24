<?php

namespace App\Http\Controllers;

use App\Models\Tdirectory;
use App\Models\Tinvoicekey;
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
    public function getAllDirectoryAndInvoicekey(){
        $invoicekey = Tinvoicekey::all();
        $directory = Tdirectory::all(); 
        $response = [
            "data" =>[
                'directory' => $directory,
                'invoicekey' => $invoicekey
            ]
        ];  
        return response($response,201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getAllDirectory()
    {
        //
        $directory = Tdirectory::all();
        $response = $directory;  
        return response($response,201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $fields = $request->validate([ 'DirectoryName' => 'required|string|unique:tdirectories,DirectoryName','parentId'=>'nullable|integer']);
            $branche = Tdirectory::create(['DirectoryName' => $fields['DirectoryName'],'parentId'=> $fields['parentId']]);
            $response = ['message' => "Save",];  
            return response($response,201);
        } catch (\Throwable $th) {
            $response = ['message' => $th->getMessage()]; 
            return  $response;
        }


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
