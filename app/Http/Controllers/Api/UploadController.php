<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function upload(Request $request)
    {
        
        //Storage::put('PCB2II.pdf', $request->getContent());

        $request->validate([
            'file' => 'required',
            'file_name' => 'nullable|string'
        ]);
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file->store('attachments', 's3');
            // $attachment->file_name = $payload['file_name'] ?? $file->getClientOriginalName();
            // $attachment->content_url = $file->store('attachments', 's3');
            // $attachment->content_type = $file->getClientMimeType();
            // $attachment->size = $file->getClientSize();
            // $attachment->save();
        }

        return "successful";
    }
    
}
