<?php

namespace App\Http\Controllers;

use App\Models\TBranche;
use App\Models\Tinvoice;
use Illuminate\Http\Request;

class TBrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function filter(Request $request)
    {
        $response = [];
        $branche =request('BranchName') ;
        if(count(TBranche::where("BranchName",$branche)->get()) >= 1){
            $query =Tinvoice::query()->when((TBranche::where("BranchName",request('BranchName'))->get())[0]->BranchId, function ($q) {
                return $q->where('BranchFId', (TBranche::where("BranchName",request('BranchName'))->get())[0]->BranchId);
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $fields = $request->validate([ 'BranchName' => 'required|string|unique:TBranches,BranchName']);
            $branche = TBranche::create(['BranchName' => $fields['BranchName']]);
            $response = ['message' => "Save",];  
            return response($response,201);
        } catch (\Throwable $th) {
            $response = ['message' => $th->getMessage()]; 
            return  $response;
        }
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
