function statusChange(e) {   

    let id = e.getAttribute('data-id'); 
    let route = e.getAttribute('data-route'); 

    $.post(`${route}/status/${id}`, (data) => {
        console.log(data)
    })
    
}


function getSelectOptions(route, option, selector) {

    $.getJSON(`${route}/index`, (data) => {

        for(let i = 0; i < data.length; i++) {
            let options = `<option value = "${data[i].id}">${data[i][(option)]}</option>`

            // classe nos inputs select para o modal de criacao e edicao
            $(`.${selector}`).append(options)
        }
    })
}

function getSelectOptionsFromRecords(type, selector) {

    $.getJSON(`cadastros/index/${type}`, (data) => {

        for(let i = 0; i < data.length; i++) {
            let options = `<option value = "${data[i].id}">${data[i].nome}</option>`

            // classe nos inputs select para o modal de criacao e edicao
            $(`.${selector}`).append(options)
        }
    })
}

function getClientById(id) {

    $.getJSON(`cadastros/cadastros/${id}`, (data) => {
        $(`.nome-cliente`).val(data.nome)
    })
}

function getSkuColors(id, n = 1) {

    $.getJSON(`referencias/${id}`, (data) => {
        console.log(data)
        for(let i = 0; i < data.cores.length; i++) {

            let options = `<option value = "${data.cores[i].id}">${data.cores[i].nome}</option>`
            // classe nos inputs select para o modal de criacao e edicao
            $(`#cor_id_${n}`).append(options)

        }
    })
}


function getEditOptions(e) {
    let id = e.getAttribute('data-id')
    let categoria = e.getAttribute('data-categoria')
    let nome = e.getAttribute('data-nome')
    let peso = e.getAttribute('data-peso')
    let unidade = e.getAttribute('data-unidade')
    let preco = e.getAttribute('data-preco')
    let sigla = e.getAttribute('data-sigla')
    let codigo = e.getAttribute('data-codigo')
    let linha = e.getAttribute('data-linha')
    let sequencia = e.getAttribute('data-sequencia')
    let consumo = e.getAttribute('data-consumo')
    let referencia = e.getAttribute('data-referencia')
    let cor = e.getAttribute('data-cor')
    let material = e.getAttribute('data-material')
    let grade = e.getAttribute('data-grade') == 0 ? null : e.getAttribute('data-grade')    


    $("#id-edit").val(id)  
    
    $("#categoria-edit").val(categoria)
    $("#nome-edit").val(nome)       
    $("#peso-edit").val(peso)       
    $("#preco-edit").val(preco)       
    $("#unidade-edit").val(unidade)       
    $("#codigo-edit").val(codigo)
    $("#sigla-edit").val(sigla)
    $("#linha-edit").val(linha)
    $("#grade-edit").val(grade)
    $("#sequencia-edit").val(sequencia)
    $("#consumo-edit").val(consumo)
    $("#referencia-edit").val(referencia)
    $("#cor-edit").val(cor)
    $("#material-edit").val(material)
    

    // GRADES

    let numero_33 = e.getAttribute('data-numero_33');
    let numero_34 = e.getAttribute('data-numero_34');
    let numero_35 = e.getAttribute('data-numero_35');
    let numero_36 = e.getAttribute('data-numero_36');
    let numero_37 = e.getAttribute('data-numero_37');
    let numero_38 = e.getAttribute('data-numero_38');
    let numero_39 = e.getAttribute('data-numero_39');
    let numero_40 = e.getAttribute('data-numero_40');
    let numero_41 = e.getAttribute('data-numero_41');
    let numero_42 = e.getAttribute('data-numero_42');
    let numero_43 = e.getAttribute('data-numero_43');
    let numero_44 = e.getAttribute('data-numero_44');
    let numero_45 = e.getAttribute('data-numero_45');
    let numero_46 = e.getAttribute('data-numero_46');
    let numero_47 = e.getAttribute('data-numero_47');
    let numero_48 = e.getAttribute('data-numero_48');


    $("#numero_33-edit").val(numero_33)        
    $("#numero_34-edit").val(numero_34)        
    $("#numero_35-edit").val(numero_35)        
    $("#numero_36-edit").val(numero_36)        
    $("#numero_37-edit").val(numero_37)        
    $("#numero_38-edit").val(numero_38)        
    $("#numero_39-edit").val(numero_39)        
    $("#numero_40-edit").val(numero_40)
    $("#numero_41-edit").val(numero_41)
    $("#numero_42-edit").val(numero_42)
    $("#numero_43-edit").val(numero_43)
    $("#numero_44-edit").val(numero_44)
    $("#numero_45-edit").val(numero_45)
    $("#numero_46-edit").val(numero_46)
    $("#numero_47-edit").val(numero_47)
    $("#numero_48-edit").val(numero_48)       
    
    // CADASTROS

    let ie = e.getAttribute('data-ie');
    let pessoa = e.getAttribute('data-pessoa');
    let tipo = e.getAttribute('data-tipo');
    let fantasia = e.getAttribute('data-fantasia');
    let cep = e.getAttribute('data-cep');
    let logradouro = e.getAttribute('data-logradouro');
    let numero = e.getAttribute('data-numero');
    let bairro = e.getAttribute('data-bairro');
    let complemento = e.getAttribute('data-complemento');
    let cidade = e.getAttribute('data-cidade');
    let uf = e.getAttribute('data-uf');
    let telefone = e.getAttribute('data-telefone');
    let celular = e.getAttribute('data-celular');
    let email = e.getAttribute('data-email');

    $("#ie-edit").val(ie)
    $("#pessoa-edit").val(pessoa)
    $("#tipo-edit").val(tipo)
    $("#fantasia-edit").val(fantasia)
    $("#cep-edit").val(cep)
    $("#logradouro-edit").val(logradouro)
    $("#numero-edit").val(numero)
    $("#bairro-edit").val(bairro)
    $("#complemento-edit").val(complemento)
    $("#cidade-edit").val(cidade)
    $("#uf-edit").val(uf)
    $("#telefone-edit").val(telefone)
    $("#celular-edit").val(celular)
    $("#email-edit").val(email)

    // duplicate

    $("#id-duplicate").val(id)
    $("#referencia-duplicate").val(referencia)
    $("#cor-duplicate").val(cor)
    $("#preco-duplicate").val(preco)

}

