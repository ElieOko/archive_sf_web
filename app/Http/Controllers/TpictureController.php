<?php

namespace App\Http\Controllers;

use App\Models\TBranche;
use App\Models\Tinvoice;
use App\Models\Tpicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TpictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        /*
        
        GOOGLE_CLOUD_ACCESS_KEY_ID = infinite-strata-226508
        
        */
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
        try {
            //code...
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:10302048',
            ]);
            $original_name = $request->file('image')->getClientOriginalName();
            if ($request->hasFile('image')) {
                // ...
                $invoice = Tinvoice::where('InvoiceUniqueId', $request->uniqueId)->first();
                $branchName =(TBranche::find($invoice->BranchFId))->BranchName;
                $file_name =  "$branchName-".time()."-$original_name";
                $path = "GombeIT/Archive-Public/";
                $fileContents = $request->file('image');
                $request->image->storeAs("image", $file_name );
                
                $url = "https://storage.googleapis.com/infinite-strata-226508.appspot.com/GombeIT/Archive-Public/$file_name";
                $success = Storage::disk('gcs')->putFileAs('GombeIT/Archive-Public/', $fileContents,$file_name );
                if ($success) {
                    # code...
                    Tpicture::create([
                        'PictureName'=>$file_name,
                        'PictureOriginalName'=>$original_name,
                        'PicturePath'=>$path,
                        'PublicUrl'=>$url,
                        'InvoiceFId'=>$invoice->InvoiceId
                    ]);
                    $response = [
                        'message' => 'Success '.$invoice->InvoiceId,
                        'path'=>storage_path()
                    ];  
                    return response($response,201);
                }
                else{
                    $response = [
                        'message' => 'No add '
                    ];  
                    return response($response,200);
                }
            }
            }
        catch (\Throwable $th) {
            $response = ['message' => $th->getMessage()]; 
            return  $response;
        }
    }
    public function storePicture(Request $request,$id)
    {
        //
        try {
            //code...
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:10302048',
            ]);
            $original_name = $request->file('image')->getClientOriginalName();
            if ($request->hasFile('image')) {
                // ...
                $invoice = Tinvoice::where('InvoiceId', $id)->first();
                $branchName =(TBranche::find($invoice->BranchFId))->BranchName;
                $file_name =  "$branchName-".time()."-$original_name";
                $path = "GombeIT/Archive-Public/";
                $fileContents = $request->file('image');
                $request->image->storeAs("image", $file_name );
                
                $url = "https://storage.googleapis.com/infinite-strata-226508.appspot.com/GombeIT/Archive-Public/$file_name";
                $success = Storage::disk('gcs')->putFileAs('GombeIT/Archive-Public/', $fileContents,$file_name );
                if ($success) {
                    # code...
                    Tpicture::create([
                        'PictureName'=>$file_name,
                        'PictureOriginalName'=>$original_name,
                        'PicturePath'=>$path,
                        'PublicUrl'=>$url,
                        'InvoiceFId'=>$id
                    ]);
                    $response = [
                        'message' => 'Success '.$id,
                        'path'=>storage_path()
                    ];  
                    return response($response,201);
                }
                else{
                    $response = [
                        'message' => 'No add '
                    ];  
                    return response($response,200);
                }
            }
            }
        catch (\Throwable $th) {
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
        $picture =  Tpicture::find($id);
        return response($picture,201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getAllPictureByInvoice($id)
    {
        //
        $picture = Tpicture::where('InvoiceFId', $id)->get();
        $data = [];
        foreach ($picture as $items){
            $data =[$items->PublicUrl];
        }
        return response($data,201);
    }
    public function getAllImages()
    {
        try {
            $pictures = Tpicture::all();

            $imageUrls = [];

            foreach ($pictures as $picture) {
                $imageUrl = Storage::url($picture->PublicUrl);

                $imageUrls[] = [
                    'id' => $picture->id,
                    'url' => $imageUrl,
                    'original_name' => $picture->PictureOriginalName,
                ];
            }

            $response = [
                'images' => $imageUrls,
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['message' => $th->getMessage()];
            return response()->json($response, 500);
        }
    }
    public function getAllPicture()
    {
        //
        $picture = Tpicture::with('invoice.user.branch','invoice.invoicekey','invoice.directory')->get();
        $picture_all = $picture->groupBy('InvoiceFId');
        return response($picture_all,201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function test()
    {
        //
        $picture = Tpicture::with('invoice.user.branch', 'invoice.invoicekey', 'invoice.directory')->get()->groupBy('InvoiceFId');
$imageUrls = [];
foreach ($picture as $invoiceFId => $images) {
    foreach ($images as $image) {
        $imageUrl = Storage::url($image->PictureName);
        // Chemin relatif vers l'image stockée
        // Créez le lien symbolique vers l'image
        // Storage::link($imagePath, public_path("storage/images/{$image->PictureName}"));

        $imageUrls[] = [
            'InvoiceFId' => $image->InvoiceFId,
            'PictureName'=> $image->PictureName,
            'PicturePath'=> $image->PicturePath,
            'PublicUrl'=>   $image->PublicUrl,
            'PictureOriginalName'=>$image->PictureOriginalName,
            'PictureId' => $image->PictureId,
            'url' => $imageUrl,
            'invoice' => $image->invoice,
            'branch' => $image->invoice->user->branch,
            'invoicekey' => $image->invoice->invoicekey,
            'directory' => $image->invoice->directory,
        ];
    }
    }
        $response = [
            'images' => $imageUrls,
        ];
        return response($response,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tpicture $tpicture)
    {
        //
    }
}
