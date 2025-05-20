<?php
// Asegurarnos de que $productos esté definido
if (!isset($productos)) {
    $productos = [];
}
?>
<!doctype html>
<html lang="es">

<!-- Head -->

<head>
    <!-- Page Meta Tags-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Links Estilos -->
    <?php include_once __DIR__ . '/../config/components/initComponent.php'; ?>
    <?php echo $varHeader; ?>

    <!-- Fix for custom scrollbar if JS is disabled-->
    <noscript>
        <style>
            /**
          * Reinstate scrolling for non-JS clients
          */
            .simplebar-content-wrapper {
                overflow: auto;
            }
        </style>
    </noscript>

    <!-- Page Title -->
    <title>Bruz Deporte | Gestión de Productos</title>

</head>

<body class="">

    <section class="mt-0">
        <div class="container py-5">

            <div class="table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fs-4 fw-bold m-0">Nuestros Productos</h3>
                    <!-- Botón que abre el modal -->
                    <button class="btn btn-sm btn-dark btn-px-2-5 py-3" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
                        <i class="ri-add-line me-1"></i> Agregar producto
                    </button>
                </div>
                <table class="table align-middle">
                    <tbody>
                        <?php if (empty($productos)): ?>
                            <tr>
                                <td colspan="4" class="text-center">No hay productos disponibles</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($productos as $producto): ?>
                                <tr class="border-bottom">
                                    <td class="col-2">
                                        <img src="<?php echo htmlspecialchars($producto['imgProduct1']); ?>" 
                                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                                             class="img-fluid border">
                                    </td>
                                    <td>
                                        <h6 class="mb-1"><?php echo htmlspecialchars($producto['nombre']); ?></h6>
                                        <p class="text-muted mb-0">
                                            <span class="text-body">Categoría:</span> 
                                            <?php echo htmlspecialchars($producto['categoria']); ?>
                                        </p>
                                        <p class="text-muted mb-0">
                                            <span class="text-body">Talla:</span> 
                                            <?php echo htmlspecialchars($producto['talla']); ?>
                                        </p>
                                        <p class="text-muted mb-0">
                                            <span class="text-body">Stock:</span> 
                                            <?php echo htmlspecialchars($producto['cantidad']); ?>
                                        </p>
                                        <p class="text-muted mb-0">
                                            <span class="text-body">Descripción:</span> 
                                            <?php echo htmlspecialchars($producto['descripcion']); ?>
                                        </p>
                                    </td>
                                    <td class="text-end fw-bold">
                                        $<?php echo number_format($producto['precio'], 2); ?>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border dropdown-toggle" 
                                                    type="button" 
                                                    id="dropdownMenu<?php echo $producto['id']; ?>" 
                                                    data-bs-toggle="dropdown" 
                                                    aria-expanded="false">
                                                <i class="ri-more-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" 
                                                aria-labelledby="dropdownMenu<?php echo $producto['id']; ?>">
                                                <li>
                                                    <a href="#"
                                                        class="dropdown-item btnVerProducto"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalVerProducto"
                                                        data-id="<?php echo $producto['id']; ?>"
                                                        data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                                        data-categoria="<?php echo htmlspecialchars($producto['categoria']); ?>"
                                                        data-talla="<?php echo htmlspecialchars($producto['talla']); ?>"
                                                        data-stock="<?php echo htmlspecialchars($producto['cantidad']); ?>"
                                                        data-descripcion="<?php echo htmlspecialchars($producto['descripcion']); ?>"
                                                        data-precio="<?php echo number_format($producto['precio'], 2); ?>"
                                                        data-imagen="<?php echo htmlspecialchars($producto['imgProduct1']); ?>">
                                                        Ver
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="dropdown-item btnEditarProducto"
                                                        data-id="<?php echo $producto['id']; ?>"
                                                        data-nombre="<?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES); ?>"
                                                        data-categoria="<?php echo htmlspecialchars($producto['categoria'], ENT_QUOTES); ?>"
                                                        data-talla="<?php echo htmlspecialchars($producto['talla'], ENT_QUOTES); ?>"
                                                        data-stock="<?php echo htmlspecialchars($producto['cantidad'], ENT_QUOTES); ?>"
                                                        data-precio="<?php echo htmlspecialchars($producto['precio'], ENT_QUOTES); ?>"
                                                        data-descripcion="<?php echo htmlspecialchars($producto['descripcion'], ENT_QUOTES); ?>"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#modalEditarProducto">
                                                        Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" 
                                                       href="?url=product/delete&id=<?php echo $producto['id']; ?>" 
                                                       onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                                                        Eliminar
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-top py-5 mt-4  ">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row">
                <div>
                    <ul class="list-unstyled">
                        <li class="d-inline-block me-1"><a class="text-decoration-none text-dark-hover transition-all"
                                href="#"><i class="ri-instagram-fill"></i></a></li>
                        <li class="d-inline-block me-1"><a class="text-decoration-none text-dark-hover transition-all"
                                href="#"><i class="ri-facebook-fill"></i></a></li>
                        <li class="d-inline-block me-1"><a class="text-decoration-none text-dark-hover transition-all"
                                href="#"><i class="ri-twitter-fill"></i></a></li>
                        <li class="d-inline-block me-1"><a class="text-decoration-none text-dark-hover transition-all"
                                href="#"><i class="ri-snapchat-fill"></i></a></li>
                    </ul>
                </div>
                <div class="d-flex align-items-center justify-content-end flex-column flex-lg-row">
                    <p class="small m-0 text-center text-lg-start">&copy; 2025 Bruz Deportes Todos los derechos reservados</p>
                    <ul class="list-unstyled mb-0 ms-lg-4 mt-3 mt-lg-0 d-flex justify-content-end align-items-center">
                        <li class="bg-light p-2 d-flex align-items-center justify-content-center me-2">
                            <i class="pi pi-sm pi-paypal"></i>
                        </li>
                        <li class="bg-light p-2 d-flex align-items-center justify-content-center me-2">
                            <i class="pi pi-sm pi-mastercard"></i>
                        </li>
                        <li class="bg-light p-2 d-flex align-items-center justify-content-center me-2">
                            <i class="pi pi-sm pi-american-express"></i>
                        </li>
                        <li class="bg-light p-2 d-flex align-items-center justify-content-center"><i class="pi pi-sm pi-visa"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer> <!-- / Footer-->

    <!-- Theme JS -->

    <!-- Custom JS -->
    <?php echo $varJs; ?>
    <!-- Modal Agregar Producto -->
    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="?url=product/create" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Nombre -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-1" id="nombreProducto" name="nombre" placeholder="Nombre" required>
                                    <label for="nombreProducto">Nombre</label>
                                </div>
                            </div>

                            <!-- Categoría -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select rounded-1" id="categoriaProducto" name="categoria" required>
                                        <option value="">Seleccione una categoría</option>
                                        <option value="Camiseta">Camiseta</option>
                                        <option value="Pantalón">Pantalón</option>
                                    </select>
                                    <label for="categoriaProducto">Categoría</label>
                                </div>
                            </div>

                            <!-- Talla -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select rounded-1" id="tallaProducto" name="talla" required>
                                        <option value="">Seleccione una talla</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                    <label for="tallaProducto">Talla</label>
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control rounded-1" id="descripcionProducto" name="descripcion" style="height: 100px" required></textarea>
                                    <label for="descripcionProducto">Descripción</label>
                                </div>
                            </div>

                            <!-- Precio -->
                            <div class="col-12">
                                <div class="input-group border-dark rounded-1">
                                    <span class="input-group-text bg-transparent rounded-start">$</span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="number" class="form-control rounded-0" id="precioProducto" name="precio" step="0.01" min="0" placeholder="Precio" required>
                                        <label for="precioProducto">Precio</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control rounded-1" id="stockProducto" name="cantidad" placeholder="Stock disponible" min="0" required>
                                    <label for="stockProducto">Stock disponible</label>
                                </div>
                            </div>

                            <!-- Imagen -->
                            <div class="col-12">
                                <label for="imagenProducto" class="form-label">Imagen del producto</label>
                                <input type="file" class="form-control rounded-1" id="imagenProducto" name="imgProduct1" accept="image/*" required>
                                <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Ver Producto -->
    <div class="modal fade" id="modalVerProducto" tabindex="-1" aria-labelledby="modalVerProductoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-3 shadow">

                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold" id="modalVerProductoLabel">Detalle de Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-4">

                        <div class="col-12 col-md-6">
                            <img id="modalProductoImagen" src="" alt="" class="img-fluid w-100 rounded border">
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="sticky-top top-5">
                                <h2 class="fs-3 fw-bold" id="modalProductoNombre"></h2>

                                <div class="mt-3 border-top pt-3">
                                    <p class="mb-1 text-muted fw-bold">Categoría:</p>
                                    <p class="mb-3" id="modalProductoCategoria"></p>

                                    <p class="mb-1 text-muted fw-bold">Talla:</p>
                                    <p class="mb-3" id="modalProductoTalla"></p>

                                    <p class="mb-1 text-muted fw-bold">Descripción:</p>
                                    <p class="mb-3" id="modalProductoDescripcion"></p>

                                    <p class="mb-1 text-muted fw-bold">Stock disponible:</p>
                                    <p class="mb-3" id="modalProductoStock"></p>

                                    <p class="mb-1 text-muted fw-bold">Precio:</p>
                                    <h4 class="fw-bold text-dark" id="modalProductoPrecio"></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.btnVerProducto').forEach(button => {
            button.addEventListener('click', function() {
                const modal = document.getElementById('modalVerProducto');

                modal.querySelector('#modalProductoNombre').textContent = this.getAttribute('data-nombre');
                modal.querySelector('#modalProductoCategoria').textContent = this.getAttribute('data-categoria');
                modal.querySelector('#modalProductoTalla').textContent = this.getAttribute('data-talla');
                modal.querySelector('#modalProductoStock').textContent = this.getAttribute('data-stock');
                modal.querySelector('#modalProductoDescripcion').textContent = this.getAttribute('data-descripcion');
                modal.querySelector('#modalProductoPrecio').textContent = `$${this.getAttribute('data-precio')} USD`;
                modal.querySelector('#modalProductoImagen').src = this.getAttribute('data-imagen');
                modal.querySelector('#modalProductoImagen').alt = this.getAttribute('data-nombre');
            });
        });
    </script>
    <!-- Modal Editar Producto -->
    <div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="?url=product/update" method="POST" enctype="multipart/form-data" id="formEditarProducto">
                    <input type="hidden" name="id" id="editarProductoId" />
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarProductoLabel">Editar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Nombre -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-1" id="editarNombreProducto" name="nombre" placeholder="Nombre" required>
                                    <label for="editarNombreProducto">Nombre</label>
                                </div>
                            </div>

                            <!-- Categoría -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select rounded-1" id="editarCategoriaProducto" name="categoria" required>
                                        <option value="">Seleccione una categoría</option>
                                        <option value="Camiseta">Camiseta</option>
                                        <option value="Pantalón">Pantalón</option>
                                    </select>
                                    <label for="editarCategoriaProducto">Categoría</label>
                                </div>
                            </div>

                            <!-- Talla -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select rounded-1" id="editarTallaProducto" name="talla" required>
                                        <option value="">Seleccione una talla</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                    <label for="editarTallaProducto">Talla</label>
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control rounded-1" id="editarDescripcionProducto" name="descripcion" style="height: 100px" required></textarea>
                                    <label for="editarDescripcionProducto">Descripción</label>
                                </div>
                            </div>

                            <!-- Precio -->
                            <div class="col-12">
                                <div class="input-group border-dark rounded-1">
                                    <span class="input-group-text bg-transparent rounded-start">$</span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="number" class="form-control rounded-0" id="editarPrecioProducto" name="precio" step="0.01" min="0" placeholder="Precio" required>
                                        <label for="editarPrecioProducto">Precio</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control rounded-1" id="editarStockProducto" name="cantidad" placeholder="Stock disponible" min="0" required>
                                    <label for="editarStockProducto">Stock disponible</label>
                                </div>
                            </div>

                            <!-- Imagen -->
                            <div class="col-12">
                                <label for="editarImagenProducto" class="form-label">Cambiar Imagen (opcional)</label>
                                <input type="file" class="form-control rounded-1" id="editarImagenProducto" name="imgProduct1" accept="image/*">
                                <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.btnEditarProducto').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const nombre = this.dataset.nombre;
                const categoria = this.dataset.categoria;
                const talla = this.dataset.talla;
                const stock = this.dataset.stock;
                const precio = this.dataset.precio;
                const descripcion = this.dataset.descripcion;

                // Llenar inputs del modal editar
                document.getElementById('editarProductoId').value = id;
                document.getElementById('editarNombreProducto').value = nombre;
                document.getElementById('editarCategoriaProducto').value = categoria;
                document.getElementById('editarTallaProducto').value = talla;
                document.getElementById('editarStockProducto').value = stock;
                document.getElementById('editarPrecioProducto').value = precio;
                document.getElementById('editarDescripcionProducto').value = descripcion;
            });
        });
    </script>

</body>

</html>