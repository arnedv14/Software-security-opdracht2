<?php

namespace App\Http\Controllers;

use App\Exemplar;
use App\Loan;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $numberInStock = [];
        $items = Item::all()->sortBy('name');
        foreach ($items as $item) {
            $count = DB::table('exemplars')->where(['itemID'=> $item->id,'is_loaned'=>0])->count();
            array_push($numberInStock, $count);
        }
        return view('loan/home', [
            "items" => $items,
            "numberInStock" => $numberInStock
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Loan $loan
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $req, $id)
    {
        return view('loan/detail',
            [
                "item" => Item::find($id),
                "numberInStock" => $count = DB::table('exemplars')->where(['itemID'=> $id, 'is_loaned'=> 0])->count()
            ]);
    }

    public function showLoan($id)
    {
        if (DB::table('exemplars')->where('itemID', $id)->count() < 1) {
            return redirect()->to('/loan')->withErrors('There are no more exemplars in stock of this item!');
        } else {
            $numberInStock = [];
            $items = Item::all();
            foreach ($items as $item) {
                $count = DB::table('exemplars')->where(['itemID'=> $item->id, 'is_loaned'=>0])->count();
                array_push($numberInStock, $count);
            }
            return view('loan/loan', [
                "item" => Item::find($id),
                "numberInStock" => $numberInStock,
                "items" => Item::all()
            ]);

        }
    }

    public function performLoan(Request $req)
    {
        $validatedData = $req->validate([
            'beginDate' => 'required|after_or_equal:today',
            'endDate' => 'required|after:beginDate',
            'email' => 'required|email'
        ]);
        //check if there are still exemplars left of this item

        $item = Item::where('name', $req->input('item'))->first();
        $itemID = $item->id;
        if (!Exemplar::where([['itemID', '=', $itemID],
            ['is_loaned', '=', 0]])->first()) {
            return redirect()->to('/loan/')->withErrors('There are no exemplars of this item in stock!');
        }

        //check if loaner has an account, if not: create one for him

        $check = User::where('email', $req->input('email'));
        if (!$check->count()) {
            //create user
            $user = User::create([
                'name' => $req->input('email'),
                'email' => $req->input('email'),
                'password' => Hash::make(123456),
                'role' => 'User',
                'type' => 'Student'
            ]);
            //get created user-account to link it to loan
            $createdUser = User::latest()->first();
            $userID = $createdUser->id;
        }else{
            $user=User::where('email','=',$req->input('email'))->first();
            $userID= $user->id;
        }



        //create loan


        $loan = new Loan();
        $loan->loaner = $userID;
        $exemplarID = Exemplar::where([['itemID', '=', $itemID], ['is_loaned', '=', 0]])->first()->GUID;
        $loan->exemplarID = $exemplarID;
        $startDateInput = $req->input('beginDate');
        $startDate = strtotime($startDateInput);
        $loan->start_loan = date('Y-m-d H:i:s', $startDate);

        $endDateInput = $req->input('endDate');
        $endDate = strtotime($endDateInput);
        $loan->end_loan = date('Y-m-d H:i:s', $endDate);
        $loan->remarks = $req->input('remarks');


        $loan->save();

        DB::table('exemplars')->where('GUID',$loan->exemplarID)->update(['is_loaned'=>1]);



        return redirect()->to('/loan/')->with('message', 'Loan was successfully created!');


    }

    public function overview(){
        $loans=Loan::all();
        $users= [];
        foreach($loans as $loan){
//            array_push($users, User::where(['id'=>$loan->loaner]));
            $itemID= Exemplar::where(['GUID'=>$loan->exemplarID])->first()->itemID;
            $loan->itemID=$itemID;
            $loan->itemName=Item::where(['id'=> $itemID])->first()->name;
            $loan->username=User::where(['id'=>$loan->loaner])->first()->name;
            $loan->email=User::where(['id'=>$loan->loaner])->first()->email;
            $loan->userid=User::where(['id'=>$loan->loaner])->first()->id;
        }
        return view('loan/overview',[
            'loans'=>$loans
//            'users'=>$users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
