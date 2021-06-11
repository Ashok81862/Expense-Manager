<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
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
        $expenses = Expense::with(['expenseCategory'])->paginate(10);

        return view('admin.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenseCategory = ExpenseCategory::select(['id', 'name'])->get();

        return view('admin.expenses.create', compact('expenseCategory'));
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
            'name'  =>  ['required', 'max:100'],
            'expenseCategory_id' => ['required', 'exists:expenseCategory,id'],
            'amount'    =>  ['required','integer']
        ]);

        Expense::create([
            'name'  => $request->name,
            'expenseCategory'   => $request->expenseCategory,
            'amount'    =>  $request->amount
        ]);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense Created Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $expenseCategory = ExpenseCategory::select(['id', 'name'])->get();

        return view('admin.expenses.create', compact('expenseCategory','expense'));
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
            'name'  =>  ['required', 'max:100'],
            'expenseCategory_id' => ['required', 'exists:expenseCategory,id'],
            'amount'    =>  ['required','integer']
        ]);

        $expense->update([
            'name'  => $request->name,
            'expenseCategory'   => $request->expenseCategory,
            'amount'    =>  $request->amount
        ]);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense Updated Successfully !!');
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

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense Deleted Successfully !!');
    }
}
