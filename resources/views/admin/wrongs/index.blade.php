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
                    <h4 class="card-title"> Wrongs Table</h4>
                    <a href="{{url('wrong-create')}}"class="btn btn-md float-right" style="background-color:#FA7347">Add New Wrong</a>
                </div>
                    
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Wrong Content</th>
                                <th>Question Content</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                @foreach($wrongs as $wrong)
                                <tr>
                                    <td>{{$wrong->wrong_content}}</td>
                                    <td>{{$wrong->question->question_content}}</td>
                                    <td>
                                        <a href="{{url('wrong-edit/'.$wrong->id)}}" class="btn btn-info btn-sm">EDIT</a>
                                    </td>
                                    <td>
                                        <a href="{{url('wrong-delete/'.$wrong->id)}}" class="btn btn-danger btn-sm">DELETE</a>
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