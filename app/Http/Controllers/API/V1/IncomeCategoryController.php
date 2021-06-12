<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Http\Controllers\Controller;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomeCategories = IncomeCategory::all();

        return response()->json($incomeCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  =>  'required',
        ]);

        $incomeCategory = IncomeCategory::create([
            'name'  =>  $request->name,
            'user_id'   =>  auth()->id(),
        ]);

        return response()->json($incomeCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeCategory $incomeCategory)
    {
        return response()->json([
            'id' => $incomeCategory->id,
            'name' => $incomeCategory->name,
            'user_id'   =>  $incomeCategory->user_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncomeCategory $incomeCategory)
    {
        $request->validate([
            'name'  =>  'required',
        ]);

        $incomeCategory->update([
            'name'  =>  $request->name,
            'user_id'   =>  auth()->id(),
        ]);

        return response()->json($incomeCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeCategory $incomeCategory)
    {
        $incomeCategory->delete();

        return response()->noContent();
    }
}
