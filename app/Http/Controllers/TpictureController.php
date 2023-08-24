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
        try {
            //code...
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $original_name = $request->file('image')->getClientOriginalName();
       
            if ($request->hasFile('image')) {
                // ...
                $invoice = Tinvoice::where('InvoiceUniqueId', $request->uniqueId)->first();
                $branchName =(TBranche::find($invoice->BranchFId))->BranchName;
                $file_name =  "$branchName-".time()."-$original_name";
                $path = $request->image->storeAs("images", $file_name );
                $imageUrl ="http://localhost:8000". Storage::url($file_name);
                Tpicture::create([
                    'PictureName'=>$file_name,
                    'PictureOriginalName'=>$original_name,
                    'PicturePath'=>$path,
                    'PublicUrl'=>$imageUrl,
                    'InvoiceFId'=>$invoice->InvoiceId
                ]);
                $response = [
                    'message' => 'Success '.$invoice->InvoiceId,
                ];  
                return response($response,201);
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
        return response($picture,201);
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
