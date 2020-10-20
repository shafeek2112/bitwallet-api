<?php

namespace App\Http\Controllers;

use App\Http\Resources\APICollection;
use App\Services\ApiService;
use Illuminate\Http\Request;
use DataTables;

class ResultController extends Controller
{
    protected $apiService; 
    public function __construct()
    {
        $this->apiService = new ApiService();
    }

     /**
     * Get the result and show .
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $tickerPair = $this->apiService->getTickerPair();
        // dd($tickerPair);
        return view('welcome');
    }
     
    /**
     * Get the result and show for compare ticker.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function compareTicket(Request $request)
    {
        $data = $request->all();
        $return = [];
        if($request->method() == 'GET' && (!empty($data['first_symbol']) && !empty($data['second_symbol'])) ) {
            $return = $this->apiService->getIndividualTickerPairToCompare($data);
        }
        // dd($return);
        return view('compare_ticker',[
            'return' => $return,
        ]);
    }

    public function getTickerPair()
    {
        $tickerPair = $this->apiService->getTickerPair();
        // dd(datatables()->of($tickerPair)->toJson());
        // return json_encode($tickerPair);
        // return Datatables::of(User::query())->make(true);
        return datatables()->of($tickerPair)->toJson();
    }
    
    public function compareResult(Request $request)
    {
        return $this->apiService->getIndividualTickerPairToCompare($request);
    }
}
