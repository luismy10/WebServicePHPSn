<aside class="main-sidebar sidebar-dark-primary elevation-1">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link navbar-primary">
        <img src="./image/logo.png" alt="SysSoftIntegra Logo" class="brand-image" style="opacity: 1">
        <span class="brand-text font-weight-bold">SysSoft Integra</span>
    </a>
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 mb-3 d-flex">
            <div class="info">
                <div class="image p-2">
                    <img src="./image/usuario.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <span class="d-block text-white mb-3"><?php echo $_SESSION["RolName"] ?></span>
                <span class="text-white p-4"><i class="fa fa-circle text-success"></i> Conectado</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Facturación Electrónica
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-external-link-alt rotate-180deg"></i>
                        <p>
                            Ingresos
                            <i class="right fas fa-caret-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="ventas.php" class="nav-link">
                                <i class="far fa-angle-right nav-icon"></i>
                                <p>Ventas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="notacredito.php" class="nav-link">
                                <i class="far fa-angle-right nav-icon"></i>
                                <p>Nota de Crédito</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#  " class="nav-link">
                        <i class="nav-icon fas fa-external-link-alt"></i>
                        <p>
                            Gastos
                            <i class="right fas fa-caret-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Contactos
                            <i class="right fas fa-caret-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="clientes.php" class="nav-link">
                                <i class="far fa-angle-right nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Inventario
                            <i class="right fas fa-caret-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="productos.php" class="nav-link">
                                <i class="far fa-angle-right nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="inventario.php" class="nav-link">
                                <i class="far fa-angle-right nav-icon"></i>
                                <p>inventario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kardexproducto.php" class="nav-link">
                                <i class="far fa-angle-right nav-icon"></i>
                                <p>Kardex</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ajustes.php" class="nav-link">
                                <i class="far fa-angle-right nav-icon"></i>
                                <p>Ajuste de Inventario</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Bancos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-fax"></i>
                        <p>
                            Contabilidad
                            <i class="right fas fa-caret-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte.php" class="nav-link">
                        <i class="nav-icon fas fa-file-contract"></i>
                        <p>
                            Reportes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="graficas.php" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Gráficos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-laptop-house"></i>
                        <p>
                            Tienda en Línea
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Configuración
                            <i class="right fas fa-caret-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="empresa.php" class="nav-link">
                                <i class="far fa-angle-right nav-icon"></i>
                                <p>Empresa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Roles
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ventas.php" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Ventas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="notacredito.php" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Nota de Crédito
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="productos.php" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="inventario.php" class="nav-link">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            Inventario
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="kardexproducto.php" class="nav-link">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>
                            Kardex Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ajustes.php" class="nav-link">
                        <i class="nav-icon fas fa-arrows-alt-h"></i>
                        <p>
                            Ajuste de Inventario
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte.php" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Reportes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="graficas.php" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Gráficos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="empresa.php" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Empresa
                        </p>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>