<?php

namespace App\Http\Controllers;

use App\Models\Article;

use App\Services\SlugService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::paginate(config('app.paginate'));

        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Article::class);

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:articles,title',
            'subtitle' => 'required|max:255',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('articles.create'))
                ->withErrors($validator)
                ->withInput();
        }

        Article::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'text' => $request->text,
            'slug' => SlugService::decodeSlug($request->title),
        ]);

        return redirect(route('articles.index'))->with(['message' => 'Статтю успішно створено', 'class' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $article = Article::where('slug', '=', $slug)->first();

        return view('articles.show', ['article' => $article]);
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:articles,title,' . $article->id,
            'subtitle' => 'required|max:255',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('articles.edit', $article->id))
                ->withErrors($validator)
                ->withInput();
        }

        $article->title = $request->title;
        $article->subtitle = $request->subtitle;
        $article->text = $request->text;
        $article->slug = SlugService::decodeSlug($request->title);

        $article->save();

        return redirect(route('articles.index'))->with(['message' => 'Статтю успішно відредаговано', 'class' => 'alert-success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect(route('articles.index'))->with(['message' => 'Статтю успішно видалено', 'class' => 'alert-success']);
    }
}
