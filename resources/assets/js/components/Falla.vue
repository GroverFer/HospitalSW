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
                    <i class="fa fa-align-justify"></i> Falla
                    <button type="button" @click="abrirModal('jornada','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-4" v-model="criterio">
                                    <option value="fecha_hora">Fecha hora</option>
                                    <option value="id_persona">Persona</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarFalla(1,buscar,criterio)"
                                    class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarFalla(1,buscar,criterio)" class="btn btn-primary"><i
                                        class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Fecha hora</th>
                                <th>Persona</th>
                                <!-- <th>Estado</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="falla in arrayFalla" :key="falla.id">
                                <td>
                                    <button type="button" @click="abrirModal('falla','actualizar',falla)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <!-- <template v-if="falla.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarjornada(falla.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarjornada(falla.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template> -->
                                </td>
                                <td v-text="falla.fecha_hora"></td>
                                <td v-text="falla.Pnombre"></td>
                                <!-- <td>
                                    <div v-if="falla.condicion">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger">Desactivado</span>
                                    </div>

                                </td> -->
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
                                <label class="col-md-3 form-control-label" for="start">Fecha hora</label>
                                <div class="col-md-9">
                                    <input type="datetime-local" v-model="fecha_hora" class="form-control">
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

                            <div v-show="errorFalla" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjFalla" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarFalla()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarFalla()">Actualizar</button>
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
                fecha_hora: '',
                id_persona: '',
                arrayFalla: [],
                arrayPersona: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorFalla: 0,
                errorMostrarMsjFalla: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'fecha_hora',
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
            listarFalla(page, buscar, criterio) {
                let me = this;
                var url = '/falla?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayFalla = respuesta.fallas.data;
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
                me.listarFalla(page, buscar, criterio);
            },
            registrarFalla() {
                if (this.validadFalla()) {
                    return;
                }
                let me = this;

                axios.post('/falla/registrar', {
                    'id_persona': this.id_persona,
                    'fecha_hora': this.fecha_hora,
                    'hora_salida': this.hora_salida,
                    'fecha_llegada': this.fecha_llegada,
                    'fecha_salida': this.fecha_salida,

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarFalla(1, '', 'fecha_hora');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarFalla() {
                if (this.validadFalla()) {
                    return;
                }

                let me = this;
                axios.put('/falla/actualizar', {

                    'id': this.id,
                    'id_persona': this.id_persona,
                    'fecha_hora': this.fecha_hora,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarFalla(1, '', 'fecha_hora');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validadFalla() {
                this.errorFalla = 0;
                this.errorMostrarMsjFalla = [];

                if (!this.fecha_hora) this.errorMostrarMsjFalla.push("La fecha hora no puede estar vacío.");
                if (this.id_persona == 0) this.errorMostrarMsjFalla.push("Seleccione una Persona.");
                if (this.errorMostrarMsjFalla.length) this.errorFalla = 1;

                return this.errorFalla;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.fecha_hora = '';
                this.id_persona = 0;
                this.errorFalla = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.selectPersona();
                switch (modelo) {
                    case "falla": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Falta';
                                this.fecha_hora = '';
                                this.id_persona = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                console.log(123);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Falta';
                                this.tipoAccion = 2;
                                this.fecha_hora = data['fecha_hora'];
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
            this.listarFalla(1, this.buscar, this.criterio);
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