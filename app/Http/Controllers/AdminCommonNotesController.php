<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminCommonNotesCategory;

class AdminCommonNotesController extends Controller
{
    public function index(Request $request)
    {
        $notes = AdminCommonNotesCategory::where("category", "!=", null)->orderBy('id', "asc")->select('category', 'id');
        if (!empty($request->query('q'))) {
            $notes->Where(function ($query) use ($request) {
                $query->Where('category', 'like', '%' . $request->query('q') . '%');
            });
        }
        $notes = $notes->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.notes_category.show')->with(['keyword' => $keyword, 'notes' => $notes]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $category = new AdminCommonNotesCategory();
            $category->category = $request->note_category;
            $category->created_at = date("Y-m-d H:i:s");
            $category->updated_at = date("Y-m-d H:i:s");
            if ($category->save()) {
                return redirect()->back()->with('success', 'Record has been added successfully.');
            } else {
                return redirect()->back()->withError("something went wrong");
            }
        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    public function edit($id)
    {
        $notes = AdminCommonNotesCategory::where('id', $id)->select('category', 'id')->first()->toArray();

        return view('admin.notes_category.edit', ['notes' => $notes]);
    }

    public function update(Request $request)
    {

        if ($request->isMethod('post')) {
            $input = $request->all();
            AdminCommonNotesCategory::where('id', $input['id'])->update(['category' => $input['updated_category']]);

            return response()->json(\App\Helpers\Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return response()->json(\App\Helpers\Helper::renderJsonError('Not a valid request, Please check'))->header('Content-Type: application/json;', 'charset=utf-8');

    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            AdminCommonNotesCategory::where('id', $input['id'])->delete();

            return response()->json(\App\Helpers\Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return response()->json(\App\Helpers\Helper::renderJsonError('Not a valid request, Please check'))->header('Content-Type: application/json;', 'charset=utf-8');

    }

}
