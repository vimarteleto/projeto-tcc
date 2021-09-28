@extends('layouts.app', ['current' => 'categorias'])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de categorias de matéria-prima</h5>

                <table class="table table-ordered table-hover" id="tabelaCategorias">
                    <thead>
                        <tr>
                            <th>Cógido</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($categorias as $categoria)
                            <tr>
                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->nome}}</td>

                                <td>

                                    <a class="btn btn-sm btn-primary btn-modal-edit" 
                                       data-toggle="modal" 
                                       data-target="#modal-edit"
                                       data-item-id={{$categoria->id}}                                       
                                    >
                                       Editar
                                   </a>

                                    <a class="btn btn-sm btn-danger btn-modal-delete" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-item-id={{$categoria->id}}
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
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Nova categoria</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-categoria" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova categoria</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id" class="form-control"> --}}

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Categoria</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nome" placeholder="Nome da categoria">
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


    {{-- REFATORAR PARA FORA DO LOOP --}}
    {{-- modal de confirmacao de exclusao --}}
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color:white">
            <form action="categorias/excluir" id="form-categoria" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>          

            <div class="modal-body">                
                Deseja realmente excluir?
                <input name="id" type="hidden" id="id-delete" class="form-control">
            </div>

            <div class="modal-footer">
                {{-- <a href="/categorias/excluir"> --}}
                    <button class="btn btn-sm btn-danger">Excluir</button>
                {{-- </a> --}}
            </div>
            </form>
            </div>
        </div>
    </div>

    {{-- modal de edição --}}
    <div class="modal modal-edit" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/categorias" method="POST" id="form-categoria-edit" class="form-horizontal">
                    @csrf
                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar categoria</h5>
                    </div>
                    <div class="modal-body">

                        <input name="id" type="hidden" id="id-edit" class="form-control">

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Categoria</label>
                            <div class="input-group">
                                <input name="nome" type="text" class="form-control" id="nome-edit" placeholder="Nome da categoria">
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






@endsection

@section('javascript')
    <script type="text/javascript">

        // setup ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })

        // salvando novas categorias
        $('#form-categoria').submit((event) => {
            event.preventDefault()
            let categoria = {
                nome: $('#nome').val(),
            }

            $.post('categorias', categoria, (data) => {
                window.location.reload()
            })
            $('#modal-criar').modal('hide')
        })


        $(".btn-modal-edit").on('click', function() {
            // capturando o valor de data-item-id
            let id = $(this).data('item-id')   

            // passando o valor par ao input hidden       
            $("#id-edit").val(id)

            // request de show() para retorno da categoria desejada
            $.getJSON(`categorias/${id}`, (data) => {
                // console.log(data.nome)
                $("#nome-edit").val(data.nome)
            })
        })  

        // metodo de exclusao    
        $(".btn-modal-delete").on('click', function() {
            let id = $(this).data('item-id') 
            $("#id-delete").val(id) 
            // console.log(id)

            $.getJSON(`categorias/${id}`, (data) => {
                console.log(data.nome)
                $(".modal-title").text(data.nome)
            })


            
        })



        // carregando lista de itens para select
        // function carregarCategorias() {
        //     $.getJSON('api/categorias', (data) => {
        //         for(let i = 0; i < data.length; i++) {
        //             let option = `<option value="${data[i].id}">${data[i].nome}</option>`
        //             $('#categoriaCategoria').append(option)
        //         }
        //     })
        // }


    </script>
@endsection
