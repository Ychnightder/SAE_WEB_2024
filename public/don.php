<?php
require_once "../src/php/views/header.php";
?>
    <main>
      <section id="don-intro">
        <h1>Pourquoi faire un don ?</h1>
        <div class="box-info">
          <div class="info-box">
            <p>
              Pourquoi nous soutenir Depuis plus de 30 ans, Autisme France se
              mobilise pour améliorer la vie des personnes autistes, mais
              beaucoup reste à faire.
            </p>

            <p>
              Nous réclamons : Un diagnostic et des interventions précoces, Un
              soutien à la scolarisation avec les aménagements nécessaires, Un
              accès au travail et au logement pour ceux qui en ont besoin, La
              fin des maltraitances institutionnelles et un meilleur accès aux
              soins.
            </p>

            <p>
              Aidez-nous à poursuivre notre mission en faisant un don à Autisme
              France.
            </p>
          </div>
          <div class="info-box">
            <p>
              Respect de votre vie privée Vos informations sont nécessaires pour
              gérer votre don et vous informer de son utilisation. Autisme
              France ne partage jamais vos données avec des tiers.
            </p>

            <p>
              Sécurité Votre paiement est sécurisé grâce au protocole SSL.
              Aucune information bancaire n'est stockée sur nos serveurs.
            </p>

            <p>
              Pour toute question, contactez notre service donateurs au 04 93 46
              01 77 ou par email à contact@autisme-france.fr.
            </p>
          </div>
        </div>
      </section>

      <section id="don-amount">
        <h2>Mon DON</h2>
        <div class="btn-don">
          <button class="btn-choix">Je fais un don ponctuel</button>
<!--          <button class="btn-choix">Je fais un don régulier</button>-->
        </div>
        <div class="div-amount-select">
          <div class="don-amount-section">
            <label for="don-amount-slider1">Choisissez un montant</label>
            <input
              type="range"
              id="don-amount-slider1"
              min="0"
              max="100"
              value="50"
            />
            <div class="range-values">
              <span>0 €</span>
              <span>100 €</span>
            </div>
            <p class="selected-amount">Choisissez le montant de votre don !</p>

            <div class="custom-amount-input">
              <input
                type="text"
                placeholder="Autre montant ponctuel"
                id="other-amount1"
              />
              <button class="currency-button">€</button>
            </div>
          </div>

