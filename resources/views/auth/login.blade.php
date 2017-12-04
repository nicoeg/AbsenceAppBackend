@extends('layouts.app')

@section('content')
    <login @if($errors->first()) :error="'{{ $errors->first() }}'" @endif></login>
@endsection