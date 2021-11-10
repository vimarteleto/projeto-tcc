@extends('layouts.app', ['current' => 'referencias'])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de referências</h5>

                <table class="table table-sm table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Linha</th>
                            <th>Cógido</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($referencias as $referencia)
                            <tr>
                                <td>{{$referencia->linha->nome}}</td>
                                <td>{{$referencia->codigo}}</td>
                                <td>{{$referencia->nome}}</td>

                                <td>
                                    <div class="custom-control custom-switch">
                                            <input 
                                                data-id={{$referencia->id}} 
                                                data-route="referencias"
                                                type="checkbox" 
                                                class="custom-control-input" 
                                                id="switch{{$referencia->id}}"
                                                {{$referencia->status == 1 ? 'checked' : ''}}
                                                onclick=statusChange(this)
                                                
                                            >                               
                                            <label class="custom-control-label" for="switch{{$referencia->id}}"></label>
                                    </div>
                                </td>
                                
                                <td>
                                    <a class="btn btn-sm btn-primary" 
                                       data-toggle="modal" 
                                       data-target="#modal-edit"
                                       data-id={{$referencia->id}}                                       
                                       data-codigo="{{$referencia->codigo}}"
                                       data-nome="{{$referencia->nome}}"   
                                       data-linha={{$referencia->linha->id}} 
                                       data-peso={{$referencia->peso}} 
                                       onclick=getEditOptions(this)                            
                                    >
                                       Editar
                                   </a>

                                    <a  class="btn btn-sm btn-danger" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-id={{$referencia->id}}
                                        data-route="referencias"
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
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Nova referência</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/referencias" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nova referência</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id-edit" name="id" class="form-control">   --}}
                        <div class="form-group">
                            <label for="categoria" class="form-check-label">Linha</label>
                            <div class="input-group">
                                <select name="linha_id" id="linha" class="form-control linha"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="codigo" class="form-check-label">Código</label>
                            <div class="input-group">
                                <input name="codigo" type="text" class="form-control" id="codigo" placeholder="Código da referência" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Descrição</label>
                            <div class="input-group">
                                <input name="nome" type="text" class="form-control" id="nome" placeholder="Descrição da referência" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="peso" class="form-check-label">Peso (kg)</label>
                            <div class="input-group">
                                <input name="peso" type="text" class="form-control" id="peso" placeholder="Peso do produto em kilogramas" required>
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
                <form action="/referencias" method="POST" id="form-edit" class="form-horizontal">
                    @csrf                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar categoria</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-edit" name="id" class="form-control">  
                        <div class="form-group">
                            <label for="categoria" class="form-check-label">Linha</label>
                            <div class="input-group">
                                <select name="linha_id" id="linha-edit" class="form-control linha"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="codigo" class="form-check-label">Código</label>
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

                        <div class="form-group">
                            <label for="peso" class="form-check-label">Peso (kg)</label>
                            <div class="input-group">
                                <input name="peso" type="text" class="form-control peso" id="peso-edit" placeholder="Peso do produto em kilogramas" required>
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
            <form action="referencias/excluir" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-delete-title"></h5>
            </div>          

            <div class="modal-body modal-delete">                
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

        // carregamento das options via request
        // getSelectOptions(route, option, selector)
        getSelectOptions('linhas', 'nome', 'linha')

        // valor padrao para peso
        $("#peso").val('0.700')

    </script>
@endsection
