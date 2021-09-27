{{--importando de layouts.blade.php--}}
@extends('layouts.app', ['current' => 'home'])

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">

                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de categorias</h5>
                        <p class="card-text">Cadastro de categoria de matéria-prima</p>
                        <br>
                        <a href="/categorias" class="btn btn-primary">Cadastre os categorias de matéria-prima</a>
                    </div>
                </div>

                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de categorias</h5>
                        <p class="card-text">Cadastro de categoria de matéria-prima</p>
                        <br>
                        <a href="/produtos" class="btn btn-primary">Cadastre os categorias de matéria-prima</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
