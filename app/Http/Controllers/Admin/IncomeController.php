<?php

namespace App\Http\Controllers\Admin;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::with(['incomeCategory'])->paginate(10);

        return view('admin.incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $incomeCategories = IncomeCategory::select(['id', 'name'])->get();

        return view('admin.incomes.create', compact('incomeCategories'));
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
            'income_category_id' => ['required', 'exists:income_categories,id'],
            'amount'    =>  ['required','integer'],
            'entry_date'    =>  ['required','string']
        ]);

        Income::create([
            'name'  => $request->name,
            'income_category_id'   => $request->income_category_id,
            'amount'    =>  $request->amount,
            'entry_date'    =>  $request->entry_date,
            'user_id'   =>  Auth::user()->id,
        ]);

        return redirect()->route('admin.incomes.index')
            ->with('success', 'Income Created Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        $incomeCategories = IncomeCategory::select(['id', 'name'])->get();

        return view('admin.incomes.edit', compact('incomeCategories','income'));
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
            'name'  =>  ['required', 'max:100'],
            'income_category_id' => ['required', 'exists:income_categories,id'],
            'amount'    =>  ['required','integer'],
            'entry_date'    =>  ['required','string']
        ]);

        $income->update([
            'name'  => $request->name,
            'income_category_id'   => $request->income_category_id,
            'amount'    =>  $request->amount,
            'entry_date'    =>  $request->entry_date,
            'user_id'   =>  Auth::user()->id,
        ]);

        return redirect()->route('admin.incomes.index')
            ->with('success', 'Income Created Successfully !!');
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

        return redirect()->route('admin.incomes.index')
            ->with('success', 'Income Deleted Successfully !!');
    }
}
