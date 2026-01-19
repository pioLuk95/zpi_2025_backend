<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class SwaggerController extends Controller
{
    public function documentationList()
{
    $files = collect(File::files(storage_path('api-docs')))
        ->filter(fn ($f) => str_ends_with($f->getFilename(), '.json'))
        ->map(fn ($f) => $f->getFilename())
        ->sortDesc()
        ->values();

    return view('swagger.list', compact('files'));
}
}