@extends('site_layout.dashboard_layout')


@section('content')

    <div id="content">
        <div id="content-header">
        </div>
        <div class="container-fluid">
            @include('site_layout.top_widget')
        </div>

        <div class="container-fluid row-fluid text-center">
            <div class="col-12" id="main-contentArea">
                <h2>Hi,</h2>
                <h3>Welcome Dear {{ Auth::User()->name }}!</h3>
                <a href="#" class="btn btn-primary" id="start-khata">Start Now (کھاتہ شروع کریں)</a>
            </div>
        </div>
    </div>

    @include('site_layout.general_khata_area')

@endsection
