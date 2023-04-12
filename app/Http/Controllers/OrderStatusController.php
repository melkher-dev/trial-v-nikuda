<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use App\Http\Requests\OrderStatusRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\OrderStatusUpdateRequest;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderStatuses = OrderStatus::all();

        return response()->json($orderStatuses, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStatusRequest $request)
    {
        $orderStatus = OrderStatus::create([
            'title' => $request->input('title'),
        ]);

        return response()->json($orderStatus, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderStatus = OrderStatus::find($id);

        return response()->json($orderStatus, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderStatusUpdateRequest $request, string $id)
    {
        $orderStatus = OrderStatus::find($id);

        $orderStatus->update([
            'title' => $request->input('title'),
        ]);

        return response()->json($orderStatus, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        OrderStatus::destroy($id);

        return response()->json([
            'message' => 'Order Status deleted successfully',
        ]);
    }
}
