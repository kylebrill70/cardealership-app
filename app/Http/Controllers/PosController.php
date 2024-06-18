<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\Carproduct;
use App\Models\Cartype;
use App\Models\Salesmodel;
use App\Models\Partsproduct;
use App\Models\Cartmodel;
use App\Models\Partsales;



class PosController extends Controller
{
    public function Posmaindash(){
        $cars = Carproduct::all();
        return view('posdashboard.carposdash', compact('cars'));
    }

    public function show($id)
    {
        $car = Carproduct::findOrFail($id);
        return view('posdashboard.viewandbuy', compact('car'));
    }


    public function saveSales(Request $request, $id)
    {
        // Get the car details by the provided ID
        $car = Carproduct::findOrFail($id);
    
        // Calculate change
        $cash = $request->input('cash');
        $change = $cash - $car->price;
    
        // Create a new sales record using the Salesmodel
        Salesmodel::create([
            'product_name' => $car->car_name,
            'price' => $car->price,
            'quantity' => 1,
            'amount' => $cash,
            'change' => $change,
        ]);
    
        // Prepare data for the receipt
        $receiptData = [
            'car_name' => $car->car_name,
            'price' => $car->price,
            'cash' => $cash,
            'change' => $change,
        ];
    
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
    
        // Load HTML content for the receipt view
        $html = view('receipt', $receiptData)->render();
    
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
    
        // Render the HTML as PDF
        $dompdf->render();
    
        // Output the generated PDF to a string
        $output = $dompdf->output();
    
        // Generate a temporary file path
        $filename = 'receipt-' . time() . '.pdf';
        $path = storage_path('app/public/' . $filename);
    
        // Save the PDF to the temporary file
        file_put_contents($path, $output);
    
        // Return the URL of the saved PDF
        return response()->json(['pdf_url' => asset('storage/' . $filename)]);
    }

  public function buy(Request $request)
  {
      $car = Carproduct::findOrFail($request->car_id);
      return view('posdashboard.forreciept', compact('car'));
  }
  //End or CarPos Functions


  public function Pospartsdash(){
        $parts = Partsproduct::all();
        return view('posdashboard.partsposdash', compact('parts'));
  }

  public function addToCart(Request $request)
    {
        $part = Partsproduct::findOrFail($request->part_id);
        
        $cartItem = Cartmodel::where('parts_name', $part->parts_name)->first();
        
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cartmodel::create([
                'quantity' => 1,
                'parts_name' => $part->parts_name,
                'price' => $part->price
            ]);
        }

        return response()->json(['cart' => Cartmodel::all()]);
    }

    public function removeFromCart(Request $request)
    {
        $cartItem = Cartmodel::findOrFail($request->cart_id);
        $cartItem->delete();

        return response()->json(['cart' => Cartmodel::all()]);
    }

    public function getCart()
    {
        return response()->json(['cart' => Cartmodel::all()]);
    }

    public function checkout(Request $request, $cart) {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
    
        // Get the cart data
        $cart = json_decode($cart, true);
    
        // Compute total price and quantity
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $totalQuantity += $item['quantity'];
        }
    
        // Compute change
        $change = $request->amount - $totalPrice;
    
        // Check if the amount is enough
        if ($change < 0) {
            return back()->with('error', 'Insufficient amount.');
        }
    
        // Save sales data
        Salesmodel::create([
            'product_name' => json_encode(array_column($cart, 'parts_name')),
            'quantity' => $totalQuantity,
            'price' => $totalPrice,
            'amount' => $request->amount,
            'change' => $change,
        ]);
    
        // Clear the cart
        Cartmodel::clear();
    
        // Redirect to receipt page
        return redirect()->route('receipt')->with('success', 'Order placed successfully.');
    }

    public function partscheckout()
    {
        // Get cart items
        $cartItems = Cartmodel::all(); // Assuming you're storing all cart items in the 'cart' table
    
        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    
        // Pass cart items and total to the checkout view
        return view('posdashboard.order', compact('cartItems', 'total'));
    }
    

    public function computeChange(Request $request)
    {
        // Get the total of the cart
        $total = $this->getCartTotal();

        // Get the amount inputted by the customer
        $amountPaid = $request->input('amount');

        // Check if the amount inputted is less than the total
        if ($amountPaid < $total) {
            return redirect()->back()->with('error', 'Amount paid is less than the total.');
        }

        // Compute the change
        $change = $amountPaid - $total;

        // Return the change
        return response()->json(['change' => $change]);
    }

    private function getCartTotal()
    {
        // Get cart items
        $cartItems = Cartmodel::all();

        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }


    public function generateReceipt(Request $request)
    {
        // Check if the change paragraph has a value
        $change = $request->input('change');
        if (!$change) {
            return redirect()->back()->with('error', 'Please compute the change first.');
        }
    
        // Save cart data to the sales table
        $cartItems = Cartmodel::all();
        $total = Cartmodel::sum('price');
    
        // Prepare data for the receipt
        $receiptData = [
            'cartItems' => $cartItems,
            'total' => $total,
            'cash' => $request->input('amount'),
            'change' => $change,
        ];
    
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
    
        // Load HTML content for the receipt view
        $html = view('receipt2', $receiptData)->render();
    
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
    
        // Render the HTML as PDF
        $dompdf->render();
    
        // Output the generated PDF to a string
        $output = $dompdf->output();
    
        // Generate a temporary file path
        $filename = 'receipt-' . time() . '.pdf';
        $path = storage_path('app/public/' . $filename);
    
        // Save the PDF to the temporary file
        file_put_contents($path, $output);

        foreach ($cartItems as $item) {
            Partsales::create([
                'product_name' => $item->parts_name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'amount' => $request->input('amount'),
                'change' => $change
            ]);
        }
    
        // Clear the cart table
        Cartmodel::truncate();
    
        // Return the URL of the saved PDF
        return response()->json(['pdf_url' => asset('storage/' . $filename)]);
    }
    
    
    
    
    
    


}
