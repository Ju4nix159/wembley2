<?php 
  include("navbar.php");
  include("../config/database.php");


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <style>
        .section-content {
            display: none;
        }
        .section-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Finalizar Compra</h1>
        
        <div class="accordion" id="checkoutAccordion">
            <!-- Resumen del pedido -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResumen">
                        Resumen del pedido
                    </button>
                </h2>
                <div id="collapseResumen" class="accordion-collapse collapse show" data-bs-parent="#checkoutAccordion">
                    <div class="accordion-body">
                        <form id="resumenForm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Camiseta</td>
                                        <td>2</td>
                                        <td>$25.00</td>
                                        <td>$50.00</td>
                                    </tr>
                                    <tr>
                                        <td>Pantalón</td>
                                        <td>1</td>
                                        <td>$40.00</td>
                                        <td>$40.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end mb-3">
                                <strong>Total del pedido: $90.00</strong>
                            </div>
                            <button type="button" class="btn btn-primary next-section" data-next="collapseEnvio">Siguiente: Información de envío</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Información de envío -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEnvio">
                        Información de envío
                    </button>
                </h2>
                <div id="collapseEnvio" class="accordion-collapse collapse" data-bs-parent="#checkoutAccordion">
                    <div class="accordion-body">
                        <form id="envioForm">
                            <div class="mb-3">
                                <label for="direccionEnvio" class="form-label">Seleccione la dirección de envío</label>
                                <select class="form-select" id="direccionEnvio" required>
                                    <option value="">Seleccione una dirección</option>
                                    <option value="casa">Casa</option>
                                    <option value="trabajo">Trabajo</option>
                                    <option value="otro">Otra dirección</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" id="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" required>
                            </div>
                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" required>
                            </div>
                            <div class="mb-3">
                                <label for="codigoPostal" class="form-label">Código postal</label>
                                <input type="text" class="form-control" id="codigoPostal" required>
                            </div>
                            <div class="mb-3">
                                <p><strong>Resumen de costos:</strong></p>
                                <p>Total del pedido: $90.00</p>
                                <p>Costo de envío: $10.00</p>
                                <p><strong>Total (incluyendo envío): $100.00</strong></p>
                            </div>
                            <button type="button" class="btn btn-primary next-section" data-next="collapsePago">Siguiente: Método de pago</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Método de pago -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePago">
                        Método de pago
                    </button>
                </h2>
                <div id="collapsePago" class="accordion-collapse collapse" data-bs-parent="#checkoutAccordion">
                    <div class="accordion-body">
                        <form id="pagoForm">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodoPago" id="tarjeta" value="tarjeta" checked>
                                    <label class="form-check-label" for="tarjeta">
                                        Tarjeta de crédito
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metodoPago" id="paypal" value="paypal">
                                    <label class="form-check-label" for="paypal">
                                        PayPal
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="numeroTarjeta" class="form-label">Número de tarjeta</label>
                                <input type="text" class="form-control" id="numeroTarjeta" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fechaExpiracion" class="form-label">Fecha de expiración</label>
                                    <input type="text" class="form-control" id="fechaExpiracion" placeholder="MM/YY" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p><strong>Total a pagar: $100.00</strong></p>
                            </div>
                            <button type="submit" class="btn btn-primary">Finalizar compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nextButtons = document.querySelectorAll('.next-section');
            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nextSection = this.getAttribute('data-next');
                    const nextAccordion = new bootstrap.Collapse(document.getElementById(nextSection));
                    nextAccordion.show();
                });
            });

            document.getElementById('pagoForm').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Formulario enviado. Aquí se procesaría el pago y se finalizaría la compra.');
            });
        });
    </script>
    <?php include("footer.php");?>
</body>
</html>