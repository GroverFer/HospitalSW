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
                    <i class="fa fa-align-justify"></i> Usuarios
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
                                    <option value="num_documento">Documento</option>
                                    <option value="email">Email</option>
                                    <option value="telefono">Teléfono</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarUsuario(1,buscar,criterio)"
                                    class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarUsuario(1,buscar,criterio)"
                                    class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>Tipo Documento</th>
                                <th>Número</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Usuario</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="usuario in arrayUsuario" :key="usuario.id">
                                <td>
                                    <button type="button" @click="abrirModal('persona','actualizar',usuario)"
                                        class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="usuario.condicion">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarUsuario(usuario.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm"
                                            @click="activarUsuario(usuario.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="usuario.apellido"></td>
                                <td v-text="usuario.nombre"></td>
                                <td v-text="usuario.tipo_documento"></td>
                                <td v-text="usuario.num_documento"></td>
                                <td v-text="usuario.telefono"></td>
                                <td v-text="usuario.email"></td>
                                <td v-text="usuario.usuario"></td>
                                <td v-text="usuario.rol"></td>
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
                                <label class="col-md-3 form-control-label" for="email-input">Colaborador</label>
                                <div class="col-md-9">
                                    <select v-model="idper" class="form-control">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id"
                                            v-text="persona.apellido +' '+persona.nombre"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Role</label>
                                <div class="col-md-9">
                                    <select v-model="idrol" class="form-control">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="role in arrayRol" :key="role.id" :value="role.id"
                                            v-text="role.nombre"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Usuario</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="usuario" class="form-control"
                                        placeholder="Nombre del usuario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">password</label>
                                <div class="col-md-9">
                                    <input type="password" v-model="password" class="form-control"
                                        placeholder="password del usuario">
                                </div>
                            </div>
                            <div v-show="errorUsuario" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjUsuario" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                            @click="registrarUsuario()">Guardar</button>
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
    export default {
        // props: ['ruta'],
        data() {
            return {
                id: '',
                usuario: '',
                password: '',
                idrol: '',
                idper: '',
                arrayUsuario: [],
                arrayRol: [],
                arrayPersona: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorUsuario: 0,
                errorMostrarMsjUsuario: [],
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
            listarUsuario(page, buscar, criterio) {
                let me = this;
                var url = '/user?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        me.arrayUsuario = respuesta.usuarios.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            selectRol() {
                let me = this;
                var url = '/rol/selectRol';
                axios.get(url).then(function (response) {
                        //console.log(response);
                        var respuesta = response.data;
                        me.arrayRol = respuesta.roles;
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
                me.listarUsuario(page, buscar, criterio);
            },
            registrarUsuario() {
                if (this.validarPersona()) {
                    return;
                }
                let me = this;

                axios.post('/user/registrar', {
                    'idper': this.idper,
                    'idrol': this.idrol,
                    'usuario': this.usuario,
                    'password': this.password

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuario(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarPersona() {
                if (this.validarPersona()) {
                    return;
                }

                let me = this;

                axios.put('/user/actualizar', {

                    'id': this.id,
                    'idrol': this.idrol,
                    'usuario': this.usuario,
                    'password': this.password,
                    'idper': this.idper
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuario(1, '', 'nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarPersona() {
                this.errorUsuario = 0;
                this.errorMostrarMsjUsuario = [];

                if (this.idper == 0) this.errorMostrarMsjUsuario.push("Seleccione una Colaborador.");
                if (!this.usuario) this.errorMostrarMsjUsuario.push("El nombre de usuario no puede estar vacío.");
                if (!this.password) this.errorMostrarMsjUsuario.push("La password del usuario no puede estar vacía.");
                if (this.idrol == 0) this.errorMostrarMsjUsuario.push("Seleccione una Role.");
                if (this.errorMostrarMsjUsuario.length) this.errorUsuario = 1;

                return this.errorUsuario;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.tipo_documento = 'DNI';
                this.num_documento = '';
                this.direccion = '';
                this.telefono = '';
                this.email = '';
                this.usuario = '';
                this.password = '';
                this.idrol = 0;
                this.errorUsuario = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.selectRol();
                this.selectPersona();
                switch (modelo) {
                    case "persona": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Usuario';
                                this.usuario = '';
                                this.password = '';
                                this.idrol = 0;
                                this.idper = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Usuario';
                                this.tipoAccion = 2;
                                this.idper = data['idper'];
                                this.usuario = data['usuario'];
                                this.password = data['password'];
                                this.idrol = data['idrol'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarUsuario(id) {
                swal({
                    title: 'Esta seguro de desactivar este usuario?',
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

                        axios.put(this.ruta + '/user/desactivar', {
                            'id': id
                        }).then(function (response) {
                            me.listarUsuario(1, '', 'nombre');
                            swal(
                                'Desactivado!',
                                'El registro ha sido desactivado con éxito.',
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
            activarUsuario(id) {
                swal({
                    title: 'Esta seguro de activar este usuario?',
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

                        axios.put(this.ruta + '/user/activar', {
                            'id': id
                        }).then(function (response) {
                            me.listarUsuario(1, '', 'nombre');
                            swal(
                                'Activado!',
                                'El registro ha sido activado con éxito.',
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
        },
        mounted() {
            this.listarUsuario(1, this.buscar, this.criterio);
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