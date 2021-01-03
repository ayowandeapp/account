@extends('site_layout.dashboard_layout')


@section('content')

    <div id="content">
        <div id="content-header">
        </div>

        <div class="container-fluid row-fluid">
            <div class="row">
                <div class="col-4 offset-4" style="margin-top: 50px;">
                    <form action="{{ route('setting.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Change Name</label>
                            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control">
                            <input type="hidden" name="id" value="{{ Auth::User()->id }}">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Name" class="btn btn-primary float-right">
                        </div>
                    </form>
                </div>
                <div class="col-4 offset-4">
                    <form action="{{ route('setting.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="password">Change Password</label>
                            <input type="text" name="password" id="password" class="form-control">
                            <input type="hidden" name="id" value="{{ Auth::User()->id }}">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update Password" class="btn btn-danger float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
