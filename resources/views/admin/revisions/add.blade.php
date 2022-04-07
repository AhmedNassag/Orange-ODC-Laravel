@extends('layouts.master')


@section('title')
    Add A New Revision
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add A New Revision</h4>
                </div>
                
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

                    <form action="/revision-store" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label>User Degree</label>
                                    <input name="user_degree" class="form-control" placeholder="Enter Degree">
                                </div>
                                <div class="form-group">
                                    <label>Total Right Degree</label>
                                    <input name="total_right_degree" class="form-control" placeholder="Enter Right Degree">
                                </div>
                                <div class="form-group">
                                    <label>Total Wrong Degree</label>
                                    <input name="total_wrong_degree" class="form-control" placeholder="Enter Wrong Degree">
                                </div>
                                <div class="form-group">
                                    <select name="exam_id" class="form-control">
                                        @foreach($exams as $exam)
                                        <option value="{{$exam->id}}">{{$exam->course->course_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="user_id" class="form-control">
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
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
@endsection