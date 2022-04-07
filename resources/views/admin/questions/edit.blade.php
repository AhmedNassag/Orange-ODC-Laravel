@extends('layouts.master')


@section('title')
    Edit Register Roles
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Role For Registered</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="alert alert-danger">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{session()->get('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form action="/question-update/{{$question->id}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label>Question Content</label>
                                                <input type="text" name="question_content" class="form-control" placeholder="Enter Content" value="{{$question->question_content}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Question Answer</label>
                                                <input type="text" name="question_answer" class="form-control" placeholder="Enter Answer" value="{{$question->question_answer}}">
                                            </div>
                                            <div class="form-group">
                                                <select name="exam_id" class="form-control">
                                                    @foreach($exams as $exam)
                                                    <option value="{{$exam->id}}">{{$exam->course->course_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-lg" style="background-color: #FA7347; width:20%; margin-left:40%">SAVE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection
