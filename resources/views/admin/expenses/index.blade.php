@extends('adminlte::page')

@section('title', 'All expenses')

@section('content')
<x-alert />
<x-delete />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All expenses</h3>
        <div class="card-tools">
            <a href="{{ route('admin.expenses.create') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-plus-circle mr-1"></i>
                <span>Add New</span>
            </a>
        </div>
    </div>
    <div class="card-body p-0 border-top-0">
        <table class="table table-bordered border-top-0">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->id }}</td>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->expenseCategory->name}}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->entry_date }}</td>
                    <td>
                        <!-- Edit -->
                        <a href="{{ route('admin.expenses.edit', $expense->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>

                        <!-- Delete -->
                        <a href="#" onclick="confirmDelete({{ $expense->id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Delete</span>
                        </a>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $expense->id }}" action="{{ route('admin.expenses.destroy', $expense->id) }}" method="post">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($expenses->total() >10)
    <div class="card-footer">
        {{ $expenses->links() }}
    </div>
    @endif
</div>
@stop
