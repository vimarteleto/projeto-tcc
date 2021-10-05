
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
            let options = `<option value="${data[i].id}">${data[i][(option)]}</option>`

            // classe nos inputs select para o modal de criacao e edicao
            $(`.${selector}`).append(options)
        }
    })
}


function getEditOptions(e) {

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

}


function deleteModal(e) {

    let route = e.getAttribute('data-route')
    let id = e.getAttribute('data-id')
    $("#id-delete").val(id) 

    // titulo do modal com nome do item
    $.getJSON(`${route}/${id}`, (data) => {
        console.log(data)
        if(data.nome) $(".modal-delete-title").text(data.nome)
        else if(data.material.nome) $(".modal-delete-title").text(data.material.nome)
    })
}
