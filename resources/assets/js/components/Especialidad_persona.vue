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
                    <i class="fa fa-align-justify"></i> Especialidad Persona
                    <button type="button" @click="abrirModal('especialidad_persona','registrar')"
                        class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="id_persona">Persona</option>
                                    <option value="id_especialidad">Especialidad</option>
                                </select>
                                <input type="text" v-model="buscar"
                                    @keyup.enter="listarEspecialidad_persona(1,buscar,criterio)" class="form-control"
                                    placeholder="Texto a buscar">
                                <button type="submit" @click="listarEspecialidad_persona(1,buscar,criterio)"
                                    class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Persona</th>
                                <th>Especialidad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="especialidad_persona in arrayEspecialidad_persona"
                                :key="especialidad_persona.id">
                                <td>
                                    <button type="button"
                                        @click="abrirModal('especialidad_persona','actualizar',especialidad_persona)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="especialidad_persona.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarEspecialidad_persona(especialidad_persona.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarEspecialidad_persona(especialidad_persona.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="especialidad_persona.Npersona"></td>
                                <td v-text="especialidad_persona.Nespecialidad"></td>
                                <td>
                                    <div v-if="especialidad_persona.condicion">
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
                                <label class="col-md-3 form-control-label" for="email-input">Persona</label>
                                <div class="col-md-9">
                                    <select v-model="id_persona" class="form-control">
                                        <option value="0" disabled>Seleccione una persona</option>
                                        <option v-for="persona in arrayPersonas" :key="persona.id" :value="persona.id"
                                            v-text="persona.nombre"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Especialidad</label>
                                <div class="col-md-9">
                                    <select v-model="id_especialidad" class="form-control">
                                        <option value="0" disabled>Seleccione una especialidad</option>
                                        <option v-for="especialidad in arrayEspecialidad" :key="especialidad.id"
                                            :value="especialidad.id" v-text="especialidad.nombre"></option>
                                    </select>
                                </div>
                            </div>
                            <div v-show="errorEspecialidad_persona" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjEspecialidad_persona" :key="error"
                                        v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarEspecialidad_persona()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarEspecialidad_persona()">Actualizar</button>
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
                especialidad: '',
                persona: '',
                id_especialidad: '',
                id_persona: '',
                arrayEspecialidad_persona: [],
                arrayEspecialidad: [],
                arrayPersonas: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorEspecialidad_persona: 0,
                errorMostrarMsjEspecialidad_persona: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'id_persona',
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
            listarEspecialidad_persona(page, buscar, criterio) {
                let me = this;
                var url = '/especialidad_persona?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayEspecialidad_persona = respuesta.especialidades_personas.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            selectEspecialidad() {
                let me = this;
                var url = '/especialidad/selectEspecialidad';
                axios.get(url).then(function (response) {
                        //console.log(response);
                        var respuesta = response.data;
                        me.arrayEspecialidad = respuesta.especialidades;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            selectPersona() {
                let me = this;
                var url = '/persona/selectPersona';
                axios.get(url).then(function (response) {
                        //console.log(response);
                        var respuesta = response.data;
                        me.arrayPersonas = respuesta.personas;
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
            registrarEspecialidad_persona() {
                if (this.validarEspecialidad_persona()) {
                    return;
                }
                let me = this;
                axios.post('/especialidad_persona/registrar', {
                    'id_especialidad': this.id_especialidad,
                    'id_persona': this.id_persona
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEspecialidad_persona(1, '', 'id_especialidad');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarEspecialidad_persona() {
                if (this.validarEspecialidad_persona()) {
                    return;
                }
                let me = this;
                axios.put('/especialidad_persona/actualizar', {
                    'id_especialidad': this.id_especialidad,
                    'id_persona': this.id_persona,
                    'id': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEspecialidad_persona(1, '', 'id_especialidad');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarEspecialidad_persona() {
                this.errorEspecialidad_persona = 0;
                this.errorMostrarMsjEspecialidad_persona = [];
                if (this.id_persona == 0) this.errorMostrarMsjEspecialidad_persona.push("Seleccione una persona.");
                if (this.id_especialidad == 0) this.errorMostrarMsjEspecialidad_persona.push(
                    "Seleccione una especialidad.");
                if (this.errorMostrarMsjEspecialidad_persona.length) this.errorEspecialidad_persona = 1;
                return this.errorEspecialidad_persona;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.id_especialidad = 0;
                this.id_persona = 0;
                this.errorEspecialidad_persona = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.selectEspecialidad();
                this.selectPersona();
                switch (modelo) {
                    case "especialidad_persona": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Especialidad Persona';
                                this.id_especialidad = 0;
                                this.id_persona = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Especialidad';
                                this.tipoAccion = 2;
                                this.id_especialidad = data['id_especialidad'];
                                this.id_persona = data['id_persona'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarEspecialidad_persona(id) {
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
                                .put("/especialidad_persona/desactivar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarEspecialidad_persona(1, '', 'id_especialidad');
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
            activarEspecialidad_persona(id) {
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
                                .put("/especialidad_persona/activar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarEspecialidad_persona(1, '', 'id_especialidad');
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
            this.listarEspecialidad_persona(1, this.buscar, this.criterio);
        }
    }
</script>
<style>
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