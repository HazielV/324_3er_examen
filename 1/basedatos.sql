/* nombre de la base 3er_234 */

create table estados
(
    id     int auto_increment
        primary key,
    nombre varchar(50) not null
);

create table usuarios
(
    id       int auto_increment
        primary key,
    nombre   varchar(100)                    not null,
    email    varchar(100)                    not null,
    password varchar(255)                    not null,
    rol      enum ('empleado', 'supervisor') not null,
    constraint email
        unique (email)
);

create table solicitudes
(
    id                  int auto_increment
        primary key,
    titulo              varchar(255)                       not null,
    descripcion         text                               not null,
    empleado_id         int                                not null,
    supervisor_id       int                                null,
    estado_id           int                                not null,
    fecha_creacion      datetime default CURRENT_TIMESTAMP null,
    fecha_actualizacion datetime default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP,
    fecha_inicio        date                               null,
    fecha_fin           date                               null,
    constraint solicitudes_ibfk_1
        foreign key (empleado_id) references usuarios (id),
    constraint solicitudes_ibfk_2
        foreign key (supervisor_id) references usuarios (id),
    constraint solicitudes_ibfk_3
        foreign key (estado_id) references estados (id)
);

create table historial
(
    id           int auto_increment
        primary key,
    solicitud_id int                                not null,
    usuario_id   int                                not null,
    accion       varchar(100)                       not null,
    comentario   text                               null,
    fecha        datetime default CURRENT_TIMESTAMP null,
    constraint historial_ibfk_1
        foreign key (solicitud_id) references solicitudes (id),
    constraint historial_ibfk_2
        foreign key (usuario_id) references usuarios (id)
);

create index solicitud_id
    on historial (solicitud_id);

create index usuario_id
    on historial (usuario_id);

create index empleado_id
    on solicitudes (empleado_id);

create index estado_id
    on solicitudes (estado_id);

create index supervisor_id
    on solicitudes (supervisor_id);

/* inserts */
INSERT INTO `3er_324`.usuarios (id, nombre, email, password, rol) VALUES (1, 'Supervisor Principal', 'supervisor@example.com', '1425d5d3160aa6bd140605cc75e63ce0', 'supervisor');
INSERT INTO `3er_324`.usuarios (id, nombre, email, password, rol) VALUES (2, 'Empleado 1', 'empleado1@example.com', 'da0f7659b41b24a826cc1673ac948843', 'empleado');
INSERT INTO `3er_324`.usuarios (id, nombre, email, password, rol) VALUES (3, 'Empleado 2', 'empleado2@example.com', '9da1a6f0fffca83786fed29b84197b6f', 'empleado');


INSERT INTO `3er_324`.estados (id, nombre) VALUES (1, 'Pendiente');
INSERT INTO `3er_324`.estados (id, nombre) VALUES (2, 'En Proceso');
INSERT INTO `3er_324`.estados (id, nombre) VALUES (3, 'Aprobada');
INSERT INTO `3er_324`.estados (id, nombre) VALUES (4, 'Rechazada');
INSERT INTO `3er_324`.estados (id, nombre) VALUES (5, 'Cancelada');


INSERT INTO `3er_324`.solicitudes (id, titulo, descripcion, empleado_id, supervisor_id, estado_id, fecha_creacion, fecha_actualizacion, fecha_inicio, fecha_fin) VALUES (1, 'Permiso por enfermedad', 'Solicito un permiso médico por 3 días.', 3, 1, 4, '2024-12-11 01:58:53', '2024-12-11 02:51:04', '2024-02-05', '2024-02-07');
INSERT INTO `3er_324`.solicitudes (id, titulo, descripcion, empleado_id, supervisor_id, estado_id, fecha_creacion, fecha_actualizacion, fecha_inicio, fecha_fin) VALUES (2, 'Actualización de software', 'Requiero autorización para actualizar mi software.', 3, 1, 2, '2024-12-11 01:58:53', '2024-12-11 02:02:49', '2024-01-10', '2024-01-20');
INSERT INTO `3er_324`.solicitudes (id, titulo, descripcion, empleado_id, supervisor_id, estado_id, fecha_creacion, fecha_actualizacion, fecha_inicio, fecha_fin) VALUES (3, 'Solicitud de vacaciones enero', 'Solicito días de vacaciones para el mes de enero', 2, 1, 1, '2024-12-11 02:02:20', '2024-12-11 02:02:20', '2024-01-10', '2024-01-20');
INSERT INTO `3er_324`.solicitudes (id, titulo, descripcion, empleado_id, supervisor_id, estado_id, fecha_creacion, fecha_actualizacion, fecha_inicio, fecha_fin) VALUES (4, 'Solicitud de permiso', 'Solicito un permiso para un evento personal', 3, 1, 1, '2024-12-11 02:02:20', '2024-12-11 02:02:20', '2024-02-05', '2024-02-07');


INSERT INTO `3er_324`.historial (id, solicitud_id, usuario_id, accion, comentario, fecha) VALUES (1, 1, 2, 'Creación de solicitud', 'El empleado creó la solicitud', '2024-12-11 01:58:53');
INSERT INTO `3er_324`.historial (id, solicitud_id, usuario_id, accion, comentario, fecha) VALUES (2, 2, 3, 'Creación de solicitud', 'El empleado creó la solicitud', '2024-12-11 01:58:53');
INSERT INTO `3er_324`.historial (id, solicitud_id, usuario_id, accion, comentario, fecha) VALUES (3, 2, 1, 'Cambio de estado a En Proceso', 'El supervisor está revisando la solicitud', '2024-12-11 01:58:53');
