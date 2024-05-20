
    <div class="content">
        <nav class="navbar">
            <div class="container-fluid">
                <h1 class="h2">Empleados</h1>
            </div>
        </nav>
        <div class="container-fluid">
            <!-- El contenido de la tabla y los modales se carga aquí mediante JavaScript -->
            <div id="employeesTableContainer"></div>
            <div id="modalesContainer"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('./php/empleado_lista.php')
                .then(response => response.json())
                .then(data => {
                    const tableContainer = document.getElementById('employeesTableContainer');
                    const modalesContainer = document.getElementById('modalesContainer');
                    tableContainer.innerHTML = data.tabla;
                    modalesContainer.innerHTML = data.modales;
                })
                .catch(error => {
                    console.error('Error loading employee data:', error);
                });
        });
    </script>

