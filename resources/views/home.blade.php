@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status') || session('facebook_status') || session('twitter_status'))
                        <div class="alert alert-success">
                            {{ session('status') }}<br/>
                            {{ session('facebook_status') }}<br/>
                            {{ session('twitter_status') }}
                        </div>
                    @endif
                    @if (session('error') || session('facebook_error') || session('twitter_error'))
                        <div class="alert alert-error">
                            {{ session('error') }}<br/>
                            {{ session('facebook_error') }}<br/>
                            {{ session('twitter_error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
