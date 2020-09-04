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
                    <i class="fa fa-align-justify"></i> Colaborador
                    <button type="button" @click="abrirModal('especialidad','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Descripcion</option>
                                    <option value="iddepar">Departamento</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarEspecialidad(1,buscar,criterio)"
                                    class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarEspecialidad(1,buscar,criterio)"
                                    class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Departamento</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de nacimiento</th>
                                <th>Genero</th>
                                <th>Tipo de sangre</th>
                                <th>Telefono</th>
                                <th>Tipo documento</th>
                                <th>Numero de documento</th>
                                <th>Email</th>
                                <th>Año de experiencia</th>
                                <th>Registro</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="colaborador in arrayColaborador" :key="especialidad.id">
                                <td>
                                    <button type="button" @click="abrirModal('especialidad','actualizar',especialidad)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="colaborador.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarEspecialidad(colaborador.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarEspecialidad(colaborador.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="colaborador.nombre"></td>
                                <td v-text="colaborador.descripcion"></td>
                                <td v-text="colaborador.depa"></td>
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
                                        placeholder="Nombre de colaborador">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Apellido</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="apellido" class="form-control"
                                        placeholder="Apellido de colaborador">
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
                                    colaborador</label>
                                <div class="col-md-9">
                                    <select v-model="genero" class="form-control">
                                        <option value="0" disabled>Seleccione el genero de colaborador</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Tipo de
                                    sangre</label>
                                <div class="col-md-9">
                                    <select v-model="tipo_sangre" class="form-control">
                                        <option value="0" disabled>Seleccione el tipo de sangre del colaborador</option>
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
                                <label class="col-md-3 form-control-label" for="email-input">Telefono</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="telefono" class="form-control"
                                        placeholder="Telefono de colaborador">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Tipo de
                                    documento</label>
                                <div class="col-md-9">
                                    <select v-model="tipo_documento" class="form-control">
                                        <option value="0" disabled>Seleccione el tipo de documento del colaborador
                                        </option>
                                        <option value="Pasaporte">Pasaporte</option>
                                        <option value="Cedula de identidad">Cedula de identidad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Numero de documento</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="num_documento" class="form-control"
                                        placeholder="Numero de documento del colaborador">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="email" class="form-control"
                                        placeholder="Correo del colaborador">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Año de experiencia</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="anio_experiencia" class="form-control"
                                        placeholder="Año de experiencia del colaborador">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Registro</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="registro" class="form-control"
                                        placeholder="Registro del colaborador">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Foto</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="foto" class="form-control"
                                        placeholder="Foto del colaborador">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Departamento</label>
                                <div class="col-md-9">
                                    <select v-model="iddepar" class="form-control">
                                        <option value="0" disabled>Seleccione al departamento que se asignara</option>
                                        <option v-for="departamento in arrayDepartamento" :key="departamento.id"
                                            :value="departamento.id" v-text="departamento.nombre"></option>
                                    </select>
                                </div>
                            </div>

                            <div v-show="errorColaborador" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjColaborador" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarColaborador()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarEspecialidad()">Actualizar</button>
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
    export default {
        // props: ['ruta'],
        data() {
            return {
                id: '',
                nombre: '',
                apellido: '',
                fecha_nac: '',
                genero: '',
                tipo_sangre: '',
                telefono: '',
                tipo_documento: '',
                num_documento: '',
                email: '',
                anio_experiencia: '',
                registro: '',
                foto: '',
                iddepar: '',
                arrayColaborador: [],
                arrayDepartamento: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorColaborador: 0,
                errorMostrarMsjColaborador: [],
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
            listarEspecialidad(page, buscar, criterio) {
                let me = this;
                var url = '/especialidad?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayColaborador = respuesta.especialidades.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            selectDep() {
                let me = this;
                var url = '/departamento/selectDep';
                axios.get(url).then(function (response) {
                        //console.log(response);
                        var respuesta = response.data;
                        me.arrayDepartamento = respuesta.departamentos;
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
                me.listarEspecialidad(page, buscar, criterio);
            },
            registrarColaborador() {
                if (this.validarColaborador()) {
                    return;
                }
                let me = this;

                axios.post('/persona/registrar', {

                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'fecha_nac': this.fecha_nac,
                    'genero': this.genero,
                    'tipo_sangre': this.tipo_sangre,
                    'telefono': this.telefono,
                    'tipo_documento': this.tipo_documento,
                    'num_documento': this.num_documento,
                    'email': this.email,
                    'anio_experiencia': this.anio_experiencia,
                    'registro': this.registro,
                    'foto': this.foto,
                    'iddepar': this.iddepar

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEspecialidad(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarEspecialidad() {
                if (this.validarColaborador()) {
                    return;
                }

                let me = this;

                axios.put('/especialidad/actualizar', {
                    'id': this.id,
                    'iddepar': this.iddepar,
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEspecialidad(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarColaborador() {
                this.errorColaborador = 0;
                this.errorMostrarMsjColaborador = [];
                if (!this.nombre) this.errorMostrarMsjColaborador.push(
                    "El nombre no puede estar vacío.");
                if (!this.apellido) this.errorMostrarMsjColaborador.push(
                    "El apellido no puede estar vacío.");
                if (!this.fecha_nac) this.errorMostrarMsjColaborador.push(
                    "La fecha de nacimiento no puede estar vacío.");
                if (this.genero == 0) this.errorMostrarMsjColaborador.push("Seleccione un Genero.");
                if (this.tipo_sangre == 0) this.errorMostrarMsjColaborador.push("Seleccione un Tipo de sangre.");
                if (!this.telefono) this.errorMostrarMsjColaborador.push(
                    "El Telefono no puede estar vacío.");
                if (this.tipo_documento == 0) this.errorMostrarMsjColaborador.push("Seleccione un Tipo de documento.");
                if (!this.num_documento) this.errorMostrarMsjColaborador.push(
                    "El Numero de documento no puede estar vacío.");
                if (!this.email) this.errorMostrarMsjColaborador.push(
                    "El correo no puede estar vacío.");
                if (!this.anio_experiencia) this.errorMostrarMsjColaborador.push(
                    "El Año de experiencia no puede estar vacío.");
                if (!this.registro) this.errorMostrarMsjColaborador.push(
                    "El Registro no puede estar vacío.");
                if (!this.foto) this.errorMostrarMsjColaborador.push(
                    "La foto no puede estar vacío.");
                if (this.iddepar == 0) this.errorMostrarMsjColaborador.push("Seleccione un Departamento.");

                if (this.errorMostrarMsjColaborador.length) this.errorColaborador = 1;

                return this.errorColaborador;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.descripcion = '';
                this.iddepar = 0;
                this.errorColaborador = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.selectDep();
                switch (modelo) {
                    case "especialidad": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar de Colaborador';
                                this.nombre = '';
                                this.apellido = '';
                                this.fecha_nac = '';
                                this.genero = 0;
                                this.tipo_sangre = 0;
                                this.telefono = '';
                                this.tipo_documento = 0;
                                this.num_documento = '';
                                this.email = '';
                                this.anio_experiencia = '';
                                this.registro = '';
                                this.foto = '';
                                this.iddepar = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Colaborador';
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.iddepar = data['iddepar'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarEspecialidad(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro desactivar este Especialidad?",
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
                                .put("/especialidad/desactivar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarEspecialidad(1, '', 'nombre');
                                    swalWithBootstrapButtons.fire(
                                        "Desactivado!",
                                        "La Especialidad ha sido desactivado con exito.",
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
            activarEspecialidad(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro de Activar esta Especialidad?",
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
                                .put("/especialidad/activar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarEspecialidad(1, '', 'nombre');
                                    swalWithBootstrapButtons.fire(
                                        "Activado!",
                                        "La Especialidad ha sido activado con exito.",
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
            this.listarEspecialidad(1, this.buscar, this.criterio);
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