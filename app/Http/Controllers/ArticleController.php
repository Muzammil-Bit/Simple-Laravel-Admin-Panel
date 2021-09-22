<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);

        $article = new Article();
        $article->fill($request->except('_token'));
        $article->created_by = auth()->user()->id;
        $article->save();
        $article->image = $this->uploadFile($request->image, $article->id);
        $article->save();
        return redirect(route('articles.index'));
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
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
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
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image',
        ]);
        $article = Article::findOrFail($id);
        $article->fill($request->except('_token'));
        $article->created_by = auth()->user()->id;
        if (isset($request->image)) {
            $article->image = $this->uploadFile($request->file('image'), $id);
        }
        $article->save();

        return redirect(route('articles.index'));
    }



    private function uploadFile($file, $id)
    {
        $imageName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('/article-headers'), $imageName);
        return asset("article-headers/" . $imageName);
        
        // $path = $file->store('images/' . $id, ['disk' => 'public']);
        // return asset(str_replace('public', 'storage', $path));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return back()->with(['success' => true, 'message' => "Deleted Successfully."]);
    }
}
