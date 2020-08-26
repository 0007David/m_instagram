
@extends('errors::layout')

@section('title', 'No Autorizado')

@section('message')
    Sorry, you are forbidden from accessing this page.
    <br>
    <br>
    <small><a href="{{ url('home') }}">Home </a>.</small>
    
@endsection
