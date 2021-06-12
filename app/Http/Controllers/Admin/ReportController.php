<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SebastianBergmann\Environment\Console;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $user= auth()->user()->id;

        $all = collect([]);

        //Expenses

        $expenses = Expense::select(['amount', 'expense_category_id','name', 'entry_date','user_id'])
        ->where('entry_date', '>', Carbon::parse($request->start_date)->startOfDay())
        ->where('entry_date', '<', Carbon::parse($request->end_date)->endOfDay())
        ->where('user_id',$user)
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
        ->where('user_id',$user)
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

        return view('admin.reports.show', [
            'expenses' => $expenses,
            'incomes'   =>  $incomes,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
            'end_date' => Carbon::parse($request->end_date)->format('Y-m-d'),
            'exp_amount' => $all_expenses->sum('amount'),
            'inc_amount' => $all_incomes->sum('amount'),
            'values' => $values

        ]);



    }
}


// $expenses = Expense::whereBetween('created_at', [$request->start_date, $$request->end_date]);

//         $incomes = Income::whereBetween('created_at', [$request->start_date, $$request->end_date]);

//         $exp_total = $expenses->sum('amount');
//         $inc_total = $incomes->sum('amount');
//         $exp_group = $expenses->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
//         $inc_group = $incomes->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
//         $profit    = $inc_total - $exp_total;

//         $exp_summary = [];
//         foreach ($exp_group as $exp) {
//             foreach ($exp as $line) {
//                 if (! isset($exp_summary[$line->expenseCategory->name])) {
//                     $exp_summary[$line->expenseCategory->name] = [
//                         'name'   => $line->expenseCategory->name,
//                         'amount' => 0,
//                     ];
//                 }
//                 $exp_summary[$line->expenseCategory->name]['amount'] += $line->amount;
//             }
//         }

//         $inc_summary = [];
//         foreach ($inc_group as $inc) {
//             foreach ($inc as $line) {
//                 if (! isset($inc_summary[$line->incomeCategory->name])) {
//                     $inc_summary[$line->incomeCategory->name] = [
//                         'name'   => $line->incomeCategory->name,
//                         'amount' => 0,
//                     ];
//                 }
//                 $inc_summary[$line->incomeCategory->name]['amount'] += $line->amount;
//             }
//         }

//         return view('admin.reports.index', compact(
//             'exp_summary',
//             'inc_summary',
//             'exp_total',
//             'inc_total',
//             'profit'
//         ));

