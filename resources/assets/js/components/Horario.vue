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
                    <i class="fa fa-align-justify"></i> Horario
                    <button type="button" @click="abrirModal('horario','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="hora_entrada">Hora entrada</option>
                                    <option value="hora_salida">Hora salida</option>
                                    <option value="fecha_inicio">Fecha inicio</option>
                                    <option value="fecha_fin">Fecha fin</option>
                                    <option value="id_persona">Persona</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarHorario(1,buscar,criterio)"
                                    class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarHorario(1,buscar,criterio)"
                                    class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Hora Entrada</th>
                                <th>Hora Salida</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Persona</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="horario in arrayHorario" :key="horario.id">
                                <td>
                                    <button type="button" @click="abrirModal('horario','actualizar',horario)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="horario.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarHorario(horario.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarHorario(horario.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="horario.hora_entrada"></td>
                                <td v-text="horario.hora_salida"></td>
                                <td v-text="horario.fecha_inicio"></td>
                                <td v-text="horario.fecha_fin"></td>
                                <td v-text="horario.Pnombre"></td>
                                <td>
                                    <div v-if="horario.condicion">
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
                                <label class="col-md-3 form-control-label" for="start">Hora de Entrada</label>
                                <div class="col-md-9">
                                    <input type="time" v-model="hora_entrada" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="start">Hora de Salida</label>
                                <div class="col-md-9">
                                    <input type="time" v-model="hora_salida" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="start">Fecha de Inicio</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha_inicio" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="start">Fecha de Fin</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha_fin" class="form-control">
                                </div>
                            </div>




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

                            <div v-show="errorHorario" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjHorario" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarHorario()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarHorario()">Actualizar</button>
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
                hora_entrada: '',
                hora_salida: '',
                fecha_inicio: '',
                fecha_fin: '',
                id_persona: '',
                arrayHorario: [],
                arrayPersona: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorHorario: 0,
                errorMostrarMsjHorario: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'hora_entrada',
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
            listarHorario(page, buscar, criterio) {
                let me = this;
                var url = '/horario?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayHorario = respuesta.horarios.data;
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

            cambiarPagina(page, buscar, criterio) {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarHorario(page, buscar, criterio);
            },
            registrarHorario() {
                if (this.validarHorario()) {
                    return;
                }
                let me = this;

                axios.post('/horario/registrar', {
                    'id_persona': this.id_persona,
                    'hora_entrada': this.hora_entrada,
                    'hora_salida': this.hora_salida,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarHorario(1, '', 'hora_entrada');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarHorario() {
                if (this.validarHorario()) {
                    return;
                }

                let me = this;
                console.log('111')
                axios.put('/horario/actualizar', {

                    'id': this.id,
                    'id_persona': this.id_persona,
                    'hora_entrada': this.hora_entrada,
                    'hora_salida': this.hora_salida,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarHorario(1, '', 'hora_entrada');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarHorario() {
                this.errorHorario = 0;
                this.errorMostrarMsjHorario = [];

                if (!this.hora_entrada) this.errorMostrarMsjHorario.push("La hora de entrada no puede estar vacío.");
                if (!this.hora_salida) this.errorMostrarMsjHorario.push("La hora de salida no puede estar vacío.");
                if (!this.fecha_inicio) this.errorMostrarMsjHorario.push("La fecha de inicio no puede estar vacío.");
                if (!this.fecha_fin) this.errorMostrarMsjHorario.push("La fecha de final no puede estar vacío.");
                if (this.fecha_fin < this.fecha_inicio) {
                    this.errorMostrarMsjHorario.push("la fecha final tiene que ser superior a la fecha de inicio");
                }
                if (this.hora_salida < this.hora_entrada) {
                    this.errorMostrarMsjHorario.push("La hora de salida tiene que ser superior a la hora de entrada");
                }
                if (this.id_persona == 0) this.errorMostrarMsjHorario.push("Seleccione una Persona.");
                if (this.errorMostrarMsjHorario.length) this.errorHorario = 1;

                return this.errorHorario;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.hora_entrada = '';
                this.hora_salida = '';
                this.fecha_inicio = '';
                this.fecha_fin = '';
                this.id_persona = 0;
                this.errorHorario = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.selectPersona();
                switch (modelo) {
                    case "horario": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Horario';
                                this.hora_entrada = '';
                                this.hora_salida = '';
                                this.fecha_inicio = '';
                                this.fecha_fin = '';
                                this.id_persona = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                console.log(123);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Horario';
                                this.tipoAccion = 2;
                                this.hora_entrada = data['hora_entrada'];
                                this.hora_salida = data['hora_salida'];
                                this.fecha_inicio = data['fecha_inicio'];
                                this.fecha_fin = data['fecha_fin'];
                                this.id_persona = data['id_persona'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarHorario(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro desactivar este Horario?",
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
                                .put("/horario/desactivar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarHorario(1, '', 'hora_entrada');
                                    swalWithBootstrapButtons.fire(
                                        "Desactivado!",
                                        "El Horario ha sido desactivado con exito.",
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
            activarHorario(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro de Activar este Horario?",
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
                                .put("/horario/activar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarHorario(1, '', 'hora_entrada');
                                    swalWithBootstrapButtons.fire(
                                        "Activado!",
                                        "El Horario ha sido activado con exito.",
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
            this.listarHorario(1, this.buscar, this.criterio);
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