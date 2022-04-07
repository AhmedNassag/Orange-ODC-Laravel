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
                    <h4 class="card-title"> Questions Table</h4>
                    <a href="{{url('question-create')}}"class="btn btn-md float-right" style="background-color:#FA7347">Add New Question</a>
                </div>
                    
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Question Content</th>
                                <th>Question Answer</th>
                                <th>Exam Course</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                <tr>
                                    <td>{{$question->question_content}}</td>
                                    <td>{{$question->question_answer}}</td>
                                    <td>{{$question->exam->course->course_name}}</td>
                                    <td>
                                        <a href="{{url('question-edit/'.$question->id)}}" class="btn btn-info btn-sm">EDIT</a>
                                    </td>
                                    <td>
                                        <a href="{{url('question-delete/'.$question->id)}}" class="btn btn-danger btn-sm">DELETE</a>
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