<!-- Modal de confirmación para eliminar empleado -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">
                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                    Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">¿Está seguro que desea eliminar al empleado <strong>{{ $empleado->nombre }}</strong>?</p>
                <p class="text-muted small mb-0">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>
                    Cancelar
                </button>
                <form style="display: inline;" 
                      hx-delete="{{ route('myDestroy', $empleado->id) }}"
                      hx-target="#empleados-table tbody"
                      hx-swap="innerHTML"
                      hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
                      hx-on::after-request="bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal')).hide()">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>