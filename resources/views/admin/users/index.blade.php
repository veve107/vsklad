@extends('layouts.admin')

@section('admin_content')

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <a class="breadcrumb-item" href="index.html">Tables</a>
            <span class="breadcrumb-item active">Používatelia</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Používatelia</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zoznam používateľov <a href="" class="btn btn-sm btn-warning"
                                                                   style="float: right"
                                                                   data-toggle="modal" data-target="#modaldemo3">Pridať
                        nového</a>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Meno používateľa</th>
                            <th class="wd-15p">Rola</th>
                            <th class="wd-15p">Pozícia</th>
                            <th class="wd-20p">Akcia</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->role->name}}</td>
                                <td>{{$user->position->name}}</td>
                                <td><a href="{{url('edit/category/'.$user->id)}}" class="btn btn-sm btn-info">Editovať</a> ||
                                    <a href="{{url('delete/category/'.$user->id)}}"
                                       class="btn btn-sm btn-danger"
                                       id="delete">Zmazať</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div>
    </div><!-- sl-mainpanel -->

    <!-- LARGE MODAL -->

    <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Pridaj používateľa</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif

                <form method="post" action="{{route('store.user')}}">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="name">Meno používateľa</label>
                            <input type="text" class="form-control" id="name"
                                   placeholder="Meno" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"
                                   placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="role_id">Rola</label>
                            <select name="role_id" id="role_id" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position_id">Pozícia</label>
                            <select name="position_id" id="position_id" class="form-control">
                                @foreach($positions as $position)
                                    <option value="{{$position->id}}">{{$position->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Pridať</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Zavrieť</button>
                    </div>
                </form>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
    </div>
@endsection
