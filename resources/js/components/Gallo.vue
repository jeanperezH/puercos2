<template>
    <div class="container">

      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> Gallos
              <button type="button" @click="abrirModal('gallo','registrar')" class="btn btn-success">
                  <i class="fas fa-plus-square"></i>&nbsp;Nuevo
              </button>
          </div>

          <div class="card-body">
              <div class="form-group row">
                  <div class="col-md-6">
                      <div class="input-group">
                          <select class="form-control col-md-3" v-model="criterio">
                            <option value="nombre">Gallo</option>
                            <option value="fecha_nacimiento">Fecha Nacimiento</option>
                            <option value="raza">Raza</option>
                            <option value="color">Color</option>
                          </select>
                          <input type="text" v-model="buscar" @keyup.enter="listarGallo(1,buscar,criterio)" class="form-control" placeholder="Buscar Gallo">
                          <button type="submit" @click="listarGallo(1,buscar,criterio)" class="btn btn-success"><i class="fas fa-search-location"></i> Buscar</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr class="table-danger">
                        <th scope="col">Opciones</th>
                        <th scope="col">Gallo</th>
                        <th scope="col">Raza</th>
                        <th scope="col">Color</th>
                        <th scope="col">Fecha Nacimiento</th>
                        <th scope="col">Edad</th>
                        
                        <th scope="col">Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="puerco in arrayGallo" :key="puerco.id">
                        <td class="table-success">
                          <button type="button" @click="abrirModal('gallo','actualizar',puerco)" class="btn btn-warning btn-sm" >
                            <i class="fas fa-pen"></i>
                          </button>
                          <button type="button" @click="abrirModalImagen('Imagen','ver',puerco)" class="btn btn-success btn-sm" >
                            <i class="fas fa-eye"></i>
                          </button>
                          <template v-if="puerco.estado">
                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarGallo(puerco.id)">
                              <i class="fas fa-trash"></i>
                            </button>
                          </template>
                          <template v-else>
                            <button type="button" class="btn btn-info btn-sm" @click="activarGallo(puerco.id)">
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
                      <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                    <div class="col-md-9">
                      <input type="text" v-model="nombre" class="form-control" placeholder="nombre del gallo">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Raza</label>
                    <div class="col-md-9">
                      <input type="text" v-model="raza" class="form-control" placeholder="raza del gallo">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Color</label>
                    <div class="col-md-9">
                      <input type="text" v-model="color" class="form-control" placeholder="color del gallo">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                    <div class="col-md-9">
                      <input type="date" v-model="fecha_nacimiento" class="form-control" >                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Ubicacion</label>
                    <div class="col-md-9">
                      <input type="text" v-model="ubicacion" class="form-control" placeholder="ubicación del gallo">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                    <div class="col-md-9">
                      <input type="text" v-model="descripcion" class="form-control" placeholder="descripcion del gallo">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input" >Foto</label>
                    <div class="col-md-9">
                      <input type="file" id="foto" ref="foto" v-on:change="img()" class="form-control" accept="image/*"/>
                    </div>
                  </div>
                        
                  <div v-show="errorGallo" class="form-group row div-error">
                    <div class="text-center text-error">
                      <div v-for="error in errorMostrarMsjGallo" :key="error" v-text="error">

                      </div>
                    </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
              <button type="button" v-if="tipoAccion==1" class="btn btn-success" @click="registrarGallo()">Guardar</button>
              <button type="button" v-if="tipoAccion==2" class="btn btn-success" @click="actualizarGallo()">Actualizar</button>
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
              
              <center><img :src="this.foto" class="rounded"  width="100%"><br>
              <div class="card border-success mb-3" style="max-width: 18rem;">
                <div class="card-header ">DETALLES DEL GALLO</div>
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
        data (){
            return {
                puerco_id: 0,
                nombre : '',
                raza : '',
                color : '',
                fecha_nacimiento : '',
                ubicacion : '',
                descripcion : '',
                estado : '',
                foto : null,
                arrayGallo : [],
                modal : 0,
                modalImagen:0,
                tituloModal : '',
                tipoAccion : 0,
                errorGallo : 0,
                errorMostrarMsjGallo : [],
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
            listarGallo (page,buscar,criterio){
                let me=this;
                var url= '/gallo?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayGallo = respuesta.puercos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            img() {
            this.foto = this.$refs.foto.files[0];
            },
            
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarGallo(page,buscar,criterio);
            },
            registrarGallo(){
                if (this.validarGallo()){
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
                formData.append('foto', me.foto);
                axios.post( '/gallo/registrar',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then(function(){
                    me.cerrarModal();
                    me.listarGallo(1,'','nombre');
                })
                .catch(function(error){
                console.log(error);
                });
                    
            },
            actualizarGallo(){
               if (this.validarGallo()){
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
                formData.append('foto', me.foto);
                formData.append("_method", "put");
                axios.post( 'gallo/actualizar',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then(function(){
                    me.cerrarModal();
                    me.listarGallo(1,'','nombre');
                })
                .catch(function(error){
                console.log(error);
                });

            },
            desactivarGallo(id){
               swal({
                title: 'Esta seguro de desactivar a este gallo?',
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

                    axios.post('/gallo/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarGallo();
                        swal(
                        'Desactivado!',
                        'El gallo ha sido desactivado',
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
            activarGallo(id){
               swal({
                title: 'Esta seguro de activar a este gallo?',
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

                    axios.put('/gallo/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarGallo();
                        swal(
                        'Activado!',
                        'El gallo ha sido activado con éxito.',
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
            validarGallo(){
                this.errorGallo=0;
                this.errorMostrarMsjGallo =[];

                if (!this.nombre) this.errorMostrarMsjGallo.push("Ingrese el nombre de Gallo ");
                if (!this.fecha_nacimiento) this.errorMostrarMsjGallo.push("ingrese una fecha de nacimiento");
                
                if(this.foto){
                  if (!(/\.(jpg|png|gif)$/i).test(foto.value)) this.errorMostrarMsjGallo.push("Ingrese una foto válida .jpg .png");
                }
                
                
                if (this.errorMostrarMsjGallo.length) this.errorGallo = 1;

                return this.errorGallo;
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
                this.errorGallo=0;
                this.tipoAccion=0;

            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "gallo":
                    {
                        switch(accion){
                            case 'registrar':{
                                this.modal = 1;
                                this.tituloModal = 'Registrar gallo';
                                this.nombre='';
                                this.raza='';
                                this.color='';
                                this.fecha_nacimiento='';
                                this.ubicacion='';
                                this.descripcion='';
                                this.estado='';
                                this.foto=null;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':{
                                this.modal=1;
                                this.tituloModal='Actualizar gallo';
                                this.tipoAccion=2;
                                this.puerco_id=data['id_gallo'];
                                this.nombre = data['nombre'];
                                this.raza = data['raza'];
                                this.color = data['color'];
                                this.fecha_nacimiento = data['fecha_nacimiento'];
                                this.ubicacion = data['ubicacion'];
                                this.descripcion = data['descripcion'];
                                this.estado = data['estado'];
                                //this.foto=['foto'];
                                break;
                            }
                        }
                    }
                }

            },
            abrirModalImagen(modelo, accion, data = []){
                switch(modelo){
                    case "Imagen":
                    {
                        switch(accion){

                            case 'ver':{
                                this.modalImagen=1;
                                this.tituloModal='Imagen del Gallo';
                                this.puerco_id=data['id'];
                                this.foto = data['foto'];
                                this.descripcion=data['descripcion'];
                                this.ubicacion=data['ubicacion'];
                                /*let rename = this.foto.slice(6, -1  );
                                this.foto = "storage"+rename+"g";*/
                                let rename = this.foto.replace('public','storage')
                                this.foto = rename;
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
            this.listarGallo(1,this.buscar,this.criterio);
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