<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Ingredientes</h2>
        <button class="btn btn-success" wire:click="openModal">➕ Nuevo Ingrediente</button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar ingredientes..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-success">
                <tr>
                    <th>Nombre</th>
                    <th>Unidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredientes as $ingrediente)
                <tr>
                    <td>{{ $ingrediente->nombre }}</td>
                    <td>{{ $ingrediente->unidad }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $ingrediente->id }})">✏️</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $ingrediente->id }})" onclick="return confirm('¿Estás seguro?')">🗑️</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $ingredientes->links() }}
    </div>

    @if($showModal)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $ingredienteId ? 'Editar Ingrediente' : 'Nuevo Ingrediente' }}</h5>
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
                            <label class="form-label">Unidad</label>
                            <input type="text" class="form-control" wire:model="unidad" placeholder="ej: kg, g, unidades">
                            @error('unidad') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $ingredienteId ? 'update' : 'store' }}">
                        {{ $ingredienteId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>
