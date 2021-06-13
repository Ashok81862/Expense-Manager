<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $expenseCategories = ExpenseCategory::all();

        return response()->json($expenseCategories);
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

        $expenseCategory = ExpenseCategory::create([
            'name'  =>  $request->name,
            'user_id'   =>  auth()->id(),
        ]);

        return response()->json($expenseCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        return response()->json([
            'id' => $expenseCategory->id,
            'name' => $expenseCategory->name,
            'user_id'   =>  $expenseCategory->user_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $request->validate([
            'name'  =>  'nullable|string',
        ]);

        $expenseCategory->update([
            'name'  =>  $request->name ?? $expenseCategory->name,
            'user_id'   =>  auth()->id(),
        ]);

        return response()->json($expenseCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();

        return response()->noContent();
    }
}
