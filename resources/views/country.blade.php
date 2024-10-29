@extends('_layouts.marketing', ['ACTIVE_TAB' => 'index'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))


@section('PAGE_LEVEL_STYLES')
    <style type="text/css">
        .bannerSection {
            position: relative;
            display: none !important;
        }

        .headerSection nav.navbar.navbar-default {
            border-bottom: solid 2px #a0a0a000 !important;
        }
    </style>
@endsection

@section('PAGE_LEVEL_SCRIPTS')
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection


@section('content')

    <div class="row innerPagesWrapper">
        <div class="container">
            <div class="row innerPageHead" style="min-height:200px;">
                {{__('index.coming-soon')}}
            </div>
        </div>
    </div>

@endsection
