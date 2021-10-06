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
                        <a href="/estoques" class="btn btn-primary">Estoques</a><br>
                        <a href="/categorias" class="btn btn-primary">Categorias</a><br>
                        <a href="/materiais" class="btn btn-primary">Materiais</a><br>
                        <a href="/grades" class="btn btn-primary">Grades</a><br>
                        <a href="/unidades" class="btn btn-primary">Unidades</a><br>
                    </div>
                </div>

                {{-- materiais --}}
                {{-- <div class="card border border-danger">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro</h5>
                        <a href="/#" class="btn btn-primary btn-danger">Cadastre</a>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>

@endsection
