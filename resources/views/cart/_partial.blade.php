<style>
.watermark {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-70deg);
    font-size: 6rem;
    
    color: rgba(0, 0, 0, 0.1); /* Couleur noire avec 10% d'opacité */
    pointer-events: none; /* Rendre le filigrane non interactif */
    z-index: 1;
    white-space: nowrap;
    text-transform: uppercase;
}


@media print {
        @page {
          size: 80mm auto;
          margin: 0;
        }
        body {
          font-family: "Courier New", monospace;
          font-size: 12px;
          line-height: 1.2;
          text-align: left;
          width: 80mm;
          margin: 0 auto;
        }
      }

     

</style>

<div class="watermark">
    facture annulée
</div>