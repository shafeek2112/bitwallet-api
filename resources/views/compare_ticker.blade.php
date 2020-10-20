@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-12 text-center">
            <!-- <a class="btn btn-sm btn-primary cu-btn m-2"
                href="{{ url('/result') }}"
                style="margin-right: 20px;">
                <i class="icon wb-plus text" aria-hidden="true"></i>
                <span class="text">Get Ticker Pair</span>
            </a> -->
            
        </div>
    </div>
    <div class="row">
        <div class="col-6 text-right " >
            <h2 class="headerText">Compare Bittrex & Binance Ticker Pair</h2>
        </div>
        <div class="col-6 text-center mt-3">
            <a class="btn btn-sm btn-primary cu-btn m-2"
                href="{{ url('/result') }}"
                style="margin-right: 20px;">
                <i class="icon wb-plus text" aria-hidden="true"></i>
                <span class="text">Get Ticker Pair</span>
            </a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <h5 >If you want to compare this Ticker "LTCBTC", <br/>then please enter the first symbol in first textbox like - LTC. And second symbol in second textbox like - BTC</h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="GET"
                autocomplete="off" action="" >
                <div class="row">
                    <div class="col-3">
                        <input type="text" name="first_symbol" class="form-control" placeholder="LTC">
                    </div>
                    <div class="co-4">
                        <input type="text" name="second_symbol" class="form-control" placeholder="BTC">
                    </div>
                    <div class="co-3 text-center">
                        <button type="submit" class="btn btn-primary ml-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="">
        @if(!empty($return))
            
            <h4 ><u>Binance Ticker Pair Details</u></h4>
            @if(!empty($return['binance']['data']))
                <ul class="list-group">
                    <li class="list-group-item">{{ 'Symbol - '.$return['binance']['data']['symbol'] }}</li>
                    <li class="list-group-item">{{ 'Price Change - '.$return['binance']['data']['priceChange'] }}</li>
                    <li class="list-group-item">{{ 'Price Change % - '.$return['binance']['data']['priceChangePercent'] }}</li>
                    <li class="list-group-item">{{ 'Bid Price - '.$return['binance']['data']['bidPrice'] }}</li>
                    <li class="list-group-item">{{ 'Bid  Qty - '.$return['binance']['data']['bidQty'] }}</li>
                    <li class="list-group-item">{{ 'Ask Price - '.$return['binance']['data']['askPrice'] }}</li>
                    <li class="list-group-item">{{ 'Last Price - '.$return['binance']['data']['lastPrice'] }}</li>
                </ul>
            @else
                <h5>{{ !empty($return['binance']['message']) ? $return['binance']['message'] : 'Ticket Pair details are not found in Binance.' }}</h5>
            @endif
            <br/><br/>
            <h4 ><u>Bittrex Ticker Pair Details</u></h4>
            @if(!empty($return['bittrex']['data']))
                <ul class="list-group">
                    <li class="list-group-item">{{ 'Bid Price - '.$return['bittrex']['data']['result']['Bid'] }}</li>
                    <li class="list-group-item">{{ 'Ask Price - '.$return['bittrex']['data']['result']['Ask'] }}</li>
                    <li class="list-group-item">{{ 'Last Price - '.$return['bittrex']['data']['result']['Last'] }}</li>
                </ul>
            @else
                <h5>{{ !empty($return['bittrex']['message']) ? $return['bittrex']['message'] : 'Ticket Pair details are not found in Bittrex.' }}</h5>
            @endif
            
            @if(!empty($return['bestSellingPrice']))
                <h3 class="htop">{{$return['bestSellingPrice']}}</h3>
            @endif
        @else
            <div class="mt-15">
                <h5 class="text-center htop">Please add Ticker pair in above text box and submit to check the best selling price.</h5>
            </div>
        @endif  
    </div>
@endsection
