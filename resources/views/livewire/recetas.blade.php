<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Recetas</h2>
        <button class="btn btn-success" wire:click="openModal">➕ Nueva Receta</button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar recetas..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-success">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Tiempo (min)</th>
                    <th>Porciones</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                <tr>
                    <td>{{ $receta->name }}</td>
                    <td>{{ Str::limit($receta->description, 50) }}</td>
                    <td>{{ $receta->tiempo_preparacion }}</td>
                    <td>{{ $receta->porciones }}</td>
                    <td>{{ $receta->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $receta->id }})">✏️</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $receta->id }})" onclick="return confirm('¿Estás seguro?')">🗑️</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $recetas->links() }}
    </div>

    @if($showModal)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $recetaId ? 'Editar Receta' : 'Nueva Receta' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" wire:model="description" rows="2"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tiempo de Preparación (min)</label>
                                <input type="number" class="form-control" wire:model="tiempo_preparacion">
                                @error('tiempo_preparacion') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Porciones</label>
                                <input type="number" class="form-control" wire:model="porciones">
                                @error('porciones') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <select class="form-select" wire:model="categoria_id">
                                <option value="">Seleccionar categoría</option>
                                @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto (URL)</label>
                            <input type="text" class="form-control" wire:model="foto">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instrucciones</label>
                            <textarea class="form-control" wire:model="instrucciones" rows="4"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Ingredientes</label>
                            @foreach($selectedIngredients as $index => $ingredient)
                            <div class="row mb-2">
                                <div class="col-7">
                                    <select class="form-select" wire:model="selectedIngredients.{{ $index }}.ingrediente_id">
                                        <option value="">Seleccionar ingrediente</option>
                                        @foreach(\App\Models\Ingrediente::all() as $ing)
                                        <option value="{{ $ing->id }}">{{ $ing->nombre }} ({{ $ing->unidad }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="number" step="0.01" class="form-control" placeholder="Cantidad" wire:model="selectedIngredients.{{ $index }}.cantidad">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-danger" wire:click="removeIngredient({{ $index }})">✕</button>
                                </div>
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-secondary btn-sm" wire:click="addIngredient">➕ Agregar Ingrediente</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $recetaId ? 'update' : 'store' }}">
                        {{ $recetaId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>
