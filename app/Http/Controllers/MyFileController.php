<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\MyFile;
use Illuminate\Http\Request;

class MyFileController extends Controller
{
    public function index()
    {
        $files=MyFile::with('media')->get();
        return view('index',compact('files'));
    }
    public function add()
    {
        return view('add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|array',
            'file.*' => 'mimes:jpg,jpeg,png,gif,mp4,mov,avi,wmv|max:51200'
        ]);


        $title = MyFile::create([
            'title' => $request->title,
        ]);
    
        foreach ($request->file('file') as $file) {
            $mimeType = $file->getMimeType();
            $fileType = str_contains($mimeType, 'image') ? 'image' : (str_contains($mimeType, 'video') ? 'video' : null);
    
            if (!$fileType) {
                continue;
            }
    
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('media'), $filename);
    
            
           
            $media = Media::create([
                'my_file_id' => $title->id,
                'file_name' => $filename,
                'type' => $fileType,
            ]);

        }
    
        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }
    public function edit($id)
    {
        $media=MyFile::with('media')->where('id', $id)->first();
        return view('edit',compact('media'));
    }
  

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'file.*' => 'nullable|mimes:jpg,jpeg,png,gif,mp4,mov,avi,wmv|max:51200'
    ]);

    $file = MyFile::findOrFail($id);
    $file->title = $request->title;
    $file->save();

    if ($request->has('deleted_files')) {
        $deletedIds = json_decode($request->deleted_files, true);

        if (!empty($deletedIds)) {
            $filesToDelete = Media::whereIn('id', $deletedIds)->get();

            foreach ($filesToDelete as $mediaFile) {
                
                $filePath = public_path('media/' . $mediaFile->file_name);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $mediaFile->delete();
            }
        }
    }
    if ($request->hasFile('file')) {

        foreach ($request->file('file') as $uploadedFile) {

            $newName = time() . '_' . $uploadedFile->getClientOriginalName();
            $mimeType = $uploadedFile->getMimeType();
            $fileType = explode('/', $mimeType)[0]; 
        
            $uploadedFile->move(public_path('media'), $newName);
        
            Media::create([
                'my_file_id' => $file->id,
                'file_name' => $newName,
                'type' => $fileType,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Media updated successfully!');
}


public function destroy($id)
{
    $file = MyFile::find($id);
    
    if (!$file) {
        return redirect()->back()->with('error', 'File not found.');
    }

    $media = Media::where('my_file_id', $file->id)->get();
    foreach ($media as $item) {
        $filePath = public_path('media/' . $item->file_name);
        if (file_exists($filePath)) {
            unlink($filePath); 
        }        
        $item->delete();
    }
    
    $file->delete();

    return redirect()->route('index')->with('success', 'File and associated media deleted successfully.');
}



}
