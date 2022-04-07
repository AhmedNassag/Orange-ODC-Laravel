@extends('layouts.master')


@section('title')
    Add A New Trainer
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add A New Trainer</h4>
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

                    <form action="/trainer-store" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label>Trainer Name</label>
                                    <input type="text" name="trainer_name" class="form-control" placeholder="Enter Name">
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