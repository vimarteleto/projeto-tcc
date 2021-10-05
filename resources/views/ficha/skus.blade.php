@extends('layouts.app', ['current' => 'skus'])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de SKUs</h5>

                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Linha</th>
                            <th>Referência</th>
                            <th>Cor</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($skus as $sku)
                            <tr>
                                <td>{{$sku->referencia->linha->nome}}</td>
                                <td>{{$sku->referencia->codigo}}</td>
                                <td>{{$sku->cor->nome}}</td>

                                <td>
                                    <div class="custom-control custom-switch">
                                            <input 
                                                data-id={{$sku->id}} 
                                                data-route="skus"
                                                type="checkbox" 
                                                class="custom-control-input" 
                                                id="switch{{$sku->id}}"
                                                {{$sku->status == 1 ? 'checked' : ''}}
                                                onclick=statusChange(this)
                                                
                                            >                               
                                            <label class="custom-control-label" for="switch{{$sku->id}}"></label>
                                    </div>
                                </td>
                                
                                <td>
                                    <a class="btn btn-sm btn-primary" 
                                       {{-- data-toggle="modal" 
                                       data-target="#modal-edit"
                                       data-id={{$sku->id}}                                       
                                       data-codigo="{{$sku->codigo}}"
                                       data-nome="{{$sku->nome}}"   
                                       data-linha={{$sku->linha->id}} 
                                       onclick=getEditOptions(this)    --}}
                                       href="/fichas/{{$sku->id}}"                         
                                    >
                                       Visualizar
                                   </a>

                                    <a  class="btn btn-sm btn-success" 
                                        data-toggle="modal" 
                                        data-target="#modal-duplicate"
                                        data-id={{$sku->id}}
                                        data-route="skus"
                                        onclick=getEditOptions(this)
                                    >
                                        Duplicar
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

        </div>
        <div class="card-footer">
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Novo SKU</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/skus" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Novo SKU</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id-edit" name="id" class="form-control">   --}}

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Referência</label>
                            <div class="input-group">
                                <select name="referencia_id" id="referencia" class="form-control referencia"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Cor</label>
                            <div class="input-group">
                                <select name="cor_id" id="cor" class="form-control cor"></select>
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

    {{-- modal de duplicar --}}
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-duplicate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/skus/duplicate" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Novo SKU</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-duplicate" name="id" class="form-control">  

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Referência</label>
                            <div class="input-group">
                                <select name="referencia_id" id="referencia" class="form-control referencia"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Cor</label>
                            <div class="input-group">
                                <select name="cor_id" id="cor" class="form-control cor"></select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" type="submit">Criar</button>
                        <button class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 

    {{-- modal de confirmacao de exclusao
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color:white">
            <form action="skus/excluir" class="form-horizontal">
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
    </div> --}}

    

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
        getSelectOptions('referencias', 'codigo', 'referencia')
        getSelectOptions('cores', 'nome', 'cor')


    </script>
@endsection
