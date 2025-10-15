<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DomesticAddress;
use Exception;
use App\Helpers\Helper;

class AdminDomesticAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $addresses = DomesticAddress::where("address_name", "!=", null)->orderBy('address_name', 'asc')->select('address_name', 'address_street', 'address_line2', 'address_city', 'address_zip', 'address_state', 'id');
        if (!empty($request->query('q'))) {
            $addresses->Where(function ($query) use ($request) {
                $query->Where('address_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('address_street', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('address_line2', 'like', '%' . $request->query('q') . '%');

                $query->orWhere('address_city', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('address_zip', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('address_state', 'like', '%' . $request->query('q') . '%');
            });
        }
        $addresses = $addresses->paginate(10);
        //dump($client->getBindings());
        $keyword = $request->query('q') ?? '';

        return view('admin.domesticaddress.show', ['keyword' => $keyword,'addresses' => $addresses]);


    }


    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
               'address_name' => 'required',
               'address_street' => 'required',
               'address_city' => 'required',
               'address_state' => 'required',
               'address_zip' => 'required'
            ]);

            $domestic = new DomesticAddress();
            $domestic->address_name = $request->address_name;
            $domestic->address_street = $request->address_street;
            $domestic->address_line2 = $request->address_line2;

            $domestic->address_city = $request->address_city;
            $domestic->address_state = $request->address_state;
            $domestic->address_zip = $request->address_zip;
            $domestic->address_phone = $request->address_phone ?? '';
            $domestic->address_email = $request->address_email ?? '';
            $domestic->address_fax = $request->address_fax ?? '';

            $domestic->notify_address_name = $request->notify_address_name;
            $domestic->notify_address_street = $request->notify_address_street;
            $domestic->notify_address_line2 = $request->notify_address_line2;

            $domestic->notify_address_city = $request->notify_address_city;
            $domestic->notify_address_zip = $request->notify_address_zip;
            $domestic->notify_address_phone = $request->notify_address_phone ?? '';
            $domestic->notify_address_email = $request->notify_address_email ?? '';
            $domestic->notify_address_fax = $request->notify_address_fax ?? '';

            if ($domestic->save()) {
                return redirect()->route('admin_domestic_index')->with('success', 'Domestic Address has been added successfully.');
            } else {
                return redirect()->back()->withError("something went wrong");
            }

        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = DomesticAddress::find($id);

        return view('admin.domesticaddress.edit')->with('address', $address);
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
        $this->validate($request, [
            'address_name' => 'required',
            'address_street' => 'required',
            'address_city' => 'required',
            'address_state' => 'required',
            'address_zip' => 'required'
        ]);

        try {
            DomesticAddress::where('id', $id)->update([
                "address_name" => $request->address_name,
                "address_street" => $request->address_street,
                "address_line2" => $request->address_line2,

                "address_city" => $request->address_city,
                "address_state" => $request->address_state,
                "address_zip" => $request->address_zip,
                "address_phone" => $request->address_phone ?? '',
                "address_email" => $request->address_email ?? '',
                "address_fax" => $request->address_fax ?? '',

                "notify_address_name" => $request->notify_address_name,
                "notify_address_street" => $request->notify_address_street,
                "notify_address_line2" => $request->notify_address_line2,
                "notify_address_city" => $request->notify_address_city,
                "notify_address_zip" => $request->notify_address_zip,
                "notify_address_phone" => $request->notify_address_phone ?? '',
                "notify_address_email" => $request->notify_address_email ?? '',
                "notify_address_fax" => $request->notify_address_fax ?? ''

            ]);

            return redirect()->route('admin_domestic_index')->with('success', 'Domestic Address has been updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        DomesticAddress::where('id', $request->id)->delete();

        return response()->json(Helper::renderJsonSuccess('Domestic Address Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');

    }
}
