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

                                    <a class="btn btn-sm btn-primary" 
                                       data-toggle="modal" 
                                       data-target="#modal-edit-{{$categoria->id}}"
                                    >
                                       Editar
                                   </a>

                                    <a class="btn btn-sm btn-danger" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete-{{$categoria->id}}"
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
    @foreach ($categorias as $categoria)

    <div class="modal fade" id="modal-delete-{{$categoria->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color:white">
            <div class="modal-header">
                <h5 class="modal-title">{{$categoria->nome}}</h5>
            </div>          

            <div class="modal-body">                
                @if (count($categoria->materiais) == 0)
                    Deseja realmente excluir a categoria {{$categoria->nome}}?

                @else
            
                    A categoria {{$categoria->nome}} possui {{count($categoria->materiais)}} materiais cadastrados, 
                A categoria {{$categoria->nome}} possui {{count($categoria->materiais)}} materiais cadastrados, 
                    A categoria {{$categoria->nome}} possui {{count($categoria->materiais)}} materiais cadastrados, 
                    deseja realmente excluir?
                @endif
            </div>

            <div class="modal-footer">
                <a href="/categorias/excluir/{{$categoria->id}}">
                    <button class="btn btn-sm btn-danger">Excluir</button>
                </a>
            </div>

            </div>
        </div>
    </div>
    {{-- modal de confirmacao de edição --}}

    <div class="modal modal-edit" tabindex="-1" role="dialog" id="modal-edit-{{$categoria->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formCategoriaEdit" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar categoria</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idEdit" value={{$categoria->id}} class="form-control">

                        <div class="form-group">
                            <label for="nomeEdit" class="form-check-label">Categoria</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomeEdit" placeholder="Nome da categoria" value="{{$categoria->nome}}">
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

        
    @endforeach




@endsection

@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        })

        function criarCategoria() {
            let categoria = {
                nome: $('#nome').val(),
            }

            $.post('api/categorias', categoria, (data) => {
                // let categoria = JSON.parse(data)
                // console.log(categoria)
                // let row = criarLinha(categoria)
                // $('#tabelaCategorias>tbody').append(row)
                window.location.reload()
            })
        }

        $('#formCategoria').submit((event) => {
            event.preventDefault()
            criarCategoria()
            $('#modal-criar').modal('hide')
        })


        // EDICAO
        
        function editarCategoria() {
            let categoria = {
                id: $('#idEdit').val(),
                nome: $('#nomeEdit').val(),
            }
            console.log(categoria)
            $.post('api/categorias', categoria, (data) => {
                // let categoria = JSON.parse(data)
                // console.log(categoria)
                // let row = criarLinha(categoria)
                // $('#tabelaCategorias>tbody').append(row)
                // window.location.reload()
            })
        }
        
        $('#formCategoriaEdit').submit((event) => {
            event.preventDefault()
            editarCategoria()
            $('.modal-edit').modal('hide')
        })


        // modal de nova categoria
        // function novaCategoria() {
        //     $(() => {
        //         $('#id').val('')
        //         $('#nome').val('')
        //         $('#modal-criar').modal('show')
        //     })
        // }

        // carregando lista de itens para select
        // function carregarCategorias() {
        //     $.getJSON('api/categorias', (data) => {
        //         for(let i = 0; i < data.length; i++) {
        //             let option = `<option value="${data[i].id}">${data[i].nome}</option>`
        //             $('#categoriaCategoria').append(option)
        //         }
        //     })
        // }

        // function criarLinha(categoria) {
        //     return `<tr>
        //                 <td>${categoria.id}</td>
        //                 <td>${categoria.nome}</td>
        //                 <td>
        //                     <button class="btn btn-sm btn-primary">Editar</button>
                            

        //                     <a href="categorias/excluir/${categoria.id}" >
        //                         <button class="btn btn-sm btn-danger">Excluir</button>
        //                     </a>
        //                 </td>
        //         </tr>`
        // }

        // function carregarTabelaCategorias() {
        //     $.getJSON('api/categorias', (data) => {
        //         for(let i = 0; i < data.length; i++) {
        //             let row = criarLinha(data[i])
        //             $('#tabelaCategorias>tbody').append(row)
        //         }
        //     })
        // }

        

        // $(() => {
        //     // carregarCategorias();
        //     carregarTabelaCategorias();
        // })


    </script>
@endsection
