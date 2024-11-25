import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
        input: [
          'resources/css/admin/style.css',
          'resources/js/admin/script.js',
          'resources/js/admin/tinymce.js'
        ],
        refresh: true,
    }),
  ],
    resolve: {
      alias: {
        '/': path.resolve(__dirname, './resources'),
        '/css': path.resolve(__dirname, './resources/css'),
        '/js': path.resolve(__dirname, './resources/js'),
        '/views': path.resolve(__dirname, './resources/views')
      }
    }
});
