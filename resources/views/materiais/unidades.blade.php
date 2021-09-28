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

        // carregamento das options
        // $(document).ready(function() {

        //     $.getJSON('categorias/index', (data) => {
        //         for(let i = 0; i < data.length; i++) {
        //             let option = `<option value="${data[i].id}">${data[i].nome}</option>`

        //             // classe nos inputs select para o modal de criacao e edicao
        //             $('.categoria').append(option)
        //         }
        //     })

        //     $.getJSON('unidades/index', (data) => {
        //         for(let i = 0; i < data.length; i++) {
        //             let option = `<option value="${data[i].id}">${data[i].sigla}</option>`

        //             $('.unidade').append(option)

        //         }
        //     })

        //     $.getJSON('grades/index', (data) => {
        //         for(let i = 0; i < data.length; i++) {
        //             let option = `<option value="${data[i].id}">${data[i].nome}</option>`

        //             $('.grade').append(option)

        //         }
        //     })
        // })

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

            // passando o valor par ao input hidden       
            $("#id-edit").val(id)            

            // request de show() para retorno do item nos inputs do modal de edicao
            $.getJSON(`unidades/${id}`, (data) => {
                console.log(data)

                $("#nome-edit").val(data.nome)
                $("#sigla-edit").val(data.sigla)
                // $(`#categoria-edit option[value=${data.categoria_id}]`).attr('selected','selected')
                // $(`#unidade-edit option[value=${data.unidade_id}]`).attr('selected','selected')
                // $(`#grade-edit option[value=${data.grade_id ? data.grade_id : null}]`).attr('selected','selected')                
                
            })
        })              

        // limpeza do selected
        // $('.modal-request').on('hidden.bs.modal', function () {       
        //     $('#categoria-edit option:selected').removeAttr('selected');
        //     $('#unidade-edit option:selected').removeAttr('selected');
        //     $('#grade-edit option:selected').removeAttr('selected');
        // })


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

{{-- FLUXO DE CRIACAO DOS CRUDS BASICOS
    
        ADICIONAR TH
        ADICIONAR TD
        ALTERAR TEXTO BOTAO DE CRIACAO
        ALTERAR MODAL DE CRIACAO:
            ALTERAR TITULO
            ALTERAR ATRIBUTOS: FOR, NAME, ID E CLASS COM NOME DO INPUT

        COPIAR O MODAL DE CRIACAO PARA O MODAL DE EDICAO:
            ALTERAR ACTION
            ALTERAR TITULO
            DESCOMENTAR O INPUT HIDDEN
            ALTERAR NAME PARA ITENS QUE SAO FK, COLOCANDO O EXEMPLO_ID
            ALTERAR ID COM EXEMPLO-EDIT DE TODOS
            MATER O FOR E A CLASSE NORMAL

        ALTERAR A TODA NO MODAL DE EXCLUSAO

        //////

        SCRIPTS
        GETS DE CARREGAMENTO 
        ALTERAR O OBJETO NO POST DE SUBMIT DE CRIACAO
        ALTERAR CAMPOS NO GET SHOW()
        ALTERAR CAMPOS NA LIMPEZA DOS SELECT
        ALTERAR ROTA NO METODO DE EXCLUSAO    
    
    --}}