function explosionDetails(e) {
    $('#explosion-table').empty()
    let id = e.getAttribute('data-id')
    $.getJSON(`pedidos/explosao/${id}`, (data) => {
        console.log(data)

        $('.card-title-pedido').text(`Consumo de materiais do pedido ${id}`)

        for(let i = 0; i < data.length; i++) {

            let materials = `
            <tr>
                <td>${data[i].material}</td>
                <td>${data[i].consumo}</td>
            </tr>`

            $('#explosion-table').append(materials)
        }

    })
}


function deleteModal(e) {
    
    let route = e.getAttribute('data-route')
    let id = e.getAttribute('data-id')
    $("#id-delete").val(id) 

    // titulo do modal com nome do item
    $.getJSON(`${route}/${id}`, (data) => {
        console.log(data)
        data.nome ? $(".modal-delete-title").text(data.nome) :
        data.material ? $(".modal-delete-title").text(data.material.nome) :
        data.referencia && data.cor ? $(".modal-delete-title").text(data.referencia.codigo + ' ' + data.cor.nome) :
        data.id ? $(".modal-delete-title").text('GRADE ' + data.id) :
        console.log('nao')

    })
}


// SERVICE CONSULTA CEP

function searchCep(value) {
    let cep = value.replace(/\D/g, '');
    if (cep != '') {
        let validCep = /^[0-9]{8}$/;
        if(validCep.test(cep)) {
            $.ajax({
                type: 'GET',
                crossDomain: true,
                dataType: 'jsonp',
                url: 'https://viacep.com.br/ws/' + cep + '/json',
                success: function(data){
                    document.getElementById('logradouro').value = (data.logradouro.toUpperCase())
                    document.getElementById('bairro').value = (data.bairro.toUpperCase())
                    document.getElementById('cidade').value = (data.localidade.toUpperCase())
                    document.getElementById('uf').value = (data.uf)
                }
            })

        } 
    }
}


// SERVICE CONSULTA CNPJ

function searchCnpj(value) {
    let cnpj = value.replace(/\D/g, '');
    if (cnpj != '') {
        let validCnpj = /^[0-9]{14}$/;
        if(validCnpj.test(cnpj)) {
            $.ajax({
                type: 'GET',
                crossDomain: true,
                dataType: 'jsonp',
                url: 'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
                success: function(data){
                    document.getElementById('nome').value = (data.nome.toUpperCase());
                    document.getElementById('pessoa').value = ('PJ');
                }
            })
        } 
    } 

};

// SERVICE CONSULTA IE

