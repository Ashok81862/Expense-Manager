@extends('adminlte::page')

@section('title', 'Reports')
@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .box {
        font-size: 1.2rem;
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
<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#start_date').val(start.format('MMMM D, YYYY'));
            $('#end_date').val(end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            opens:'left',
            timePicker:true,
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);


    });
</script>
@endsection

@section('content')

    <x-delete />

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Reports</h3>
            <div class="card-tools">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reports.generate')  }}" method="GET">

                <div class="row d-flex justify-content-center">
                    <div class="form-group col-md-6">
                        <label for="Ranges">Ranges</label>
                        <div id="reportrange"  class="form-control">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down" style="padding-left:200px !important; "></i>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="start_date" id="start_date">
                <input type="hidden" name="end_date" id="end_date">

                <div class="card-footer row d-flex justify-content-center ">
                    <button class="btn btn-primary col-md-3">Generate Report</button>
                </div>
            </form>
        </div>
    </div>
@stop
