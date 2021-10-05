@extends('layouts.app', ['current' => 'unidades'])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de unidades</h5>

                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Cógido</th>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($unidades as $unidade)
                            <tr>
                                <td>{{$unidade->id}}</td>
                                <td>{{$unidade->nome}}</td>
                                <td>{{$unidade->sigla}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary btn-modal-edit" 
                                       data-toggle="modal" 
                                       data-target="#modal-edit"
                                       data-id={{$unidade->id}}                                       
                                       data-nome="{{$unidade->nome}}"                                       
                                       data-sigla="{{$unidade->sigla}}" 
                                       onclick=getEditOptions(this)                                                                     
                                    >
                                       Editar
                                   </a>

                                    <a class="btn btn-sm btn-danger btn-modal-delete {{count($unidade->materiais) > 0 ? 'disabled' : ''}}" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-id={{$unidade->id}}  
                                        data-route="unidades"
                                        onclick=deleteModal(this)                                  
                                    >
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

        </div>
        <div class="card-footer">
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Nova unidade</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="unidades" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nova unidade</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id-edit" name="id" class="form-control">                          --}}

                        <div class="row">
                            <div class="col">
                                <label for="nome" class="form-check-label">Unidade</label>
                                <div class="input-group">
                                    <input name="nome" id="nome" class="form-control nome" placeholder="Nome da unidade" required>
                                </div>
                            </div>

                            <div class="col">
                                <label for="sigla" class="form-check-label">Sigla</label>
                                <div class="input-group">
                                    <input name="sigla" type="text" class="form-control" id="sigla" placeholder="Sigla da unidade" required>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" type="submit">Salvar</button>
                        <button class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    

    {{-- modal de edição --}}
    <div class="modal modal-edit modal-request" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/unidades" method="POST" id="form-edit" class="form-horizontal">
                    @csrf                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar unidade</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-edit" name="id" class="form-control">                        

                        <div class="row">
                            <div class="col">
                                <label for="nome" class="form-check-label">Unidade</label>
                                <div class="input-group">
                                    <input name="nome" id="nome-edit" class="form-control nome" placeholder="Nome da unidade" required>
                                </div>
                            </div>

                            <div class="col">
                                <label for="sigla" class="form-check-label">Sigla</label>
                                <div class="input-group">
                                    <input name="sigla" type="text" class="form-control" id="sigla-edit" placeholder="Sigla da unidade" required>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" type="submit">Salvar</button>
                        <button class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal de confirmacao de exclusao --}}
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color:white">
            <form action="unidades/excluir" id="form-categoria" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-delete-title"></h5>
            </div>          

            <div class="modal-body">                
                Deseja realmente excluir?
                <input name="id" type="hidden" id="id-delete" class="form-control">
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm btn-danger">Excluir</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    

@endsection

@section('javascript')
    <script type="text/javascript">

        // setup ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })

    </script>
@endsection
