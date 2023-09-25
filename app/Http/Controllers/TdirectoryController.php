<?php

namespace App\Http\Controllers;

use App\Models\Tinvoice;
use App\Models\Tdirectory;
use App\Models\Tinvoicekey;
use Illuminate\Http\Request;

class TdirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function filter(Request $request)
    {   
        $response = [];
        $directory = request('directory');
       //return response(["value "=>(Tdirectory::where("DirectoryName",$directory)->get())[0]->DirectoryId],201);
        if(count(Tdirectory::where("DirectoryName",$directory)->get()) >= 1){
            $query =Tinvoice::query()->when((Tdirectory::where("DirectoryName",request('directory'))->get())[0]->DirectoryId, function ($q) {
                return $q->where('DirectoryFId', (Tdirectory::where("DirectoryName",$directory)->get())[0]->DirectoryId);
            })->with('user.branch', 'invoicekey', 'directory',"pictures");
            $data = ($query->paginate(5));
            $response =  $data;
        }
        return response($response,201);
    }
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
            $fields = $request->validate([ 'DirectoryName' => 'required|string|unique:tdirectories,DirectoryName','ParentFId'=>'nullable|integer']);
            $branche = Tdirectory::create(['DirectoryName' => $fields['DirectoryName'],'ParentFId'=> $fields['ParentFId'],'ForClient'=>$request->ForClient]);
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
