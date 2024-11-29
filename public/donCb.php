<?php
require_once "../src/php/views/header.php";
?>
    <div class="donation-container">
      <!-- Section Carte Bleu -->
      <div class="section-title">Carte Bleu</div>

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
          <p>Mode de don: <span>Mensuel</span></p>
        </div>
      </div>

      <!-- Section Informations bancaire -->
      <div class="section-title">Informations bancaire</div>

      <div class="bank-info">
        <div class="bank-info2">
          <label>Numéro de carte</label>
          <input type="text" placeholder="1234 5678 1234 5678" />
          <label>Date d'expiration</label>
          <input type="text" placeholder="MM/AA" />
          <label>CVV</label>
          <input type="text" placeholder="123" />
        </div>
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

