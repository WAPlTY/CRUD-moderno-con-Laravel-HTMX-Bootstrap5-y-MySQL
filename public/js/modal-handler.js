/**
 * Manejador unificado para modales de Bootstrap con HTMX
 * Maneja automáticamente la apertura y limpieza de modales
 */
(function() {
    'use strict';
    
    // Función para mostrar modal automáticamente
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            const bootstrapModal = new bootstrap.Modal(modal);
            bootstrapModal.show();
            
            // Limpiar la modal del DOM cuando se cierre
            modal.addEventListener('hidden.bs.modal', function() {
                const container = document.querySelector('.modal_container');
                if (container) {
                    container.innerHTML = '';
                }
            });
        }
    }
    
    // Función para detectar y mostrar modales después de cargar contenido HTMX
    function detectAndShowModals() {
        const modalIds = [
            'empleadoModal',
            'empleadoEditModal', 
            'confirmDeleteModal'
        ];
        
        modalIds.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && !bootstrap.Modal.getInstance(modal)) {
                showModal(modalId);
            }
        });
    }
    
    // Escuchar cuando HTMX carga contenido nuevo
    document.body.addEventListener('htmx:afterSwap', function(evt) {
        // Detectar si se cargó una modal
        detectAndShowModals();
    });
    
    // También detectar al cargar la página inicialmente
    document.addEventListener('DOMContentLoaded', function() {
        detectAndShowModals();
    });
    
    // Escuchar eventos personalizados para cerrar modales
    document.body.addEventListener('closeModal', function(evt) {
        if (evt.detail && evt.detail.value) {
            const modal = bootstrap.Modal.getInstance(document.getElementById(evt.detail.value));
            if (modal) {
                modal.hide();
            }
        }
    });
    
})();