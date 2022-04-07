@extends('layouts.master')


@section('title')
    Categories
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-dismissible alert-{{ session('alert-type') }} alert-styled-left alert-arrow-left" id="session-alert">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Categories Table</h4>
                    <a href="{{url('category-create')}}"class="btn btn-md float-right" style="background-color:#FA7347">Add New Catgeory</a>
                </div>
                    
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Category Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        <a href="{{url('category-edit/'.$category->id)}}" class="btn btn-info btn-sm">EDIT</a>
                                    </td>
                                    <td>
                                        <a href="{{url('category-delete/'.$category->id)}}" class="btn btn-danger btn-sm">DELETE</a>
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
@endsection