<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SalesItem;
use Illuminate\Http\Request;
use App\Models\ReturnProduct;

class ReturnController extends Controller
{
    public function returnlist()
{
    $returns = ReturnProduct::with('sale', 'salesItem.product')->get();

    return view('pages.return.returnList', compact('returns'));
}

public function createReturn()
{
    $sales = Sale::with('items.product')->get(); // Fetch all sales with products

    return view('pages.return.returnCreate', compact('sales'));
}

public function storeReturn(Request $request)
{
    $request->validate([
        'sale_id' => 'required|exists:sales,id',
        'sales_item_id' => 'required|exists:sales_items,id',
        'quantity' => 'required|integer|min:1',
        'amount_refunded' => 'required|numeric|min:0',
        'reason' => 'nullable|string|max:255',
    ]);

    // Fetch the sale and its date
    $sale = Sale::findOrFail($request->sale_id);
    $salesItem = SalesItem::findOrFail($request->sales_item_id);

    // Check if the sale is within the 7-day return policy
    $returnDeadline = $sale->created_at->addDays(7); // Sale date + 7 days
    if (now()->greaterThan($returnDeadline)) {
        return back()->withErrors(['return_policy' => 'The return period for this sale has expired.']);
    }

    // Ensure the return quantity does not exceed the sold quantity
    if ($request->quantity > $salesItem->quantity) {
        return back()->withErrors(['quantity' => 'Return quantity cannot exceed sold quantity.']);
    }

    // Create the return record
    ReturnProduct::create([
        'sale_id' => $request->sale_id,
        'sales_item_id' => $request->sales_item_id,
        'quantity' => $request->quantity,
        'amount_refunded' => $request->amount_refunded,
        'reason' => $request->reason,
    ]);

    // Update the sales item's quantity
    $salesItem->quantity -= $request->quantity;
    $salesItem->save();

    return redirect()->route('return.list')->with('success', 'Return processed successfully.');
}


}
