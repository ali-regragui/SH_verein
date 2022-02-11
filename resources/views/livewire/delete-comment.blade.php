<x-modal-confirm
    livewire-event-to-open-modal="deleteCommentWasSet"
    event-to-close-modal="commentWasDeleted"
    modal-title="Kommentar Löschen"
    modal-description="bist du dir Sicher, diesen Kommentar zu löschen"
    modal-confirm-button-text="Löschen"
    wire-click="deleteComment"
/>
