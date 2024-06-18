<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Partsproduct;
use App\Models\Partstype;

class PartsController extends Controller
{
    //To View PartsType Table
    public function partsTypetable(){
        $partstypes=Partstype::all();

        return view('partsblade.typetable',compact('partstypes'));
    }

    public function storePartType(Request $request)
    {
        $validated = $request->validate([
            'part_type' => ['required']
        ]);

        PartsType::create($validated);

        return redirect()->back()->with('message_success', 'New part type added successfully');
    }

    













    //To View Add Product Page
    public function addProductpage(){
        $parttypes=Partstype::all();

        return view('partsblade.addpartproduct',compact('parttypes'));
    }

    //Add Product to Database Function
    public function addpartProduct(Request $request)
{
    $validated = $request->validate([
        'parts_name' => ['required'],
        'price' => ['required', 'numeric'],
        'parts_image' => ['nullable', 'image', 'mimes:png,jpeg,bmp,biff', 'max:4096'],
        'parts_type_id' => ['required', 'exists:parts_type,parts_type_id'], // Assuming parts_type_id is a valid foreign key
    ]);

    if ($request->hasFile('parts_image')) {
        $filenameWithExtension = $request->file('parts_image')->getClientOriginalName();

        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('parts_image')->getClientOriginalExtension();

        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        $request->file('parts_image')->storeAs('public/img/parts', $filenameToStore);

        $validated['parts_image'] = $filenameToStore;
    }

    Partsproduct::create($validated);

    return redirect('/partstable')->with('message_success', 'Part successfully added');
}


    //For Viewing the PartsTable
    public function partsTable(Request $request) {
        $search = $request->input('search');
        
        // Query parts with search condition
        $partsQuery = Partsproduct::join('parts_type as p', 'p.parts_type_id', '=', 'parts_product.parts_type_id')
                        ->select('parts_product.*', 'p.part_type as part_type_name');
        
        if($search) {
            $partsQuery->where('parts_product.parts_name', 'LIKE', "%$search%");
        }
        
        $parts = $partsQuery->paginate(5);
        $parttypes = PartsType::all();
        
        return view('partsblade.partstable', compact('parts','parttypes', 'search'));
    }
    //For Viewing Edit Parts Page
    public function editpartPage($id){
        $part = Partsproduct::join('parts_type as p', 'p.parts_type_id', '=', 'parts_product.parts_type_id')
                        ->select('parts_product.*', 'p.part_type as part_type_name')
                        ->where('parts_product.parts_id', $id)
                        ->first();

    $parttypes = PartsType::all();
    
    return view('partsblade.editpart', compact('part', 'parttypes'));
    }

    //For Updating Products
    public function updateProducts(Request $request, $id){

    $validated = $request->validate([
        'parts_name' => ['required'],
        'price' => ['required', 'numeric'],
        'parts_image' => ['nullable', 'image', 'mimes:png,jpeg,bmp,biff', 'max:4096'],
        'parts_type_id' => ['required', 'exists:parts_type,parts_type_id'], // Assuming parts_type_id is a valid foreign key
    ]);

    if ($request->hasFile('parts_image')) {
        $filenameWithExtension = $request->file('parts_image')->getClientOriginalName();

        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('parts_image')->getClientOriginalExtension();

        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        $request->file('parts_image')->storeAs('public/img/parts', $filenameToStore);

        $validated['parts_image'] = $filenameToStore;
    }

    Partsproduct::where('parts_id', $id)->update($validated);

    return redirect('/partstable')->with('message_success', 'Part successfully updated');
}


    //For Viewing a Specific Part Data
    public function partsTableview($id) {
        $parts = Partsproduct::join('parts_type as p', 'p.parts_type_id', '=', 'parts_product.parts_type_id')
                            ->select('parts_product.*', 'p.part_type as part_type_name')
                            ->where('parts_product.parts_id', $id)
                            ->first();
    
        return view('partsblade.viewparts', compact('parts'));
    }

    //For Viewing Delete a Part Page
    public function deletepartPage($id){
        $parts = Partsproduct::join('parts_type as p', 'p.parts_type_id', '=', 'parts_product.parts_type_id')
                        ->select('parts_product.*', 'p.part_type as part_type_name')
                        ->where('parts_product.parts_id', $id)
                        ->first();

        $parttypes = PartsType::all();
    
    return view('partsblade.deletepart', compact('parts', 'parttypes'));
    }

    //For Deleting Parts in Database
    public function destroy(Partsproduct $part)
    {
        // Delete the image file from storage
        if (Storage::exists('public/img/parts/' . $part->parts_image)) {
            Storage::delete('public/img/parts/' . $part->parts_image);
        }
    
        // Delete the part
        $part->delete();
    
        return redirect('/partstable')->with('message_success', 'Part successfully deleted.');
    }
    

    public function update(Request $request, $id)
    {
        // Validate the request data
    $validated = $request->validate([
        'part_type' => ['required', 'string'], // Adjust validation rules as needed
    ]);

    // Update the Partstype record
    Partstype::where('parts_type_id', $id)->update($validated);

    // Redirect back with a success message
    return redirect('/partstypetable')->with('message_success', 'Part type successfully updated');
    }

    public function destroytype($id)
{
    Partstype::findOrFail($id)->delete();
    return redirect('/partstypetable')->with('message_success', 'Part Type successfully deleted');
}
    
    
}
