<?php

namespace App\Http\Controllers;

use App\Models\Tinvoice;
use App\Models\Tpicture;
use Illuminate\Http\Request;

class TinvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getAllInvoice()
    {
        $invoice = Tinvoice::with('user.branch','invoicekey','directory')->get();
        $response = $invoice;
       return  response($response,201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $fields = $request->validate([
                'InvoiceCode' => 'required|string|unique:TInvoices',
                'InvoiceDesc' => '',
                'InvoiceBarCode'=>'required|string',
                'UserFId'=>'int',
                'DirectoryFId'=>'required|int',
                'BranchFId'=>'required|int',
                'InvoiceDate'=>'string',
                'InvoiceKeyFId'=>'required|int',
                'InvoicePath'=>'string',
                'AndroidVersion'=>'string',
                'InvoiceUniqueId'=>'string',
                'ClientName'=>'string',
                'ClientPhone'=>'string',
                'ExpiredDate'=>'string'    
            ]);
                $invoice = Tinvoice::create(
                    ['InvoiceCode' => $fields['InvoiceCode'],
                    'InvoiceDesc' =>$fields['InvoiceDesc'],
                    'InvoiceBarCode' =>$fields['InvoiceBarCode'] ,
                    'UserFId'=>$fields['UserFId'],
                    'DirectoryFId'=>$fields['DirectoryFId'],
                    'BranchFId'=>$fields['BranchFId'],
                    'InvoiceDate'=>$fields['InvoiceDate'],
                    'InvoiceKeyFId'=> $fields['InvoiceKeyFId'],
                    'InvoicePath'=> $fields['InvoicePath'],
                    'AndroidVersion'=> $fields['AndroidVersion'],
                    'InvoiceUniqueId'=> $fields['InvoiceUniqueId'],
                    'ClientName'=> $fields['ClientName'],
                    'ClientPhone'=> $fields['ClientPhone'],
                    'ExpiredDate'=>$fields['ExpiredDate']
                    ]
                );
                $response = ['message' => "Save"];  
            return response($response,201);
        } catch (\Throwable $th) {
            //throw $th;
            $response = ['message' => $th->getMessage()]; 
            return  $response;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $invoice = Tinvoice::find($id);
            return response($invoice,201);
        } catch (\Throwable $th) {
            
        }
       

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        //
        try {
                
            $data = [
                'InvoiceDesc' =>$request->InvoiceDesc,
                'InvoiceBarCode'=>$request->InvoiceBarCode];
            $invoice = Tinvoice::find($id);
            if(!$invoice){
                
            }
            $actualy = $invoice->update([
                'InvoiceDesc' =>$data['InvoiceDesc'],
                'InvoiceBarCode' =>$data['InvoiceBarCode']
            ]);
            $response =[
                'message'=>"Success"
            ];
            return response($response,201);
        } catch (\Throwable $th) {
            $response = ['message' => $th->getMessage()]; 
            return  $response;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tinvoice $tinvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $invoice = Tinvoice::find($id);
            if($invoice){
            //   $picture = Tpicture::where("InvoiceFId",$id)->get();
            //   foreach ($picture  as $item ) {
            //     Storage::disk('gcs')->delete($item['PublicUrl']);
            //   }
              $invoice->delete();

              return response(['message'=>"Suppression réussi avec succès"],201);
            }
        } catch (\Throwable $th) {
            
        }



    }
}
