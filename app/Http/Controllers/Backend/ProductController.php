<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\MultiImg;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

use function App\SKU_gen;

class ProductController extends Controller
{

    public function allProduct()
    {
        $products = Product::orderBy('product_name', 'ASC')->get();

        return view('backend.product.product_all', compact('products'));
    }







    public function addProduct()
    {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();

        return view('backend.product.product_add', compact('brands', 'categories', 'activeVendor'));
    }










    public function storeProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'max:50'],
            'product_quantity' => ['required', 'regex:/^[1-9]+|not_in:0$/'],
            'product_size' => ['nullable'],
            'product_color' => ['nullable'],
            'product_country' => ['nullable'],
            'product_type' => ['nullable'],
            'product_price' => ['required', 'regex:/^[1-9]+|not_in:0$/'],
            'discount_price' => ['nullable', 'regex:/^[1-9]+|not_in:0$/'],
            'long_description' => ['required'],
            'product_thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'brand_id' => ['required'],
            'vendor_id' => ['required'],
            'category_id' => ['required'],

        ], [
            'product_name.required' => 'Ce champ est requis',
            'product_name.max' => '50 caractères maximums',
            'brand_id.required' => 'Ce champ est requis',
            'vendor_id.required' => 'Ce champ est requis',
            'category_id.required' => 'Ce champ est requis',
            'product_quantity.required' => 'Ce champ est requis',
            'product_quantity.regex' => 'Uniquement des chiffres',
            'product_price.required' => 'Ce champ est requis',
            'product_price.regex' => 'Uniquement des chiffres',
            'discount_price.required' => 'Uniquement des chiffres',
            'long_description.required' => 'Ce champ est requis',
            'product_thumbnail.required' => 'Ce champ est requis',
            'product_thumbnail.image' => 'UNiquement des images',
            'product_thumbnail.max' => 'Le poids de l\'image doit-etre de 1 Mo maximum',
        ]);



        //replace decimal separator in price
        $price1 = $request->product_price;
        $price2 = str_replace(",", ".", $price1);

        $discount_price1 = null;

        if ($request->discount_price == null) {
            $discount_price1 = $request->discount_price;
        } else {
            $discount_price1 = str_replace(",", ".", $request->discount_price);
        }


        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $name_gen);

            $save_url = 'upload/products/thumbnail/' . $name_gen;


            // dd($request);

            $product_id = Product::insertGetId([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'vendor_id' => $request->vendor_id,

                'product_name' => $request->product_name,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'product_quantity' => $request->product_quantity,
                'product_country' => $request->product_country,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'product_type' => $request->product_type,

                'product_price' => $price2,
                'discount_price' => $discount_price1,
                'long_description' => $request->long_description,

                'product_thumbnail' => $save_url,
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);


            // sku generator
            $p_name = Product::find($product_id)->product_name;
            $cat_name = Product::find($product_id)->category;
            $bran_name = Product::find($product_id)->brand;

            $code_gen = SKU_gen($p_name, $cat_name->category_name, $bran_name->brand_name, $product_id);

            Product::findOrFail($product_id)->update([
                'product_code' => $code_gen,
            ]);



            // multi image
            $images = $request->file('multi_img');
            foreach ($images as $img) {

                $request->validate([
                    'multi_img.*' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
                ]);

                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(800, 800)->save('upload/products/multi_image/' . $make_name);

                $upload_path = 'upload/products/multi_image/' . $make_name;

                MultiImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $upload_path,
                    'created_at' => Carbon::now(),
                ]);
            }


            $notification = array(
                'message' => 'Article ajouté avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('all.product')->with($notification);
        }
    }











    # Edit
    public function editProduct($id)
    {
        $images = MultiImg::where('product_id', $id)->get();
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $products = Product::findOrFail($id);


        return view('backend.product.product_edit', compact('brands', 'categories', 'activeVendor', 'products', 'images'));
    }










    # update
    public function updateProduct(Request $request)
    {
        // dd($request);

        $validator = Validator::make($request->all(), [
            'product_name' => ['required', 'max:50'],
            'product_quantity' => ['required', 'regex:/^[1-9]+|not_in:0$/'],
            'product_size' => ['nullable'],
            'product_color' => ['nullable'],
            'product_country' => ['nullable'],
            'product_type' => ['nullable'],
            'product_price' => ['required', 'regex:/^[1-9]+|not_in:0$/'],
            'discount_price' => ['nullable', 'regex:/^[1-9]+|not_in:0$/'],
            'long_description' => ['required'],
            'brand_id' => ['required'],
            'vendor_id' => ['required'],
            'category_id' => ['required'],

        ], [
            'product_name.required' => 'Ce champ est requis',
            'product_name.max' => '50 caractères maximums',
            'brand_id.required' => 'Ce champ est requis',
            'vendor_id.required' => 'Ce champ est requis',
            'category_id.required' => 'Ce champ est requis',
            'product_quantity.required' => 'Ce champ est requis',
            'product_quantity.regex' => 'Uniquement des chiffres',
            'product_price.required' => 'Ce champ est requis',
            'product_price.regex' => 'Uniquement des chiffres',
            'discount_price.required' => 'Uniquement des chiffres',
            'long_description.required' => 'Ce champ est requis',
        ]);



        //replace decimal separator in price
        $price1 = $request->product_price;
        $price2 = str_replace(",", ".", $price1);



        /**
         * Pour eviter d'avoir un valeur vide dans la colonne discount price lorsque l'on edite un produit qui n'a pas de discount
         * je verifie bien la valeur retourné par la requete,
         * si elle est null je m'assure de tjrs conserver cette valeur null (sans ca le calcul va retourné une valeur vide au lieu du null)
         */
        $discount_price1 = null;

        if ($request->discount_price == null) {
            $discount_price1 = $request->discount_price;
        } else {
            $discount_price1 = str_replace(",", ".", $request->discount_price);
        }



        // dd($discount_price1);

        $product_id = $request->id;

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            Product::findOrFail($product_id)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,

                'product_name' => $request->product_name,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'product_quantity' => $request->product_quantity,
                'product_country' => $request->product_country,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'product_type' => $request->product_type,
                'product_price' => $price2,
                'long_description' => $request->long_description,
                'discount_price' => $discount_price1,

                'vendor_id' => $request->vendor_id,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Produit mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->route('all.product')->with($notification);
        }
    }









    /**
     * Update thumbnail
     */
    public function updateProductThumbnail(Request $request)
    {
        $pro_id = $request->id;
        $old_image = $request->old_img;

        $request->validate([
            'product_thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
        ]);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $name_gen);

        $save_url = 'upload/products/thumbnail/' . $name_gen;

        if (file_exists($old_image)) {
            unlink($old_image);
        }

        Product::findOrFail($pro_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Miniature du produit mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }







    /**
     *  Update Multi image
     */
    public function updateProductMultiImage(Request $request)
    {
        $image_multi = $request->multi_img;

        if ($image_multi == NULL) {

            $notification = array(
                'message' => 'Image du produit mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            foreach ($image_multi as $id => $img) {

                $request->validate([
                    'multi_img.*' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
                ]);


                $img_delete = MultiImg::findOrFail($id);

                unlink($img_delete->photo_name);

                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(800, 800)->save('upload/products/multi_image/' . $make_name);

                $upload_path = 'upload/products/multi_image/' . $make_name;

                MultiImg::where('id', $id)->update([
                    'photo_name' => $upload_path,
                    'updated_at' => Carbon::now(),
                ]);
            }

            $notification = array(
                'message' => 'Image du produit mis à jour avec succès',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }







    /**
     * delete Multi image
     */
    public function multiImageDelete($id)
    {
        $old_img = MultiImg::findOrFail($id);
        unlink($old_img->photo_name);

        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Image du produit supprimée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }










    public function productDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Produit supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }









    /**
     * Product inactive
     */
    public function productInactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'Produit désactivé',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Product active
     */
    public function productActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Produit activé',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }













    //////////////////////////////////////////////////////

    public function productStock()
    {
        $products = Product::latest()->get();

        return view('backend.product.product_stock', compact('products'));
    }
}
