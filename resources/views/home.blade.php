@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
<script>
  window.location.href='https://members.microweber.com/login_redirect.php?quiet=1&return_to=https://microweber.com/';
</script>

                <div id="app">
                <passport-clients></passport-clients>
                <passport-authorized-clients></passport-authorized-clients>
                <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                <div class="panel-body">


                    You are logged in!



                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form-main').submit();">
                        Logout
                    </a>
                    <form id="logout-form-main" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>



                </div>


            </div>
        </div>
    </div>
</div>
@endsection
