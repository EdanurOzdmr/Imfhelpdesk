<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Demand;
use App\Http\Controllers\Controller;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //Müşterilerin talep oluşturduğu api
    {
        $input = $request->all();
        $input['status'] = 'open';
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'department_id' => 'required',
            'product_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $demand = Demand::create($input);
        $response = [
            'data' => $demand
        ];
        return response()->json($response, 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//Müşterilerin talep durumunu değiştirdiği api
    {
        $status = Demand::where('id', $id)
            ->update([
                'status' => $request->status
            ]);
        $response = [
            'data' => $status
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function demandShow(Request $request)//Personellerin talepleri görüntülediği api
    {
        $query = Staff::where('id', $request->input('id'))->first();
        $demandList = Demand::where('department_id', $query->department_id)->get();
        $response = [
            'data' => $demandList
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function demandResponse(Request $request)// Personellerin talep yanıtladığı api
    {
        $comments=Comment::where('status', 'open')
            ->create([
            'staff_id' => $request->staff_id,
            'demand_id' => $request->demand_id,
            'comments' => $request->comments
        ]);
        $response = [
            'data' => $comments
        ];
        return response()->json($response, 201);

    }
}
