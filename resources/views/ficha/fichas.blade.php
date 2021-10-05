@extends('layouts.app', ['current' => 'fichas'])

@section('body')   
    
    <div class="card border">
        <div class="card-body">
            {{-- <h5 class="card-title">Cadastro de fichas</h5> --}}
            <h5 class="card-title">{{$sku->referencia->codigo}} {{$sku->cor->nome}}</h5>

                <table class="table table-ordered table-hover" id="tabelaLinhas">
                    <thead>
                        <tr>
                            <th>Sequência</th>
                            <th>Categoria</th>
                            <th>Material</th>
                            <th>Consumo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        @foreach ($itens as $item)
                            
                        
                        
                            <tr>
                                <td>{{$item->sequencia}}</td>
                                <td>{{$item->material->categoria->nome}}</td>
                                <td>{{$item->material->nome}}</td>
                                <td>{{$item->consumo}}</td>

                                <td>
                                    <a class="btn btn-sm btn-primary btn-modal-edit" 
                                       data-toggle="modal" 
                                       data-target="#modal-edit"
                                       data-id={{$item->id}}                                       
                                       data-nome="{{$item->nome}}" 
                                       data-sequencia="{{$item->sequencia}}" 
                                       data-consumo="{{$item->consumo}}" 
                                       data-codigo="{{$item->codigo}}" 
                                       onclick=getEditOptions(this)                                   
                                    >
                                       Editar
                                   </a>

                                    {{-- <a  class="btn btn-sm btn-danger {{count($item->referencias) > 0 ? 'disabled' : ''}}"  --}}
                                    <a  class="btn btn-sm btn-danger" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-id={{$item->id}}
                                        data-route="fichas"
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
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Novo item</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/fichas" method="POST" id="form-ficha" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nova ficha</h5>
                    </div>
                    <div class="modal-body">
                        <input name="cor_referencia_id" type="hidden" value={{$sku->id}}> 

                        <div class="form-group row">
                            <div class="col">
                                <label for="nome" class="form-check-label">Material</label>
                                <div class="input-group">
                                    <select name="material_id" id="material" class="form-control material"></select>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="form-group row">
                            <div class="col">
                                <label for="sequencia" class="form-check-label">Sequência</label>
                                <div class="input-group">
                                    <input name="sequencia" type="number" class="form-control" id="sequencia" required>
                                </div>
                            </div>                               
                            
                            <div class="col">
                                <label for="consumo" class="form-check-label">Consumo</label>
                                <div class="input-group">
                                    <input name="consumo" type="text" class="form-control" id="consumo" required>
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
    <div class="modal modal-edit" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/fichas" method="POST" id="form-ficha-edit" class="form-horizontal">
                    @csrf
                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar material</h5>
                    </div>
                    <div class="modal-body">
                        <input name="id" type="hidden" id="id-edit" class="form-control">   
                        
                        
                        <div class="form-group row">
                            <div class="col">
                                <label for="nome" class="form-check-label">Material</label>
                                <div class="input-group">
                                    <select name="material_id" id="material-edit" class="form-control material"></select>
                                </div>
                            </div> 
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label for="sequencia" class="form-check-label">Sequência</label>
                                <div class="input-group">
                                    <input name="sequencia" type="number" class="form-control sequencia" id="sequencia-edit" required>
                                </div>
                            </div>                               
                            
                            <div class="col">
                                <label for="consumo" class="form-check-label">Consumo</label>
                                <div class="input-group">
                                    <input name="consumo" type="text" class="form-control consumo" id="consumo-edit" required>
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
            <form action="fichas/excluir" id="form-ficha" class="form-horizontal">
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

        getSelectOptions('materiais', 'nome', 'material')

    </script>
@endsection
