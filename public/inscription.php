<?php
require"../src/php/views/headerAC.php";
?>
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
        <div class="div-form-inscription">
            <form
                    class="form-inscription"

                    method="post"
                action="index.php?action=register_user"
            >
                <!--            ../src/php/adhesion-connexion/process_register_user.php-->

                <div class="first-info">
                    <div class="name-firsname">
                        <label for="nom">
                            Nom :
                            <input type="text" id="nom" name="nom" required />
                            <span class="error-message"></span>

                        </label>
                        <label for="prenom">
                            Prenom :
                            <input type="text" id="prenom" name="prenom" required />
                            <span class="error-message"></span>

                        </label>
                    </div>
                    <label for="Email">
                        Adresse mail :
                        <input id="Email" type="email" name="email" required />
                        <span class="error-message"></span>

                    </label>

                    <label for="pwd">
                        Mot de passe :
                        <input id="pwd" type="password" name="password" required />
                        <span class="error-message"></span>

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
                        <span class="error-message"></span>

                    </label>
                    <div class="info-position">
                        <label for="codepostale">
                            Code de postale :
                            <input
                                id="codepostale"
                                type="number"
                                name="codepostale"
                            />
                            <span class="error-message"></span>

                        </label>
                        <label for="ville">
                            Ville :
                            <input type="text" id="ville" name="ville" />
                            <span class="error-message"></span>

                        </label>
                    </div>
                    <label for="pays">
                        Pays :
                        <select class="select-pays" name="pays" id="pays">


                            <option selected  name="pays">
                                France
                            </option>
                        </select>
                        <span class="error-message"></span>

                    </label>
                    <label for="telephone">
                        Téléphone :
                        <input id="telephone" type="number" name="telephone" />
                        <span class="error-message"></span>

                    </label>

                    <div class="divSubmit">
                        <button class="return-btn2" type="button" >Retour</button>
                        <button type="submit">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
   
<?php
require "../src/php/views/footerAC.php";
?>