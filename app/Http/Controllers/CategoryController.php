<?php
namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Lumen\Application;

class CategoryController extends Controller
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
        $Categorys =  Category::all();
        return response()->json(['status' => 'success','result' => $Categorys]);
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
            'name' => 'required',


        ]);

        if(Category::firstOrCreate( ['name' => $request->input('name') ],  $request->all() )){
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
        $Category = Category::where('id', $id)->get();
        return response()->json($Category);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View|Application
     */
    public function edit($id)
    {
        $Category = Category::where('id', $id)->get();
        return view('Category.editCategory',['Categories' => $Category]);
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
            'name' => 'filled',
            
        ]);
        $Category= Category::find($id);
        if($Category->fill($request->all())->save()){
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
        if(Category::destroy($id)){
            return response()->json(['status' => 'success']);
        }
    }
}