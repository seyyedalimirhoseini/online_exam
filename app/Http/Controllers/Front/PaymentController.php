<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Zarinpal\Zarinpal;
use App\Payment;
use App\Answer;
use App\Session;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function payment($id)
    {
        $session=Session::findOrFail($id);
        $results= Answer::groupBy('count')
        ->where('user_id',auth()->user()->id)
    
         ->selectRaw('sum(score) as score,count')
      
        ->where('session_id',$session->id)

        ->get();
        $price= count($results);
        $data=array(
            $session->id,$price,$results,
        );
     
        session()->put('data',$data);
        session()->save();

       $zarinpal = new Zarinpal('aae0a368-021a-11e6-a1db-005056a205be');
        $zarinpal->enableSandbox(); // active sandbox mod for test env
        // $zarinpal->isZarinGate(); // active zarinGate mode
        $results = $zarinpal->request(
            route('payment.callback'),           //required
           $price*1000,                                  //required
            auth()->user()->name,                             //required
            auth()->user()->email,                       //optional
            '09000000000',                         //optional
            [                          //optional
                "Wages" => [
                    "zp.1.1"=> [
                        "Amount"=> 120,
                        "Description"=> "part 1"
                    ],
                    "zp.2.5"=> [
                        "Amount"=> 60,
                        "Description"=> "part 2"
                    ]
                ]
            ]
        );
        echo json_encode($results);
        if (isset($results['Authority'])) {
            file_put_contents('Authority', $results['Authority']);
            $zarinpal->redirect();
        }
        //it will redirect to zarinpal to do the transaction or fail and just echo the errors.
        //$results['Authority'] must save somewhere to do the verification
    }
    public function callback()
    {

        $status=$_GET['Status'];


        if($status == 'OK')
        {
            $this->success();
            session()->flash('success','پرداخت با موفقیت انجام شد.');

            return redirect()->back();
        }else{
            return 'مشکلی در پرداخت به وجود آمده است.';
        }
    }
    public function success()
    {
        $session_id = session('data')[0];
        $results=session('data')[2];
       
         
        if (session()->has('data')) {
           
              
            $payment = [
                'user_id' => auth()->user()->id,
                'status' => 1,
                'count'=>count($results),
                'price' => session('data')[1] * 1000,
                'session_id' => $session_id,
                'authority' => $_GET['Authority'],
            ];
            $insert = Payment::where('user_id', auth()->user()->id)->where('session_id', $session_id)->increment('count');
            $data = Payment::insert($payment);
            session()->put('data', null);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
