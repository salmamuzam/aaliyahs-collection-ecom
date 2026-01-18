import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/dropdown.js",
                "resources/js/sidebar.js",
                "resources/js/product-detail.js",
            ],
            refresh: true,
        }),
    ],
});
