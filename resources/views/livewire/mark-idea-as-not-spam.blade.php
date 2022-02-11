<x-modal-confirm
    event-to-open-modal="custom-show-mark-idea-as-not-spam-modal"
    event-to-close-modal="ideaWasMarkedAsNotSpam"
    modal-title="Meldung Löschen"
    modal-description="bist du dir sicher, die Anzahl der Meldungen wieder auf 0 zu setzen"
    modal-confirm-button-text="Meldungen Löschen"
    wire-click="markAsNotSpam"
/>
