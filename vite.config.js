import { defineConfig } from "vite";

export default defineConfig({
  root: "./",

  build: {
    outDir: "dist", // Dossier de sortie pour le build

    rollupOptions: {
      input: {
        main: "./index.html",
        contact: "/src/contact.html",
        adhesionconnexion: "/src/adhesion-connexion.html",
        //don: '/src/don.html'
      },
    },
  },
});
