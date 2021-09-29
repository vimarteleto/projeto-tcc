@extends('layouts.app', ['current' => 'materiais'])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de materiais</h5>

                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Cógido</th>
                            <th>Categoria</th>
                            <th>Nome</th>
                            <th>Unidade</th>
                            <th>Preço</th>
                            <th>Grade</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($materiais as $material)
                            <tr>
                                <td>{{$material->id}}</td>
                                <td>{{$material->categoria->nome}}</td>
                                <td>{{$material->nome}}</td>
                                <td>{{$material->unidade->sigla}}</td>
                                <td>R$ {{$material->preco}}</td>
                                <td>{{$material->grade ? $material->grade->id : '-'}}</td>

                                <td>
                                    <div class="custom-control custom-switch">
                                            <input 
                                                data-item-switch={{$material->id}} 
                                                type="checkbox" 
                                                class="custom-control-input" 
                                                id="switch{{$material->id}}"
                                                {{$material->status == 1 ? 'checked' : ''}}
                                            >                                    
                                            <label class="custom-control-label" for="switch{{$material->id}}"></label>
                                    </div>
                                </td>
                                
                                <td>
                                    <a class="btn btn-sm btn-primary btn-modal-edit" 
                                       data-toggle="modal" 
                                       data-target="#modal-edit"
                                       data-item-id={{$material->id}}                                       
                                       data-item-categoria={{$material->categoria->id}}                                       
                                       data-item-nome="{{$material->nome}}"   
                                       data-item-unidade={{$material->unidade->id}} 
                                       data-item-preco="{{$material->preco}}"                                     
                                       data-item-grade={{$material->grade ? $material->grade->id : ''}}                                     
                                    >
                                       Editar
                                   </a>

                                    <a class="btn btn-sm btn-danger btn-modal-delete" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-item-id={{$material->id}}
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
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Novo material</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/materiais" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Novo material</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id-edit" name="id" class="form-control">   --}}
                        <div class="form-group">
                            <label for="categoria" class="form-check-label">Categoria</label>
                            <div class="input-group">
                                <select name="categoria_id" id="categoria" class="form-control categoria"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Material</label>
                            <div class="input-group">
                                <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome do material" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="grade" class="form-check-label">Grade</label>
                                <div class="input-group">
                                    <select name="grade_id" id="grade" class="form-control grade">
                                        <option value="">-</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <label for="unidade" class="form-check-label">Unidade</label>
                                <div class="input-group">
                                    <select name="unidade_id" id="unidade" class="form-control unidade"></select>
                                </div>
                            </div>

                            <div class="col">
                                <label for="preco" class="form-check-label">Preço</label>
                                <div class="input-group">
                                    <input name="preco" class="form-control" id="preco" required>
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
                <form action="/materiais" method="POST" id="form-edit" class="form-horizontal">
                    @csrf                    
                    <div class="modal-header">
                        <h5 class="modal-title">Editar categoria</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-edit" name="id" class="form-control">   

                        <div class="form-group">
                            <label for="categoria" class="form-check-label">Categoria</label>
                            <div class="input-group">
                                <select name="categoria_id" id="categoria-edit" class="form-control categoria"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="form-check-label">Material</label>
                            <div class="input-group">
                                <input name="nome" type="text" class="form-control" id="nome-edit" placeholder="Nome da categoria" required>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col">
                                <label for="grade" class="form-check-label">Grade</label>
                                <div class="input-group">
                                    <select name="grade_id" id="grade-edit" class="form-control grade">
                                        <option value="">-</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <label for="unidade" class="form-check-label">Unidade</label>
                                <div class="input-group">
                                    <select name="unidade_id" id="unidade-edit" class="form-control unidade"></select>
                                </div>
                            </div>

                            <div class="col">
                                <label for="preco" class="form-check-label">Preço</label>
                                <div class="input-group">
                                    <input name="preco" class="form-control" id="preco-edit" required>
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
            <form action="materiais/excluir" class="form-horizontal">
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

        // carregamento das options via request
        $(document).ready(function() {

            $.getJSON('categorias/index', (data) => {
                for(let i = 0; i < data.length; i++) {
                    let option = `<option value="${data[i].id}">${data[i].nome}</option>`

                    // classe nos inputs select para o modal de criacao e edicao
                    $('.categoria').append(option)
                }
            })

            $.getJSON('unidades/index', (data) => {
                for(let i = 0; i < data.length; i++) {
                    let option = `<option value="${data[i].id}">${data[i].sigla}</option>`
                    
                    $('.unidade').append(option)

                }
            })

            $.getJSON('grades/index', (data) => {
                for(let i = 0; i < data.length; i++) {
                    let option = `<option value="${data[i].id}">${data[i].id}</option>`

                    $('.grade').append(option)

                }
            })
        })

        //////////////////////////////////////////////////////////
        
        // clique no botao editar
        $(".btn-modal-edit").on('click', function() {
            // capturando o valor de data-item-id
            let id = $(this).data('item-id')   
            let categoria = $(this).data('item-categoria')   
            let nome = $(this).data('item-nome')   
            let unidade = $(this).data('item-unidade')   
            let preco = $(this).data('item-preco')   
            let grade = $(this).data('item-grade')   

            // passando o valor par ao input hidden       
            $("#id-edit").val(id)       
            $("#categoria-edit").val(categoria)       
            $("#nome-edit").val(nome)       
            $("#unidade-edit").val(unidade)       
            $("#preco-edit").val(preco)       
            $("#grade-edit").val(grade)     

        })             

        ////////////////////////////////////////////////

        // metodo de exclusao    
        $(".btn-modal-delete").on('click', function() {
            let id = $(this).data('item-id') 
            $("#id-delete").val(id) 

            // titulo do modal com nome do item
            $.getJSON(`materiais/${id}`, (data) => {
                $(".modal-title").text(data.nome)
            })            

            // MANIPULACAO DO BODY DO MODAL DE DELETE ???
            // if(CONDICAO)  {
            //     $(".modal-delete").text(
            //         `TEXTO` 
            //     )
            // } else {
            //     $(".modal-delete").text(
            //         `TEXTO` 
            //     )
            // }
        })

        ////////////////////////////////////////////////

        // inativacao via switch
        $(".custom-control-input").on('click', function() {
            let id = $(this).data('item-switch')
            console.log(id)

            $.post(`materiais/status/${id}`, (data) => {
                console.log(data)
            })
        })

    </script>
@endsection
