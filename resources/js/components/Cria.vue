<template>
    <div class="container">

      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> Crías
              <button type="button" @click="abrirModal('cria','registrar')" class="btn btn-success">
                  <i class="fas fa-plus-square"></i>&nbsp;Nuevo
              </button>
          </div>

          <div class="card-body">
              <div class="form-group row">
                  <div class="col-md-6">
                      <div class="input-group">
                          <select class="form-control col-md-3" v-model="criterio">
                            <option value="nombre">Cría</option>
                            <option value="fecha_nacimiento">Fecha Nacimiento</option>
                            <option value="raza">Raza</option>
                            <option value="color">Color</option>
                          </select>
                          <input type="text" v-model="buscar" @keyup.enter="listarCria(1,buscar,criterio)" class="form-control" placeholder="Buscar Cría">
                          <button type="submit" @click="listarCria(1,buscar,criterio)" class="btn btn-success"><i class="fas fa-search-location"></i> Buscar</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr class="table-danger">
                        <th scope="col">Opciones</th>
                        <th scope="col">Cría</th>
                        <th scope="col">Raza</th>
                        <th scope="col">Color</th>
                        <th scope="col">Fecha Nacimiento</th>
                        <th scope="col">Edad</th>
                        
                        <th scope="col">Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="puerco in arrayCria" :key="puerco.id">
                        <td class="table-success">
                          
                          <button type="button" @click="abrirModalImagen('Imagen','ver',puerco)" class="btn btn-success btn-sm" >
                            <i class="fas fa-eye"></i>
                          </button>
                          <template v-if="puerco.estado">
                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarCria(puerco.id)">
                              <i class="fas fa-trash"></i>
                            </button>
                          </template>
                          <template v-else>
                            <button type="button" class="btn btn-info btn-sm" @click="activarCria(puerco.id)">
                              <i class="fas fa-check"></i>
                            </button>
                          </template>
                        </td>
                        <td v-text="puerco.nombre"></td>
                        <td v-text="puerco.raza"></td>
                        <td v-text="puerco.color"></td>
                        <td v-text="puerco.fecha_nacimiento"></td>
                        <td v-text="puerco.edad +' año(s) '"></td>

                        <td>
                          <div v-if="puerco.estado">
                            <span class="badge badge-success">Vivo</span>
                          </div>
                          <div v-else>
                            <span class="badge badge-danger">Muerto</span>
                          </div>             
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <nav>
                    <ul class="pagination">
                      <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                      </li>
                      <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                      </li>
                      <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                      </li>
                    </ul>
                  </nav>
                </div>
          </div>

      </div>
      
      <!-- Modal Registrar Actualizar-->
      <div class="modal" tabindex="-1" :class="{'mostrar' : modal}" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content ">
            <div class="modal-header">
              <h5 class="modal-title" v-text="tituloModal"></h5>
              <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Papá</label>
                    <div class="col-md-9">
                      <select class="form-control" v-model="id_gallo" >
                          <option v-for="papas in arrayPapa" :key="papas.id" :value="papas.id" v-text="papas.nombre"></option>
                      </select>                                       
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Mamá</label>
                    <div class="col-md-9">
                      <select class="form-control" v-model="id_gallina" >
                          <option v-for="mamas in arrayMama" :key="mamas.id" :value="mamas.id" v-text="mamas.nombre"></option>
                      </select>                                       
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Nombre(*)</label>
                    <div class="col-md-9">
                      <input type="text" v-model="nombre" class="form-control" placeholder="nombre de la cría">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Raza</label>
                    <div class="col-md-9">
                      <input type="text" v-model="raza" class="form-control" placeholder="raza de la cría">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Color</label>
                    <div class="col-md-9">
                      <input type="text" v-model="color" class="form-control" placeholder="color de la cría">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento(*)</label>
                    <div class="col-md-9">
                      <input type="date" v-model="fecha_nacimiento" class="form-control" >                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Ubicacion</label>
                    <div class="col-md-9">
                      <input type="text" v-model="ubicacion" class="form-control" placeholder="ubicación de la cría">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                    <div class="col-md-9">
                      <input type="text" v-model="descripcion" class="form-control" placeholder="descripcion de la cría">                                        
                    </div>
                  </div>
                        
                  <div v-show="errorCria" class="form-group row div-error">
                    <div class="text-center text-error">
                      <div v-for="error in errorMostrarMsjCria" :key="error" v-text="error">

                      </div>
                    </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
              <button type="button" v-if="tipoAccion==1" class="btn btn-success" @click="registrarCria()">Guardar</button>
              <button type="button" v-if="tipoAccion==2" class="btn btn-success" @click="actualizarCria()">Actualizar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Ver Imagen-->
      <div class="modal" tabindex="-2" :class="{'mostrarImagen' : modalImagen}" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" v-text="tituloModal"></h5>
              <button type="button" class="close" @click="cerrarModalImagen()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
              <center>
              <div class="card border-success mb-3" style="max-width: 18rem;">
                <div class="card-header ">DETALLES DE LA CRÍA</div>
                <div class="card-body">
                  <h6 class="card-text text-left">Descripción: <td v-text="descripcion"></td></h6>
                  <h6 class="card-text text-left">Ubicación:<td v-text="ubicacion"></td></h6>
                </div>
              </div>
              </center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="cerrarModalImagen()">Close</button>
            </div>
          </div>
        </div>
      </div>
    
    </div>
</template>

