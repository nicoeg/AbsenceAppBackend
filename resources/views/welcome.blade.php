@extends('layouts.app')

@section('content')
    <transition name="slide-x-transition">
        <router-view
            style="position: absolute;"
            :user="{{ auth()->user()->toJson() }}"
            :search="search"
        ></router-view>
    </transition>
@endsection