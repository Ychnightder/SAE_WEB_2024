<?php
session_start();
require_once "../src/php/helpers/fonction.php";

$routes = [
    'connect_user' => '../src/php/user/process_connect_user.php',
    'register_user' => '../src/php/user/process_add_user.php',
    'connect_admin' => '../src/php/admin/process_connect_admin.php',
];

handleRequest($routes);
require_once "../src/php/views/header.php";

// Vérifier si l'utilisateur est connecté en vérifiant si l'ID de l'utilisateur est dans la session
if (isset($_SESSION['user_id'])) {
    // Si l'utilisateur est connecté, rediriger vers la page d'enquête
    $enquete_url = 'enquete.php';
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    $enquete_url = 'connexion.php';
}
?>

    <section class="section-banniere">
        <a class="link-enquete" href="<?php echo $enquete_url; ?>">Enquête</a>
        <img class="banniere" src="/assets/image/Accueil/slider.png" />
    </section>
  <main class="main-presentation">
    <div class="wrapper-main-presentation">
      <div class="presentation-header">
        <h3 class="title">AUTISME FRANCE</h3>
        <h4 class="subtitle">Association reconnue d’utilité publique</h4>
      </div>
      <div class="presentation-content">
        <p class="description">
          Environ un million de personnes vivent en France avec un trouble du
          spectre de l'autisme, mais beaucoup d’entre elles n’ont toujours pas
          droit à un diagnostic et à des interventions éducatives,
          scientifiquement validées, tout au long de leur vie. La réponse à
          leurs besoins spécifiques, appuyée sur un référentiel qualité
          autisme exigeant, conditionne leur vie parmi les autres et le
          soutien aux familles.
        </p>
        <p class="description">
          L'association conseille et aide les familles, diffuse l'information
          actualisée sur l'autisme, et ses représentants militent dans les
          instances locales et nationales pour la défense des droits des
          personnes autistes. Le réseau d'associations partenaires,
          rassemblant environ 10 000 familles, les soutient concrètement en
          proposant des services d’aide administrative et éducative grâce à
          l’expertise familiale.
        </p>
      </div>
      <div class="btn-div">
        <button><a href="#">En savoir plus</a></button>
      </div>
    </div>
    <div class="wrapper-main-img">
      <div class="cta-header">
        <h2 class="cta-title">Aidez-nous</h2>
        <h4 class="cta-subtitle">
          à défendre les droits des personnes autistes
        </h4>
      </div>

      <div class="cta-buttons-main">
        <a href="adhesion-connexion.php" class="member-button-main">
          <svg
            class="member-icon"
            width="17"
            height="17"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M13.3334 14V12.6667C13.3334 11.9594 13.0525 11.2811 12.5524 10.781C12.0523 10.281 11.374 10 10.6667 10H5.33341C4.62617 10 3.94789 10.281 3.4478 10.781C2.9477 11.2811 2.66675 11.9594 2.66675 12.6667V14M10.6667 4.66667C10.6667 6.13943 9.47284 7.33333 8.00008 7.33333C6.52732 7.33333 5.33341 6.13943 5.33341 4.66667C5.33341 3.19391 6.52732 2 8.00008 2C9.47284 2 10.6667 3.19391 10.6667 4.66667Z"
              stroke="#FFFAFA"
              stroke-width="1.6"
              stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          Espace Membre
        </a>

        <a href="don.php" class="heart-button-main">
          <svg
            width="30"
            height="30"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M13.8933 3.07333C13.5528 2.73267 13.1485 2.46243 12.7036 2.27805C12.2586 2.09368 11.7817 1.99878 11.3 1.99878C10.8183 1.99878 10.3414 2.09368 9.89643 2.27805C9.45146 2.46243 9.04717 2.73267 8.70667 3.07333L8 3.78L7.29333 3.07333C6.60554 2.38554 5.67269 1.99914 4.7 1.99914C3.72731 1.99914 2.79446 2.38554 2.10666 3.07333C1.41887 3.76112 1.03247 4.69397 1.03247 5.66666C1.03247 6.63935 1.41887 7.5722 2.10666 8.26L8 14.1533L13.8933 8.26C14.234 7.91949 14.5042 7.51521 14.6886 7.07023C14.873 6.62526 14.9679 6.14832 14.9679 5.66666C14.9679 5.185 14.873 4.70807 14.6886 4.26309C14.5042 3.81812 14.234 3.41383 13.8933 3.07333Z"
              stroke="white"
              stroke-width="1.6"
              stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </a>
      </div>

      <div class="div-cta-mess">
        <h2 class="cta-message">
          Autisme France existe uniquement grâce à votre générosité. <br />
          ❤️ Merci à tous ❤️
        </h2>
      </div>
    </div>
  </main>
  <section class="actu-carousel">
    <div class="header-title">
      <h5 class="title">ACTUALITÉS & INFOS</h5>
      <h6 class="subtitle">Austime France vous informe</h6>
    </div>

    <div class="wrapper-carousel">
      <ul class="carousel">

      </ul>
    </div>

    <div class="carousel-nav">
      <button class="prevBtn">
        <svg
          width="32"
          height="32"
          viewBox="0 0 32 32"
          fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path
            d="M20 24L12 16L20 8"
            stroke="#017ac3"
            stroke-width="3"
            stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>
      <button class="nextBtn">
        <svg
          width="32"
          height="32"
          viewBox="0 0 32 32"
          fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path
            d="M12 24L20 16L12 8"
            stroke="#017ac3"
            stroke-width="3"
            stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>
    </div>
  </section>
  <section class="parteners">
    <div class="parter-present">
      <h2 class="parter sub">Autisme France vous représente</h2>
      <p class="para">
        Autisme France œuvre pour que les besoins des personnes autistes
        soient compris et pour que leurs droits soient respectés par divers
        organismes publics ou associatifs qui ont un rôle clef dans les
        politiques du handicap, de la santé et de l'éducation.
      </p>
    </div>
    <div class="wrapper">
      <ul class="carrousel-partener">
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0001_logo-droit-au-savoir.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0002_logo-cfhe-1-320x320.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0003_logo_SOSS_2-1.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0004_Logo_FIPHFP.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0005_logo_conférence-nationale-de-sante.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0006_Logo_CAUT_WEB_72dpi-01.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0009_Conseil-TSA-TND.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0010_Collectif-handicaps.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0011_Collectif_AutismeLogo.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0012_cnsa_logo_def_quadri.png"
            alt="" />
        </li>
        <li>
          <img
            src="../assets/image/Accueil/logoPartenner/logo_0013_cncph_logo_cncph.png"
            alt="" />
        </li>
      </ul>
    </div>
  </section>

<?php
require_once "../src/php/views/footer.php";
?>