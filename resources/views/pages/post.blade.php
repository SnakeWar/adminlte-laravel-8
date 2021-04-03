@extends('pages.layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card">
                    <img src="{{asset('storage/' . $post->photo)}}" class="card-img-top" alt="{{ $post->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{!! $post->body !!}</p>
                    </div>
                </div>
            </div>
{{--            Formulário Comentário--}}
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        Deixe seu Comentário
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comment') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="nome" class="form-control" placeholder="Nome">
                                </div>
                                <div class="col">
                                    <input type="email" name="email" class="form-control" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="mensagem"></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-info">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
{{--            Fim Formulário Comentário--}}
            <div class="col-lg-12 col-md-12 mb-4">
                <a class="btn btn-outline-info mb-4" data-toggle="collapse" href="#collapseComentario" role="button"
                   aria-expanded="false" aria-controls="collapseComentario">
                    {{ $post->comments->count() }} Comentário(s)
                </a>
            </div>
            <div class="col-lg-12 col-md-12 mb-4 collapse" id="collapseComentario">
                @foreach($post->comments as $comment)
                    {{--                    Comentários--}}
                    <div class="media mt-1">
                        <i class="fas fa-user fa-3x mr-3"></i>
                        <div class="media-body">
                            <h5 class="mt-0">{{ $comment->nome }}</h5>
                            <small>{{ $comment->email }}</small>
                            <p>{{ $comment->mensagem }}</p>
                            {{--                        Fim Comentários--}}

                            {{--                        Form Resposta--}}
                            <a class="btn btn-outline-info" data-toggle="collapse" href="#collapseResposta" role="button"
                               aria-expanded="false" aria-controls="collapseResposta">
                                Responder
                            </a>
                            <div class="collapse mt-3" id="collapseResposta">
                                <form action="{{ route('response') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="nome" class="form-control" placeholder="Nome">
                                        </div>
                                        <div class="col">
                                            <input type="email" name="email" class="form-control" placeholder="E-mail">
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <textarea class="form-control" name="mensagem"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                            </div>
                            <hr>
                            {{--                        Fim Form Resposta--}}

                            {{--                        Respostas--}}
                            @foreach($comment->responses as $responses)
                                <div class="media mt-3">
                                    <i class="fas fa-user fa-3x mr-3"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0">{{ $responses->nome }}</h5>
                                        <small>{{ $responses->email }}</small>
                                        <p>{{ $responses->mensagem }}</p>
                                    </div>
                                </div>
                            @endforeach
                            {{--                        Fim Respostas--}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
