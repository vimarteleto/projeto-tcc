@extends('layouts.app', ['current' => 'grades'])

@section('body')
    <style>
        .line-number {
            line-height: 2.5;
            padding-right: 2px;
            padding-bottom: 2px
        
        }
    </style>

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de grades</h5>

                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Cógido</th>
                            <th>33</th>
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
                            <th>46</th>
                            <th>47</th>
                            <th>48</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>            
                        
                        @foreach($grades as $grade)
                            <tr>
                                <td>{{$grade->id}}</td>
                                <td>{{$grade->numero_33}}</td>
                                <td>{{$grade->numero_34}}</td>
                                <td>{{$grade->numero_35}}</td>
                                <td>{{$grade->numero_36}}</td>
                                <td>{{$grade->numero_37}}</td>
                                <td>{{$grade->numero_38}}</td>
                                <td>{{$grade->numero_39}}</td>
                                <td>{{$grade->numero_40}}</td>
                                <td>{{$grade->numero_41}}</td>
                                <td>{{$grade->numero_42}}</td>
                                <td>{{$grade->numero_43}}</td>
                                <td>{{$grade->numero_44}}</td>
                                <td>{{$grade->numero_45}}</td>
                                <td>{{$grade->numero_46}}</td>
                                <td>{{$grade->numero_47}}</td>
                                <td>{{$grade->numero_48}}</td>
                                <td nowrap>
                                    <a class="btn btn-sm btn-primary btn-modal-edit" 
                                       data-toggle="modal" 
                                       data-target="#modal-edit"
                                       data-item-id={{$grade->id}}                                       
                                       data-item-nome="{{$grade->nome}}"
                                       data-item-33="{{$grade->numero_33}}"
                                       data-item-34="{{$grade->numero_34}}"
                                       data-item-35="{{$grade->numero_35}}"
                                       data-item-36="{{$grade->numero_36}}"
                                       data-item-37="{{$grade->numero_37}}"
                                       data-item-38="{{$grade->numero_38}}"  
                                       data-item-39="{{$grade->numero_39}}"  
                                       data-item-40="{{$grade->numero_40}}"
                                       data-item-41="{{$grade->numero_41}}"
                                       data-item-42="{{$grade->numero_42}}"
                                       data-item-43="{{$grade->numero_43}}"
                                       data-item-44="{{$grade->numero_44}}"
                                       data-item-45="{{$grade->numero_45}}"
                                       data-item-46="{{$grade->numero_46}}"
                                       data-item-47="{{$grade->numero_47}}"
                                       data-item-48="{{$grade->numero_48}}"                                                                
                                    >
                                       Editar
                                   </a>

                                    <a  class="btn btn-sm btn-danger btn-modal-delete {{count($grade->materiais) > 0 ? 'disabled' : ''}}" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-item-id={{$grade->id}}                                    
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
            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-criar">Nova grade</a>
        </div>
    </div>

    {{-- modal de criacao --}}
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-criar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="grades" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nova grade</h5>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id-edit" name="id" class="form-control">                          --}}

                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_33" class="form-check-label line-number">33</label>
                                    <input name="numero_33" id="numero_33" class="form-control numero_33">
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_34" class="form-check-label line-number">34</label>
                                    <input name="numero_34" id="numero_34" class="form-control numero_34">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_35" class="form-check-label line-number">35</label>
                                    <input name="numero_35" id="numero_35" class="form-control numero_35">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_36" class="form-check-label line-number">36</label>
                                    <input name="numero_36" id="numero_36" class="form-control numero_36">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_37" class="form-check-label line-number">37</label>
                                    <input name="numero_37" id="numero_37" class="form-control numero_37">
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_38" class="form-check-label line-number">38</label>
                                    <input name="numero_38" id="numero_38" class="form-control numero_38">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_39" class="form-check-label line-number">39</label>
                                    <input name="numero_39" id="numero_39" class="form-control numero_39">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_40" class="form-check-label line-number">40</label>
                                    <input name="numero_40" id="numero_40" class="form-control numero_40">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_41" class="form-check-label line-number">41</label>
                                    <input name="numero_41" id="numero_41" class="form-control numero_41">
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_42" class="form-check-label line-number">42</label>
                                    <input name="numero_42" id="numero_42" class="form-control numero_42">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_43" class="form-check-label line-number">43</label>
                                    <input name="numero_43" id="numero_43" class="form-control numero_43">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_44" class="form-check-label line-number">44</label>
                                    <input name="numero_44" id="numero_44" class="form-control numero_44">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_45" class="form-check-label line-number">45</label>
                                    <input name="numero_45" id="numero_45" class="form-control numero_45">
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_46" class="form-check-label line-number">46</label>
                                    <input name="numero_46" id="numero_46" class="form-control numero_46">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_47" class="form-check-label line-number">47</label>
                                    <input name="numero_47" id="numero_47" class="form-control numero_47">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_48" class="form-check-label line-number">48</label>
                                    <input name="numero_48" id="numero_48" class="form-control numero_48">
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
    <div class="modal modal-request" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="grades" method="POST" id="form-store" class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Nova grade</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-edit" name="id" class="form-control">                   

                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_33" class="form-check-label line-number">33</label>
                                    <input name="numero_33" id="numero_33-edit" class="form-control numero_33">
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_34" class="form-check-label line-number">34</label>
                                    <input name="numero_34" id="numero_34-edit" class="form-control numero_34">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_35" class="form-check-label line-number">35</label>
                                    <input name="numero_35" id="numero_35-edit" class="form-control numero_35">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_36" class="form-check-label line-number">36</label>
                                    <input name="numero_36" id="numero_36-edit" class="form-control numero_36">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_37" class="form-check-label line-number">37</label>
                                    <input name="numero_37" id="numero_37-edit" class="form-control numero_37">
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_38" class="form-check-label line-number">38</label>
                                    <input name="numero_38" id="numero_38-edit" class="form-control numero_38">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_39" class="form-check-label line-number">39</label>
                                    <input name="numero_39" id="numero_39-edit" class="form-control numero_39">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_40" class="form-check-label line-number">40</label>
                                    <input name="numero_40" id="numero_40-edit" class="form-control numero_40">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_41" class="form-check-label line-number">41</label>
                                    <input name="numero_41" id="numero_41-edit" class="form-control numero_41">
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_42" class="form-check-label line-number">42</label>
                                    <input name="numero_42" id="numero_42-edit" class="form-control numero_42">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_43" class="form-check-label line-number">43</label>
                                    <input name="numero_43" id="numero_43-edit" class="form-control numero_43">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_44" class="form-check-label line-number">44</label>
                                    <input name="numero_44" id="numero_44-edit" class="form-control numero_44">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_45" class="form-check-label line-number">45</label>
                                    <input name="numero_45" id="numero_45-edit" class="form-control numero_45">
                                </div>                                
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_46" class="form-check-label line-number">46</label>
                                    <input name="numero_46" id="numero_46-edit" class="form-control numero_46">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_47" class="form-check-label line-number">47</label>
                                    <input name="numero_47" id="numero_47-edit" class="form-control numero_47">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <label for="numero_48" class="form-check-label line-number">48</label>
                                    <input name="numero_48" id="numero_48-edit" class="form-control numero_48">
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
            <form action="grades/excluir" id="form-categoria" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-title">Grade</h5>
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


        //////////////////////////////////////////////////////////
        
        // clique no botao editar
        $(".btn-modal-edit").on('click', function() {
            // capturando o valor de data-item-id
            let id = $(this).data('item-id')  
            let numero_33 = $(this).data('item-33')
            let numero_34 = $(this).data('item-34')
            let numero_35 = $(this).data('item-35')
            let numero_36 = $(this).data('item-36')
            let numero_37 = $(this).data('item-37')
            let numero_38 = $(this).data('item-38')
            let numero_39 = $(this).data('item-39')
            let numero_40 = $(this).data('item-40')
            let numero_41 = $(this).data('item-41')
            let numero_42 = $(this).data('item-42')
            let numero_43 = $(this).data('item-43')
            let numero_44 = $(this).data('item-44')
            let numero_45 = $(this).data('item-45')
            let numero_46 = $(this).data('item-46')
            let numero_47 = $(this).data('item-47')
            let numero_48 = $(this).data('item-48')

            // passando o valor par ao input hidden       
            $("#id-edit").val(id)    

            // demais inputs
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
      

        })              

        ////////////////////////////////////////////////

        // metodo de exclusao    
        $(".btn-modal-delete").on('click', function() {
            let id = $(this).data('item-id') 
            $("#id-delete").val(id) 
        
            // titulo do modal com nome do item
            $.getJSON(`grades/${id}`, (data) => {
                $(".modal-title").text(data.nome)
                console.log(data)
            })            
        })

    </script>
@endsection
