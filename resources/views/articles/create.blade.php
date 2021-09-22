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
                        <form enctype="multipart/form-data" action="{{ route('articles.store') }}" method="POST">
                            @csrf
                            <div class="form-group bmd-form-group my-5">
                                <label class="bmd-label-floating">Article Heading : </label>
                                <input type="text" name="heading" id="heading" class="form-control error {{ $errors->has('heading') ? " is-invalid" : "" }}">
                                @if ($errors->has('heading'))
                                    <span class="text-danger error">{{ $errors->first('heading') }}</span>
                                @endif
                            </div>
                            <div class="form-group bmd-form-group my-5">
                                <label class="bmd-label-floating display-1">Article Desctiption :</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger error">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="form-group my-5">
                                <label>Header Image :</label>
                               <input type="file" accept=".jpg, .png, .jpeg" class="form-control" style="opacity: 1; position: unset;" name="image">
                                @if ($errors->has('image'))
                                    <span class="text-danger error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>

                            

                            <div class="form-group my-5">
                                <label class="bmd-label-floating">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="{{ App\Models\Article::DRAFT }}">Draft</option>
                                    <option value="{{ App\Models\Article::POSTED }}">Posted</option>
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