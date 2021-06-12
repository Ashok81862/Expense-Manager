@extends('adminlte::page')

@section('title', 'Reports')

@section('js')
<style>
    .box {
        font-size: 1.5rem;
        border-radius: 3px;
        shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 1px rgba(0,0,0,.15);
        text-align: center;
        padding: 10px 15px;
    }

    .box:hover{
        transition: 0.3s all ease-in;
        opacity: 0.8;
        box-shadow:0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
    }

</style>
@endsection

@section('content')

    <x-delete />
    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">
                Report from: {{ $start_date }} to {{ $end_date }}
            </h3>
              <div class="card-tools">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-info d-print-none">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered border-top-0">
                <thead class="thead-dark">
                    <th>S.N</th>
                    <th>Date</th>
                    <th>User Name</th>
                    <th>Expense Name</th>
                    <th>Category</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    @foreach($expenses as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['user_id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['expense_category_id'] }}</td>
                            <td>Rs.{{ $item['amount'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="border-top:2px solid #444;text-align:right;font-weight:bold" colspan="6">Total Expenses: Rs.  {{$exp_amount}}</td>

                    </tr>
                </tbody>
            </table>
            {{-- Income --}}
            <table class="table table-bordered border-top-0">
                <thead class="thead-dark">
                    <th>S.N</th>
                    <th>Date</th>
                    <th>User Name</th>
                    <th>Income Name</th>
                    <th>Category</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    @foreach($incomes as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['user_id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['income_category_id'] }}</td>
                            <td>Rs.{{ $item['amount'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="border-top:2px solid #444;text-align:right;font-weight:bold" colspan="6">Total Incomes:Rs.  {{$inc_amount}}</td>

                    </tr>
                </tbody>
            </table>

            <div class="card-footer row d-flex justify-content-center ">
                @if($values < 0)
                        <h1>Loss Rs. {{ $values }}</h1>
                @elseif( $values > 0)
                        <h1>Profit Rs. {{ $values }}</h1>
                @else
                        <h1>Rs. 0</h1>
                @endif

            </div>
        </div>
    </div>
@stop
