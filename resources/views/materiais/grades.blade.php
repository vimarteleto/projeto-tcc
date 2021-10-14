@extends('layouts.app', ['current' => 'grades'])

@section('body')
    <style>
        .line-number {
            line-height: 2.5;
            padding-right: 3px;
            padding-bottom: 3px
        
        }
    </style>

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de grades</h5>

                <table class="table table-sm table-ordered table-hover">
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
                                       data-id={{$grade->id}}                                       
                                       data-nome="{{$grade->nome}}"
                                       data-numero_33="{{$grade->numero_33}}"
                                       data-numero_34="{{$grade->numero_34}}"
                                       data-numero_35="{{$grade->numero_35}}"
                                       data-numero_36="{{$grade->numero_36}}"
                                       data-numero_37="{{$grade->numero_37}}"
                                       data-numero_38="{{$grade->numero_38}}"  
                                       data-numero_39="{{$grade->numero_39}}"  
                                       data-numero_40="{{$grade->numero_40}}"
                                       data-numero_41="{{$grade->numero_41}}"
                                       data-numero_42="{{$grade->numero_42}}"
                                       data-numero_43="{{$grade->numero_43}}"
                                       data-numero_44="{{$grade->numero_44}}"
                                       data-numero_45="{{$grade->numero_45}}"
                                       data-numero_46="{{$grade->numero_46}}"
                                       data-numero_47="{{$grade->numero_47}}"
                                       data-numero_48="{{$grade->numero_48}}"  
                                       onclick=getEditOptions(this)                                                         
                                    >
                                       Editar
                                   </a>

                                    <a  class="btn btn-sm btn-danger {{count($grade->materiais) > 0 ? 'disabled' : ''}}" 
                                        data-toggle="modal" 
                                        data-target="#modal-delete"
                                        data-id={{$grade->id}}      
                                        data-route="grades"      
                                        onclick=deleteModal(this)                     
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
                        <h5 class="modal-title">Editar grade</h5>
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
                <h5 class="modal-delete-title"></h5>
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

    </script>
@endsection
