<?php

namespace GMJ\LaravelBlock2Content\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use GMJ\LaravelBlock2Content\Models\Block;
use Illuminate\Support\Facades\Storage;
use File;

class BlockController extends Controller
{
    public function index($element_id)
    {
        $collection = Block::where("element_id", $element_id)->first();
        if ($collection) {
            return redirect()->route("LaravelBlock2Content.edit", $element_id);
        }
        return redirect()->route("LaravelBlock2Content.create", $element_id);
    }

    public function create($element_id)
    {
        $element = Element::find($element_id);
        return view("LaravelBlock2Content::create", compact("element", "element_id"));
    }

    public function store($element_id)
    {

        $element = Element::findOrFail($element_id);
        request()->validate([
            "text.*" => ["required"],
        ]);

        $collection = new Block;
        $collection->element_id = $element_id;
        $collection->text = request()->text;
        $collection->save();

        $element->active();
        Alert::success("Add Element {$element->title} Content success");
        return redirect()->route("admin.element.index");
    }

    public function edit($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Block::where("element_id", $element_id)->first();
        return view("LaravelBlock2Content::edit", compact("element", "element_id", "collection"));
    }

    public function update($element_id)
    {

        $element = Element::findOrFail($element_id);

        request()->validate([
            "text.*" => ["required"],
        ]);

        $collection = Block::where("element_id", $element_id)->first();
        $collection->text = request()->text;
        $collection->save();

        $element = Element::find($element_id);
        Alert::success("Edit Element {$element->title} Content success");
        return redirect()->route("admin.element.index");
    }

    public function upload()
    {
        /* $fileName = request()->file("file")->getClientOriginalName();
        $path = request()->file("file")->storeAs("uploads", $fileName, "public");
        return response()->json(["location" => '/storage/' . $path]); */

        if (!file_exists(public_path() . "/storage/uploads")) {
            File::makeDirectory(public_path() . "/storage/uploads", 0777, true, true);
        }
        //mkdir("/storage/uploads", 0777, true);
        /* if (!file_exists("/storage/uploads")) {
            mkdir("/storage/uploads", 0777, true);
        } */
        $path = request()->file('file')->store('uploads', 'public');
        return response()->json(['location' => '/storage/' . $path]);
    }
}
