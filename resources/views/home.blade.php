@extends('layouts.app')

@section('content')
    <div class="container">

        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif
    </div>

    <div class="container" id="home-app">
        <home-app></home-app>
    </div>

    <div class="container" id="home-app2">
        <home-app2></home-app2>
    </div>
    test

    {{--<div class="container">--}}
        {{--Disk Usage Compositions--}}
        {{--<table class="table table-bordered">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th colspan="3"><strong> Disk Usage Compositions </strong></th>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th>Type</th>--}}
                {{--<th>No of files</th>--}}
                {{--<th>Size</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
                {{--<tr>--}}
                    {{--<td> Type </td>--}}
                    {{--<td> image/jpeg </td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td> No of files </td>--}}
                    {{--<td> 4</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td> Size </td>--}}
                    {{--<td> 53453</td>--}}
                {{--</tr>--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}
@endsection