<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminParalegalListController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listing(Request $request)
    {
        $attorney = \App\Models\User::where('users.role', \App\Models\User::ATTORNEY)->orderBy('users.id', 'DESC')->where('users.parent_attorney_id', '!=', 0)->leftJoin(
            'users as parentattorney',
            'parentattorney.id',
            '=',
            'users.parent_attorney_id'
        )->select('users.name', 'users.email', 'users.phone_no', 'parentattorney.name as parent_attorney', 'users.created_at', 'users.company', 'users.id');
        if (!empty($request->query('q'))) {
            $attorney->Where(function ($query) use ($request) {
                $query->Where('users.name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.email', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.company', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.id', '=', $request->query('q'));
            });
        }

        $attorney = $attorney->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.paralegal.list', ['keyword' => $keyword,'attorney' => $attorney]);
    }

    public function edit(Request $request, $id)
    {
        $attorney = \App\Models\User::find($id);
        if ($request->isMethod('post')) {
            if (empty($id)) {
                return redirect()->route('admin_paralegal_list')->with('error', 'Invalid Request.');
            }
            $input = $request->all();
            $this->validate($request, [
                'name' => 'required|alpha_dash_space',
                'email' => 'required|email|unique:App\Models\User,email,'.$id,
                'phone_no' => 'required',
            ]);
            unset($input['_token']);
            $user = \App\Models\User::where('id', $id)->update($input);
            if (!empty($user)) {
                return redirect()->route('admin_paralegal_list')->with('success', 'User has been updated successfully.');
            } else {
                return redirect()->route('admin_paralegal_list')->with('error', 'Record has not been saved, Please check.');
            }
        } else {
            return view('admin.paralegal.edit', ['User' => $attorney]);
        }
    }

}
