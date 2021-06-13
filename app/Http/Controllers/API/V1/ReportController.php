<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Cast\String_;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $all = collect([]);

        //Expense
        $expenses = Expense::select(['amount', 'expense_category_id','name', 'entry_date','user_id'])
        ->where('entry_date', '>', Carbon::parse($request->start_date)->startOfDay())
        ->where('entry_date', '<', Carbon::parse($request->end_date)->endOfDay())
        ->where('user_id',auth()->id())
        ->get();


        $expenses = $expenses->map(function ($expense) {
            return [
                'amount' => $expense->amount,
                'name'  => $expense->name,
                'expense_category_id'   => $expense->expenseCategory->name,
                'date' => $expense->entry_date,
                'user_id'  => $expense->user->name
            ];
        });

        $all_expenses = $all->merge($expenses);


        //Income
        $incomes = Income::select(['amount','name', 'income_category_id', 'entry_date','user_id'])
        ->where('entry_date', '>', Carbon::parse($request->start_date)->startOfDay())
        ->where('entry_date', '<', Carbon::parse($request->end_date)->endOfDay())
        ->where('user_id',auth()->id())
        ->get();

        $incomes = $incomes->map(function ($income) {
            return [
                'amount' => $income->amount,
                'income_category_id'   => $income->incomeCategory->name,
                'date' => $income->entry_date,
                'name'  =>  $income->name,
                'user_id'  => $income->user->name
            ];
        });

        $all_incomes = $all->merge($incomes);
        $values =( $all_incomes->sum('amount')) -($all_expenses->sum('amount'));

        return response()->json(
            [
                'expenses' => $expenses,
                'incomes'   =>  $incomes,
                'values' => $values
            ]
        );
    }
}
