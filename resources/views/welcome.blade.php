@extends('layouts.app')

@section('content')
<div class="row">
    </div>
    <div class="row">
        <div class="col-6 text-right " >
            <h2 class="headerText">Ticker Pair List</h2>
        </div>
        <div class="col-6 text-center mt-3">
            <a class="btn btn-sm btn-primary cu-btn m-2"
                href="{{ route('compare') }}"
                style="margin-right: 20px;">
                <i class="icon wb-plus text" aria-hidden="true"></i>
                <span class="text">Compare Ticker Pair</span>
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
        <div class="table-responsive">
                <table class="table table-bordered" id="ticker-table">
                    <thead>
                        <tr>
                            <th>Symbol</th>
                            <th>Price Change</th>
                            <th>Last Price</th>
                            <th>Last Qty</th>
                            <th>High Price</th>
                            <th>Low Price</th>
                            <th>Open Time</th>
                            <th>Close Time</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {

    $('#ticker-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('get_data') }}",
        columns: [
            { data: 'symbol', name: 'symbol' },
            { data: 'priceChange', name: 'priceChange' },
            { data: 'lastPrice', name: 'lastPrice' },
            { data: 'lastQty', name: 'lastQty' },
            { data: 'highPrice', name: 'highPrice' },
            { data: 'lowPrice', name: 'lowPrice' },
            { data: 'openTime', name: 'openTime' },
            { data: 'closeTime', name: 'closeTime' },
        ]
    });
});
</script>
@endsection
