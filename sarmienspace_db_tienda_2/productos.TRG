TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `actualizarPrecioDesc` BEFORE UPDATE ON `productos` FOR EACH ROW BEGIN\n    SET NEW.precio_desc = NEW.precio - (NEW.precio * (NEW.descuento / 100));\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `tr_actualizar_estado` BEFORE UPDATE ON `productos` FOR EACH ROW BEGIN \n    IF NEW.stock = 0 THEN \n        SET NEW.id_estado = 3; \n    END IF;\nEND'
sql_modes=524288 524288
definers='root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1722819112256462 1722819112269688
