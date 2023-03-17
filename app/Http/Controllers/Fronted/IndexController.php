<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    /**
     * Home page
     */
    public function index()
    {
        $slider = Slider::orderBy('slider_title', 'ASC')->get();

        return view('fronted.index', compact(
            'slider',
        ));
    }




    /**
     * Page des réductions
     */
    // public function deals()
    // {
    //     $deals = Product::where('status', 1)
    //         ->where('discount_price', '!=', NULL)
    //         ->orderBy('id', 'DESC')
    //         ->get();

    //     $categories = Category::orderBy('category_name', 'ASC')->get();

    //     $new_product = Product::where('status', 1)
    //         ->orderBy('id', 'DESC')
    //         ->limit(3)
    //         ->get();


    //     return view('fronted.home.deals', compact(
    //         'deals',
    //         'categories',
    //         'new_product'
    //     ));
    // }











    /**
     * Page de details du produit
     */
    public function productDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $product_color = $product->product_color;
        $product_size = $product->product_size;

        $multi_img = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $related_product = Product::where('status', 1)
            ->where('category_id', $cat_id)
            ->where('id', '!=', $id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('fronted.product.product_details', compact('product', 'product_color', 'product_size', 'multi_img', 'related_product'));
    }






    /**
     * Page de details vendeur
     */
    public function vendorDetails(Request $request, $id)
    {
        $vendor = User::findOrFail($id);
        $vendor_product = Product::where('status', 1)
            ->where('vendor_id', $id)
            ->orderBy('id')
            ->get();

        return view('fronted.vendor.vendor_details', compact('vendor', 'vendor_product'));
    }






    /**
     * Vendor all
     */
    public function vendorAll()
    {
        $vendors = User::where('status', 'active')
            ->where('role', 'vendor')
            ->orderBy('id', 'ASC')
            ->get();

        return view('fronted.vendor.vendor_all', compact('vendors'));
    }






    /**
     * category page
     */
    public function catWiseProduct(Request $request, $id, $slug)
    {

        $products = Product::where('status', 1)
            ->where('category_id', $id)
            ->orderBy('id', 'DESC')
            ->get();


        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadcat = Category::where('id', $id)->first();

        $new_product = Product::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        return view('fronted.product.category_view', compact('products', 'categories', 'breadcat', 'new_product'));
    }













    /**
     * Product search
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $item = $request->search;

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $new_product = Product::where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        $products = Product::where('status', 1)
            ->where('product_name', 'LIKE', "%$item%")
            ->get();

        return view('fronted.product.search', compact('products', 'item', 'categories', 'new_product'));
    }




    public function searchProduct(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $item = $request->search;
        $products = Product::where('status', 1)
            ->where('product_name', 'LIKE', "%$item%")
            ->select('id', 'product_name', 'product_slug', 'product_thumbnail', 'product_price')
            ->limit(7)
            ->paginate(20);

        return view('fronted.product.search_product', compact('products', 'item'));
    }







    /**
     * brand details
     */
    public function brandDetails(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand_product = Product::where('status', 1)
            ->where('brand_id', $id)
            ->orderBy('id')
            ->get();

        return view('fronted.brand.brand_details', compact('brand', 'brand_product'));
    }






    /**
     * brand all
     */
    public function brandAll()
    {
        $brands = Brand::orderBy('brand_name', 'ASC')
            ->get();

        return view('fronted.brand.brand_all', compact('brands'));
    }
}
