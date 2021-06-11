@extends('adminlte::page')

@section('title', 'Create Expense')
@section('plugins.Select2', true)

@push('js')
<script>
    $(document).ready(function() {
        $('#expense_category_id').select2();
    });
</script>
@endpush


@section('content')
<x-alert />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Create Expense</h3>
        <div class="card-tools">
            <a href="{{ route('admin.expenses.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.expenses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    name="name" id="name"
                    value="{{ old('name') ?? '' }}"
                    class="form-control @error('name') is-invalid @enderror"
                    autofocus
                >
                @error('name')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="expense_category_id">Category</label>
                <select
                    name="expense_category_id" id="expense_category_id"
                    class="form-control @error('expense_category_id') is-invalid @enderror"
                >
                    @foreach($expenseCategories as $category)
                        <option value="{{ $category->id }}" @if(old('expense_category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('expense_category_id')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="entry_date">Date</label>
                <input
                    type="date"
                    value="{{ old('entry_date') ?? '' }}"
                    name="entry_date" id="entry_date"
                    class="form-control @error('entry_date') is-invalid @enderror"
                >
                @error('entry_date')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input
                    type="number"
                    name="amount" id="amount"
                    value="{{ old('amount') ?? '' }}"
                    class="form-control @error('amount') is-invalid @enderror"
                    autofocus
                >
                @error('amount')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Add New Expense">
                <a href="{{ route('admin.expenses.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
