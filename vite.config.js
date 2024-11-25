import { defineConfig } from "vite";
import path from "path";
import php  from 'vite-plugin-php';
export default defineConfig({
  root: "./",
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "src"), // Alias pour simplifier l'accès aux fichiers sous "src"
    },
  },
  plugins: [
    php({
      publicDirectory: "src/php", // Répertoire où se trouvent les fichiers PHP (par défaut "public")
    }),
  ],

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
       // admin: "./src/admin.html",
      },
    },
  },
});
