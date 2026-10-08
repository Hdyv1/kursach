<?php

namespace App\Http\Controllers;

use App\Models\RepairOrderReview;
use App\Http\Requests\StoreRepairOrderReviewRequest;
use App\Http\Requests\UpdateRepairOrderReviewRequest;
use App\Models\RepairOrder;
use Illuminate\Support\Facades\Auth;

class RepairOrderReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(repairOrder $order)
    {
        return response()->json($order->reviews()->with('user')->get());
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRepairOrderReviewRequest $request, RepairOrder $order)
    {
        if($order->status !== 'done') {
            return response()->json(['error' => 'Нельзя оставить отзыв на незавершённый заказ'], 422);
        }
        $review = new RepairOrderReview();
        $review->user_id = auth::id();
        $review->repair_order_id = $order->id;
        $review->content = $request->content;
        $review->save();

        return response()->json(['message' => 'Отзыв добавлен', 'review_id' => $review->id, 'repair_order_id' => $review->repair_order_id], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RepairOrderReview $repairOrderReviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepairOrderReview $repairOrderReviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepairOrderReviewRequest $request, RepairOrderReview $repairOrderReviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepairOrderReview $repairOrderReviews)
    {
        //
    }
}
