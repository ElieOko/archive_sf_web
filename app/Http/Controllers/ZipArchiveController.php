<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use ZipArchive;
use App\Models\Tinvoice;
use Illuminate\Http\Request;

class ZipArchiveController extends Controller
{
    //
    public function download($data)
    {
    //   $zip = new ZipArchive();
      
    //   $name = "Soficom-Archive-".time().".zip";
    //   $dir = sys_get_temp_dir();
    //   $tmp = tempnam($dir, $name);
    //   if($zip->open($tmp, ZipArchive::CREATE) === true){    
    //     $data=Tinvoice::where("InvoiceId", $data)->with('user.branch','invoicekey','directory',"pictures")->first();
    //    // $zip->addFile(public_path()."/storage/".$data->directory."/".$data->InvoiceId.".pdf", $data->InvoiceId.".pdf");
    //         foreach ($data->pictures as $item) {
    //             $absf = basename($item['PublicUrl']);
    //             $zip->addFromString($item['PublicUrl'],"djd");
    //         } 
    //         $zip->close(); 
    //   }    
    $zip = new ZipArchive;
    
    $fileName = 'myNewFile.zip';
        $pa = "";
        $data=Tinvoice::where("InvoiceId", $data)->with('user.branch','invoicekey','directory',"pictures")->first();
    if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
    {
        $files = File::files(storage_path('app/image'));
        foreach ($data->pictures as $item) {
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                if($relativeNameInZipFile == $item['PictureName']){
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            } 
        }
        $zip->close();
    }  
    return response()->download(public_path($fileName));
    }
    public function __invoke()
    {
        $zip = new ZipArchive;
    
        $fileName = 'myNewFile.zip';
     
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path('storage'));
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            } 
            $zip->close();
        }
        return response()->download(public_path($fileName));
    }
}
