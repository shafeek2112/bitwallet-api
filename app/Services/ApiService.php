<?php

namespace App\Services;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\RequestException;
class ApiService
{
    protected $clientInstance;
    protected $binanceGetTickerPairEndPoint;
    protected $bittrexGetTickerPairEndPoint;

    public function __construct()
    {
        $this->clientInstance = new Client(); //GuzzleHttp\Client
        $this->binanceGetTickerPairEndPoint = Config::get('constants.api.binanceGetTickerPairEndPoint') ;
        $this->bittrexGetTickerPairEndPoint = Config::get('constants.api.bittrexGetTickerPairEndPoint') ;
    }
    
    public function getTickerPair()
    {
        $response = $this->clientInstance->request('GET', $this->binanceGetTickerPairEndPoint);
        
        // $statusCode = $response->getStatusCode();
        // $body = $response->getBody()->getContents();
        
        return json_decode ((string)$response->getBody ());
    }
    
    public function getIndividualTickerPairToCompare($data)
    {
        $validator = Validator::make($data, [
            'first_symbol'  => 'required|string',
            'second_symbol' => 'required|string',
        ]);

        $returnArray = [
            'binance' => [
                'status' => 'Success',
                'data' => [],
            ],
            'bittrex'  => [
                'status' => 'Success',
                'data' => [],
            ],
            'binanceLastPrice'  => '0',
            'bittrexLastPrice'  => '0',
            'bestSellingPrice'  => 'Cannot find the best selling price. Something wrong with the Ticker Pair',
        ];
        
        ## Binance Response
        try {
            $binanceSymbol = $data['first_symbol'].$data['second_symbol'];
            $binanceResponse = $this->clientInstance->request('GET', $this->binanceGetTickerPairEndPoint.'?symbol='.$binanceSymbol);
            if($binanceResponse->getStatusCode() !== 200)
            {
                $returnArray['binance']['status'] = 'Error';
                $returnArray['binance']['message'] = 'Something went wrong :). Please try another Pair. ';
            }
            else 
            {
                $return = json_decode ((string)$binanceResponse->getBody (), TRUE);
                $returnArray['binance']['data'] = $return;
                $returnArray['binanceLastPrice'] = $return['lastPrice'];
            }
            
        } catch (RequestException $e) {
        
            // Catch all 4XX errors 
            // To catch exactly error 400 use 
            if ($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() == '400') {

                    $returnArray['binance']['status'] = 'Error';
                    $returnArray['binance']['message'] = 'Invalid Ticker Pair symbols provided, please check your Ticker Pair symbols';
                }
            }            
        } catch (\Exception $e) {
            // There was another exception.
            $returnArray['binance']['status'] = 'Error';
            $returnArray['binance']['message'] = 'Something went wrong :). Please try another Pair. ';
        }
        
        ## Bittrex Response
        try {
            $bittrexSymbol = $data['second_symbol'].'-'.$data['first_symbol'];
            $bittrexResponse = $this->clientInstance->request('GET', $this->bittrexGetTickerPairEndPoint.'?market='.$bittrexSymbol);
            $return = json_decode ((string)$bittrexResponse->getBody (), TRUE);
            if(!$return['success'] || empty($return['result']))
            {
                $returnArray['bittrex']['status'] = 'Error';
                $returnArray['bittrex']['message'] = ($return['message'] == 'INVALID_MARKET') ? 
                    'Invalid Ticker Pair symbols provided, please check your Ticker Pair symbols' :
                    'Something went wrong :). Please try another Pair.';
            }
            else {
                $returnArray['bittrex']['data'] = $return;
                $returnArray['bittrexLastPrice'] = $return['result']['Last'];
            }
        } catch (RequestException $e) {
        
            // Catch all 4XX errors 
            // To catch exactly error 400 use 
            if ($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() == '400') {
                    return ['error' => 'Invalid Ticker Pair symbols provided, please check your Ticker Pair symbols'];
                }
            }            
        } catch (\Exception $e) {
            // There was another exception.
            return ['error' => 'Something went wrong :( '];
        
        }

        if($returnArray['binanceLastPrice'] != 0 || $returnArray['bittrexLastPrice'] != 0)
        {
            $returnArray['bestSellingPrice'] = ($returnArray['binanceLastPrice'] > $returnArray['bittrexLastPrice']) ? 
                                            'Binance has the best selling price of '.$returnArray['binanceLastPrice'] : 
                                            'Bittrex has the best selling price of '.$returnArray['bittrexLastPrice'];
        }
        return $returnArray;
    }
}
