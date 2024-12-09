<?php
require_once "../src/php/views/headerAC.php";

session_start();
$errors = isset($_SESSION['login_errors']) ? $_SESSION['login_errors'] : [];
$oldInputs = isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs'] : [];
unset($_SESSION['login_errors'], $_SESSION['old_inputs']); // Nettoyer les sessions après récupération
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
        <div class="div-form-conexion">
            <form
                    action="index.php?action=connect_user"
                    method="post"
                    class="form-conexion"
            >
                <?php if (!empty($errors['general'])): ?>
                    <p class="error-message-general"><?= htmlspecialchars($errors['general']) ?></p>
                <?php endif; ?>

                <div class="input-connexion">
                    <label for="ID" aria-label="Identifiant">
                        <p>Email :</p>
                        <input id="ID" name="identifiant" type="email"
                               class="<?= isset($errors['identifiant']) ? 'input-error' : '' ?>"
                               value="<?= htmlspecialchars($_POST['identifiant'] ?? '') ?>"
                        />
                        <?php if (!empty($errors['identifiant'])): ?>
                            <span class="error-message"><?= htmlspecialchars($errors['identifiant']) ?></span>
                        <?php endif; ?>
                    </label>

                    <label for="password">
                        <p>Mot de passe :</p>
                        <input
                                id="password"
                                name="password"
                                type="password"

                                class="<?= isset($errors['password']) ? 'input-error' : '' ?>"
                        />
                        <?php if (!empty($errors['password'])): ?>
                            <span class="error-message"><?= htmlspecialchars($errors['password']) ?></span>
                        <?php endif; ?>
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
                        <a class="link-online" href="./inscription.php">Adhérer en ligne </a>
                        <a
                                href="https://www.autisme-france.fr/f/e153a43c2f60efdd91367104a91ed6218c1d396a/Adhesion_AF_2024.pdf"
                        >Adhérer par voie postale</a
                        >
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once "../src/php/views/footerAC.php";
?>