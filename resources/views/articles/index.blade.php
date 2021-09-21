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
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Heading
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Updated On
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </thead>
                                <tbody>

                                    @foreach ($articles as $article)

                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->heading }}</td>
                                        <td>{{ $article->status }}</td>
                                        <td>{{ $article->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
                                            <a href="" class="btn btn-warning btn-sm"><i class="material-icons">delete</i></a>
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