@extends('layouts.app', ['current' => 'cores'])

@section('body')   
    
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de cores</h5>

                <table class="table table-ordered table-hover" id="tabelaLinhas">
                    <thead>
                        <tr>
                            <th>Cógido</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($cores as $cor)
                            <tr>
                                <td>{{$cor->codigo}}</td>
                                <td>{{$cor->nome}}</td>

                                <td>
                                    <a class="btn btn-sm btn-primary btn-modal-edit" 
                                       data-toggle="modal" 
                                       data-target="#modal-edit"
                                       data-id={{$cor->id}}                                       
                                       data-nome="{{$cor->nome}}" 
                                       data-codigo="{{$cor->codigo}}" 
                                       onclick=getEditOptions(this)                                   
                                    >
                                       Editar
                                   </a>

                                    <a  class="btn btn-sm btn-danger {{count($cor->skus) > 0 ? 'disabled' : ''}}" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-id={{$cor->id}}
                                        data-route="cores"
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
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Nova cor</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/cores" method="POST" id="form-cor" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nova cor</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id" class="form-control"> --}}

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Código</label>
                            <div class="input-group">
                                <input name="codigo" type="text" class="form-control" id="codigo" placeholder="Código da cor" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Descrição</label>
                            <div class="input-group">
                                <input name="nome" type="text" class="form-control" id="nome" placeholder="Descrição da cor" required>
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
    <div class="modal modal-edit" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/cores" method="POST" id="form-cor-edit" class="form-horizontal">
                    @csrf
                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar cor</h5>
                    </div>
                    <div class="modal-body">
                        <input name="id" type="hidden" id="id-edit" class="form-control">

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Código</label>
                            <div class="input-group">
                                <input name="codigo" type="text" class="form-control codigo" id="codigo-edit" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Descrição</label>
                            <div class="input-group">
                                <input name="nome" type="text" class="form-control nome" id="nome-edit" required>
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
            <form action="cores/excluir" id="form-cor" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-delete-title"></h5>
            </div>          
            <input name="id" type="hidden" id="id-delete" class="form-control">
            <div class="modal-body modal-delete">
                Deseja realmente excluir?
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
