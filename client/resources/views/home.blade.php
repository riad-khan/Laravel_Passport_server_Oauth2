@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    @if(!auth()->user()->token)
                    <a class="btn btn-primary" href="{{route('token')}}">Connect Larabook Server</a>

                    @else
                    <h3>Larabook Posts</h3><br>

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                          <tr>



                            <th scope="row">1</th>
                            <td>{{$post['title']}}</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
