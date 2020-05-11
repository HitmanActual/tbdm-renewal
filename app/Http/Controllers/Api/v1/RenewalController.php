<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use App\Renewal;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;


class RenewalController  extends Controller
{
    use ApiResponser;
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return List of Rates
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        //
        $renewals = Renewal::all();
        
        return $this->successResponse($renewals);
      
    }

    /**
     * Create one new Renewal
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[

            'subscription_fees'=>'required|numeric',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'user_id'=>'required|integer',
        ]);
       
        $renewal = Renewal::create($request->all());          
        return $this->successResponse($renewal,Response::HTTP_CREATED);
       
    }

    /**
     * get one Rate
     *
     * @return Illuminate\Http\Response
     */
    public function show($renewal)
    {
        //

        $renewal = Renewal::findOrFail($renewal);
        return $this->successResponse($renewal);
        
    }

    /**
     * update an existing one Renewal
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$renewal)
    {

        $this->validate($request,[
            'subscription_fees'=>'numeric',
            'start_date'=>'date',
            'end_date'=>'date',
            'user_id'=>'integer',
        ]);
        $renewal = Renewal::findOrFail($renewal);
        $renewal->fill($request->all());

        
        if($renewal->isClean()){
            return $this->errorResponse("you didn't change any value",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $renewal->save();
        return $this->successResponse($renewal);
    }

     /**
     * remove an existing one renewal
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($renewal)
    {
        $renewal = Renewal::findOrFail($renewal);
        $renewal->delete();
        return $this->successResponse($renewal);
      
    }
    /**
     * 
     */

    public function calculateInterval(){



    }
}
