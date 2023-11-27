-- Insertar datos de prueba
INSERT INTO pagos (id, fechaPago, fechaReg, valor, numeroFact, excedente, idEstado, idTransaccion, idMedioPago, created_at, updated_at) VALUES
(1, '2023-11-26', '2023-11-26', 100.00, '123ABC', 20.00, 1, 1, 1, NOW(), NOW()),
(2, '2023-11-27', '2023-11-27', 150.00, '456DEF', 30.00, 2, 2, 2, NOW(), NOW()),
(3, '2023-11-28', '2023-11-28', 75.00, '789GHI', 15.00, 3, 3, 3, NOW(), NOW());
