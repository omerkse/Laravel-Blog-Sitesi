<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::with('articles')->get();

        return view('Back.Categories.index' , compact('categories'));
    }

    public function create(Request $request){
        $isExists = Category::whereSlug(Str::slug($request->category))->first();
        if($isExists){
            toastr()->error($request->category.'Adında Kategori Zaten Mevcut');
            return redirect()->back();
        }
        $categories = new Category();
        $categories->name = $request->category;
        $categories->slug=Str::slug($request->category);
        $categories->save();
        return redirect()->back();

    }

    public function edit(Request $request)
    {
            $categories = Category::findOrFail($request->id);
            return response()->json($categories);
    }
    public function update(Request $request){
        $isSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName = Category::whereName($request->category)->whereNotIn('id', [$request->id])->first();

        if ($isName || $isSlug) {
            toastr()->error($request->category . ' adında bir kategori zaten mevcut.');
            return redirect()->back();
        }

        $category = Category::findOrFail($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->category); // Kategori adından slug oluşturun
        $category->save();


        return redirect()->route("admin.kategoriler")->with("success", "Kategori Güncellemesi Başarılı");
    }

    public function silme($id)
    {
        $category = Category::findOrFail($id);
        $articleCount = $category->articles()->count(); // Kategoriye ait makale sayısını al

        $category->delete();

        return redirect()->route("admin.kategoriler")->with("success", "Kategori Başarıyla Silinmiştir")->with("articleCount", $articleCount);
    }


}
