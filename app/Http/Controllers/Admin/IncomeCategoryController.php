<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = IncomeCategory::paginate(10);

        return view('admin.incomes.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.incomes.categories.create');
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
            'name'  =>  ['required','max:100']
        ]);

        IncomeCategory::create([
            'name'  =>  $request->name,
            'user_id'   =>  Auth::user()->id,
        ]);

        return redirect()->route('admin.incomeCategories.index')
            ->with('success', 'Income Category Created Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeCategory $incomeCategory)
    {
        return view('admin.incomes.categories.edit', compact('incomeCategory'));
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
            'name'  =>  ['required','max:100']
        ]);

        $incomeCategory->update([
            'name'  =>  $request->name,
            'user_id'   =>  Auth::user()->id,
        ]);

        return redirect()->route('admin.incomeCategories.index')
            ->with('success', 'Income Category Updated Successfully !!');
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

        return redirect()->route('admin.incomeCategories.index')
        ->with('success', 'Income Category Deleted Successfully !!');
    }
}
