<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();
        return view('deliveries.index', compact('deliveries'));
    }

    public function create()
    {
        return view('deliveries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'shipping_date' => 'required|date',
            'tracking_code' => 'required|string|max:20',
            'status' => 'required|string|max:20',
        ]);

        Delivery::create($request->all());

        return redirect()->route('deliveries.index')->with('success', 'Delivery created successfully.');
    }

    public function show($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('deliveries.show', compact('delivery'));
    }

    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('deliveries.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'shipping_date' => 'required|date',
            'tracking_code' => 'required|string|max:20',
            'status' => 'required|string|max:20',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->update($request->all());

        return redirect()->route('deliveries.index')->with('success', 'Delivery updated successfully.');
    }

    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return redirect()->route('deliveries.index')->with('success', 'Delivery deleted successfully.');
    }
}
