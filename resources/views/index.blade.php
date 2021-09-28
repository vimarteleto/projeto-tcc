{{--importando de layouts.blade.php--}}
@extends('layouts.app', ['current' => 'home'])
<style>
    a.btn.btn-primary {
        margin-bottom: 10px;
        width: 150px
    }
</style>

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                {{-- categorias --}}
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Materiais</h5>
                        <p class="card-text">Cadastros de materiais</p>
                        <a href="/categorias" class="btn btn-primary">Categorias</a><br>
                        <a href="/materiais" class="btn btn-primary">Materiais</a><br>
                        <a href="/unidades" class="btn btn-primary">Unidades</a><br>
                    </div>
                </div>

                {{-- materiais --}}
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro</h5>
                        <p class="card-text">Cadastro</p>
                        <a href="/#" class="btn btn-primary">Cadastre</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
