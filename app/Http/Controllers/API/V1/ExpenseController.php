<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();

        return response()->json($expenses);
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
            'amount'=>  'required|integer',
            'entry_date' => 'required|string',
            'expense_category_id'=> 'required|exists:expense_categories,id',
        ]);

        $expense = Expense::create([
            'name'  =>  $request->name,
            'amount'  =>   $request->amount,
            'entry_date' => $request->entry_date,
            'user_id'   =>  auth()->id(),
            'expense_category_id'   =>  $request->expense_category_id,
        ]);

        return response()->json($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return response()->json([
            'id' => $expense->id,
            'amount'    =>  $expense->amount,
            'entry_date'    =>  $expense->entry_date,
            'name' => $expense->name,
            'user_id'   =>  $expense->user_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'name'  =>  'nullable|string',
            'amount'=>  'nullable|integer',
            'entry_date' => 'nullable|string',
            'expense_category_id'=> 'nullable|exists:expense_categories,id',
        ]);

        $expense->update([
            'name'  =>  $request->name ?? $expense->name,
            'amount'  =>   $request->amount ?? $expense->amount,
            'entry_date' => $request->entry_date ?? $expense->entry_date,
            'user_id'   =>  auth()->id(),
            'expense_category_id'   =>  $request->expense_category_id ?? $expense->expense_category_id,
        ]);

        return response()->json($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->noContent();
    }
}
