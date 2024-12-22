// script.js

// Función para cargar módulos
function cargarModulo(modulo) {
    const contenidoCentral = $('#contenido-central');
    console.log('Intentando cargar el módulo:', modulo);

    $.ajax({
        url: modulo,
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
            console.log('Cargando módulo: ' + modulo);
        },
        success: function(data) {
            contenidoCentral.html(data);
            console.log('Módulo cargado correctamente:', modulo);

            // Inicializar el JS específico del módulo cargado
            if (modulo.includes('mod_perfil')) {
                inicializarPerfil();
            }
            if (modulo.includes('mod_crear_club')) {
                inicializarCrearClub();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar el módulo:', status, error);
            contenidoCentral.html('<p>Error al cargar el contenido solicitado. Verifique que el archivo esté en la ruta correcta.</p>');
        },
        complete: function() {
            console.log('Finalizada la carga del módulo: ' + modulo);
        }
    });
}

// Función para abrir/cerrar el menú hamburguesa
function abrirCerrarMenu() {
    const menu = $('#menu-principal');
    menu.toggleClass('mostrar');
}

// Funciones para abrir y cerrar los modales
function abrirLogin() {
    $('#loginModal').css('display', 'flex');
}
function cerrarLogin() {
    $('#loginModal').hide();
}
function abrirRegistro() {
    $('#registroModal').css('display', 'flex');
}
function cerrarRegistro() {
    $('#registroModal').hide();
}
function abrirRecuperarContrasena() {
    $('#recuperarModal').css('display', 'flex');
}
function cerrarRecuperar() {
    $('#recuperarModal').hide();
}

// Función para verificar si hay un usuario en sesión
function verificarSesion() {
    $.ajax({
        url: 'mods/mod_login/verificar_sesion.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.autenticado) {
                $('#usuario-info').show();
                $('#nombre-usuario').text(data.usuario);
                $('#login-link').hide();
                $('#registro-link').hide();
                $('#logout-link').show();
                $('#crear-club-link').show(); // Mostrar enlace de Crear Club
                $('#editar-perfil-link').show(); // Mostrar enlace de Editar Perfil

                // Verificar y mostrar la imagen de perfil
                if (data.foto_perfil) {
                    $('#imagen-usuario').attr('src', data.foto_perfil);
                } else {
                    $('#imagen-usuario').attr('src', 'mods/mod_registro/default_avatar.png');
                }
            } else {
                $('#usuario-info').hide();
                $('#login-link').show();
                $('#registro-link').show();
                $('#logout-link').hide();
                $('#crear-club-link').hide(); // Ocultar enlace de Crear Club si no está autenticado
                $('#editar-perfil-link').hide(); // Ocultar enlace de Editar Perfil si no está autenticado
            }
        },
        error: function() {
            console.error('Error al verificar la sesión.');
        }
    });
}

// Ejecutar verificarSesion al cargar el documento
$(document).ready(function() {
    verificarSesion();

    // Manejar el botón de inicio de sesión
    $('#loginButton').click(function(e) {
        e.preventDefault();
        const formData = $('#loginForm').serialize();

        $.ajax({
            url: 'mods/mod_login/procesar_login.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    cerrarLogin();
                    verificarSesion();
                } else {
                    alert('Error en el inicio de sesión: ' + response.message);
                }
            },
            error: function() {
                alert('Error al intentar iniciar sesión. Verifica tu correo y contraseña.');
            }
        });
    });

    // Manejar el botón de registro
    $('#registroForm').submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: 'mods/mod_registro/procesar_registro.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    cerrarRegistro();
                    verificarSesion();
                    alert('Registro exitoso. Bienvenido a la Liga FC25.');
                } else {
                    alert('Error en el registro: ' + response.message);
                }
            },
            error: function() {
                alert('Error al intentar registrarse. Verifica los datos ingresados.');
            }
        });
    });

    // Manejar el botón de recuperación de contraseña
    $('#recuperarForm').submit(function(e) {
        e.preventDefault();
        const formData = $('#recuperarForm').serialize();

        $.ajax({
            url: 'mods/mod_recuperar/procesar_recuperacion.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    cerrarRecuperar();
                    alert('Correo de recuperación enviado. Revisa tu bandeja de entrada.');
                } else {
                    alert('Error en la recuperación: ' + response.message);
                }
            },
            error: function() {
                alert('Error al intentar enviar el formulario de recuperación.');
            }
        });
    });
});

// Función para cerrar sesión
function cerrarSesion() {
    $.ajax({
        url: 'mods/mod_login/cerrar_sesion.php',
        type: 'GET',
        success: function(response) {
            alert('Sesión cerrada correctamente.');
            verificarSesion();
        },
        error: function() {
            console.error('Error al intentar cerrar sesión.');
        }
    });
}

// Inicializar funciones del perfil
function inicializarPerfil() {
    const perfilForm = document.getElementById('perfilForm');
    const eliminarCuentaButton = document.getElementById('eliminarCuentaButton');

    // Manejar el formulario de actualización del perfil
    if (perfilForm) {
        perfilForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(perfilForm);

            fetch('mods/mod_perfil/procesar_perfil.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Perfil actualizado exitosamente.');
                    // Actualizar la imagen y el nombre del usuario si se modificaron
                    if (data.foto_perfil) {
                        document.getElementById('imagen-usuario').src = data.foto_perfil;
                    }
                    if (data.username) {
                        document.getElementById('nombre-usuario').textContent = data.username;
                    }
                } else {
                    alert('Error al actualizar el perfil: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error al intentar actualizar el perfil:', error);
                alert('Error al intentar actualizar el perfil.');
            });
        });
    }

    // Manejar el botón de eliminar cuenta
    if (eliminarCuentaButton) {
        eliminarCuentaButton.addEventListener('click', function() {
            if (confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')) {
                fetch('mods/mod_perfil/eliminar_cuenta.php', {
                    method: 'POST',
                    body: JSON.stringify({ email: document.getElementById('email').value }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cuenta eliminada exitosamente.');
                        window.location.href = '/index.php';
                    } else {
                        alert('Error al eliminar la cuenta: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error al intentar eliminar la cuenta:', error);
                    alert('Error al intentar eliminar la cuenta.');
                });
            }
        });
    }
}

// Inicializar funciones para crear club
function inicializarCrearClub() {
    const crearClubForm = document.getElementById('crearClubForm');

    // Manejar el formulario de creación de club
    if (crearClubForm) {
        crearClubForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(crearClubForm);

            fetch('mods/mod_crear_club/procesar_crear_club.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Club creado exitosamente.');
                } else {
                    alert('Error al crear el club: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error al intentar crear el club:', error);
                alert('Error al intentar crear el club.');
            });
        });
    }
}
