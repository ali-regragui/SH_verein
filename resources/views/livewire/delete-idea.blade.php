<x-modal-confirm
    event-to-open-modal="custom-show-delete-modal"
    event-to-close-modal="ideaWasDeleted"
    modal-title="Beitrag löschen"
    modal-description="Du bist kurz davor den Beitrag zu löschen. Bist du sicher?"
    modal-confirm-button-text="Löschen"
    wire-click="deleteIdea"
/>
