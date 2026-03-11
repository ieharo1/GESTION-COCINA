<div>
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Recetas</h5>
                    <p class="card-text display-4">{{ $totalRecetas }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Ingredientes</h5>
                    <p class="card-text display-4">{{ $totalIngredientes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Menús Esta Semana</h5>
                    <p class="card-text display-4">{{ $menusSemana }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Bienvenido al Sistema de Gestión de Cocina</h5>
                </div>
                <div class="card-body">
                    <p>Utilice el menú de navegación para acceder a las diferentes secciones del sistema.</p>
                    <ul>
                        <li><strong>Recetas:</strong> Gestione todas sus recetas con sus ingredientes</li>
                        <li><strong>Ingredientes:</strong> Administre el inventario de ingredientes</li>
                        <li><strong>Categorías:</strong> Organice sus recetas por categorías</li>
                        <li><strong>Menús:</strong> Planifique los menús semanales</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