<!--          <div class="don-amount-section">-->
<!--            <label for="don-amount-slider">Choisissez un montant</label>-->
<!--            <input-->
<!--              type="range"-->
<!--              id="don-amount-slider"-->
<!--              min="0"-->
<!--              max="100"-->
<!--              value="50"-->
<!--            />-->
<!--            <div class="range-values">-->
<!--              <span>0 €</span>-->
<!--              <span>100 €</span>-->
<!--            </div>-->
<!--            <p class="selected-amount">Choisissez le montant de votre don !</p>-->
<!---->
<!--            <div class="custom-amount-input">-->
<!--              <input-->
<!--                type="text"-->
<!--                placeholder="Autre montant ponctuel"-->
<!--                id="other-amount"-->
<!--              />-->
<!--              <button class="currency-button">€</button>-->
<!--            </div>-->
<!--          </div>-->
        </div>
      </section>

      <section id="don-coordinates">
        <h2>Mes coordonnées</h2>
        <div class="form-container">
          <div class="form-header">
            <button
              class="form-tab active"
              id="individual-tab"
              onclick="showForm('individual')"
            >
              <svg
                width="40"
                height="40"
                viewBox="0 0 40 40"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9.75004 28.5C11.1667 27.4167 12.75 26.5625 14.5 25.9375C16.25 25.3125 18.0834 25 20 25C21.9167 25 23.75 25.3125 25.5 25.9375C27.25 26.5625 28.8334 27.4167 30.25 28.5C31.2223 27.3612 31.9792 26.0695 32.5209 24.625C33.0625 23.1806 33.3334 21.6389 33.3334 20C33.3334 16.3056 32.0348 13.1598 29.4375 10.5625C26.8403 7.96532 23.6945 6.66671 20 6.66671C16.3056 6.66671 13.1598 7.96532 10.5625 10.5625C7.96532 13.1598 6.66671 16.3056 6.66671 20C6.66671 21.6389 6.93754 23.1806 7.47921 24.625C8.02087 26.0695 8.77782 27.3612 9.75004 28.5ZM20 21.6667C18.3612 21.6667 16.9792 21.1042 15.8542 19.9792C14.7292 18.8542 14.1667 17.4723 14.1667 15.8334C14.1667 14.1945 14.7292 12.8125 15.8542 11.6875C16.9792 10.5625 18.3612 10 20 10C21.6389 10 23.0209 10.5625 24.1459 11.6875C25.2709 12.8125 25.8334 14.1945 25.8334 15.8334C25.8334 17.4723 25.2709 18.8542 24.1459 19.9792C23.0209 21.1042 21.6389 21.6667 20 21.6667ZM20 36.6667C17.6945 36.6667 15.5278 36.2292 13.5 35.3542C11.4723 34.4792 9.70837 33.2917 8.20837 31.7917C6.70837 30.2917 5.52087 28.5278 4.64587 26.5C3.77087 24.4723 3.33337 22.3056 3.33337 20C3.33337 17.6945 3.77087 15.5278 4.64587 13.5C5.52087 11.4723 6.70837 9.70837 8.20837 8.20837C9.70837 6.70837 11.4723 5.52087 13.5 4.64587C15.5278 3.77087 17.6945 3.33337 20 3.33337C22.3056 3.33337 24.4723 3.77087 26.5 4.64587C28.5278 5.52087 30.2917 6.70837 31.7917 8.20837C33.2917 9.70837 34.4792 11.4723 35.3542 13.5C36.2292 15.5278 36.6667 17.6945 36.6667 20C36.6667 22.3056 36.2292 24.4723 35.3542 26.5C34.4792 28.5278 33.2917 30.2917 31.7917 31.7917C30.2917 33.2917 28.5278 34.4792 26.5 35.3542C24.4723 36.2292 22.3056 36.6667 20 36.6667Z"
                  fill="white"
                />
              </svg>

              <p>Particulier</p>
            </button>
            <button
              class="form-tab"
              id="organization-tab"
              onclick="showForm('organization')"
            >
              <svg
                width="40"
                height="28"
                viewBox="0 0 40 28"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M0 27.3333V22.7083C0 21.7639 0.236111 20.8889 0.708333 20.0833C1.18056 19.2777 1.83333 18.6666 2.66667 18.25C3.05556 18.0555 3.43056 17.875 3.79167 17.7083C4.18056 17.5416 4.58333 17.3889 5 17.25V27.3333H0ZM6.66667 15.6666C5.27778 15.6666 4.09722 15.1805 3.125 14.2083C2.15278 13.2361 1.66667 12.0555 1.66667 10.6666C1.66667 9.27774 2.15278 8.09718 3.125 7.12496C4.09722 6.15274 5.27778 5.66663 6.66667 5.66663C8.05556 5.66663 9.23611 6.15274 10.2083 7.12496C11.1806 8.09718 11.6667 9.27774 11.6667 10.6666C11.6667 12.0555 11.1806 13.2361 10.2083 14.2083C9.23611 15.1805 8.05556 15.6666 6.66667 15.6666ZM6.66667 12.3333C7.13889 12.3333 7.52778 12.1805 7.83333 11.875C8.16667 11.5416 8.33333 11.1388 8.33333 10.6666C8.33333 10.1944 8.16667 9.80552 7.83333 9.49996C7.52778 9.16663 7.13889 8.99996 6.66667 8.99996C6.19444 8.99996 5.79167 9.16663 5.45833 9.49996C5.15278 9.80552 5 10.1944 5 10.6666C5 11.1388 5.15278 11.5416 5.45833 11.875C5.79167 12.1805 6.19444 12.3333 6.66667 12.3333ZM6.66667 27.3333V22.6666C6.66667 21.7222 6.90278 20.8611 7.375 20.0833C7.875 19.2777 8.52778 18.6666 9.33333 18.25C11.0556 17.3888 12.8056 16.75 14.5833 16.3333C16.3611 15.8889 18.1667 15.6666 20 15.6666C21.8333 15.6666 23.6389 15.8889 25.4167 16.3333C27.1944 16.75 28.9444 17.3888 30.6667 18.25C31.4722 18.6666 32.1111 19.2777 32.5833 20.0833C33.0833 20.8611 33.3333 21.7222 33.3333 22.6666V27.3333H6.66667ZM10 24H30V22.6666C30 22.3611 29.9167 22.0833 29.75 21.8333C29.6111 21.5833 29.4167 21.3888 29.1667 21.25C27.6667 20.5 26.1528 19.9444 24.625 19.5833C23.0972 19.1944 21.5556 19 20 19C18.4444 19 16.9028 19.1944 15.375 19.5833C13.8472 19.9444 12.3333 20.5 10.8333 21.25C10.5833 21.3888 10.375 21.5833 10.2083 21.8333C10.0694 22.0833 10 22.3611 10 22.6666V24ZM20 14C18.1667 14 16.5972 13.3472 15.2917 12.0416C13.9861 10.7361 13.3333 9.16663 13.3333 7.33329C13.3333 5.49996 13.9861 3.93052 15.2917 2.62496C16.5972 1.3194 18.1667 0.666626 20 0.666626C21.8333 0.666626 23.4028 1.3194 24.7083 2.62496C26.0139 3.93052 26.6667 5.49996 26.6667 7.33329C26.6667 9.16663 26.0139 10.7361 24.7083 12.0416C23.4028 13.3472 21.8333 14 20 14ZM20 10.6666C20.9167 10.6666 21.6944 10.3472 22.3333 9.70829C23 9.04163 23.3333 8.24996 23.3333 7.33329C23.3333 6.41663 23 5.63885 22.3333 4.99996C21.6944 4.33329 20.9167 3.99996 20 3.99996C19.0833 3.99996 18.2917 4.33329 17.625 4.99996C16.9861 5.63885 16.6667 6.41663 16.6667 7.33329C16.6667 8.24996 16.9861 9.04163 17.625 9.70829C18.2917 10.3472 19.0833 10.6666 20 10.6666ZM33.3333 15.6666C31.9444 15.6666 30.7639 15.1805 29.7917 14.2083C28.8194 13.2361 28.3333 12.0555 28.3333 10.6666C28.3333 9.27774 28.8194 8.09718 29.7917 7.12496C30.7639 6.15274 31.9444 5.66663 33.3333 5.66663C34.7222 5.66663 35.9028 6.15274 36.875 7.12496C37.8472 8.09718 38.3333 9.27774 38.3333 10.6666C38.3333 12.0555 37.8472 13.2361 36.875 14.2083C35.9028 15.1805 34.7222 15.6666 33.3333 15.6666ZM33.3333 12.3333C33.8056 12.3333 34.1944 12.1805 34.5 11.875C34.8333 11.5416 35 11.1388 35 10.6666C35 10.1944 34.8333 9.80552 34.5 9.49996C34.1944 9.16663 33.8056 8.99996 33.3333 8.99996C32.8611 8.99996 32.4583 9.16663 32.125 9.49996C31.8194 9.80552 31.6667 10.1944 31.6667 10.6666C31.6667 11.1388 31.8194 11.5416 32.125 11.875C32.4583 12.1805 32.8611 12.3333 33.3333 12.3333ZM35 27.3333V17.25C35.4167 17.3889 35.8056 17.5416 36.1667 17.7083C36.5556 17.875 36.9444 18.0555 37.3333 18.25C38.1667 18.6666 38.8194 19.2777 39.2917 20.0833C39.7639 20.8889 40 21.7639 40 22.7083V27.3333H35Z"
                  fill="white"
                />
              </svg>

              <p>Organisation</p>
            </button>
          </div>

          <!-- Formulaire pour particulier -->
          <form id="individual-form" class="form-content active">
            <label for="email">Adresse E-Mail *</label>
            <input type="email" id="email" placeholder="E-Mail" required />

            <label for="civility">Civilité *</label>
            <select id="civility" required>
              <option>Selectionner</option>
              <option>M.</option>
              <option>Mme</option>
            </select>

            <label for="first-name">Prénom *</label>
            <input type="text" id="first-name" placeholder="Prénom" required />

            <label for="last-name">Nom *</label>
            <input type="text" id="last-name" placeholder="Nom" required />

            <label for="phone">Téléphone *</label>
            <input type="tel" id="phone" placeholder="Téléphone" required />

            <label for="address">Adresse *</label>
            <input
              type="text"
              id="address"
              placeholder="Adresse Postal"
              required
            />

            <label for="address-complement">Complément d’adresse</label>
            <input
              type="text"
              id="address-complement"
              placeholder="Complément"
            />

            <label for="city">Ville *</label>
            <input type="text" id="city" placeholder="Ville" required />

            <label for="postal-code">Code Postal *</label>
            <input
              type="text"
              id="postal-code"
              placeholder="Code Postal"
              required
            />

            <p class="mandatory-fields">* Champs obligatoires</p>
          </form>

          <!-- Formulaire pour organisation -->
          <form id="organization-form" class="form-content">
            <label for="org-email">Adresse E-Mail *</label>
            <input type="email" id="org-email" placeholder="E-Mail" required />

            <label for="org-name">Société *</label>
            <input type="text" id="org-name" placeholder="Société" required />

            <label for="org-civility">Civilité *</label>
            <select id="org-civility" required>
              <option>Selectionner</option>
              <option>M.</option>
              <option>Mme</option>
            </select>

            <label for="org-first-name">Prénom *</label>
            <input
              type="text"
              id="org-first-name"
              placeholder="Prénom"
              required
            />

            <label for="org-last-name">Nom *</label>
            <input type="text" id="org-last-name" placeholder="Nom" required />

            <label for="org-phone">Téléphone *</label>
            <input type="tel" id="org-phone" placeholder="Téléphone" required />

            <label for="org-address">Adresse *</label>
            <input
              type="text"
              id="org-address"
              placeholder="Adresse Postal"
              required
            />

            <label for="org-address-complement">Complément d’adresse</label>
            <input
              type="text"
              id="org-address-complement"
              placeholder="Complément"
            />

            <label for="org-city">Ville *</label>
            <input type="text" id="org-city" placeholder="Ville" required />

            <label for="org-postal-code">Code Postal *</label>
            <input
              type="text"
              id="org-postal-code"
              placeholder="Code Postal"
              required
            />

            <p class="mandatory-fields">* Champs obligatoires</p>
          </form>
        </div>
      </section>
      <section id="don-payment">
        <h2>Mon payement</h2>
        <div class="div-btn-mode">
          <button
            class="btn-select-mode"
            onclick="location.href='donCb.php'"
          >
            Payer par carte bancaire
          </button>
<!--          <button-->
<!--            class="btn-select-mode"-->
<!--            onclick="location.href='donCheque.php'"-->
<!--          >-->
<!--            Payer par chèque-->
<!--          </button>-->
        </div>

        <div class="info">
          Paiement en toute confiance Ce site est 100% sécurisé. Vos
          informations bancaires ne sont en aucun cas conservées sur nos
          systèmes informatiques. Grâce au cryptage SSL de vos données, vous
          êtes assurés de la fiabilité des transactions.
        </div>
      </section>
    </main>
<?php
require_once "../src/php/views/footer.php";
?>
