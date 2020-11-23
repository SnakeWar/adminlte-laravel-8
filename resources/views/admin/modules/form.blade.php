@extends('adminlte::page')

@section('title', $title)

@section('content')

    <div class="container-fluid card">
        <h1>
            {{$title}}
        </h1>
        <hr>
            <h3 class="box-title">{{ $subtitle }}</h3>
        <hr>
        <form role="form" method="POST" action="{{ isset($module) ? route('admin.modules.update', $module->id) : route('admin.modules.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título do módulo</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título do módulo" value="{{ isset($module) ? $module->title : old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                            <label for="inputTitle">URL do módulo</label>
                            <input type="text" name="url" class="form-control" id="inputTitle" placeholder="URL do módulo" value="{{ isset($module) ? $module->url : old('url') }}">
                            @if ($errors->has('url'))
                                <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="inputDesc">Descrição</label>
                            <textarea name="description" class="form-control" id="inputDesc" placeholder="Descrição breve do grupo" rows="4">{{ isset($module) ? $module->description : old('description') }}</textarea>
                            @error('description')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
            </div>
        </form>
    </div>
@stop
