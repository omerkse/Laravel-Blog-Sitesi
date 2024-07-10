<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articleCount = Article::count();
        $articles = Article::orderBy('created_at', 'ASC')->get();
        return view('back.articles.index', compact('articles', 'articleCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Örnek olarak resim için kurallar
            'content' => 'required|string', // content alanı zorunlu olarak tanımlandı
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->input('content');
        $article->slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imgName= Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imgName);
            $article->image = 'uploads/'.$imgName;
        }
            $article->save();
        return redirect()->route('admin.makaleler.index')
            ->with('success', 'Makale başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);

        $categories = Category::all();
        return view('back.articles.edit', compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article =  Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->input('content');
        $article->slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imgName= Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imgName);
            $article->image = 'uploads/'.$imgName;
        }
        $article->save();
        return redirect()->route('admin.makaleler.index')
            ->with('success', 'Makale Başarıyla Güncellendi.');
    }


    public function checkbox(Request $request)
    {
            $article = Article::findOrFail($request->id);
            $article->status = $request->statu =='true' ? 1 : 0;
            $article->save();
    }


    public function delete($id)
    {

        Article::find($id)->delete();
        return redirect()->route('admin.makaleler.index')->with('success', 'Makale Çöp Kutusuna Taşındı.');
    }

    public function copkutusu()
    {
           $articles= Article::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
           return view('back.articles.copkutusu', compact('articles'));
    }

    public function geriyukle(Request $request)
    {
        $article = Article::withTrashed()->findOrFail($request->id); // Silinmiş ya da aktif olanı getirmek için withTrashed() kullanılır
        $article->restore();

        return redirect()->route('admin.copkutusu')->with('success', 'Makale Tekrar Yüklendi.');
    }
        public function kaldır($id)
        {
            $article = Article::onlyTrashed()->find($id);
            if (File::exists($article->image)) {
                File::delete(public_path($article->image));
            }


            $article->forceDelete();
            return redirect()->route('admin.copkutusu')->with('success', 'Makale Kalıcı Olarak Silindi.');
        }

}

