<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::all();

        return response()->json($incomes);
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
            'income_category_id'=> 'required|exists:income_categories,id',
        ]);

        $income = Income::create([
            'name'  =>  $request->name,
            'amount'  =>   $request->amount,
            'entry_date' => $request->entry_date,
            'user_id'   =>  auth()->id(),
            'income_category_id'   =>  $request->income_category_id,
        ]);

        return response()->json($income);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        return response()->json([
            'id' => $income->id,
            'name' => $income->name,
            'amount'    =>  $income->amount,
            'entry_date'    =>  $income->entry_date,
            'user_id'   =>  $income->user_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'name'  =>  'nullable|string',
            'amount'=>  'nullable|integer',
            'entry_date' => 'nullable|string',
            'income_category_id'=> 'nullable|exists:income_categories,id',
        ]);

        $income->update([
            'name'  =>  $request->name ?? $income->name,
            'amount'  =>   $request->amount ?? $income->amount,
            'entry_date' => $request->entry_date ?? $income->entry_date,
            'user_id'   =>  auth()->id(),
            'income_category_id'   =>  $request->income_category_id ?? $income->income_category_id,
        ]);

        return response()->json($income);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $income->delete();

        return response()->noContent();
    }
}
