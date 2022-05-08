<?php
namespace App\Http\Controllers;
use App\Category;
use App\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Sale;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
class SaleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('ApiAuth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $Sales =  Sale::all();
        return response()->json(['status' => 'success','result' => $Sales]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'item_code' => 'required',
            'customer_name' => 'required',

        ]);

        if(Sale::firstOrCreate(
            [
                'item_code' => $request->input('item_code') ,
            ],  $request->all() )){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $Sale = Sale::where('id', $id)->get();
        return response()->json($Sale);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'item_code' => 'required',
            'customer_name' => 'required',

        ]);
        $Sale= Sale::find($id);
        if($Sale->fill($request->all())->save()){
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'failed']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse|void
     */
    public function destroy($id)
    {
        if(Sale::destroy($id)){
            return response()->json(['status' => 'success']);
        }
    }
}