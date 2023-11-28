-- Insertar datos de prueba en la tabla transaccion
INSERT INTO transaccion (id, fechaTransaccion, hora, numFacturaInicial, valor, idEstado, idTipoTransaccion, idTipoPago, created_at, updated_at) VALUES
(1, '2023-11-26', '12:30:00', 21412343, 100000, 1, 1, 1, NOW(), NOW()),
(2, '2023-11-27', '14:45:00', 21456789, 150000, 2, 2, 2, NOW(), NOW()),
(3, '2023-11-28', '10:15:00', 21567890, 75000, 3, 3, 1, NOW(), NOW());
