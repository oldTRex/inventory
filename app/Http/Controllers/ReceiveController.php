<?php
namespace App\Http\Controllers;
use App\Category;
use App\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\receive;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
class ReceiveController extends Controller
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
        $receives =  Receive::all();
        return response()->json(['status' => 'success','result' => $receives]);
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
            'supplier_name' => 'required',
            'item_code' => 'required',

        ]);

        if(receive::firstOrCreate(
             $request->all() )){
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
        $receive = receive::where('id', $id)->get();
        return response()->json($receive);

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
            'supplier_name' => 'required',
            'item_code' => 'required',

        ]);
        $receive= receive::find($id);
        if($receive->fill($request->all())->save()){
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
        if(receive::destroy($id)){
            return response()->json(['status' => 'success']);
        }
    }
}