<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Validator;

use App\Exports\DashboardExport;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Imports\importProduct;
use App\Models\Post;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MarketController extends Controller
{
    // home
    public function home(){
        return view('home');
    }
    
    public function product(){
        return view('product');
    }
    public function getProfile(Request $request, User $user)
    {
        $user = Auth::user();

        return view('profile', ['user' => $user]);
    }

    public function login(){
        return view('login');
    }
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')
                ->with('error', 'Login failed email or password is incorrect');
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('dashboard', compact('user'));
    }
    
    public function register(){
        return view('register');
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:superadmin,user',
            'gender' => 'required',
            'age' => 'required|integer|min:1',
            'birth' => 'required|date',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'age' => $request->age,
            'birth' => $request->birth,
            'address' => $request->address,

        ]);

        // assign role
        $user->assignRole($request->role);

        if ($user) {
            return redirect()->route('login')
                ->with('success', 'User created successfully');
        } else {
            return redirect()->route('register')
                ->with('error', 'Failed to create user');
        }
    }

    public function getAdmin(User $user)
    {
        // $products = Product::where('user_id', $user->id)->get();
        $products = Product::all();
        return view('admin_page', ['products' => $products]);
    }
    public function importProduct(Request $request)
    {

        DB::beginTransaction();
        try {
            $user = Auth::user();
            // Excel::import(new ProductImport($user), $request->file('import'));
            DB::commit();

            return redirect()->route('admin_page');
        } catch (\Exception $e) {
            DB::commit();
            Log::debug($e);
            abort(400);
        }
    }
    public function handleRequest(Request $request, User $user)
    {
        return view('handle_request');
    }






















}
