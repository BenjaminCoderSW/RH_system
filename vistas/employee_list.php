<div class="content">
        <nav class="navbar">
            <div class="container-fluid">
                <h1 class="h4">Lista de Empleados</h1>
            </div>
        </nav>
        <div class="search-bar mt-3">
            <input type="text" class="form-control" id="searchEmployee" placeholder="Buscar empleado...">
        </div>
        <div class="container-fluid">
            <table class="table table-hover" id="employeesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>CURP</th>
                        <th>RFC</th>
                        <th>Número de Seguro Social</th>
                        <th>Cargo</th>
                        <th>Fecha de Ingreso</th>
                        <th>Quién lo Contrató</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>PEJL980401HDFRLL00</td>
                        <td>JPL9804015M5</td>
                        <td>123456789012</td>
                        <td>Analista</td>
                        <td>2023-04-15</td>
                        <td>Maria López</td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="showModal(1)">Ver Detalles</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Más empleados -->
                </tbody>
            </table>
        </div>
    </div>