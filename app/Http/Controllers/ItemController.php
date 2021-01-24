<?php

namespace App\Http\Controllers;

use App\Exemplar;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ItemController extends Controller
{
    public function detail($id)
    {
        $item = Item::find($id);
        return view('inventory/detail', [
            "item" => $item,
            "numberInStock" => DB::table('exemplars')->where('itemID', $id)->count(),
            "numberAvailable"=>DB::table('exemplars')->where(['itemID'=>$id, 'is_loaned'=>0])->count()
        ]);
    }

    public function downloadPDF($id)
    {
        $file = public_path() . '\\' . Item::find($id)->manual;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, 'manual' . Item::find($id)->name . '.pdf', $headers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(Request $req)
    {

        //validate Form
        $validatedData = $req->validate([
            'name' => 'required|min:6|max:255',
            'description' => 'required',
            'photoItem' => 'required|mimes:jpeg,png,jpg|max:3000',
            'manualItem' => 'required|max:10000|mimes:pdf',
            'numberInStock' => 'min:0'
        ]);

        //use data to create a new item
        $item = new Item();
        $item->name = $req->input('name');
        $item->description = $req->input('description');

        //resize image with Image-Intervention package
        $image = $req->file('photoItem');
        $img = Image::make($image->path());
        $itemFileName = $item->name . '.' . $image->getClientOriginalExtension();
        $path = public_path() . '\storage\images\\';
        $img->resize(350, 200)->save($path . $itemFileName);
        //save path to image to db
        $item->image = 'storage\images\\' . $itemFileName;

        //proccess uploaded manual
        $manual = $req->file('manualItem');
        $manualFileName = $item->name . '.' . $manual->getClientOriginalExtension();
        $path = public_path() . '\storage\manuals\\';
        $manual->move($path, $manualFileName);
        $item->manual = 'storage\manuals\\' . $manualFileName;

        $item->save();
        //create exemplaries of this item
        for ($i = 0; $i < $req->input('numberInStock'); $i++) {
            $exemplar = new Exemplar();
            $exemplar->itemID = DB::table('items')->latest('created_at')->first()->id;
            $exemplar->is_loaned = 0;
            $exemplar->save();
        }
        return redirect()->to('/inventory');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreate()
    {
        return view('inventory/create');
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
     * @param \App\Item $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show(Request $req)
    {
        $numberInStock=[];
        foreach(Item::all() as $item){
            $count=DB::table('exemplars')->where('itemID', $item->id)->count();
            array_push($numberInStock,$count);
        }
        $items=Item::all()->sortBy('name');
        return view('inventory/home', [
            "items" => $items,
            "numberInStock"=>$numberInStock
        ]);
    }


    public function showEdit($id)
    {
        return view('inventory/edit',
            [
                "item" => Item::find($id),
                "numberInStock" => DB::table('exemplars')->where('itemID', $id)->count()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $req, $id)
    {
        $validatedData = $req->validate([
            'name' => 'required|min:6|max:255',
            'description' => 'required',
            'photoItem' => 'mimes:jpeg,png,jpg|max:3000',
            'manualItem' => 'max:10000|mimes:pdf',
            'numberInStock' => 'min:0'
        ]);

        $item = Item::find($id);

        $item->name = $req->input('name');
        $item->description = $req->input('description');

        //process new image
        if ($req->hasFile('photoItem')) {
            //resize image with Image-Intervention package
            $image = $req->file('photoItem');
            $img = Image::make($image->path());
            $itemFileName = $item->name . '.' . $image->getClientOriginalExtension();
            $path = public_path() . '\storage\images\\';
            $img->resize(350, 200)->save($path . $itemFileName);
            //save path to image to db
            $item->image = 'storage\images\\' . $itemFileName;
        }
        //process new manual
        if ($req->hasFile('manualItem')) {
            //process uploaded manual
            $manual = $req->file('manualItem');
            $manualFileName = $item->name . '.' . $manual->getClientOriginalExtension();
            $path = public_path() . '\storage\manuals\\';
            $manual->move($path, $manualFileName);
            $item->manual = 'storage\manuals\\' . $manualFileName;
        }
        $item->save();

        //delete or create exemplars
        $numberInStock = DB::table('exemplars')->where('itemID', $id)->count();
        $diff = $req->input('numberInStock') - $numberInStock;
        if ($diff > 0) {
            for ($i = 0; $i < $diff; $i++) {
                $exemplar = new Exemplar();
                $exemplar->itemId = $id;
                $exemplar->save();
            }
        } elseif ($diff < 0) {
            for ($i = $diff; $i < 0; $i++) {
                $exemplar=DB::table('exemplars')->where('itemID', $id)->first();
                $exemplar=DB::table('exemplars')->where('GUID', $exemplar->GUID)->delete();
            }
        }


        return redirect()->to('inventory/' . $id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $req,$id)
    {
        if($req->input('deleteItem')=='true'){
            Item::find($id)->delete();
        }
        return redirect()->to('/inventory')->with('message','Item was successfully deleted!');
    }
}
