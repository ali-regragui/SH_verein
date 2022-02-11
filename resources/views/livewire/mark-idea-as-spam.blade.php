<x-modal-confirm
    event-to-open-modal="custom-show-mark-idea-as-spam-modal"
    event-to-close-modal="ideaWasMarkedAsSpam"
    modal-title="Beitrag Melden"
    modal-description="Bist du dir Sicher, den Beitrag zu melden"
    modal-confirm-button-text="Melden"
    wire-click="markAsSpam"
/>
