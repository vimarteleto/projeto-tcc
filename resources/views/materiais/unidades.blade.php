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
                                       data-item-id={{$unidade->id}}                                       
                                       data-item-nome="{{$unidade->nome}}"                                       
                                       data-item-sigla="{{$unidade->sigla}}"                                   
                                    >
                                       Editar
                                   </a>

                                    <a class="btn btn-sm btn-danger btn-modal-delete" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-item-id={{$unidade->id}}
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
                <form id="form-store" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova unidade</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id-edit" name="id" class="form-control">                          --}}

                        <div class="row">
                            <div class="col">
                                <label for="nome" class="form-check-label">Unidade</label>
                                <div class="input-group">
                                    <input name="nome" id="nome" class="form-control nome" placeholder="Nome da unidade">
                                </div>
                            </div>

                            <div class="col">
                                <label for="sigla" class="form-check-label">Sigla</label>
                                <div class="input-group">
                                    <input name="sigla" type="text" class="form-control" id="sigla" placeholder="Sigla da unidade">
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
                                    <input name="nome" id="nome-edit" class="form-control nome" placeholder="Nome da unidade">
                                </div>
                            </div>

                            <div class="col">
                                <label for="sigla" class="form-check-label">Sigla</label>
                                <div class="input-group">
                                    <input name="sigla" type="text" class="form-control" id="sigla-edit" placeholder="Sigla da unidade">
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
                <h5 class="modal-title"></h5>
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

        //////////////////////////////////////////////////////////
        
        // salvando novas categorias
        $('#form-store').submit((event) => {
            event.preventDefault()
            let unidade = {
                // categoria_id: $('#categoria').val(),
                nome: $('#nome').val(),
                // unidade_id: $('#unidade').val(),
                sigla: $('#sigla').val(),
                // grade_id: $('#grade').val(),
                // status: 1,
            }

            $.post('unidades', unidade, (data) => {
                window.location.reload()
            })
            $('#modal-criar').modal('hide')
        })

        //////////////////////////////////////////////////////////
        
        // clique no botao editar
        $(".btn-modal-edit").on('click', function() {
            // capturando o valor de data-item-id
            let id = $(this).data('item-id')  
            let nome = $(this).data('item-nome') 
            let sigla = $(this).data('item-sigla')  

            // passando o valor par ao input hidden       
            $("#id-edit").val(id)    

            // demais inputs
            $("#nome-edit").val(nome)        
            $("#sigla-edit").val(sigla)        

        })              

        ////////////////////////////////////////////////

        // metodo de exclusao    
        $(".btn-modal-delete").on('click', function() {
            let id = $(this).data('item-id') 
            $("#id-delete").val(id) 

            // titulo do modal com nome do item
            $.getJSON(`unidades/${id}`, (data) => {
                $(".modal-title").text(data.nome)
            })            
        })

    </script>
@endsection
