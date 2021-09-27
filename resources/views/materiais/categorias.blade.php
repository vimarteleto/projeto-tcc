@extends('layouts.app', ['current' => 'categoria'])

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
                                    <a href="/categorias/editar/{{$categoria->id}}"
                                       class="btn btn-sm btn-primary">Editar</a>

                                    <a href="/categorias/excluir/{{$categoria->id}}"
                                       class="btn btn-sm btn-danger">Excluir</a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onclick="novaCategoria()">Nova categoria</button>
        </div>
    </div>

    {{-- modal de criar --}}
    <div class="modal" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formCategoria" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova categoria</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

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

    {{-- modal de confirmacao de exclusao --}}
    {{-- modal de confirmacao de edição --}}


@endsection

@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })

        // modal de nova categoria
        function novaCategoria() {
            $(() => {
                $('#id').val('')
                $('#nome').val('')
                $('#modal-criar').modal('show')
            })
        }

        // carregando lista de itens para select
        // function carregarCategorias() {
        //     $.getJSON('api/categorias', (data) => {
        //         for(let i = 0; i < data.length; i++) {
        //             let option = `<option value="${data[i].id}">${data[i].nome}</option>`
        //             $('#categoriaCategoria').append(option)
        //         }
        //     })
        // }

        function criarLinha(categoria) {
            return `<tr>
                        <td>${categoria.id}</td>
                        <td>${categoria.nome}</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Editar</button>
                            

                            <a href="categorias/excluir/${categoria.id}" >
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </a>
                        </td>
                </tr>`
        }

        // function carregarTabelaCategorias() {
        //     $.getJSON('api/categorias', (data) => {
        //         for(let i = 0; i < data.length; i++) {
        //             let row = criarLinha(data[i])
        //             $('#tabelaCategorias>tbody').append(row)
        //         }
        //     })
        // }

        function criarCategoria() {
            let categoria = {
                nome: $('#nome').val(),
            }

            $.post('api/categorias', categoria, (data) => {
                let categoria = JSON.parse(data)
                console.log(categoria)
                let row = criarLinha(categoria)
                $('#tabelaCategorias>tbody').append(row)
            })
        }

        $('#formCategoria').submit((event) => {
            event.preventDefault()
            criarCategoria()
            $('#modal-criar').modal('hide')
        })

        // $(() => {
        //     // carregarCategorias();
        //     carregarTabelaCategorias();
        // })


    </script>
@endsection
