import { defineConfig } from "vite";
import path from "path";
export default defineConfig({
  root: "./",
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "src"), // Alias pour simplifier l'accès aux fichiers sous "src"
    },
  },

  build: {
    outDir: "dist", // Dossier de sortie pour le build
    rollupOptions: {
      input: {
        main: "./index.html",
        contact: "./src/contact.html",
        adhesionconnexion: "./src/adhesion-connexion.html",
        don: "./src/don.html",
        donCheque: "./src/donCheque.html",
        donCb: "./src/donCb.html",
        admin: "./src/admin.html",
      },
    },
  },
});
