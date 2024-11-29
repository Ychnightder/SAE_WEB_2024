<?php
require_once "../src/php/views/header.php";
?>
    <div class="donation-container">
      <!-- Section Chèque -->
      <div class="section-title">Chèque</div>

      <!-- Section Récapitulatif -->
      <div class="section-title">Récapitulatif</div>

      <div class="info-container">
        <!-- Informations personnelles -->
        <div class="info-box">
          <div class="info-header">Informations personnelles</div>
          <p>Nom: <span>Jean Dupont</span></p>
          <p>Prénom: <span>Jean</span></p>
          <p>Adresse: <span>123 Rue de Paris</span></p>
        </div>

        <!-- Informations sur le don -->
        <div class="info-box">
          <div class="info-header">Informations sur le Don</div>
          <p>Montant: <span>50€</span></p>
          <p>Mode de don: <span>Mensuel / Ponctuel</span></p>
        </div>
      </div>

      <!-- Section Instructions et Informations supplémentaires -->
      <div class="section-title">Informations</div>

      <div class="additional-info">
        <p>
          Veuillez nous joindre dans une enveloppe, votre chèque à l’ordre
          “AutismeFrance” et le récapitulatif à télécharger ci-après à l’adresse
          suivant “1175 AVENUE DE LA REPUBLIQUE 06550 LA ROQUETTE-SUR-SIAGNE”
        </p>
      </div>

      <div class="receipt-option">
        <label for="postal-receipt" class="toggle-label">
          Recevoir un reçu par voie postale ?
          <input type="checkbox" id="postal-receipt" class="toggle-checkbox" />
          <span class="toggle-slider"></span>
        </label>
        <p class="description">
          En cochant cette case, une fois le paiement reçu, vous recevrez une
          facture de votre don envoyée par voie postale.
        </p>
      </div>

      <!-- Boutons de validation et d'annulation -->
      <div class="button-container">
        <button class="cancel-button" onclick="location.href='don.php'">
          Retour
        </button>
        <button class="confirm-button">Valider</button>
      </div>
    </div>

<?php
require_once "../src/php/views/footer.php";
?>