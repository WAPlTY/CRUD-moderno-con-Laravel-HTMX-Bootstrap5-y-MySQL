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
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn"
                        data-delete-url="{{ route('myDestroy', $empleado->id) }}"
                        data-csrf-token="{{ csrf_token() }}">
                    <i class="bi bi-trash me-1"></i>
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    // Mostrar la modal automáticamente
    const modal = document.getElementById('confirmDeleteModal');
    if (modal) {
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
        
        // Limpiar la modal del DOM cuando se cierre
        modal.addEventListener('hidden.bs.modal', function() {
            document.querySelector('.modal_container').innerHTML = '';
        });
    }
    
    // Manejar la confirmación de eliminación
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        const deleteUrl = this.dataset.deleteUrl;
        const csrfToken = this.dataset.csrfToken;
        
        // Ejecutar la eliminación con HTMX
        htmx.ajax('DELETE', deleteUrl, {
            target: '#empleados-table tbody',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        
        // Cerrar la modal
        bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal')).hide();
    });
})();
</script>