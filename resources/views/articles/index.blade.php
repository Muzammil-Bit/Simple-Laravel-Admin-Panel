@extends('layouts.app', ['activePage' => 'articles.index', 'titlePage' => __('Articles')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary d-flex justify-content-between">
                        <h4 class="card-title ">Articles</h4>
                        <a href="{{ route('articles.create') }}" class="btn btn-warning">Create New <i class="material-icons">add</i></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>Heading</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Updated On</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->heading }}</td>
                                        <td>{{ App\Models\Article::getStatusById($article->status) }}</td>
                                        <td><img src="{{ asset($article->image) }}" alt="no-image" width="50px"></td>
                                        <td>{{ $article->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                               <button class="btn btn-danger btn-sm" type="submit"><i class="material-icons">delete</i></button> 
                                            </form>
                                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection