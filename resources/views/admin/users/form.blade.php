@extends('adminlte::page')
@section('title_prefix', 'Admin - ')
@section('title', $title)
@section('content')
        <div class="container-fluid card">
            <h1>{{$title}}</h1>
            <hr>
            <h3>{{$subtitle}}</h3>
            <hr>
            <form role="form" method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="inputName">Nome do usuário</label>
                                <input type="text" name="name" class="form-control" id="inputName" placeholder="Nome do usuário" value="{{ isset($user) ? $user->name : old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="inputEmail">E-mail de login</label>
                                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="teste@teste.com" value="{{ isset($user) ? $user->email : old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="inputPassword">Senha</label>
                                <input type="password" name="password" class="form-control" id="inputPassword">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="inputPasswordConfirmation">Confirme a senha</label>
                                <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="inputRole">Grupos</label>
                                <select class="form-control select2" name="role_id" id="inputRole" style="width: 100%;">
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}" {{ (isset($user) && isset($user->roles->id)) ? (($item->id == $user->roles->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
                    </div>
            </form>
        </div>
@stop
