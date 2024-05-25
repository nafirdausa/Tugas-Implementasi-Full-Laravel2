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
        $data = Product::all();
        // $user = User::find(1);
        // $data = $user->products;
        return view('product')->with('products', $data);
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
        return view('tambah_product');
    }
    // input produk
    public function postRequest(Request $request, User $user){
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string',
            'weight' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'condition' => 'required|in:Baru,Bekas',
            'description' => 'required|max:2000',
        ],[
            'image.required' => 'Kolom image harus diisi.',
            'name.required' => 'Kolom name harus diisi.',
            'weight.required' => 'Kolom weight harus diisi.',
            'price.required' => 'Kolom price harus diisi.',
            'stock.required' => 'Kolom stock harus diisi.',
            'condition.required' => 'Kolom condition harus diisi.',
            'description.required' => 'Kolom description harus diisi.',
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
            'image.max' => 'The image must not be greater than 2048 kilobytes.',
            'description.max' => 'The description must not be greater than 2000 characters.'
        ]);
    
        $imagePath = $request->file('image')->store('product_image', 'public');

        Product::create([
            'image' => $imagePath,
            'name' => $request->name,
            'condition' => $request->condition,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'price' => $request->price,
            'description' => $request->description,
        ]);
    
        return redirect()->route('admin_page', ['user'=>$user->id]);
    }

    public function editProduct(Request $request, User $user, Product $product){
        return view('edit_product', ['product'=>$product, 'user'=>$user]);
    }

    public function updateProduct(Request $request, User $user, Product $product){
        if(!$request->filled('image')){
            return redirect()->back()->with('error', 'Error. File image Produk Wajib Diisi');
        }elseif(!$request->filled('name')){
            return redirect()->back()->with('error', 'Error. File name Produk Wajib Diisi');
        }elseif(!$request->filled('weight')){
            return redirect()->back()->with('error', 'Error. File weight Wajib Diisi');
        }
        elseif(!$request->filled('price')){
            return redirect()->back()->with('error', 'Error. File Harga Wajib Diisi');
        }
        elseif(!$request->filled('stock')){
            return redirect()->back()->with('error', 'Error. File stock Wajib Diisi');
        }
        elseif(!$request->filled('condition') || !in_array($request->condition, ['Baru', 'Bekas'])){
            return redirect()->back()->with('error', 'Error. File condition Wajib Diisi');
        }
        elseif(!$request->filled('description')){
            return redirect()->back()->with('error', 'Error. File description Wajib Diisi');
        }
        
        if($product->user_id === $user->id){
            $product->image = $request->image;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->condition = $request->condition;
            $product->description = $request->description;
        }
        $product->save();
        return redirect()->route('admin_page', ['user'=>$user->id])->with('message', 'Berhasil update data');
    }

    public function deleteProduct(Request $request, User $user, Product $product){
        if($product->user_id === $user->id){
            $product->delete();
        }
        return redirect()->back()->with('status', 'Berhasil menghapus data produk');
    }




















}
