@extends('layouts.app')

@section('content')
    {{--<div class="container">--}}
        {{--@if(\Session::has('success'))--}}
            {{--<div class="alert alert-success">--}}
                {{--{{\Session::get('success')}}--}}
            {{--</div>--}}
            {{--<p class="text-center alert alert-danger"--}}
               {{--v-bind:class="{ hidden: hasError }">Please fill all fields!</p>--}}
        {{--@endif--}}

        {{--<div id="counts-obj">--}}
            {{--<div class="form-group">--}}
                {{--<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">--}}
                    {{--Menu--}}
                    {{--<span class="caret"></span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li><button class="btn btn-link" @click.prevent="showManagePage()">Manage Account</button></li>--}}
                {{--</ul>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<button class="btn btn-primary" @click.prevent="showManagePage()" id="add">ADD</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="container">
        @if(\Session::has('success'))
            <div class="alert alert-success">
                {{\Session::get('success')}}
            </div>
            <p class="text-center alert alert-danger"
               v-bind:class="{ hidden: hasError }">Please fill all fields!</p>
        @endif
        <div id="vue-crud-wrapper">
            <div class="form-group">
                {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
                <label for="empname">Name:</label>
                <input type="text" class="form-control" id="empname" name="name"
                       {{--required v-model="newItem.name"--}}
                       placeholder=" Enter some name">
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age"
                       {{--required v-model="newItem.age"--}}
                       placeholder=" Enter your age">
            </div>
            <div class="form-group">
                <label for="profession">Profession:</label>
                <input type="text" class="form-control" id="profession" name="profession"
                       {{--required v-model="newItem.profession"--}}
                       placeholder=" Enter your profession">
            </div>

            <button class="btn btn-primary" @click.prevent="createItem()" id="add">
                <span class="glyphicon glyphicon-plus"></span> ADD
            </button>

            <div class="table table-borderless" id="table">
                <table class="table table-borderless" id="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Profession</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tr v-for="item in items">
                        <td>@{{ item.id }}</td>
                        <td>@{{ item.name }}</td>
                        <td>@{{ item.age }}</td>
                        <td>@{{ item.profession }}</td>

                        <td id="show-modal" @click="showModal=true; setVal(item.id, item.name, item.age, item.profession)"
                            class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </td>
                        <td @click.prevent="deleteItem(item)" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>
                        </td>
                    </tr>


                    <modal v-if="showModal" @close="showModal=false">
                        <h3 slot="header">Edit Item</h3>
                        <div slot="body">

                            <input type="hidden" disabled class="form-control" id="e_id" name="id"
                                   required  :value="this.e_id">
                            Name: <input type="text" class="form-control" id="e_name" name="name"
                                         required  :value="this.e_name">
                            Age: <input type="number" class="form-control" id="e_age" name="age"
                                        required  :value="this.e_age">
                            Profession: <input type="text" class="form-control" id="e_profession" name="profession"
                                               required  :value="this.e_profession">


                        </div>
                        <div slot="footer">
                            <button class="btn btn-default" @click="showModal = false">
                                Cancel
                            </button>

                            <button class="btn btn-info" @click="editItem()">
                                Update
                            </button>
                        </div>
                    </modal>
                </table>
            </div>
        </div>
@endsection