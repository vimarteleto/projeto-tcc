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


function getEditOptions(e) {
    console.log('oie')
    let id = e.getAttribute('data-id');
    let categoria = e.getAttribute('data-categoria');
    let nome = e.getAttribute('data-nome');
    let unidade = e.getAttribute('data-unidade');
    let preco = e.getAttribute('data-preco');
    let sigla = e.getAttribute('data-sigla');
    let codigo = e.getAttribute('data-codigo');
    let linha = e.getAttribute('data-linha');
    let sequencia = e.getAttribute('data-sequencia');
    let consumo = e.getAttribute('data-consumo');
    let referencia = e.getAttribute('data-referencia');
    let cor = e.getAttribute('data-cor');
    let material = e.getAttribute('data-material');
    let grade = e.getAttribute('data-grade') == 0 ? null : e.getAttribute('data-grade');    


    $("#id-edit").val(id)       
    $("#id-duplicate").val(id)       
    $("#categoria-edit").val(categoria)       
    $("#nome-edit").val(nome)       
    $("#unidade-edit").val(unidade)       
    $("#preco-edit").val(preco)       
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
