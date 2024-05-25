<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function importCSV(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();

            // $request->validate([
            //     'import_csv' => 'required|mimes:csv',
            // ]);
            $file = $request->file('import_csv');
            $handle = fopen($file->path(), 'r');
    
            fgetcsv($handle);
    
            $chunksize = 25;
            $data = [];
            while(!feof($handle))
            {
                for($i = 0; $i<$chunksize; $i++)
                {
                    $row = fgetcsv($handle);
                    if($row === false)
                    {
                        break;
                    }
                    $data[] = [
                        "name" => $row[0],
                        "weight" => $row[1],
                        "price" => $row[2],
                        "stock" => $row[3],
                        "condition" => $row[4],
                        "description" => $row[5], 
                        "image" => $row[6],
                    ];
                }
            }
            fclose($handle);
            if (count($data)) {
                Product::insert($data);
                DB::commit();
            }
            else return redirect()->route('admin_page')->with('success', 'Data not found.');
    
            return redirect()->route('admin_page')->with('success', 'Data has been added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::debug($e);
            abort(400);
        }
    }

    public function exportCSV()
    {
        $filename = 'products.csv';
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
    
        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
    
            // Add CSV headers
            fputcsv($handle, [
                'Nama Produk',
                'Berat',
                'Harga',
                'Stok',
                'Kondisi',
                'Deskripsi',
                'Gambar',
                'Salary',
                'Skills'
            ]);
    
            Product::chunk(25, function ($products) use ($handle) {
                foreach ($products as $product) {
                    $data = [
                        isset($product->name)? $product->name : '',
                        isset($product->weight)? $product->weight : '',
                        isset($product->price)? $product->price : '',
                        isset($product->stock)? $product->stock : '',
                        isset($product->condition)? $product->condition : '',
                        isset($product->description)? $product->description : '',
                        isset($product->image)? $product->image : '',
                    ];
    
                    fputcsv($handle, $data);
                }
            });
    
            fclose($handle);
        }, 200, $headers);
    }
}
