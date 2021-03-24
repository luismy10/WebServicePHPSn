<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Dashboard</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link text-md" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="lblNumeroNotificaciones">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="divNotificaciones">
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link text-md" data-toggle="dropdown" data-slide="true" href="#" role="button">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="./image/usuario.png" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center"><?php echo $_SESSION["RolName"] ?></h3>

                    <p class="text-muted text-center pb-2"><?php echo $_SESSION["Nombres"] . " " . $_SESSION["Apellidos"] ?> </p>

                    <button class="btn btn-default btn-block btn-sm" id="btnCerrarSession"><b>Cerrar Sesión</b></button>
                    <button class="btn btn-default btn-block btn-sm"><b>Cambiar Clave</b></button>
                </div>
            </div>

        </li>
    </ul>


</nav>