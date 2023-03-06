<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'detail');
    }
    
    public function index()
    {
        $data= Article::latest()->paginate(5);
        return view("articles.index", ['articles'=>$data]);


        return view('articles.index', [ 'articles' => $data]);
    }

    public function detail($id)
    {
        $data = Article::find($id);

        return view("articles.detail", ['article'=>$data]);
    }

    public function add()
    {
        $categories = Category::all();
        
        return view('articles.add', ["categories" => $categories]);
    }


    public function create()
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
            exit;
        }

        $article = new Article;
        $article->title= request()->title;
        $article->body= request()->body;
        $article->category_id = request()->category_id;
        $article->save();

        return redirect('/articles');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if (Gate::allows('article-delete', $article)) {
            $article->delete();
            return redirect('/articles')->with('info', 'article deleted successfully');
        } else {
            return back()->with('error', 'You can\'t delete this article!');
        }
    }

    public function edit($id)
    {
        $categories = Category::all();

        $article = Article::find($id);
        if (Gate::allows('article-edit', $article)) {
            return view("articles.edit", ["article" => $article, "categories" => $categories]);
        } else {
            return back()->with('error', 'You can\'t edit this article!');
        }
    }

    public function update($id)
    {
        $article = Article::find($id);
        $article->title= request()->title;
        $article->body= request()->body;
        $article->category_id = request()->category_id;
        $article->save();
        return redirect('/articles')->with('info', 'article updated successfully');
    }
}
