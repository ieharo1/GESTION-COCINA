<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Menús</h2>
        <button class="btn btn-success" wire:click="openModal">➕ Nuevo Menú</button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar menús..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-success">
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Recetas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->nombre }}</td>
                    <td>{{ $menu->fecha->format('d/m/Y') }}</td>
                    <td>{{ $menu->recetas->count() }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $menu->id }})">✏️</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $menu->id }})" onclick="return confirm('¿Estás seguro?')">🗑️</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $menus->links() }}
    </div>

    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <h5>Planificador Semanal</h5>
        </div>
        <div class="card-body">
            @php
                $weeklyMenus = $this->getWeeklyMenus();
                $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
            @endphp
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            @foreach($days as $day)
                            <th>{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($days as $index => $day)
                            <td>
                                @foreach($weeklyMenus as $menu)
                                    @if(\Carbon\Carbon::parse($menu->fecha)->dayOfWeek - 1 == $index)
                                        <strong>{{ $menu->nombre }}</strong>
                                        <ul class="mb-0 small">
                                            @foreach($menu->recetas as $receta)
                                            <li>{{ $receta->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endforeach
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($showModal)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $menuId ? 'Editar Menú' : 'Nuevo Menú' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" wire:model="nombre">
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" wire:model="fecha">
                            @error('fecha') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Recetas</label>
                            @foreach($selectedRecipes as $index => $recipe)
                            <div class="row mb-2">
                                <div class="col-5">
                                    <select class="form-select" wire:model="selectedRecipes.{{ $index }}.receta_id">
                                        <option value="">Seleccionar receta</option>
                                        @foreach($availableRecipes as $receta)
                                        <option value="{{ $receta->id }}">{{ $receta->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" placeholder="Día de la semana" wire:model="selectedRecipes.{{ $index }}.dia_semana">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-danger" wire:click="removeRecipe({{ $index }})">✕</button>
                                </div>
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-secondary btn-sm" wire:click="addRecipe">➕ Agregar Receta</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $menuId ? 'update' : 'store' }}">
                        {{ $menuId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>
