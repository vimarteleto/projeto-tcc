{{--importando de layouts.blade.php--}}
@extends('layouts.app', ['current' => 'home'])

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                {{-- categorias --}}
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de categorias</h5>
                        <p class="card-text">Cadastro de categoria de materiais</p>
                        <a href="/categorias" class="btn btn-primary">Cadastre as categorias</a>
                    </div>
                </div>

                {{-- materiais --}}
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de materiais</h5>
                        <p class="card-text">Cadastro de materiais</p>
                        <a href="/materiais" class="btn btn-primary">Cadastre os materiais</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
