@@ -0,0 +1,38 @@
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
            <upload-panel></upload-panel>
            {{--</div>--}}
        </div>
    </div>

    {{--<div class="uploader"--}}
         {{--@dragenter="OnDragEnter"--}}
         {{--@dragleave="OnDragLeave"--}}
         {{--@dragover.prevent--}}
         {{--@drop="onDrop"--}}
         {{--:class="{ dragging: isDragging }">--}}

        {{--<div class="upload-control" v-show="images.length">--}}
            {{--<input type="hidden" value="{{csrf_token()}}" name="_token" />--}}
            {{--<label for="file">Select a file</label>--}}
            {{--<button @click="upload">Upload</button>--}}
        {{--</div>--}}


        {{--<div v-show="!images.length">--}}
            {{--<i class="fa fa-cloud-upload"></i>--}}
            {{--<p>Drag your images here</p>--}}
            {{--<div>OR</div>--}}
            {{--<div class="file-input">--}}
                {{--<input type="hidden" value="{{csrf_token()}}" name="_token" />--}}
                {{--<label for="file">Select a file</label>--}}
                {{--<input type="file" id="file" @change="onInputChange" multiple>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<progress max="100" :value.prop="uploadPercentage"></progress>--}}
s
        {{--<!--<div class="images-preview" v-show="images.length">-->--}}
        {{--<!--<div class="img-wrapper" v-for="(image, index) in images" :key="index">-->--}}
        {{--<!--<img :src="image" :alt="`Image Uploader ${index}`">-->--}}

        {{--<!--<div class="details">-->--}}
        {{--<!--<span class="name" v-text="files[index].name"></span>-->--}}
        {{--<!--<span class="size" v-text="getFileSize(files[index].size)"></span>-->--}}
        {{--<!--</div>-->--}}
        {{--<!--</div>-->--}}
        {{--<!--</div>-->--}}

        {{--<div class="images-preview" v-show="items.length" @mouseenter="showDelBtn=true;" @mouseleave="showDelBtn=false;">--}}
            {{--<div class="img-wrapper" v-for="image in items">--}}
                {{--<img src="" :src="image.image_name"  :alt="image.image_name">--}}
                {{--<div class="details">--}}
                    {{--<div class="btn" v-if="showDelBtn" @close="showDelBtn=false">--}}
                        {{--<button class="btn btn-outline-warning" @click="deleteImage(image.id, image.image_name)">Delete</button>--}}
                    {{--</div>--}}
                    {{--<!--@click="showModal=true; setVal(item.id, item.name, item.age, item.profession)"-->--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection