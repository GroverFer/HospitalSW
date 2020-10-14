<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Persona
                    <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="apellido">Apellido</option>
                                    <option value="email">Email</option>
                                    <option value="tipo_sangre">Tipo de Sangre</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)"
                                    class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarPersona(1,buscar,criterio)"
                                    class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>C.I.</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Genero</th>
                                <th>Telefono</th>
                                <th>Año de Experiencia</th>
                                <th>Tipo de sangre</th>
                                <th>Foto</th>
                                <th>Email</th>
                                <th>Tipo de Empleado</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="persona in arrayPersona" :key="persona.id">
                                <td>
                                    <button type="button" @click="abrirModal('persona','actualizar',persona)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> 
                                    <template v-if="persona.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarPersona(persona.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarPersona(persona.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="persona.nombre"></td>
                                <td v-text="persona.apellido"></td>
                                <td v-text="persona.ci"></td>
                                <td v-text="persona.fecha_nac"></td>
                                <td v-text="persona.genero"></td>
                                <td v-text="persona.telefono"></td>
                                <td v-text="persona.año_experiencia"></td>
                                <td v-text="persona.tipo_sangre"></td>
                                <label v-for="img in imagenes" v-bind:key="img">
                                    <td v-if="img.includes(persona.foto)"><img :src="img" class="center" width="60" height="60" alt="">
                                    </td>
                                    </label>
                                <td v-text="persona.email"></td>
                                <td v-text="persona.cargo"></td>
                                <td v-text="persona.registro"></td>
                                <td>
                                    <div v-if="persona.condicion">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger">Desactivado</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page"
                                :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)"
                                    v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#"
                                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control"
                                        placeholder="Nombre de la Persona">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Apellido</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="apellido" class="form-control"
                                        placeholder="Apellido de la Persona">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">C.I.</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="ci" class="form-control"
                                        placeholder="CI de la Persona">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="start">Fecha de nacimiento</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha_nac" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Genero de
                                    la Persona</label>
                                <div class="col-md-9">
                                    <select v-model="genero" class="form-control">
                                        <option value="0" disabled>Seleccione el genero de la Persona</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Telefono</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="telefono" class="form-control"
                                        placeholder="Telefono de la Persona">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Año de experiencia</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="año_experiencia" class="form-control"
                                        placeholder="Año de experiencia del colaborador">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Tipo de
                                    sangre</label>
                                <div class="col-md-9">
                                    <select v-model="tipo_sangre" class="form-control">
                                        <option value="0" disabled>Seleccione el tipo de sangre de la Persona</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="email" class="form-control"
                                        placeholder="Correo de la Persona">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Foto</label>
                                <form @submit.prevent="subirImagen" enctype="multipart/form-data">
                                <input @change="clickImagen($event)" type="file" accept="image/*">
                                <input type="submit" value="Subir Imagen">
                                </form>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Tipo de Empleado</label>
                                <div class="col-md-9">
                                    <select v-model="id_tipoempleado" class="form-control">
                                        <option value="0" disabled>Seleccione el Tipo de Empleado que se le asignara</option>
                                        <option v-for="tipo_empleado in arrayTipo_empleado" :key="tipo_empleado.id"
                                            :value="tipo_empleado.id" v-text="tipo_empleado.cargo"></option>
                                    </select>
                                </div>                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Usuario</label>
                                <div class="col-md-9">
                                    <select v-model="id_usuario" class="form-control">
                                        <option value="0" disabled>Seleccione al usuario que se le asignara</option>
                                        <option v-for="users in arrayUsuario" :key="users.id"
                                            :value="users.id" v-text="users.registro"></option>
                                    </select>
                                </div>
                            </div>

                            <div v-show="errorPersona" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarPersona()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarPersona()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
    </main>
</template>

<script>
import {storage} from '../firebase'
const ref = storage.ref()
    export default {
        // props: ['ruta'],
        data() {
            return {
                id: '',
                nombre: '',
                apellido: '',
                ci: '',
                fecha_nac: '',
                genero: '',
                telefono: '',
                año_experiencia: '',
                tipo_sangre: '',
                email: '',
                foto: '',
                foto_nombre: '',
                id_tipoempleado: '',
                id_usuario: '',
                arrayPersona: [],
                arrayTipo_empleado: [],
                arrayUsuario: [],

                imagenes: [],
                imagen: null,
                imagendesc: false,

                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorPersona: 0,
                errorMostrarMsjPersona: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'nombre',
                buscar: ''
            }
        },
        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;

            }
        },
        methods: {
            clickImagen(e){
                this.imagen=e.target.files[0]
                console.log(this.imagen)
            },
            subirImagen(){
                const refImg = ref.child('imagenes/'+this.imagen.name)
                this.foto_nombre=this.imagen.name
                const metadata = {contentType: 'img/jpeg'}
                refImg.put(this.imagen,metadata)
                .then(e => console.log(e))
            },
            cargarImagenes(){
                ref.child('/imagenes')
                .listAll()
                .then((res)=>{
                    console.log(res)
                    res.items.map( (item)=> {
                        ref.child(item.location.path_)
                        .getDownloadURL()
                        .then((url)=>{
                            this.imagendesc=true,
                            this.imagenes.push(url),
                            console.log(this.imagenes)
                        })
                    })
                })
            },
            listarPersona(page, buscar, criterio) {
                let me = this;
                var url = '/persona?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayPersona = respuesta.personas.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            selectTipo_empleado() {
                let me = this;
                var url = '/tipo_empleado/selectTipo_empleado';
                axios.get(url).then(function (response) {
                        //console.log(response);
                        var respuesta = response.data;
                        me.arrayTipo_empleado = respuesta.tipos_empleados;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            selectUsuario() {
                let me = this;
                var url = '/user/selectUsuario';
                axios.get(url).then(function (response) {
                        //console.log(response);
                        var respuesta = response.data;
                        me.arrayUsuario = respuesta.usuarios;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            cambiarPagina(page, buscar, criterio) {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarPersona(page, buscar, criterio);
            },
            registrarPersona() {
                if (this.validarPersona()) {
                    return;
                }
                let me = this;

                axios.post('/persona/registrar', {

                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'ci': this.ci,
                    'fecha_nac': this.fecha_nac,
                    'genero': this.genero,
                    'telefono': this.telefono,
                    'año_experiencia': this.año_experiencia,
                    'tipo_sangre': this.tipo_sangre,
                    'email': this.email,
                    'foto': this.foto_nombre,
                    'id_tipoempleado': this.id_tipoempleado,
                    'id_usuario': this.id_usuario,

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarPersona() {
                if (this.validarPersona()) {
                    return;
                }

                let me = this;

                axios.put('/persona/actualizar', {
                    'id': this.id,
                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'ci': this.ci,
                    'fecha_nac': this.fecha_nac,
                    'genero': this.genero,
                    'telefono': this.telefono,
                    'año_experiencia': this.año_experiencia,
                    'tipo_sangre': this.tipo_sangre,
                    'email': this.email,
                    'foto': this.foto_nombre,
                    'id_tipoempleado': this.id_tipoempleado,
                    'id_usuario': this.id_usuario,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarPersona() {
                this.errorPersona = 0;
                this.errorMostrarMsjPersona = [];
                if (!this.nombre) this.errorMostrarMsjPersona.push(
                    "El nombre no puede estar vacío.");
                if (!this.apellido) this.errorMostrarMsjPersona.push(
                    "El apellido no puede estar vacío.");
                if (!this.ci) this.errorMostrarMsjPersona.push(
                    "El C.I. no puede estar vacío.");
                if (!this.fecha_nac) this.errorMostrarMsjPersona.push(
                    "La fecha de nacimiento no puede estar vacío.");
                if (this.genero == 0) this.errorMostrarMsjPersona.push("Seleccione un Genero.");
                if (!this.telefono) this.errorMostrarMsjPersona.push(
                    "El Telefono no puede estar vacío.");
                if (!this.año_experiencia) this.errorMostrarMsjPersona.push(
                    "El Año de experiencia no puede estar vacío.");
                if (this.tipo_sangre == 0) this.errorMostrarMsjPersona.push("Seleccione un Tipo de sangre.");
                if (!this.email) this.errorMostrarMsjPersona.push(
                    "El correo no puede estar vacío.");
                if (!this.foto_nombre) this.errorMostrarMsjPersona.push(
                    "Seleccione una foto.");    
                if (this.id_tipoempleado == 0) this.errorMostrarMsjPersona.push("Seleccione un Tipo de Empleado.");
                if (this.id_usuario == 0) this.errorMostrarMsjPersona.push("Seleccione un Usuario.");

                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';

                this.nombre = '';
                this.apellido = '';
                this.ci = '',
                this.fecha_nac = '',
                this.genero = '',
                this.telefono = '',
                this.año_experiencia = '',
                this.tipo_sangre = '',
                this.email = '',
                this.foto = '',
                this.imagen='',
                this.id_tipoempleado = 0;
                this.id_usuario = 0;

                this.errorPersona = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.selectTipo_empleado();
                this.selectUsuario();
                switch (modelo) {
                    case "persona": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Persona';

                                this.nombre = '';
                                this.apellido = '';
                                this.ci = '',
                                this.fecha_nac = '',
                                this.genero = '',
                                this.telefono = '',
                                this.año_experiencia = '',
                                this.tipo_sangre = '',
                                this.email = '',
                                this.foto = '',
                                this.foto_nombre='',
                                this.imagen='',
                                this.id_tipoempleado = 0;
                                this.id_usuario = 0;

                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Persona';
                                this.tipoAccion = 2;

                                this.nombre = data['nombre'];
                                this.apellido = data['apellido'];
                                this.ci = data['ci'],
                                this.fecha_nac = data['fecha_nac'],
                                this.genero = data['genero'],
                                this.telefono = data['telefono'],
                                this.año_experiencia = data['año_experiencia'],
                                this.tipo_sangre = data['tipo_sangre'],
                                this.email = data['email'],
                                this.foto = data['foto'],
                                this.foto_nombre=data['foto'],
                                this.imagen='',
                                this.id_tipoempleado = data['id_tipoempleado'];
                                this.id_usuario = data['id_usuario'];

                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarPersona(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro desactivar esta Persona?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Aceptar",
                        cancelButtonText: "Cancelar",
                        reverseButtons: true
                    })
                    .then(result => {
                        if (result.value) {
                            let me = this;
                            axios
                                .put("/persona/desactivar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarPersona(1, '', 'nombre');
                                    swalWithBootstrapButtons.fire(
                                        "Desactivado!",
                                        "La Persona ha sido desactivado con exito.",
                                        "success"
                                    );
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {}
                    });
            },
            activarPersona(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro de Activar esta Persona?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Aceptar",
                        cancelButtonText: "Cancelar",
                        reverseButtons: true
                    })
                    .then(result => {
                        if (result.value) {
                            let me = this;
                            axios
                                .put("/persona/activar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarPersona(1, '', 'nombre');
                                    swalWithBootstrapButtons.fire(
                                        "Activado!",
                                        "La Persona ha sido activado con exito.",
                                        "success"
                                    );
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {}
                    });
            },
        },
        mounted() {
            this.listarPersona(1, this.buscar, this.criterio);
            this.cargarImagenes();
        }
    }
</script>
<style>
    .modal-body {
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }

    .modal-content {
        width: 100% !important;
        position: absolute !important;
    }

    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }

    .div-error {
        display: flex;
        justify-content: center;
    }

    .text-error {
        color: red !important;
        font-weight: bold;
    }
</style>