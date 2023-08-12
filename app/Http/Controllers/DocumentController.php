<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Document::orderBy('created_at', 'desc')->paginate(30);

        $data = [
            'items' => $items,
            'csrf_token' => csrf_token(),
        ];
        return Inertia::render('Documents/Index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $uploadedFiles = [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $pathFile = $file->store('/');
                $data = [
                    'name' => $file->getClientOriginalName(),
                    'path_file' =>  env('APP_URL').'/storage/'.$pathFile,
                ];

                $itemCreated = Document::create($data);

                $uploadedFiles[] = $itemCreated;
            }
        }

        return $uploadedFiles;
    }
}
