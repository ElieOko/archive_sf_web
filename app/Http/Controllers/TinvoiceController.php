<?php

namespace App\Http\Controllers;

use App\Models\Tinvoice;
use App\Models\Tpicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $invoice = Tinvoice::with('user.branch','invoicekey','directory',"pictures")->orderBy('InvoiceId', 'desc')->paginate(5);
        $response = $invoice;
       return  response($response,201);
    }
    public function getAllInvoice2($id)
    {
        $query =Tinvoice::where('UserFId', $id)->with('user.branch','invoicekey','directory',"pictures")->orderBy('InvoiceId', 'desc')->paginate(5);
        $response = $query ;
       return  response($response,201);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $key = 0;
            $fields = $request->validate([
                'InvoiceCode' => 'required|string',
                'InvoiceDesc' => '',
                'InvoiceBarCode'=>'',
                'UserFId'=>'int',
                'DirectoryFId'=>'int',
                'BranchFId'=>'int',
                'InvoiceDate'=>'string',
                'InvoiceKeyFId'=>'',
                'InvoicePath'=>'',
                'AndroidVersion'=>'string',
                'InvoiceUniqueId'=>'string',
                'ClientName'=>'',
                'ClientPhone'=>'',
                'ExpiredDate'=>''    
            ]);
            if($fields['InvoiceKeyFId'] != 0){
                $key = $fields['InvoiceKeyFId'];
            }
                $invoice = Tinvoice::create(
                    ['InvoiceCode' => $fields['InvoiceCode'],
                    'InvoiceDesc' =>$fields['InvoiceDesc'],
                    'InvoiceBarCode' =>$fields['InvoiceBarCode'] ,
                    'UserFId'=>$fields['UserFId'],
                    'DirectoryFId'=>$fields['DirectoryFId'],
                    'BranchFId'=>$fields['BranchFId'],
                    'InvoiceDate'=>$fields['InvoiceDate'],
                    'InvoiceKeyFId'=>  $key,
                    'InvoicePath'=> $fields['InvoicePath'],
                    'AndroidVersion'=> $fields['AndroidVersion'],
                    'InvoiceUniqueId'=> $fields['InvoiceUniqueId'],
                    'ClientName'=> $fields['ClientName'],
                    'ClientPhone'=> $fields['ClientPhone'],
                    'ExpiredDate'=>$fields['ExpiredDate']
                    ]
                );
                $response = ['message' => "Save","invoiceId"=>$invoice->InvoiceId];  
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
        try {
            $invoice = Tinvoice::where("InvoiceId",$id)->with('user.branch', 'invoicekey', 'directory',"pictures")->get();
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

    public function filterInvoice(Request $request)
    {
        $query =Tinvoice::query()
        ->when(request('InvoiceCode'), function ($q) {
            return $q->where('InvoiceCode', request('InvoiceCode'));
        })
        ->when(request('InvoiceDesc'), function ($q) {
            return $q->where('InvoiceDesc', request('InvoiceDesc'),);
        })
        ->when(request('InvoiceBarCode'), function ($q) {
            return $q->where('InvoiceBarCode', request('InvoiceBarCode'),);
        })
        ->when([request('dateFrom'),request('dateTo')], function ($q) {
            return $q->whereBetween('InvoiceDate', [request('dateFrom'),request('dateTo')],);
        })
        ->when(request('InvoiceDate'), function ($q) {
            return $q->where('InvoiceDate', request('InvoiceDate'),);
        })
        ->when(request('UserFId'), function ($q) {
            return $q->where('UserFId', request('UserFId'),);
        })
        ->when(request('DirectoryFId'), function ($q) {
            return $q->where('DirectoryFId', request('DirectoryFId'),);
        })
        ->when(request('InvoiceKeyFId'), function ($q) {
            return $q->where('InvoiceKeyFId', request('InvoiceKeyFId'),);
        })
        ->when(request('BranchFId'), function ($q) {
            return $q->where('BranchFId', request('BranchFId'),);
        })
        ->with('user.branch', 'invoicekey', 'directory',"pictures");
        $data = ($query->paginate(5));
        $response =  $data;
        return response($response,201);
    }
    public function filterInvoice2(Request $request)
    {
        $query =Tinvoice::query()
        ->when(request('InvoiceCode'), function ($q) {
            return $q->where('InvoiceCode', request('InvoiceCode'));
        })
        ->when(request('InvoiceDesc'), function ($q) {
            return $q->where('InvoiceDesc', request('InvoiceDesc'),);
        })
        ->when(request('InvoiceBarCode'), function ($q) {
            return $q->where('InvoiceBarCode', request('InvoiceBarCode'),);
        })
        ->when(request('InvoiceDate'), function ($q) {
            return $q->where('InvoiceDate', request('InvoiceDate'),);
        })
        ->when(request('UserFId'), function ($q) {
            return $q->where('UserFId', request('UserFId'),);
        })
        ->when(request('DirectoryFId'), function ($q) {
            return $q->where('DirectoryFId', request('DirectoryFId'),);
        })
        ->when(request('InvoiceKeyFId'), function ($q) {
            return $q->where('InvoiceKeyFId', request('InvoiceKeyFId'),);
        })
        ->when(request('BranchFId'), function ($q) {
            return $q->where('BranchFId', request('BranchFId'),);
        })
        ->with('user.branch', 'invoicekey', 'directory',"pictures");
        $data = ($query->paginate(5));
        $response =  $data;
        return response($response,201);
    }
    // public function filterInvoiceUser(Request $request,$id)
    // {
    //     $query =Tinvoice::query()
    //     ->when(request('InvoiceCode'), function ($q) {
    //         return $q->where('InvoiceCode', request('InvoiceCode'))->where('UserFId',request('UserFId'));
    //     })
    //     ->when(request('InvoiceDesc'), function ($q) {
    //         return $q->where('InvoiceDesc', request('InvoiceDesc'),);
    //     })
    //     ->when(request('InvoiceBarCode'), function ($q) {
    //         return $q->where('InvoiceBarCode', request('InvoiceBarCode'),);
    //     })
    //     ->when(request('InvoiceDate'), function ($q) {
    //         return $q->where('InvoiceDate', request('InvoiceDate'),);
    //     })
    //     ->when(request('UserFId'), function ($q) {
    //         return $q->where('UserFId', request('UserFId'),);
    //     })
    //     ->when(request('DirectoryFId'), function ($q) {
    //         return $q->where('DirectoryFId', request('DirectoryFId'),);
    //     })
    //     ->when(request('InvoiceKeyFId'), function ($q) {
    //         return $q->where('InvoiceKeyFId', request('InvoiceKeyFId'),);
    //     })
    //     ->when(request('BranchFId'), function ($q) {
    //         return $q->where('BranchFId', request('BranchFId'),);
    //     })
    //     ->with('user.branch', 'invoicekey', 'directory',"pictures");
    //     $data = ($query->paginate(5));
    //     $response =  $data;
    //     return response($response,201);
    // }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $invoice = Tinvoice::find($id);
            if($invoice){
            $picture = Tpicture::where("InvoiceFId",$id)->get();
              foreach ($picture  as $item ) {
                Storage::disk('gcs')->delete("GombeIT/Archive-Public/".$item['PictureName']);
              }
              $invoice->delete();
              return response(['message'=>"Suppression réussi avec succès"],201);
            }
        } catch (\Throwable $th) {    
        }
    }
}
