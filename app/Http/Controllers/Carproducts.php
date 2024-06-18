<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartype;
use App\Models\Carproduct;

class Carproducts extends Controller
{
    //Viewing Car Table
    public function carTable() {
        $cars = Carproduct::join('car_type as c', 'c.car_type_id', '=', 'cars.car_type_id')
            ->select('cars.*', 'c.car_type as car_type_name')
            ->paginate(6);

    
        $cartypes = Cartype::all();
    
        return view('carsblade.cartable', compact('cars', 'cartypes'));
    }
    

    //Viewing Add Car Table
    public function viewaddCar(){
        $cartypes=Cartype::all();

        return view('carsblade.addcar',compact('cartypes'));
    }

    //ADD Car Product to Database
    public function addCarProduct(Request $request)
{
    $validated = $request->validate([
        'car_name' => ['required'],
        'engine_name' => ['required', 'string', 'max:55'], // Set maximum length to 55 characters
        'description' => ['required', 'string', 'max:255'], // Set maximum length to 255 characters
        'price' => ['required', 'numeric'],
        'cars_image' => ['nullable', 'image', 'mimes:png,jpeg,bmp,biff', 'max:4096'],
        'car_type_id' => ['required', 'exists:car_type,car_type_id'], // Assuming car_type_id is a valid foreign key
    ]);
    if ($request->hasFile('cars_image')) {
        $filenameWithExtension = $request->file('cars_image')->getClientOriginalName();

        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('cars_image')->getClientOriginalExtension();

        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        $request->file('cars_image')->storeAs('public/img/cars', $filenameToStore);

        $validated['cars_image'] = $filenameToStore;
    }

    Carproduct::create($validated);

    return redirect('/carstable')->with('message_success', 'Car successfully added');
}

public function edit($id)
    {
        $carproduct = Carproduct::findOrFail($id);
        $cartypes = Cartype::all();

        return view('carsblade.caredit', compact('carproduct', 'cartypes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'car_name' => ['required', 'string', 'max:255'],
            'engine_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'car_type_id' => ['required', 'exists:car_type,car_type_id'],
            'cars_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
    
        if ($request->hasFile('cars_image')) {
            $filenameWithExtension = $request->file('cars_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('cars_image')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
    
            $request->file('cars_image')->storeAs('public/img/cars', $filenameToStore);
            $validated['cars_image'] = $filenameToStore;
        }
    
        Carproduct::where('cars_id', $id)->update($validated);
    
        return redirect()->route('carstable')->with('success', 'Car updated successfully');
    }
    
    public function destroy($id)
    {
        $car = Carproduct::findOrFail($id);
        $car->delete();

        return redirect()->route('carstable')->with('success', 'Car deleted successfully');
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('search');

        // Perform the search query
        $cars = Carproduct::where('car_name', 'like', '%' . $query . '%')
                         ->orWhere('engine_name', 'like', '%' . $query . '%')
                         ->orWhere('description', 'like', '%' . $query . '%')
                         ->paginate(10); // Adjust as per your pagination requirement

        // Retrieve all car types
        $cartypes = Cartype::all();

        // Pass the search results and car types to the view
        return view('carsblade.cartable', ['cars' => $cars, 'cartypes' => $cartypes]);
    }


}
