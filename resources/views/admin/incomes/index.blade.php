@extends('adminlte::page')

@section('title', 'All Incomes')

@section('content')
<x-alert />
<x-delete />

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">All Incomes</h3>
        <div class="card-tools">
            <a href="{{ route('admin.incomes.create') }}" class="btn btn-sm btn-info">
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
                    <th>Added By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incomes as $income)
                <tr>
                    <td>{{ $income->id }}</td>
                    <td>{{ $income->name }}</td>
                    <td>{{ $income->incomeCategory->name}}</td>
                    <td>{{ $income->amount }}</td>
                    <td>{{ $income->entry_date }}</td>
                    <td>{{ $income->user->name }}</td>
                    <td>
                        <!-- Edit -->
                        <a href="{{ route('admin.incomes.edit', $income->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Edit</span>
                        </a>

                        <!-- Delete -->
                        <a href="#" onclick="confirmDelete({{ $income->id }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-fw fa-edit mr-1"></i>
                            <span>Delete</span>
                        </a>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $income->id }}" action="{{ route('admin.incomes.destroy', $income->id) }}" method="post">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($incomes->total() >10)
    <div class="card-footer">
        {{ $incomes->links() }}
    </div>
    @endif
</div>
@stop
