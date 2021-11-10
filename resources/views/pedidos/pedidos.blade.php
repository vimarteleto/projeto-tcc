@extends('layouts.app', ['current' => 'pedidos'])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de pedidos</h5>

                <table class="table table-sm table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Cliente</th>
                            <th>Situação</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                <td>{{$pedido->cliente->nome}}</td>
                                <td>{{$pedido->situacao}}</td>

                                <td>
                                    <a class="btn btn-sm btn-primary btn-modal-edit" 
                                        data-toggle="modal" 
                                        data-target="#modal-edit"                                 
                                        data-pessoa="{{$pedido->pedido_fabrica}}"   
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
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Novo pedido</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="/pedidos" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Novo pedido</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="id" class="form-check-label">Número do pedido</label>
                                    <div class="input-group">
                                        <input name="id" type="text" class="form-control" id="id" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="cliente_id" class="form-check-label">Documento do cliente</label>
                                    <div class="input-group">
                                        <input name="cliente_id" type="text" class="form-control" id="cliente_id" placeholder="CNPJ do cliente" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="nome-cliente" class="form-check-label">Cliente</label>
                                    <div class="input-group">
                                        <input name="nome-cliente" type="text" class="form-control" id="nome-cliente" placeholder="Nome ou razão social" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="pedido_cliente" class="form-check-label">Pedido do cliente</label>
                                    <div class="input-group">
                                        <input name="pedido_cliente" type="text" class="form-control" id="pedido_cliente" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- CEP LOGRADOURO BAIRRO
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="cep" class="form-check-label">CEP</label>
                                    <div class="input-group">
                                        <input name="cep" type="text" class="form-control" id="cep" maxlength="9" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="logradouro" class="form-check-label">Logradouro</label>
                                    <div class="input-group">
                                        <input name="logradouro" type="text" class="form-control" id="logradouro" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="bairro" class="form-check-label">Bairro</label>
                                    <div class="input-group">
                                        <input name="bairro" type="text" class="form-control" id="bairro" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        NUMERO COMPLEMENTO CIDADE ESTADO
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="numero" class="form-check-label">Número</label>
                                    <div class="input-group">
                                        <input name="numero" type="text" class="form-control" id="numero" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="complemento" class="form-check-label">Complemento</label>
                                    <div class="input-group">
                                        <input name="complemento" type="text" class="form-control" id="complemento" readonly>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="cidade" class="form-check-label">Cidade</label>
                                    <div class="input-group">
                                        <input name="cidade" type="text" class="form-control" id="cidade" readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="uf" class="form-check-label">Estado</label>
                                    <div class="input-group">
                                        <input name="uf" type="text" class="form-control" id="uf" readonly>
                                    </div>
                                </div>
                                
                            </div>
                        </div> --}}
                        {{-- REPRESENTANTE --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="representante_id" class="form-check-label">Representante</label>
                                    <div class="input-group">
                                        <select name="representante_id" id="representante_id" class="form-control pessoa">
                                            <option value="">REPRESENTANTES</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="marca" class="form-check-label">Marca</label>
                                    <div class="input-group">
                                        <input name="marca" type="text" class="form-control" id="marca" placeholder="Guilder" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="data_entrega" class="form-check-label">Data de entrega</label>
                                    <div class="input-group">
                                        <input name="data_entrega" type="date" class="form-control" id="data_entrega" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="condicao_pagamento" class="form-check-label">Pagamento</label>
                                    <div class="input-group">
                                        <input name="condicao_pagamento" type="text" class="form-control" id="condicao_pagamento" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TRANSPORTE --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="transportador_id" class="form-check-label">Transportador</label>
                                    <div class="input-group">
                                        <select name="transportador_id" id="transportador_id" class="form-control pessoa">
                                            <option value="">TRANSPORTADOR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="complemento" class="form-check-label">Frete</label>
                                    <select name="frete" id="frete" class="form-control pessoa">
                                        <option value="CIF" selected>CIF</option>
                                        <option value="FOB">FOB</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="volumes" class="form-check-label">Volumes</label>
                                    <div class="input-group">
                                        <input name="volumes" type="text" class="form-control" id="volumes" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        {{-- ITENS DO PEDIDO --}}
                        <div id="itens-pedido">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="referencia_id" class="form-check-label">Referência</label>
                                        <div class="input-group">
                                            <select name="referencia_id_1" id="referencia_id_1" class="form-control pessoa">
                                                <option value="">REFERENCIAS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label for="cor_id" class="form-check-label">Cor</label>
                                        <div class="input-group">
                                            <select name="cor_id_1" id="cor_id_1" class="form-control pessoa">
                                                <option value="">COR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <table>
                                            <tr>
                                                <th>34</th>
                                                <th>35</th>
                                                <th>36</th>
                                                <th>37</th>
                                                <th>38</th>
                                                <th>39</th>
                                                <th>40</th>
                                                <th>41</th>
                                                <th>42</th>
                                                <th>43</th>
                                                <th>44</th>
                                                <th>45</th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                                <td><input type="text" style="width: 30px"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col">
                                        <label for="quantidade_item_1" class="form-check-label">Pares</label>
                                        <div class="input-group">
                                            <input name="quantidade_item_1" type="text" class="form-control" id="quantidade_item_1" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="preco_item_1" class="form-check-label">Preço</label>
                                        <div class="input-group">
                                            <input name="preco_item_1" type="text" class="form-control" id="preco_item_1" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="desconto_item_1" class="form-check-label">Desconto</label>
                                        <div class="input-group">
                                            <input name="desconto_item_1" type="text" class="form-control" id="desconto_item_1" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="total_item_1" class="form-check-label">Total</label>
                                        <div class="input-group">
                                            <input name="total_item_1" type="text" class="form-control" id="total_item_1" readonly>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="TOTAL" class="form-check-label"></label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-primary" onclick="addItemRow()">+</button>
                                        <input type="text" value="1" hidden id="contador-hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- OBSERVAÇÕES --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="observacoes" class="form-check-label">Observações</label>
                                    <div class="input-group">
                                        <input name="observacoes" type="text" class="form-control" id="observacoes" placeholder="Observações do pedido">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="peso_liquido" class="form-check-label">Peso líquido</label>
                                    <div class="input-group">
                                        <input name="peso_liquido" type="text" class="form-control" id="peso_liquido">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="peso_bruto" class="form-check-label">Peso bruto</label>
                                    <div class="input-group">
                                        <input name="peso_bruto" type="text" class="form-control" id="peso_bruto">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="total_pares" class="form-check-label">Total de pares</label>
                                    <div class="input-group">
                                        <input name="total_pares" type="text" class="form-control" id="total_pares" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="total_valor" class="form-check-label">Valor total</label>
                                    <div class="input-group">
                                        <input name="total_valor" type="text" class="form-control" id="total_valor" readonly>
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
            <form action="pedidos/excluir" class="form-horizontal">
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
