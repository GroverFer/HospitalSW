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
                    <i class="fa fa-align-justify"></i> Evento Persona
                    <button type="button" @click="abrirModal('evento_persona','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="id_persona">Persona</option>
                                    <option value="id_evento">Evento</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarEvento_persona(1,buscar,criterio)"
                                    class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarEvento_persona(1,buscar,criterio)"
                                    class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Persona</th>
                                <th>Evento</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="evento_persona in arrayEvento_persona" :key="evento_persona.id">
                                <td>
                                    <button type="button" @click="abrirModal('evento_persona','actualizar',evento_persona)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="evento_persona.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarEvento_persona(evento_persona.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarEvento_persona(evento_persona.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="evento_persona.nombrePersona"></td>
                                <td v-text="evento_persona.nombreEvento"></td>
                                <td>
                                    <div v-if="evento_persona.condicion">
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
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id"
                                            v-text="persona.nombre"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Evento</label>
                                <div class="col-md-9">
                                    <select v-model="id_evento" class="form-control">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="evento in arrayEvento" :key="evento.id" :value="evento.id"
                                            v-text="evento.nombre"></option>
                                    </select>
                                </div>
                            </div>

                            <div v-show="errorEvento_persona" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjEvento_persona" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarEvento_persona()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarEvento_persona()">Actualizar</button>
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
                id_evento: '',
                id_persona: '',
                arrayEvento_persona: [],
                arrayEvento: [],
                arrayPersona: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorEvento_persona: 0,
                errorMostrarMsjEvento_persona: [],
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
            listarEvento_persona(page, buscar, criterio) {
                let me = this;
                var url = '/evento_persona?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayEvento_persona = respuesta.eventos_personas.data;
                        me.pagination = respuesta.pagination;
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
                        me.arrayPersona = respuesta.personas;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            selectEvento() {
                let me = this;
                var url = '/evento/selectEvento';
                axios.get(url).then(function (response) {
                        //console.log(response);
                        var respuesta = response.data;
                        me.arrayEvento = respuesta.eventos;
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
                me.listarEvento_persona(page, buscar, criterio);
            },
            registrarEvento_persona() {
                if (this.validarEvento_persona()) {
                    return;
                }
                let me = this;

                axios.post('/evento_persona/registrar', {
                    'id_persona': this.id_persona,
                    'id_evento': this.id_evento,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEvento_persona(1, '', 'id_persona');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarEvento_persona() {
                if (this.validarEvento_persona()) {
                    return;
                }

                let me = this;

                axios.put('/evento_persona/actualizar', {
                    'id': this.id,
                    'id_persona': this.id_persona,
                    'id_evento': this.id_evento,
                
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEvento_persona(1, '', 'id_persona');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarEvento_persona() {
                this.errorEvento_persona = 0;
                this.errorMostrarMsjEvento_persona = [];

                if (this.id_persona == 0) this.errorMostrarMsjEvento_persona.push(
                    "Seleccione una persona.");
                if (this.id_evento == 0) this.errorMostrarMsjEvento_persona.push(
                    "Seleccione un Evento.");

                if (this.errorMostrarMsjEvento_persona.length) this.errorEvento_persona = 1;

                return this.errorEvento_persona;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.id_persona = '';
                this.id_evento = '';
                this.errorEvento_persona = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.selectPersona();
                this.selectEvento();
                switch (modelo) {
                    case "evento_persona": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Evento Persona';
                                this.id_persona = 0;
                                this.id_evento = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Evento Persona';
                                this.tipoAccion = 2;
                                this.id_persona = data['id_persona'];
                                this.id_evento = data['id_evento'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarEvento_persona(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro desactivar este Evento Persona?",
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
                                .put("/evento_persona/desactivar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarEvento_persona(1, '', 'id_persona');
                                    swalWithBootstrapButtons.fire(
                                        "Desactivado!",
                                        "El Evento Persona ha sido desactivado con exito.",
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
            activarEvento_persona(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro de Activar este Evento Persona?",
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
                                .put("/evento_persona/activar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarEvento_persona(1, '', 'id_persona');
                                    swalWithBootstrapButtons.fire(
                                        "Activado!",
                                        "El Evento Persona ha sido activado con exito.",
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
            this.listarEvento_persona(1, this.buscar, this.criterio);
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