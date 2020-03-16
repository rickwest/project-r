<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Store an uploaded file on the default filesystem.
     *
     * @param Request $request
     * @return false|string
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image'
        ]);

        $path = $request->file('file')->store('tmp');

        return $path;
    }

    /**
     * Delete a specified file from the default filesystem.
     *
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        if (Storage::exists($request->path)) {
            Storage::delete($request->path);
        }
    }
}
