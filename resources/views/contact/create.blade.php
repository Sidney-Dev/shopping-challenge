@extends('layouts.logged')

@section('content')
<div class="container">
    <div class="row">
        @include('includes.form_error')
    </div>
    <h1>New Contact</h1>

    {!! Form::open(['method'=>'POST', 'action'=> 'ContactController@store']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            <div>{!! Form::label('phone', 'Phone:') !!} <span>Numbers only</span></div>
            
            {!! Form::text('phone', null, ['class'=>'phone-number form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

</div>
@endsection
