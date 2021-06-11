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
        $expenseCategories = ExpenseCategory::select(['id', 'name'])->get();

        return view('admin.expenses.create', compact('expenseCategories'));
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
            'expense_category_id' => ['required', 'exists:expense_categories,id'],
            'amount'    =>  ['required','integer'],
            'entry_date'    =>  ['required','string']
        ]);

        Expense::create([
            'name'  => $request->name,
            'expense_category_id'   => $request->expense_category_id,
            'amount'    =>  $request->amount,
            'entry_date'    =>  $request->entry_date
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
        $expenseCategories = ExpenseCategory::select(['id', 'name'])->get();

        return view('admin.expenses.edit', compact('expenseCategories','expense'));
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
            'expense_category_id' => ['required', 'exists:expense_categories,id'],
            'amount'    =>  ['required','integer'],
            'entry_date'    =>  ['required','string']
        ]);

        $expense->update([
            'name'  => $request->name,
            'expense_category_id'   => $request->expense_category_id,
            'amount'    =>  $request->amount,
            'entry_date'    =>  $request->entry_date
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
