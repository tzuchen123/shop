<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {

        $products = Product::with("product_type")->with("product_images")->get();

        return view('admin.products.index', compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = ProductType::all();

        return view('admin.products.create', compact("types"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // terminal: php artisan storage:link
        // 會建立一個資料夾(public/storage)，連結到資料夾(storage/app/public)
        // 上傳的圖片會存到(storage/app/public)
        // 但只有public下的資料夾，可以在網路上看到

        // 把create的資料"全部"丟到$requsetData
        // $requsetData = $request->all();
        //預設的 store 方法會去產生一個唯一的 ID 作為檔案名稱。該檔案的路徑會被 store 方法所回傳，以便將路徑和剛產生的檔案名稱存入資料庫中。
        // $file = $request->file('pic')->store('', 'public');

        // 存完之後丟回去$requsetData，表格存的資料會從path變成檔名，這樣view才叫得出來
        // $requsetData['pic'] = $file;
        // Product::create($requsetData);
        // view: img src="{{asset('/storage/'.$product->pic)}}"

        // 下面的錯誤寫法會抓到陣列
        // $file = $request->file('pic');
        // $file->store('', 'public');

        $requsetData = $request->all();
        //單張照片(單個陣列)，存在table products
        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('', 'public');
            $requsetData['image'] = $file;
        }

        //在table products 新增一列，丟到 $new_product
        $new_product = Product::create($requsetData);
        //抓新增產品的id，等下丟到table product_images的type_id
        $new_product_id = $new_product->id;

        // 多張照片(有多個陣列)，拆開之後同上，存在table product_images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // $image是資料陣列，store會抓到名字，丟到$image_name
                $image_name = $image->store('', 'public');

                // 在table product_images 新增一列，丟到 $product_image
                $product_image = new ProductImage;
                $product_image->product_id = $new_product_id;
                $product_image->image = $image_name;
                $product_image->save();
            }
        }

        return redirect('/admin/products');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with("product_type")->with("product_images")->find($id);
        $types = ProductType::all();
        return view('admin.products.edit', compact("product", "types"));
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
        $product = Product::find($id);
        $requsetData = $request->all();
        $old_image = $product->image;
        //主要照片更新
        if ($request->hasFile('image')) {
            //儲存新照片
            $file = $request->file('image')->store('', 'public');
            $requsetData['image'] = $file;
            //刪除本地舊照片
            if (file_exists(public_path('storage/' . $old_image))) {
                // public_path=>generate a fully qualified path to a given file within the public directory
                File::delete(public_path('storage/' . $old_image));
            }
        }

        //上傳新輪播照片
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // $image是資料陣列，store會抓到名字，丟到$image_name
                $image_name = $image->store('', 'public');

                // 在table product_images 新增一列，丟到 $product_image
                $product_image = new ProductImage;
                $product_image->product_id = $id;
                $product_image->image = $image_name;
                $product_image->save();
            }
        }

        //刪除舊輪播照片
        $delete_images_id = $request->delete;
        $array = explode(',', $delete_images_id);

        //whereIn找多個
        $product_images = ProductImage::whereIn('id', $array)->get();
        foreach ($product_images as $product_image) {
            $old_product_image = $product_image->image;
            if (file_exists(public_path('storage/' . $old_product_image))) {
                File::delete(public_path('storage/' . $old_product_image));
            }
            $product_image->delete();
        }

        $product->update($requsetData);

        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //單一圖片的刪除
        $item = Product::find($id);
        $old_image = $item->image;  //抓到檔名，但要抓到路徑才能刪，

        // 如果這路徑的檔案存在(file_exists)
        if (file_exists(public_path('storage/' . $old_image))) {
            // public_path=>generate a fully qualified path to a given file within the public directory
            File::delete(public_path('storage/' . $old_image));
        }
        $item->delete();

        //多張圖片的刪除
        $product_images = ProductImage::where('product_id', $id)->get();
        foreach ($product_images as $product_image) {
            $old_product_image = $product_image->image;
            if (file_exists(public_path('storage/' . $old_product_image))) {
                File::delete(public_path('storage/' . $old_product_image));
            }
            $product_image->delete();
        }

        return redirect('/admin/products');
    }
}
