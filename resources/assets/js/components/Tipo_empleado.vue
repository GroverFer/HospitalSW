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
                    <i class="fa fa-align-justify"></i> Tipo Empleado
                    <button type="button" @click="abrirModal('tipo_empleado','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="cargo">Cargo</option>
                                    <option value="descripcion">Descripcion</option>
                                </select>
                                <input type="text" v-model="buscar"
                                    @keyup.enter="listarTipo_empleados(1,buscar,criterio)" class="form-control"
                                    placeholder="Texto a buscar">
                                <button type="submit" @click="listarTipo_empleados(1,buscar,criterio)"
                                    class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Cargo</th>
                                <th>Descripcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="tipo_empleado in arrayTipo_empleados" :key="tipo_empleado.id">
                                <td>
                                    <button type="button"
                                        @click="abrirModal('tipo_empleado','actualizar',tipo_empleado)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="tipo_empleado.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarTipo_empleado(tipo_empleado.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarTipo_empleado(tipo_empleado.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="tipo_empleado.cargo"></td>
                                <td v-text="tipo_empleado.descripcion"></td>
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
                                <label class="col-md-3 form-control-label" for="email-input">Cargo</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="cargo" class="form-control"
                                        placeholder="Nombre del cargo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Descripcion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="descripcion" class="form-control"
                                        placeholder="Descripcion del cargo">
                                </div>
                            </div>
                            <div v-show="errorTipo_empleados" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjTipo_empleados" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarTipo_empleados()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                            @click="actualizarTipo_empleado()">Actualizar</button>
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
                cargo: '',
                descripcion: '',
                arrayTipo_empleados: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorTipo_empleados: 0,
                errorMostrarMsjTipo_empleados: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'cargo',
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
            listarTipo_empleados(page, buscar, criterio) {
                let me = this;
                var url = '/tipo_empleado?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayTipo_empleados = respuesta.tipo_empleados.data;
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
                me.listarTipo_empleados(page, buscar, criterio);
            },
            registrarTipo_empleados() {
                if (this.validarTipo_empleados()) {
                    return;
                }
                let me = this;

                axios.post('/tipo_empleado/registrar', {
                    'cargo': this.cargo,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTipo_empleados(1, '', 'descripcion');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarTipo_empleado() {
                if (this.validarTipo_empleados()) {
                    return;
                }

                let me = this;

                axios.put('/tipo_empleado/actualizar', {
                    'id': this.id,
                    'cargo': this.cargo,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTipo_empleados(1, '', 'cargo');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarTipo_empleados() {
                this.errorTipo_empleados = 0;
                this.errorMostrarMsjTipo_empleados = [];

                if (!this.cargo) this.errorMostrarMsjTipo_empleados.push("El cargo no puede estar Vacio.");
                if (!this.descripcion) this.errorMostrarMsjTipo_empleados.push(
                    "La descripcion no puede estar Vacio.");

                if (this.errorMostrarMsjTipo_empleados.length) this.errorTipo_empleados = 1;
                return this.errorTipo_empleados;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.cargo = '';
                this.descripcion = '';

            },
            abrirModal(modelo, accion, data = []) {
                switch (modelo) {
                    case "tipo_empleado": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Tipo de Empleado';
                                this.cargo = '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Tipo de Empleado';
                                this.tipoAccion = 2;
                                this.cargo = data['cargo'];
                                this.descripcion = data['descripcion'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarTipo_empleado(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro desactivar este Tipo de empleado?",
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
                                .put("/tipo_empleado/desactivar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarTipo_empleados(1, '', 'cargo');
                                    swalWithBootstrapButtons.fire(
                                        "Desactivado!",
                                        "El Tipo de empleado ha sido desactivado con exito.",
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
            activarTipo_empleado(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons
                    .fire({
                        title: "Estas seguro de Activar este Tipo de empleado?",
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
                                .put("/tipo_empleado/activar", {
                                    id: id
                                })
                                .then(function (response) {
                                    me.listarTipo_empleados(1, '', 'descripcion');
                                    swalWithBootstrapButtons.fire(
                                        "Activado!",
                                        "El Tipo de empleado ha sido activado con exito.",
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
            this.listarTipo_empleados(1, this.buscar, this.criterio);
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