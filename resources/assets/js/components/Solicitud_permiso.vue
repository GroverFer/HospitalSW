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
                    <i class="fa fa-align-justify"></i> Solicitud de permiso
                    <button type="button" @click="abrirModal('solicitud_permiso','registrar')"
                        class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-4" v-model="criterio">
                                    
                                    <option value="motivo">Motivo</option>
                                    <option value="fecha_inicio">Fecha Inicio</option>
                                    <option value="fecha_fin">Fecha Fin</option>
                                    <option value="id_persona">Persona</option>
                                    <option value="id_tipopermiso">Tipo de permiso</option>
                                </select>
                                <input type="text" v-model="buscar"
                                    @keyup.enter="listarSolicitud_permiso(1,buscar,criterio)" class="form-control"
                                    placeholder="Texto a buscar">
                                <button type="submit" @click="listarSolicitud_permiso(1,buscar,criterio)"
                                    class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Motivo</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Persona</th>
                                <th>Tipo de permiso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="solicitud_permiso in arraySolicitud_permiso" :key="solicitud_permiso.id">
                                <td>
                                    <button type="button"
                                        @click="abrirModal('solicitud_permiso','actualizar',solicitud_permiso)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                </td>
                                <td v-text="solicitud_permiso.motivo"></td>
                                <td v-text="solicitud_permiso.fecha_inicio"></td>
                                <td v-text="solicitud_permiso.fecha_fin"></td>
                                <td v-text="solicitud_permiso.nombrePersona"></td>
                                <td v-text="solicitud_permiso.tipoTipo_permiso"></td>
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
                                <label class="col-md-3 form-control-label" for="email-input">Motivo</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="motivo" class="form-control"
                                        placeholder="motivo de la solicitud">
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
                                        <option value="0" disabled>Seleccione una persona</option>
                                        <option v-for="persona in arrayPersonas" :key="persona.id" :value="persona.id"
                                            v-text="persona.nombre"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Tipo de permiso</label>
                                <div class="col-md-9">
                                    <select v-model="id_tipopermiso" class="form-control">
                                        <option value="0" disabled>Seleccione un tipo de permiso</option>
                                        <option v-for="tipo_permiso in arrayTipo_permiso" :key="tipo_permiso.id"
                                            :value="tipo_permiso.id" v-text="tipo_permiso.nombre"></option>
                                    </select>
                                </div>
                            </div>
                            <div v-show="errorSolicitud_permiso" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjSolicitud_permiso" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarSolicitud_permiso()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarSolicitud_permiso()">Actualizar</button>
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
                motivo: '',
                fecha_inicio: '',
                fecha_fin: '',
                tipo: '',
                persona: '',
                id_tipopermiso: '',
                id_persona: '',
                arraySolicitud_permiso: [],
                arrayTipo_permiso: [],
                arrayPersonas: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorSolicitud_permiso: 0,
                errorMostrarMsjSolicitud_permiso: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'motivo',
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
            listarSolicitud_permiso(page, buscar, criterio) {
                let me = this;
                var url = '/solicitud_permiso?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arraySolicitud_permiso = respuesta.solicitud_permisos.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            selectTipo_permiso() {
                let me = this;
                var url = '/tipo_permiso/selectTipo_permiso';
                axios.get(url).then(function (response) {
                        //console.log(response);
                        var respuesta = response.data;
                        me.arrayTipo_permiso = respuesta.tipo_permisos;
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
                me.listarSolicitud_permiso(page, buscar, criterio);
            },
            registrarSolicitud_permiso() {
                if (this.validarSolicitud_permiso()) {
                    return;
                }
                let me = this;
                axios.post('/solicitud_permiso/registrar', {
                    'motivo': this.motivo,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,
                    'id_tipopermiso': this.id_tipopermiso,
                    'id_persona': this.id_persona
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarSolicitud_permiso(1, '', 'id_tipopermiso');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarSolicitud_permiso() {
                if (this.validarSolicitud_permiso()) {
                    return;
                }
                let me = this;
                axios.put('/solicitud_permiso/actualizar', {
                    'motivo': this.motivo,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,
                    'id_tipopermiso': this.id_tipopermiso,
                    'id_persona': this.id_persona,
                    'id': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarSolicitud_permiso(1, '', 'id_tipopermiso');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarSolicitud_permiso() {
                this.errorSolicitud_permiso = 0;
                this.errorMostrarMsjSolicitud_permiso = [];

                if (!this.motivo) this.errorMostrarMsjSolicitud_permiso.push("El motivo no puede estar vacio.");
                if (!this.fecha_inicio) this.errorMostrarMsjSolicitud_permiso.push(
                    "la fecha de inicio no puede estar vacio.");
                if (!this.fecha_fin) this.errorMostrarMsjSolicitud_permiso.push(
                    "la fecha de final no puede estar vacio.");
                if (this.fecha_fin < this.fecha_inicio)
                    this.errorMostrarMsjJornada.push("la fecha fin tiene que ser superior a la fecha de inicio");

                if (this.id_persona == 0) this.errorMostrarMsjSolicitud_permiso.push("Seleccione una persona.");
                if (this.id_tipopermiso == 0) this.errorMostrarMsjSolicitud_permiso.push(
                    "Seleccione un tipo de permiso.");
                if (this.errorMostrarMsjSolicitud_permiso.length) this.errorSolicitud_permiso = 1;
                return this.errorSolicitud_permiso;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.id_tipopermiso = 0;
                this.id_persona = 0;
                this.errorSolicitud_permiso = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.selectTipo_permiso();
                this.selectPersona();
                switch (modelo) {
                    case "solicitud_permiso": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Solicitud de permiso';
                                this.motivo = '';
                                this.fecha_inicio = '';
                                this.fecha_fin = '';
                                this.id_tipopermiso = 0;
                                this.id_persona = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Solicitud de permiso';
                                this.tipoAccion = 2;
                                this.motivo = data['motivo'];
                                this.fecha_inicio = data['fecha_inicio'];
                                this.fecha_fin = data['fecha_fin'];
                                this.id_tipopermiso = data['id_tipopermiso'];
                                this.id_persona = data['id_persona'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },

        },
        mounted() {
            this.listarSolicitud_permiso(1, this.buscar, this.criterio);
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