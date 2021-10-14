@extends('layouts.app', ['current' => 'estoques'])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Estoque de materiais</h5>

                <table class="table table-sm table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Material</th>
                            <th>Unidade</th>
                            <th>Quantidade</th>
                            <th>Unitário</th>
                            <th>Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($estoques as $estoque)
                            <tr>
                                <td>{{$estoque->material->categoria->nome}}</td>
                                <td>{{$estoque->descricao}}</td>
                                <td>{{$estoque->material->unidade->sigla}}</td>
                                <td>{{$estoque->quantidade}}</td>
                                <td>R$ {{$estoque->material->preco}}</td>
                                <td>R$ {{$estoque->material->preco * $estoque->quantidade}}</td>
                                
                                <td>
                                    <a  class="btn btn-sm btn-primary btn-modal-edit" 
                                        data-toggle="modal" 
                                        data-target="#modal-edit"
                                        data-id={{$estoque->id}}                                      
                                        data-route="estoques"
                                        onclick=getEditOptions(this)   
                                   
                                    >
                                       Editar
                                   </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

        </div>
    </div>

    {{-- modal de criacao --}}
       

    {{-- modal de edição --}}
    <div class="modal modal-edit modal-request" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/estoques" method="POST" id="form-edit" class="form-horizontal">
                    @csrf                    
                    <div class="modal-header">
                        <h5 class="modal-title">Alterar estoque</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-edit" name="id" class="form-control"> 

                        <div class="row">

                            <div class="col">
                                <label for="grade" class="form-check-label">Entrada</label>
                                <div class="input-group">
                                        <input name="entrada" class="form-control" id="entrada">
                                </div>
                            </div>

                            <div class="col">
                                <label for="unidade" class="form-check-label">Saída</label>
                                <div class="input-group">
                                    <input name="saida" class="form-control" id="saida">
                                </div>
                            </div>

                            <div class="col">
                                <label for="preco" class="form-check-label">Novo estoque</label>
                                <div class="input-group">
                                    <input name="estoque" class="form-control" id="estoque">
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
            <form action="estoques/excluir" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
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


    </script>
@endsection
