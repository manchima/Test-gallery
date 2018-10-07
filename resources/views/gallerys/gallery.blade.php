@extends('layouts.app')

@section('content')
    <div class="container">

        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
        @endif
    </div>

    <div class="container" id="image-upload">
        <div class="row justify-content-center">
            {{--<div class="col-md-1">--}}
                <image-app></image-app>
            {{--</div>--}}
        </div>

        {{--<div class="container">--}}
            {{--test--}}
            {{--<img src="storage/55.jpeg"  :src="'{{ asset('storage/') }}' + '/55.jpeg' " :alt="55">--}}
        {{--</div>--}}

        {{--<div class="table table-borderless">--}}
            {{--<table class="table table-borderless">--}}
                {{--<tr v-for="image in images">--}}
                {{--<td>test</td>--}}
                    {{--<td>@{{ image.id }}</td>--}}
                    {{--<input type="hidden" disabled class="form-control" id="e_id" name="id"--}}
                           {{--required  :value="this.e_id">--}}
                    {{--<img src="" :src="image.image_name"  :alt="image.image_name">--}}
                    {{--<img src=""  :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :alt="file.name">--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</div>--}}
    </div>
@endsection