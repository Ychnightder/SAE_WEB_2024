<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/main.css" />
    <link rel="stylesheet" href="./assets/css/adhesion-connexion.css"  />
    <script
      src="./assets/js/adhesion-connexion.js"
      type="module"
    ></script>
    <title>Login</title>
  </head>
  <body>
    <main class="main">
      <div class="wrapper-main">
        <div class="leftBox">
          <div class="logoBox">
            <a href="index.php">
              <img src="./assets/image/shared/logo.png" alt="logo autisme france"
            /></a>
          </div>
          <h1 class="title-AC">
            Bienvenue sur l'intranet <br />d'Autisme France
          </h1>
          <div class="formBox">
            <div class="div-form-conexion">
              <form
                action="../src/php/adhesion/process_connect_user.php"
                method="post"
                class="form-conexion"
              >
                <div class="input-connexion">
                  <label for="ID" aria-label="Identifiant">
                    <p>Email :</p>
                    <input id="ID" name="Identifiant" type="email" required />
                  </label>

                  <label for="password">
                    <p>Mot de passe :</p>
                    <input
                      id="password"
                      name="password"
                      type="password"
                      required
                    />
                  </label>
                  <div class="linkForget">
                    <a href="#">Mot de passe oublié</a>
                  </div>
                </div>
                <div class="divSubmit">
                  <button type="reset">Retour</button>
                  <button type="submit">Connexion</button>
                </div>
                <div class="likns-ac">
                  <p>Avez-vous un compte ?</p>
                  <div class="links-box">
                    <a class="link-online" href="#">Adhérer en ligne </a>
                    <a
                      target="_blank"
                      href="https://www.autisme-france.fr/f/e153a43c2f60efdd91367104a91ed6218c1d396a/Adhesion_AF_2024.pdf"
                      >Adhérer par voie postale</a
                    >
                  </div>
                </div>
              </form>
            </div>
            <div class="div-form-inscription">
              <form
                action=""
                method="post"
                class="form-inscription"
              >
                <div class="first-info">
                  <div class="name-firsname">
                    <label for="nom">
                      Nom :
                      <input type="text" id="nom" name="nom" required />
                    </label>
                    <label for="prenom">
                      Prenom :
                      <input type="text" id="prenom" name="prenom" required />
                    </label>
                  </div>
                  <label for="Email">
                    Adresse mail :
                    <input id="Email" type="email" name="email" required />
                  </label>

                  <label for="pwd">
                    Mot de passe :
                    <input id="pwd" type="password" name="password" required />
                  </label>

                  <div class="divSubmit">
                    <button type="reset" class="return-btn">Retour</button>
                    <button type="button" class="btn-suivant">Suivant</button>
                  </div>
                </div>
                <div class="second-info">
                  <label for="voie">
                    Voie :
                    <input type="text" id="voie" name="voie" />
                  </label>
                  <div class="info-position">
                    <label for="codepostale">
                      Code de postale :
                      <input
                        id="codepostale"
                        type="number"
                        name="codepostale"
                      />
                    </label>
                    <label for="ville">
                      Ville :
                      <input type="text" id="ville" name="ville" />
                    </label>
                  </div>
                  <label for="pays">
                    Pays :
                    <select class="select-pays" name="pays" id="pays">
                      <option selected disabled style="display: none">
                        Pays
                      </option>
                    </select>
                  </label>
                  <label for="telephone">
                    Téléphone :
                    <input id="telephone" type="number" name="telephone" />
                  </label>

                  <div class="divSubmit">
                    <button class="return-btn2" type="button">Retour</button>
                    <button type="submit">Valider</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="rightBox">
          <div class="img"></div>
        </div>
      </div>
      <div class="footer">
        <p>Mentions Légale</p>
        <a href="admin.php">Administration</a>
      </div>
    </main>
  </body>
</html>
