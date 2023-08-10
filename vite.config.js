import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/css/app.css",
                "resources/css/style.css",
                "resources/css/slick.css",
                "resources/css/slick-theme.css",
                "resources/js/slick.min.js",
                "resources/js/slick.js",
                "resources/css/leaflet-search.css",
            ],
            refresh: true,
        }),
    ],
});
