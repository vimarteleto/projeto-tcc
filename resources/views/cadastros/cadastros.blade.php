@extends('layouts.app', ['current' => 'cadastros'])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastros gerais</h5>

                <table class="table table-sm table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($cadastros as $cadastro)
                            <tr>
                                <td>{{$cadastro->id}}</td>
                                <td>{{$cadastro->nome}}</td>
                                <td>{{$cadastro->telefone}}</td>

                                <td>
                                    <div class="custom-control custom-switch">
                                            <input 
                                                data-id={{$cadastro->id}} 
                                                data-route="cadastros"
                                                type="checkbox" 
                                                class="custom-control-input" 
                                                id="switch{{$cadastro->id}}"
                                                {{$cadastro->status == 1 ? 'checked' : ''}}
                                                onclick=statusChange(this)
                                            >                               
                                            <label class="custom-control-label" for="switch{{$cadastro->id}}"></label>
                                    </div>
                                </td>
                                
                                <td>
                                    <a class="btn btn-sm btn-primary btn-modal-edit" 
                                        data-toggle="modal" 
                                        data-target="#modal-edit"
                                        data-id="{{$cadastro->id}}"
                                        data-ie="{{$cadastro->ie ? $cadastro->ie : ''}}"                                    
                                        data-pessoa="{{$cadastro->pessoa}}"   
                                        data-tipo="{{$cadastro->tipo}}" 
                                        data-nome="{{$cadastro->nome}}"                                     
                                        data-fantasia="{{$cadastro->fantasia ? $cadastro->fantasia : ''}}"                                     
                                        data-cep="{{$cadastro->cep}}"                                     
                                        data-logradouro="{{$cadastro->logradouro}}"
                                        data-numero="{{$cadastro->numero}}"
                                        data-bairro="{{$cadastro->bairro}}"
                                        data-complemento="{{$cadastro->complemento}}"
                                        data-cidade="{{$cadastro->cidade}}"
                                        data-uf="{{$cadastro->uf}}"
                                        data-telefone="{{$cadastro->telefone ? $cadastro->telefone : ''}}"
                                        data-celular="{{$cadastro->celular ? $cadastro->celular : ''}}"
                                        data-email="{{$cadastro->email ? $cadastro->email : '-'}}"
                                        onclick=getEditOptions(this)
                                    >
                                       Detalhes
                                   </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

        </div>
        <div class="card-footer">
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Novo cadastro</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="/cadastros" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Novo cadastro</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="id" class="form-check-label">Documento</label>
                                    <div class="input-group">
                                        <input onblur="searchCnpj(this.value);" name="id" type="text" class="form-control" id="id" placeholder="CPF ou CNPJ" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="nome" class="form-check-label">Nome</label>
                                    <div class="input-group">
                                        <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome ou razão social" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label for="pessoa" class="form-check-label">Pessoa</label>
                                    <div class="input-group">
                                        <select name="pessoa" id="pessoa" class="form-control pessoa">
                                            <option value="PJ">Jurídica</option>
                                            <option value="PF">Física</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="tipo" class="form-check-label">Tipo</label>
                                    <div class="input-group">
                                        <select name="tipo" id="tipo" class="form-control tipo">
                                            <option value="C">Cliente</option>
                                            <option value="F">Fornecedor</option>
                                            <option value="O">Outros</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="cep" class="form-check-label">CEP</label>
                                    <div class="input-group">
                                        <input onblur="searchCep(this.value)" name="cep" type="text" class="form-control" id="cep" placeholder="CEP" maxlength="9" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="logradouro" class="form-check-label">Logradouro</label>
                                    <div class="input-group">
                                        <input onblur="searchIe()" name="logradouro" type="text" class="form-control" id="logradouro" placeholder=Logradouro required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="bairro" class="form-check-label">Bairro</label>
                                    <div class="input-group">
                                        <input name="bairro" type="text" class="form-control" id="bairro" placeholder="Bairro" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="numero" class="form-check-label">Numero</label>
                                    <div class="input-group">
                                        <input name="numero" type="text" class="form-control" id="numero" placeholder="Número" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="complemento" class="form-check-label">Complemento</label>
                                    <div class="input-group">
                                        <input name="complemento" type="text" class="form-control" id="complemento" placeholder=Complemento>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="cidade" class="form-check-label">Cidade</label>
                                    <div class="input-group">
                                        <input name="cidade" type="text" class="form-control" id="cidade" placeholder=Cidade required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="uf" class="form-check-label">Estado</label>
                                    <div class="input-group">
                                        <select name="uf" id="uf" class="form-control uf">
                                            <option value="AC">ACRE</option>
                                            <option value="AL">ALAGOAS</option>
                                            <option value="AP">AMAPÁ</option>
                                            <option value="AM">AMAZONAS</option>
                                            <option value="BA">BAHIA</option>
                                            <option value="CE">CEARÁ</option>
                                            <option value="DF">DISTRITO FEDERAL</option>
                                            <option value="ES">ESPÍRITO SANTO</option>
                                            <option value="GO">GOIÁS</option>
                                            <option value="MA">MARANHÃO</option>
                                            <option value="MT">MATO GROSSO</option>
                                            <option value="MS">MATO GROSSO DO SUL</option>
                                            <option value="MG">MINAS GERAIS</option>
                                            <option value="PA">PARÁ</option>
                                            <option value="PB">PARAÍBA</option>
                                            <option value="PR">PARANÁ</option>
                                            <option value="PE">PERNAMBUCO</option>
                                            <option value="PI">PIAUÍ</option>
                                            <option value="RJ">RIO DE JANEIRO</option>
                                            <option value="RN">RIO GRANDE DO NORTE</option>
                                            <option value="RS">RIO GRANDE DO SUL</option>
                                            <option value="RO">RONDÔNIA</option>
                                            <option value="RR">RORAIMA</option>
                                            <option value="SC">SANTA CATARINA</option>
                                            <option value="SP">SÃO PAULO</option>
                                            <option value="SE">SERGIPE</option>
                                            <option value="TO">TOCANTINS</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-8">
                                    <label for="fantasia" class="form-check-label">Fantasia</label>
                                    <div class="input-group">
                                        <input name="fantasia" type="text" class="form-control" id="fantasia" placeholder="Nome fantasia">
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="ie" class="form-check-label">Inscrição estadual</label>
                                    <div class="input-group">
                                        <input name="ie" type="text" class="form-control" id="ie" placeholder="Inscrição estadual">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="telefone" class="form-check-label">Telefone</label>
                                    <div class="input-group">
                                        <input name="telefone" type="text" class="form-control" id="telefone" placeholder="Telefone">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="celular" class="form-check-label">Celular</label>
                                    <div class="input-group">
                                        <input name="celular" type="text" class="form-control" id="celular" placeholder=Celular>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="email" class="form-check-label">Email</label>
                                    <div class="input-group">
                                        <input name="email" type="text" class="form-control" id="email" placeholder=Email>
                                    </div>
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

    {{-- modal de edicao --}}
    <div class="modal modal-edit modal-request" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="/cadastros" method="POST" id="form-edit" class="form-horizontal">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Detalhes de cadastro</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="id" class="form-check-label">Documento</label>
                                    <div class="input-group">
                                        <input name="id" type="text" class="form-control" id="id-edit" placeholder="CPF ou CNPJ" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="nome" class="form-check-label">Nome</label>
                                    <div class="input-group">
                                        <input name="nome" type="text" class="form-control" id="nome-edit" placeholder="Nome ou razão social" required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label for="pessoa" class="form-check-label">Pessoa</label>
                                    <div class="input-group">
                                        <select name="pessoa" id="pessoa-edit" class="form-control pessoa">
                                            <option value="PJ">Jurídica</option>
                                            <option value="PF">Física</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="tipo" class="form-check-label">Tipo</label>
                                    <div class="input-group">
                                        <select name="tipo" id="tipo-edit" class="form-control tipo">
                                            <option value="C">Cliente</option>
                                            <option value="F">Fornecedor</option>
                                            <option value="O">Outros</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-8">
                                    <label for="fantasia" class="form-check-label">Fantasia</label>
                                    <div class="input-group">
                                        <input name="fantasia" type="text" class="form-control" id="fantasia-edit" placeholder="Nome fantasia">
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="ie" class="form-check-label">Inscrição estadual</label>
                                    <div class="input-group">
                                        <input name="ie" type="text" class="form-control" id="ie-edit" placeholder="Inscrição estadual">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="cep" class="form-check-label">CEP</label>
                                    <div class="input-group">
                                        <input name="cep" type="text" class="form-control" id="cep-edit" placeholder="CEP" maxlength="9" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="logradouro" class="form-check-label">Logradouro</label>
                                    <div class="input-group">
                                        <input name="logradouro" type="text" class="form-control" id="logradouro-edit" placeholder=Logradouro required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="bairro" class="form-check-label">Bairro</label>
                                    <div class="input-group">
                                        <input name="bairro" type="text" class="form-control" id="bairro-edit" placeholder="Bairro" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="numero" class="form-check-label">Numero</label>
                                    <div class="input-group">
                                        <input name="numero" type="text" class="form-control" id="numero-edit" placeholder="Número" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="complemento" class="form-check-label">Complemento</label>
                                    <div class="input-group">
                                        <input name="complemento" type="text" class="form-control" id="complemento-edit" placeholder=Complemento>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="cidade" class="form-check-label">Cidade</label>
                                    <div class="input-group">
                                        <input name="cidade" type="text" class="form-control" id="cidade-edit" placeholder=Cidade required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="uf" class="form-check-label">Estado</label>
                                    <div class="input-group">
                                        <select name="uf" id="uf-edit" class="form-control uf">
                                            <option value="AC">ACRE</option>
                                            <option value="AL">ALAGOAS</option>
                                            <option value="AP">AMAPÁ</option>
                                            <option value="AM">AMAZONAS</option>
                                            <option value="BA">BAHIA</option>
                                            <option value="CE">CEARÁ</option>
                                            <option value="DF">DISTRITO FEDERAL</option>
                                            <option value="ES">ESPÍRITO SANTO</option>
                                            <option value="GO">GOIÁS</option>
                                            <option value="MA">MARANHÃO</option>
                                            <option value="MT">MATO GROSSO</option>
                                            <option value="MS">MATO GROSSO DO SUL</option>
                                            <option value="MG">MINAS GERAIS</option>
                                            <option value="PA">PARÁ</option>
                                            <option value="PB">PARAÍBA</option>
                                            <option value="PR">PARANÁ</option>
                                            <option value="PE">PERNAMBUCO</option>
                                            <option value="PI">PIAUÍ</option>
                                            <option value="RJ">RIO DE JANEIRO</option>
                                            <option value="RN">RIO GRANDE DO NORTE</option>
                                            <option value="RS">RIO GRANDE DO SUL</option>
                                            <option value="RO">RONDÔNIA</option>
                                            <option value="RR">RORAIMA</option>
                                            <option value="SC">SANTA CATARINA</option>
                                            <option value="SP">SÃO PAULO</option>
                                            <option value="SE">SERGIPE</option>
                                            <option value="TO">TOCANTINS</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="telefone" class="form-check-label">Telefone</label>
                                    <div class="input-group">
                                        <input name="telefone" type="text" class="form-control" id="telefone-edit" placeholder="Telefone">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="celular" class="form-check-label">Celular</label>
                                    <div class="input-group">
                                        <input name="celular" type="text" class="form-control" id="celular-edit" placeholder=Celular>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="email" class="form-check-label">Email</label>
                                    <div class="input-group">
                                        <input name="email" type="text" class="form-control" id="email-edit" placeholder=Email>
                                    </div>
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
            <form action="cadastros/excluir" class="form-horizontal">
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
        // getSelectOptions('categorias', 'nome', 'categoria')


    </script>

<script>
    
    

</script>
    
@endsection