<script>
    export default {
      props : ['ruta'],
        data (){
            return {
                puerco_id: 0,
                id_gallo:0,
                id_gallina:0,
                nombre : '',
                raza : '',
                color : '',
                fecha_nacimiento : '',
                ubicacion : '',
                descripcion : '',
                estado : '',
                foto : null,
                arrayCria : [],
                modal : 0,
                modalImagen:0,
                tituloModal : '',
                tipoAccion : 0,
                errorCria : 0,
                errorMostrarMsjCria : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayPapa:[],
                arrayMama:[],
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarCria (page,buscar,criterio){
                let me=this;
                var url=this.ruta + '/Cria?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCria = respuesta.puercos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            img() {
            this.foto = this.$refs.foto.files[0];
            },
            selectPapa(){
                let me = this;
                var url=this.ruta + '/gallo/selectGallo';
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayPapa=respuesta.puercos;
                    
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectMama(){
                let me = this;
                var url=this.ruta + '/gallina/selectGallina';
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayMama=respuesta.puercos;
                    
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCria(page,buscar,criterio);
            },
            registrarCria(){
                if (this.validarCria()){
                    return;
                }
                var me = this;
                let formData = new FormData();
                formData.append('nombre', me.nombre);
                formData.append('raza', me.raza);
                formData.append('color', me.color);
                formData.append('fecha_nacimiento', me.fecha_nacimiento);
                formData.append('ubicacion', me.ubicacion);
                formData.append('descripcion', me.descripcion);
                //formData.append('estado', me.estado);
                formData.append('id_gallo', me.id_gallo);
                formData.append('id_gallina', me.id_gallina);
                axios.post(this.ruta +  '/Cria/registrar',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then(function(){
                    me.cerrarModal();
                    me.listarCria(1,'','nombre');
                })
                .catch(function(error){
                console.log(error);
                });
                    
            },
            
            actualizarCria(){
               if (this.validarCria()){
                    return;
                }
                var me = this;
                let formData = new FormData();
                formData.append('id',me.puerco_id);
                formData.append('nombre', me.nombre);
                formData.append('raza', me.raza);
                formData.append('color', me.color);
                formData.append('fecha_nacimiento', me.fecha_nacimiento);
                formData.append('ubicacion', me.ubicacion);
                formData.append('descripcion', me.descripcion);
                //formData.append('estado', me.estado);
                formData.append('id_gallo', me.id_gallo);
                formData.append('id_gallina', me.id_gallina);
                //formData.append("_method", "put");
                axios.put(this.ruta +  'Cria/actualizar',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then(function(){
                    me.cerrarModal();
                    me.listarCria(1,'','nombre');
                })
                .catch(function(error){
                console.log(error);
                });

            },
            desactivarCria(id){
               swal({
                title: 'Esta seguro de desactivar a este Cria?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.post(this.ruta + '/Cria/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCria();
                        swal(
                        'Desactivado!',
                        'El Cria ha sido desactivado',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarCria(id){
               swal({
                title: 'Esta seguro de activar a este Cria?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put(this.ruta + '/Cria/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCria();
                        swal(
                        'Activado!',
                        'El Cria ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },            
            validarCria(){
                this.errorCria=0;
                this.errorMostrarMsjCria =[];

                if (this.id_gallo==0) this.errorMostrarMsjCria.push("Seleccione un papá");
                if (this.id_gallina==0) this.errorMostrarMsjCria.push("Seleccione una mamá");
                if (!this.nombre) this.errorMostrarMsjCria.push("Ingrese el nombre de la Cria ");
                if (!this.fecha_nacimiento) this.errorMostrarMsjCria.push("ingrese una fecha de nacimiento");
          
                if (this.errorMostrarMsjCria.length) this.errorCria = 1;

                return this.errorCria;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.puerco_id=0;
                this.nombre='';
                this.raza='';
                this.color='';
                this.fecha_nacimiento='';
                this.ubicacion='';
                this.descripcion='';
                this.estado='';
                this.foto=null;
                this.errorCria=0;
                this.tipoAccion=0;
                this.id_gallo=0;
                this.id_gallina=0;

            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "cria":
                    {
                        switch(accion){
                            case 'registrar':{
                                this.modal = 1;
                                this.tituloModal = 'Registrar cria';
                                this.nombre='';
                                this.raza='';
                                this.color='';
                                this.fecha_nacimiento='';
                                this.ubicacion='';
                                this.descripcion='';
                                this.estado='';
                                this.id_gallo=0;
                                this.id_gallina=0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':{
                                this.modal=1;
                                this.tituloModal='Actualizar cria';
                                this.tipoAccion=2;
                                this.puerco_id=data['id'];
                                this.nombre = data['nombre'];
                                this.raza = data['raza'];
                                this.color = data['color'];
                                this.fecha_nacimiento = data['fecha_nacimiento'];
                                this.ubicacion = data['ubicacion'];
                                this.descripcion = data['descripcion'];
                                this.estado = data['estado'];
                                this.id_gallo=data['id_gallo'];
                                this.id_gallina=data['id_gallina'];
                                break;
                            }
                        }
                    }
                }
              this.selectPapa();
              this.selectMama();
            },
            abrirModalImagen(modelo, accion, data = []){
                switch(modelo){
                    case "Imagen":
                    {
                        switch(accion){

                            case 'ver':{
                                this.modalImagen=1;
                                this.tituloModal='Detalles de la Cría';
                                this.puerco_id=data['id'];
                                
                                this.descripcion=data['descripcion'];
                                this.ubicacion=data['ubicacion'];
                                
                                break;
                            }
                        }
                    }
                }

            },
            
            cerrarModalImagen(){
                this.modalImagen=0;
                this.puerco_id=0;
                this.tituloModal='';
                this.foto=null;
                this.descripcion='';
                this.ubicacion='';
            }
        },
        mounted() {
            this.listarCria(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
        
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .mostrarImagen{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>