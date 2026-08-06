import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/js/project-form.js',
        'resources/js/show-locale.js',
      ],
      refresh: true,
    }),
  ],
  server: {
    host: '0.0.0.0',
    port: 5174,
    strictPort: true,
    origin: 'http://localhost:5174',
    hmr: {
      host: 'localhost',
    },
  },
});
