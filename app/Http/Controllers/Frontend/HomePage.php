<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class HomePage extends Controller
{
    public function __construct()
    {
        view()->share('pages', Page::orderBy('order', 'ASC')->get());
        view()->share('categories', Category::all());
    }

    public function index()
    {

        $data['articles'] = Article::orderBy('created_at', 'DESC')->paginate(5);
        return view('Front.home', $data);
    }

    public function single($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403, 'Kategori Bulunamadı');
        $article = Article::whereSlug($slug)->where('category_id', $category->id)->first() ?? abort(404, 'Yazı Bulunamadı');
        $data['articles'] = $article;
        return view('Front.single', $data);
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort('404',); // Kategori bulunamazsa 404 hatası döndürür
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id', $category->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
        return view('Front.categories', $data);
    }


    public function page($slug)
    {
        $page = Page::whereSlug($slug)->first() ?? abort(403, 'Böyle Bir Sayfa Bulunamadı.');
        $data['page'] = $page;
        return view('Front.page', $data);

    }

    public function contact()
    {
        return view('Front.contact');

    }

    public function contactPost(Request $request)
    {
        $rules = [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10',
        ];

        // Validator oluştur
        $validator = Validator::make($request->all(), $rules);

        // Doğrulama başarısızsa hataları göster ve inputları geri gönder
        if ($validator->fails()) {
            return redirect()->route('contact')->withErrors($validator)->withInput();
        }

        Mail::raw(
            'Mesajı gönderen: ' . $request->name . "\n" .
            'Mesajı Gönderen Mail: ' . $request->email . "\n" .
            'Mesaj Konusu: ' . $request->topic . "\n" .
            'Mesaj: ' . $request->message . "\n" .
            'Mesaj Gonderilme Tarihi: ' . Carbon::now()->toDateTimeString(). "\n",
            function ($message) use ($request) {
                $message->from($request->email);
                $message->to($request->email);
                $message->subject($request->name.' Tarafından Gönderildi.');
            }
        );

        // Doğrulama başarılıysa veritabanına kaydet
        /*$contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $contact->save();*/

        // Başarılı iletişim sayfasına yönlendir ve başarı mesajı göster
        return redirect()->route('contact')->with('success', 'Mesajınız başarıyla gönderildi. Bize ulaştığınız için teşekkür ederiz.');
    }



}