function searchIe() {

    let cep = document.getElementById('cep').value
    let cnpj = document.getElementById('id').value
    let ufOption = document.getElementById("uf");
    let uf = ufOption.options[ufOption.selectedIndex].value;

    if (cnpj != '' && cep != '') {
        let validCnpj = /^[0-9]{14}$/;
        let validCep = /^[0-9]{8}$/;
        if(validCnpj.test(cnpj) && validCep.test(cep)) {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": "5ac425e7-d034-48e0-8179-0841bc4c5352-6b7444ec-9723-4b3f-825f-f4001dce6291"
                },
                url: 'https://api.cnpja.com/office/' + cnpj + '?registrations=' + uf,
                success: function(data){
                    for (let i = 0; i < data.registrations.length; i++) {
                        if (data.registrations[i].enabled == true) {
                            document.getElementById('ie').value = data.registrations[i].number
                            break
                        }
                        
                    }
                }
            })
        } 
    } 
};

// ADICIONAR ITEM AO PEDIDO

function addItemRow() {

    let row = document.createElement('div')
    document.getElementById('contador-hidden').value++
    let n = parseInt(document.getElementById('contador-hidden').value)
    row.innerHTML = `
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <div class="input-group">
                        <select onblur="getSkuColors(this.value, ${n})" name="item[${n}][referencia]" id="referencia_id_${n}" class="form-control referencia">
                            <option value="">Referência</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="input-group">
                        <select onblur="getPreco(document.getElementById('referencia_id_${n}').value, this.value, ${n})" name="item[${n}][cor]" id="cor_id_${n}" class="form-control cor">
                            <option value="">Cor</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <table>
                        <tr>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_34]" id="item[${n}][numero_34]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_35]" id="item[${n}][numero_35]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_36]" id="item[${n}][numero_36]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_37]" id="item[${n}][numero_37]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_38]" id="item[${n}][numero_38]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_39]" id="item[${n}][numero_39]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_40]" id="item[${n}][numero_40]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_41]" id="item[${n}][numero_41]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_42]" id="item[${n}][numero_42]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_43]" id="item[${n}][numero_43]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_44]" id="item[${n}][numero_44]"></td>
                            <td><input value="0" onblur="getTotalPairs(${n})" type="text" style="width: 30px" name="item[${n}][numero_45]" id="item[${n}][numero_45]"></td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input name="item[${n}][quantidade]" type="text" class="form-control" id="quantidade_item_${n}" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input name="item[${n}][preco]" type="text" class="form-control" id="preco_item_${n}" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input value="0" name="item[${n}][desconto]" type="text" class="form-control" id="desconto_item_${n}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input name="item[${n}][total]" type="text" class="form-control" id="total_item_${n}" readonly>
                    </div>
                </div>
            </div>
        </div>
    ` 
    let element = document.getElementById("itens-pedido");
    element.appendChild(row);

    getSkuSelectOption(n)
}

function getSkuSelectOption(selector) {

    $.getJSON(`referencias/index`, (data) => {

        for(let i = 0; i < data.length; i++) {
            let options = `<option value = "${data[i].id}">${data[i].codigo}</option>`

            $(`#referencia_id_${selector}`).append(options)
        }
    })
}

function getTotalPairs(n) {
    let numero_34_row = parseInt(document.getElementById(`item[${n}][numero_34]`).value)
    let numero_35_row = parseInt(document.getElementById(`item[${n}][numero_35]`).value)
    let numero_36_row = parseInt(document.getElementById(`item[${n}][numero_36]`).value)
    let numero_37_row = parseInt(document.getElementById(`item[${n}][numero_37]`).value)
    let numero_38_row = parseInt(document.getElementById(`item[${n}][numero_38]`).value)
    let numero_39_row = parseInt(document.getElementById(`item[${n}][numero_39]`).value)
    let numero_40_row = parseInt(document.getElementById(`item[${n}][numero_40]`).value)
    let numero_41_row = parseInt(document.getElementById(`item[${n}][numero_41]`).value)
    let numero_42_row = parseInt(document.getElementById(`item[${n}][numero_42]`).value)
    let numero_43_row = parseInt(document.getElementById(`item[${n}][numero_43]`).value)
    let numero_44_row = parseInt(document.getElementById(`item[${n}][numero_44]`).value)
    let numero_45_row = parseInt(document.getElementById(`item[${n}][numero_45]`).value)

    let total = (
        numero_34_row + numero_35_row + numero_36_row + numero_37_row + numero_38_row + numero_39_row + 
        numero_40_row + numero_41_row + numero_42_row + numero_43_row + numero_44_row + numero_45_row
    )

    document.getElementById(`quantidade_item_${n}`).value = total
}

function getPreco(referencia_id, cor_id, n) {

    $.getJSON(`skus/${referencia_id}/${cor_id}`, (data) => {
        $(`#preco_item_${n}`).val(data.preco)
    })
}

// TODO
// VALOR TOTAL COM DESCONTO
// TOTAL PARES GERAL
// VALOR TOTAL GERAL

