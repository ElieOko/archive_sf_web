<?php

namespace App\Http\Controllers;

use App\Models\Tinvoicekey;
use Illuminate\Http\Request;

class TinvoicekeyController extends Controller
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
    public function getAllInvoiceKey()
    {
        //
        $invoicekey = Tinvoicekey::all();
        $response = $invoicekey;
     
        return response($response,201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([ 'Invoicekey' => 'required|string|unique:tinvoicekeys,Invoicekey','DirectoryFId'=>'required|int']);
        $branche = Tinvoicekey::create(['Invoicekey' => $fields['Invoicekey'],'DirectoryFId'=>$fields['DirectoryFId']]);
        $response = ['message' => "Save",];  
        return response($response,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tinvoicekey $tinvoicekey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tinvoicekey $tinvoicekey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tinvoicekey $tinvoicekey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tinvoicekey $tinvoicekey)
    {
        //
    }
}
