import { defineConfig } from 'vite';


export default defineConfig({
    root: './', // Définir la racine du projet (racine actuelle)
    server: {
        port: 3000, // Port pour le serveur de développement
    },
    build: {
        outDir: 'dist', // Dossier de sortie pour le build
    },
});