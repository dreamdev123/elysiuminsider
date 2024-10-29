@extends('errors::minimal')

@section('title', __($exception->getMessage() ?: 'Service Unavailable'))
{{--
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
--}}
@section('message')
    <img src="/images/maintenance_comingsoon.png" width="80%"/>
@stop
