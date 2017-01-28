<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Song;

class SongController extends Controller{


    public function index(Request $request){
        $songs =  Song::orderBy('identifier','DESC')->paginate(5);
        return view('Song.index',compact('songs'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /*
    public function create(){
        return view('Song.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        Item::create($request->all());
        return redirect()->route('itemCRUD.index')->with('success','Item created successfully');
    }

    public function show($id){
        $item = Item::find($id);
        return view('ItemCRUD.show',compact('item'));
    }

    public function edit($id){
        $item = Item::find($id);
        return view('ItemCRUD.edit',compact('item'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        Item::find($id)->update($request->all());
        return redirect()->route('itemCRUD.index')->with('success','Item updated successfully');
    }

    public function destroy($id){
        Item::find($id)->delete();
        return redirect()->route('itemCRUD.index')->with('success','Item deleted successfully');
    }
    */
}
