@extends('_layouts.marketing', ['ACTIVE_TAB' => 'index'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))


@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/style_new.css') }}" rel="stylesheet">
@endsection

@section('PAGE_LEVEL_SCRIPTS')
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection


@section('content')

    @include('_sections.home')
    @include('_sections.team')
    @include('_sections.footer')

@endsection
