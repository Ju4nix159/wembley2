<?php
include("../config/database.php");
include("../html/navbar.php");


// Verificar si hay una sesión de usuario iniciada
if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && ($_SESSION['permiso'] == 1 || $_SESSION['permiso'] == 2)) {
    /* INFORMACION DEL USUARIO */
    // Preparar y ejecutar la consulta SQL para obtener la información del usuario
    $sql_info_usuario = $con->prepare("SELECT i.id_usuario, i.nombre, i.apellido, i.dni, i.fecha_nacimiento, i.telefono, s.nombre as sexo, s.id_sexo FROM info_usuarios i JOIN sexos s ON i.id_sexo = s.id_sexo  WHERE i.id_usuario = :id_usuario;");
    $sql_info_usuario->bindParam(':id_usuario', $_SESSION["id_usuario"], PDO::PARAM_INT);
    $sql_info_usuario->execute();
    $info_usuario = $sql_info_usuario->fetch(PDO::FETCH_ASSOC);

    $sql_sexos = $con->query("SELECT id_sexo, nombre FROM sexos");
    $sql_sexos->execute();
    $sexos = $sql_sexos->fetchAll(PDO::FETCH_ASSOC);




    /* PEDIDOS DEL USUARIO */
    // Preparar y ejecutar la consulta SQL para obtener los pedidos del usuario
    /* $sql_pedidos = $con->prepare("SELECT id_pedido,fecha FROM pedidos WHERE id_usuario = :id_usuario");
    $sql_pedidos->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $sql_pedidos->execute();
    $resultado_pedidos = $sql_pedidos->fetchAll(PDO::FETCH_ASSOC); */
} ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <style>
        .user-avatar {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="../imagen/noimagen.jpg" alt="Avatares" class="user-avatar mb-3">
                        <h3 class="card-title"><?php echo $info_usuario["nombre"] . " " . $info_usuario["apellido"] ?></h3>
                        <p class="card-text"><?php echo $_SESSION["usuario"] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Información Personal</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">Resumen de Pedidos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="addresses-tab" data-bs-toggle="tab" data-bs-target="#addresses" type="button" role="tab" aria-controls="addresses" aria-selected="false">Domicilios</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Información Personal</h5>
                                <p><strong>Nombre:</strong><?php echo $info_usuario["nombre"] . " " . $info_usuario["apellido"] ?></p>
                                <p><strong>Email:</strong> <?php echo $_SESSION["usuario"] ?></p>
                                <p><strong>Teléfono:</strong><?php echo $info_usuario["telefono"] ?></p>
                                <p><strong>Fecha de Nacimiento:</strong><?php echo $info_usuario["fecha_nacimiento"] ?></p>
                                <p><strong>D.N.I:</strong> <?php echo $info_usuario["dni"] ?></p>
                                <p><strong>sexo:</strong> <?php echo $info_usuario["sexo"] ?></p>

                                <button class="btn btn-primary mt-3" onclick="toggleEditInfo()">Editar Información</button>
                            </div>
                        </div>
                        <div id="editInfoForm" class="card mt-3 hidden">
                            <div class="card-body">
                                <h5 class="card-title">Editar Información Personal</h5>
                                <form method="POST" action="<?php ?>">
                                    <input type="hidden" name="id_usuario" value="<?php echo $_SESSION["id_usuario"] ?>">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" value="<?php echo $info_usuario["nombre"] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="apellido" value="<?php echo $info_usuario["apellido"] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="tel" class="form-control" id="telefono" value="<?php echo $info_usuario["telefono"] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editBirthdate" class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" id="editBirthdate" value="<?php echo $info_usuario["fecha_nacimiento"] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="sexo">Selecciona el sexo:</label>
                                        <select class="form-select form-label" id="sexo" name="id_sexo">
                                            <?php foreach ($sexos as $sexo): ?>
                                                <option value="<?php echo $sexo['id_sexo']; ?>"
                                                    <?php if ($sexo['id_sexo'] == $info_usuario["id_sexo"]): ?>
                                                    selected
                                                    <?php endif; ?>>
                                                    <?php echo htmlspecialchars($sexo['nombre']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    <button type="button" class="btn btn-secondary" onclick="toggleEditInfo()">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Resumen de Pedidos</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nº Pedido</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1234</td>
                                            <td>01/06/2023</td>
                                            <td>$150.00</td>
                                            <td><span class="badge bg-success">Entregado</span></td>
                                            <td><button class="btn btn-sm btn-info" onclick="showOrderDetails(1234)">Ver</button></td>
                                        </tr>
                                        <tr>
                                            <td>#1235</td>
                                            <td>15/06/2023</td>
                                            <td>$75.50</td>
                                            <td><span class="badge bg-warning">En proceso</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="showOrderDetails(1235)">Ver</button>
                                                <button class="btn btn-sm btn-danger" onclick="cancelOrder(1235)">Cancelar pedido</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="orderDetails" class="card mt-3 hidden">
                            <div class="card-body">
                                <h5 class="card-title">Resumen de Pedido #<span id="orderNumber"></span></h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orderProductsList">
                                    </tbody>
                                </table>
                                <div class="text-end">
                                    <strong>Total del Pedido: $<span id="orderTotal"></span></strong>
                                </div>
                                <button class="btn btn-secondary mt-3" onclick="hideOrderDetails()">Cerrar</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Domicilios</h5>
                                <div class="mb-3">
                                    <h6>Domicilio Principal</h6>
                                    <p>Calle Mayor 123, 28001 Madrid, España</p>
                                    <button class="btn btn-sm btn-primary" onclick="showEditAddress('principal')">Editar</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteAddress('principal')">Eliminar</button>
                                </div>
                                <div class="mb-3">
                                    <h6>Domicilio Secundario</h6>
                                    <p>Avenida del Mar 45, 29601 Marbella, España</p>
                                    <button class="btn btn-sm btn-primary" onclick="showEditAddress('secundario')">Editar</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteAddress('secundario')">Eliminar</button>
                                </div>
                                <h6 class="mt-4">Otros Domicilios Registrados</h6>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Calle del Sol 78, 41001 Sevilla, España
                                        <div>
                                            <button class="btn btn-sm btn-primary" onclick="showEditAddress('otro1')">Editar</button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteAddress('otro1')">Eliminar</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Paseo de Gracia 43, 08007 Barcelona, España
                                        <div>
                                            <button class="btn btn-sm btn-primary" onclick="showEditAddress('otro2')">Editar</button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteAddress('otro2')">Eliminar</button>
                                        </div>
                                    </li>
                                </ul>
                                <button class="btn btn-success mt-3" onclick="showAddAddress()">Agregar Domicilio</button>
                            </div>
                        </div>
                        <div id="editAddressForm" class="card mt-3 hidden">
                            <div class="card-body">
                                <h5 class="card-title">Editar Domicilio</h5>
                                <form>
                                    <div class="mb-3">
                                        <label for="editAddressLine1" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="editAddressLine1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editAddressCity" class="form-label">Ciudad</label>
                                        <input type="text" class="form-control" id="editAddressCity">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editAddressPostalCode" class="form-label">Código Postal</label>
                                        <input type="text" class="form-control" id="editAddressPostalCode">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editAddressCountry" class="form-label">País</label>
                                        <input type="text" class="form-control" id="editAddressCountry">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    <button type="button" class="btn btn-secondary" onclick="hideEditAddress()">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleEditInfo() {
            const infoCard = document.querySelector('#info .card');
            const editForm = document.getElementById('editInfoForm');
            infoCard.classList.toggle('hidden');
            editForm.classList.toggle('hidden');
        }

        function showOrderDetails(orderNumber) {
            const orderDetails = document.getElementById('orderDetails');
            const orderNumberSpan = document.getElementById('orderNumber');
            const orderProductsList = document.getElementById('orderProductsList');
            const orderTotal = document.getElementById('orderTotal');

            orderNumberSpan.textContent = orderNumber;
            orderProductsList.innerHTML = '';

            const products = [{
                    name: 'Producto 1',
                    quantity: 2,
                    price: 25.00
                },
                {
                    name: 'Producto 2',
                    quantity: 1,
                    price: 50.00
                },
            ];

            let total = 0;
            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.name}</td>
                    <td>${product.quantity}</td>
                    <td>$${product.price.toFixed(2)}</td>
                    <td>$${(product.quantity * product.price).toFixed(2)}</td>
                `;
                orderProductsList.appendChild(row);
                total += product.quantity * product.price;
            });

            orderTotal.textContent = total.toFixed(2);
            orderDetails.classList.remove('hidden');
        }

        function hideOrderDetails() {
            const orderDetails = document.getElementById('orderDetails');
            orderDetails.classList.add('hidden');
        }

        function showEditAddress(addressType) {
            const addressesCard = document.querySelector('#addresses .card');
            const editForm = document.getElementById('editAddressForm');
            addressesCard.classList.add('hidden');
            editForm.classList.remove('hidden');

            const addressData = {
                principal: {
                    line1: 'Calle Mayor 123',
                    city: 'Madrid',
                    postalCode: '28001',
                    country: 'España'
                },
                secundario: {
                    line1: 'Avenida del Mar 45',
                    city: 'Marbella',
                    postalCode: '29601',
                    country: 'España'
                },
                otro1: {
                    line1: 'Calle del Sol 78',
                    city: 'Sevilla',
                    postalCode: '41001',
                    country: 'España'
                },
                otro2: {
                    line1: 'Paseo de Gracia 43',
                    city: 'Barcelona',
                    postalCode: '08007',
                    country: 'España'
                }
            };

            const address = addressData[addressType];
            document.getElementById('editAddressLine1').value = address.line1;
            document.getElementById('editAddressCity').value = address.city;
            document.getElementByI
            d('editAddressPostalCode').value = address.postalCode;
            document.getElementById('editAddressCountry').value = address.country;
        }

        function hideEditAddress() {
            const addressesCard = document.querySelector('#addresses .card');
            const editForm = document.getElementById('editAddressForm');
            addressesCard.classList.remove('hidden');
            editForm.classList.add('hidden');
        }

        function cancelOrder(orderNumber) {
            alert(`Pedido #${orderNumber} cancelado`);
            // Aquí iría la lógica para cancelar el pedido
        }

        function deleteAddress(addressType) {
            alert(`Domicilio ${addressType} eliminado`);
            // Aquí iría la lógica para eliminar el domicilio
        }

        function showAddAddress() {
            const addressesCard = document.querySelector('#addresses .card');
            const editForm = document.getElementById('editAddressForm');
            addressesCard.classList.add('hidden');
            editForm.classList.remove('hidden');

            // Limpiar el formulario
            document.getElementById('editAddressLine1').value = '';
            document.getElementById('editAddressCity').value = '';
            document.getElementById('editAddressPostalCode').value = '';
            document.getElementById('editAddressCountry').value = '';

            // Cambiar el título del formulario
            editForm.querySelector('.card-title').textContent = 'Agregar Domicilio';
        }
    </script>

</body>

</html>