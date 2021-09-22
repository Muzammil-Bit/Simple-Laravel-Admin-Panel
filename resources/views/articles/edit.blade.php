@extends('layouts.app', ['activePage' => 'articles.index', 'titlePage' => __('Articles')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary d-flex justify-content-between">
                        <h4 class="card-title ">Create new article</h4>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('articles.update', $article->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group bmd-form-group my-5">
                                <label class="bmd-label-floating">Article Heading : </label>
                                <input type="text" name="heading" id="heading" class="form-control error {{ $errors->has('heading') ? " is-invalid" : "" }}" value="{{ $article->heading }}">
                                @if ($errors->has('heading'))
                                    <span class="text-danger error">{{ $errors->first('heading') }}</span>
                                @endif
                            </div>
                            <div class="form-group bmd-form-group my-5">
                                <label class="bmd-label-floating display-1">Article Desctiption :</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $article->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger error">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="form-group my-5">
                                <label>Header Image :</label>
                               <input type="file" accept=".jpg, .png, .jpeg" class="form-control" style="opacity: 1; position: unset;" name="image" value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span class="text-danger error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>

                            <div class="d-flex w-100 justify-content-center">
                                <img src="{{ asset($article->image) }}" alt="no-image" width="50%" class="p-4 border">
                            </div>

                            <div class="form-group my-5">
                                <label class="bmd-label-floating">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="{{ App\Models\Article::DRAFT }}" @if($article->status == 1) selected @endif>Draft</option>
                                    <option value="{{ App\Models\Article::POSTED }}" @if($article->status == 2) selected @endif>Posted</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end w-100">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection