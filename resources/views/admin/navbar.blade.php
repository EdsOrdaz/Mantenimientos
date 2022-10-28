<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-0 pb-1 mb-1" align="center">
        <div class="info" style="display:block;" align="center">
          <font color="#CACACA">Bienvenido<br></font>
          <?php
            $nombreusuario = explode(" ",Auth::user()->name);
            $n1 = $nombreusuario[0];
          ?>
          <font color="#FFFFFF"><h2>{{$n1}}</h2></font>
          <font color="#CACACA"><a href="/logout"><h6>Cerrar Sesión</h6></a></font>
      </font>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        
        <cursor>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            
          <li id="navmantenimientosgrupo" class="nav-item menu-close">
            <a id="navmantenimientos" href="#" class="nav-link">
              <i class="nav-icon fas fa-laptop"></i>
              <p>
                Mantenimientos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="navmantenimientos_buscar" class="nav-link">
                  &emsp;&emsp;
                  <i class="nav-icon fas fa-search"></i><p>Buscar</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="navmantenimientos_xml" class="nav-link">
                  &emsp;&emsp;
                  <i class="nav-icon fas fa-cloud-upload"></i><p>Cargar XML</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="navreportes" class="nav-link">
                  &emsp;&emsp;
                  <i class="fas fa-chart-area nav-icon"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="navprograma" class="nav-link">
                  &emsp;&emsp;
                  <i class="fas fa-file-chart-line nav-icon"></i>
                  <p> Programa</p>
                </a>
              </li>
            </ul>
          </li>

          <li id="navusuariosgrupo" class="nav-item menu-close">
            <a id="navusuarios" href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="listausuarios" class="nav-link">
                  &emsp;&emsp;
                  <i class="far fa-book-user nav-icon"></i>
                  <p>Lista de Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="agregarusuario" class="nav-link">
                  &emsp;&emsp;
                  <i class="far fa-user-plus nav-icon"></i>
                  <p>Agregar Usuario</p>
                </a>
              </li>
            </ul>
          </li>

          <li id="navinfeqgrupo" class="nav-item menu-close">
            <a id="navinfeq" href="#" class="nav-link">
              <i class="nav-icon far fa-laptop-code"></i>
              <p>
                Equipos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="infeqbuscar" class="nav-link">
                  &emsp;&emsp;
                  <i class="far fa-file-search nav-icon"></i>
                  <p>InfEq</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="siracbuscar" class="nav-link">
                  &emsp;&emsp;
                  <i class="far fa-file-search nav-icon"></i>
                  <p>Sirac</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="infeqbuscar_baja" class="nav-link">
                  &emsp;&emsp;
                  <i class="far fa-file-times nav-icon"></i>
                  <p>Formato de Baja</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="infeqbuscar_venta" class="nav-link">
                  &emsp;&emsp;
                  <i class="fal fa-file-invoice-dollar nav-icon"></i>
                  <p>Venta de Equipo</p>
                </a>
              </li>
            </ul>
          </li>


          <li id="navsettingsgrupo" class="nav-item menu-close">
            <a id="navsettings" href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Configuración
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="settings_panel" class="nav-link">
                  &emsp;&emsp;
                  <i class="fas fa-cog nav-icon"></i>
                  <p>Configuración</p>
                </a>
              </li>
            </ul>
          </li>

          
        </ul>
        </cursor>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>