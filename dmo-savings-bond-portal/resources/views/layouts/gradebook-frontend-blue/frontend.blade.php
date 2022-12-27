@extends('layouts.gradebook-frontend-blue.page-master')

@section('body')
    @yield('content')
@stop

@section('nav')
  @include('layouts.gradebook-frontend-blue.nav')
@stop

@section('footer')
  @include('layouts.gradebook-frontend-blue.footer')
@stop