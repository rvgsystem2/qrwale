<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfEditorController extends Controller
{
    public function index()
    {
        return view('pdf.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:20480',
        ]);

        $path = $request->file('pdf_file')->store('public/pdf_files');
        $url = Storage::url($path);
  dd($url);
        return view('pdf.editor', ['pdfUrl' => $url]);
    }

}
