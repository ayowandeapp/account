@extends('site_layout.dashboard_layout')


@section('content')

    <div id="content">
        <div id="content-header">
        </div>
        <div class="container-fluid">
            @include('site_layout.top_widget')

            <div id="general-khata-area" class="row-fluid">
                <div class="widget-box">
                    <div class="widget-title">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#open_account">Open New Account</a></li>
                            <li class=""><a data-toggle="tab" href="#payments">Payments</a></li>
                            <li class=""><a data-toggle="tab" href="#receipts">Receipts</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content">
                        <div id="open_account" class="tab-pane active">
                            <div class="row">
                                <div class="col-4">
                                    <form action="{{ route('account.create') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="acc_name">Account Name</label>
                                            <input type="text" class="form-control" name="acc_name" id="acc_name" placeholder="Please Enter Account Name!" autofocus>
                                        </div>
                                        <div class="form-group text-right">
                                            <input type="submit" value="Register" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                                <div class="offet-1 col-7">
                                    <h5>List Of Accounts</h5>
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <td><b>Account Name</b> </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($accounts))
                                            @foreach ($accounts as $account)
                                            <tr>
                                                <td>{{ $account->acc_name }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="payments" class="tab-pane">
                            <p> waffle to pad out the comment. Usually, you just wish these sorts of comments would come to
                                an end.multiple paragraphs and is full of waffle to pad out the comment. Usually, you just
                                wish these sorts of comments would come to an end. </p>

                        </div>
                        <div id="receipts" class="tab-pane">
                            <p>full of waffle to pad out the comment. Usually, you just wish these sorts of comments would
                                come to an end.multiple paragraphs and is full of waffle to pad out the comment. Usually,
                                you just wish these sorts of comments would come to an end. </p>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

@endsection
