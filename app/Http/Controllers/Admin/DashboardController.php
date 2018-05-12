<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {                                        
        $this->middleware('admin-auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {         
		$data['count_categories'] = DB::table('categories')->count();
        $data['count_products'] = DB::table('products')->count(); 
        return view('admin.dashboard', [ 'data'=>$data ] );
    }
}
