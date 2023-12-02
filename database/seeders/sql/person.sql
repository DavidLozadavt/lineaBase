INSERT INTO persona (
    id,
    identificacion,
    nombre1,
    nombre2,
    apellido1,
    apellido2,
    fechaNac,
    direccion,
    email,
    telefonoFijo,
    celular,
    perfil,
    sexo,
    rh,
    rutaFoto,
    idTipoIdentificacion,
    idCiudadNac,
    idCiudadUbicacion,
    created_at,
    updated_at
) VALUES (
    3,
    123456789, -- Reemplaza con el valor generado aleatoriamente para 'identificacion'
    'WILL', -- Reemplaza con el valor generado aleatoriamente para 'nombre1'
    'ANDRES', -- Reemplaza con el valor generado aleatoriamente para 'nombre2'
    'MENESES', -- Reemplaza con el valor generado aleatoriamente para 'apellido1'
    'MENESES', -- Reemplaza con el valor generado aleatoriamente para 'apellido2'
    '2000-01-01', -- Reemplaza con el valor generado aleatoriamente para 'fechaNac'
    'NOT FOUND', -- Reemplaza con el valor generado aleatoriamente para 'direccion'
    'admin@fup.com', -- Reemplaza con el valor generado aleatoriamente para 'email'
    '123456789', -- Reemplaza con el valor generado aleatoriamente para 'telefonoFijo'
    '987654321', -- Reemplaza con el valor generado aleatoriamente para 'celular'
    'ERROR 500', -- Reemplaza con el valor generado aleatoriamente para 'perfil'
    'M', -- Reemplaza con el valor generado aleatoriamente para 'sexo'
    'O+', -- Reemplaza con el valor generado aleatoriamente para 'rh'
    '/default/user.svg',
    1, -- Reemplaza con el valor generado aleatoriamente para 'idTipoIdentificacion'
    1, -- Reemplaza con el valor generado aleatoriamente para 'idCiudadNac'
    2, -- Reemplaza con el valor generado aleatoriamente para 'idCiudadUbicacion'
    NOW(),
    NOW()
);
