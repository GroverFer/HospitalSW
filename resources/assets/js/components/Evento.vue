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
                    <i class="fa fa-align-justify"></i> Eventos
                    <button type="button" @click="abrirModal('evento','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Descripción</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarEventos(1,buscar,criterio)"
                                    class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarEventos(1,buscar,criterio)" class="btn btn-primary"><i
                                        class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Hora Entrada</th>
                                <th>Hora Salida</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="evento in arrayEvento" :key="evento.id">

                                <td>
                                    <button type="button"
                                        @click="abrirModal('evento','actualizar',evento)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="evento.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarEvento(evento.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarEvento(evento.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>

                                <td v-text="evento.nombre"></td>
                                <td v-text="evento.descripcion"></td>
                                <td v-text="evento.hora_entrada"></td>
                                <td v-text="evento.hora_salida"></td>
                                <td v-text="evento.fecha_inicio"></td>
                                <td v-text="evento.fecha_fin"></td>
                                <td v-text="evento.latitud"></td>
                                <td v-text="evento.longitud"></td>
                                <td>
                                    <div v-if="evento.condicion">
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
                                        placeholder="Nombre del Evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Descripcion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="descripcion" class="form-control"
                                        placeholder="Descripcion del Evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Hora Entrada</label>
                                <div class="col-md-9">
                                    <input type="time" v-model="hora_entrada" class="form-control"
                                        placeholder="Hora de Entrada del evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Hora Salida</label>
                                <div class="col-md-9">
                                    <input type="time" v-model="hora_salida" class="form-control"
                                        placeholder="Hora Salida del evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Fecha Inicio</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha_inicio" class="form-control"
                                        placeholder="Fecha Inicio del Evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Fecha Fin</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fecha_fin" class="form-control"
                                        placeholder="Fecha Fin del Evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Latitud</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="latitud" class="form-control"
                                        placeholder="Latitud">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Longitud</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="longitud" class="form-control"
                                        placeholder="Longitud">
                                </div>
                            </div>
                            <div v-show="errorEventos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjEventos" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarEventos()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarEvento()">Actualizar</button>
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
                id: 0,
                nombre: '',
                descripcion: '',
                hora_entrada: '',
                hora_salida: '',
                fecha_inicio: '',
                fecha_fin: '',
                latitud: '',
                longitud: '',
                arrayEvento: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorEventos: 0,
                errorMostrarMsjEventos: [],
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
            listarEventos(page, buscar, criterio) {
                let me = this;
                var url = '/evento?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayEvento = respuesta.eventos.data;
                        me.pagination = respuesta.pagination;
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
                me.listarEventos(page, buscar, criterio);
            },

            registrarEventos() {
                if (this.validarEventos()) {
                    return;
                }
                let me = this;

                axios.post('/evento/registrar', {
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'hora_entrada': this.hora_entrada,
                    'hora_salida': this.hora_salida,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,
                    'latitud': this.latitud,
                    'longitud': this.longitud,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEventos(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarEvento() {
                if (this.validarEventos()) {
                    return;
                }

                let me = this;

                axios.put('/evento/actualizar', {
                    'id': this.id,
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'hora_entrada': this.hora_entrada,
                    'hora_salida': this.hora_salida,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,
                    'latitud': this.latitud,
                    'longitud': this.longitud,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEventos(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarEventos() {
                this.errorEventos = 0;
                this.errorMostrarMsjEventos = [];

                if (!this.nombre) this.errorMostrarMsjEventos.push("El nombre del Evento no puede estar Vacio.");
                if (!this.descripcion) this.errorMostrarMsjEventos.push(
                    "La descripcion no puede estar Vacio.");
                if (!this.hora_entrada) this.errorMostrarMsjEventos.push("La hora de entrada no puede estar vacia");
                if (!this.hora_salida) this.errorMostrarMsjEventos.push(
                    "La hora de salida no puede estar vacia");    
                if (!this.fecha_inicio) this.errorMostrarMsjEventos.push("Fecha Inicio no puede estar vacio");
                if (!this.fecha_fin) this.errorMostrarMsjEventos.push(
                    "Fecha Fin no puede estar vacio.");
                if (!this.latitud) this.errorMostrarMsjEventos.push("La latitud del evento no puede estar vacio");
                if (!this.longitud) this.errorMostrarMsjEventos.push(
                    "La longitud del evento no puede estar vacio");

                if (this.errorMostrarMsjEventos.length) this.errorEventos = 1;
                return this.errorEventos;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.descripcion = '';
                this.hora_entrada = '';
                this.hora_salida = '';
                this.fecha_inicio = '';
                this.fecha_fin = '';
                this.latitud = '';
                this.longitud = '';
            },
            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "evento": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Evento';
                                this.nombre = '';
                                this.descripcion = '';
                                this.hora_entrada = '';
                                this.hora_salida = '';
                                this.fecha_inicio = '';
                                this.fecha_fin = '';
                                this.latitud = '';
                                this.longitud = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Evento';
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.id = data['id'];
                                this.hora_entrada = data['hora_entrada'];
                                this.hora_salida = data['hora_salida'];
                                this.fecha_inicio = data['fecha_inicio'];
                                this.fecha_fin = data['fecha_fin'];
                                this.latitud = data['latitud'];
                                this.longitud = data['longitud'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarEvento(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro desactivar este Evento?",
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
                                .put("/evento/desactivar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarEventos(1, '', 'nombre');
                                    swalWithBootstrapButtons.fire(
                                        "Desactivado!",
                                        "El Evento ha sido desactivado con exito.",
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
            activarEvento(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro de Activar este Evento?",
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
                                .put("/evento/activar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarEventos(1, '', 'nombre');
                                    swalWithBootstrapButtons.fire(
                                        "Activado!",
                                        "El Evento ha sido activado con exito.",
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
            this.listarEventos(1, this.buscar, this.criterio);
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