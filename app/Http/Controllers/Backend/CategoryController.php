<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $categories = Category::latest()->get();

        return view('backend.category.category_all', compact('categories'));
    }

    public function addCategory()
    {
        return view('backend.category.category_add');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'string', 'max:170'],
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Catégorie ajoutée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    /**
     * Edit category
     */
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);

        return view('backend.category.category_edit', compact('category'));
    }

    /**
     * Update category
     */
    public function updateCategory(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'string', 'max:170'],
        ]);

        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Catégorie mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Catégorie supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
