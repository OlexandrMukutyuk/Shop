<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Type;
use App\Models\Categoty;

class AdminController extends Controller
{

    public function index(){
        return view('admin/indexAdmin');
    }

    public function viewCreate(){
        return view('admin/create/view');
    }

    public function viewSave(Request $request){
        $validator = Validator::make($request->all(), [
            'view_name' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = new Type();
        $type->name_type = $request->input('view_name');
        $type->save();

        return redirect()->route('index_admin');
    }

    public function viewAll(){
        $types = Type::all();
        //dd($types);
        return view('admin/edit/viewAll',['types' => $types]);
    }

    public function deleteType($id){
        $type = Type::find($id);

        if ($type) {
            $type->delete();
            return back();
        } else {
            return back();
        }
    }

    public function updateType(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'view_name' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = Type::find($id);
        $type->name_type = $request->input('view_name');
        $type->save();
        return back();
    }


    public function categotyCreate(){
        $types = Type::all();

        return view('admin/create/category',['types' => $types]);
    }

    public function categotySave(Request $request){
        $validator = Validator::make($request->all(), [
            'view_name' => 'required|min:4',
            'exampleSelect' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //dd($request->input('exampleSelect'));
        $categoty = new Categoty();
        $categoty->categori = $request->input('view_name');
        $categoty->type_id = $request->input('exampleSelect');
        $categoty->save();
        return back();
    }

    public function categotyAll(){
        $categoty = Categoty::all();
        $types = Type::all();
        //dd($categoty);
        return view('admin/edit/categotyAll',['categotys' => $categoty,'types' => $types]);
    }

    public function updateCategoty(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'view_name' => 'required|min:4',
            'exampleSelect' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //dd($request);
        $categoty = Categoty::find($id);
        $categoty->categori = $request->input('view_name');
        $categoty->type_id = $request->input('exampleSelect');
        $categoty->save();
        return back();
    }


    public function deleteCategoty($id){
        $type = Categoty::find($id);

        if ($type) {
            $type->delete();
            return back();
        } else {
            return back();
        }

    }
}
