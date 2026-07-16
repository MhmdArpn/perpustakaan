import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  build: {
    outDir: path.resolve(__dirname, '../laravel-BE/public/build'),
    emptyOutDir: true, 
    manifest: 'manifest.json',
    rollupOptions: {
      input: 'src/main.js', 
    },
  },
  server: {
    origin: 'http://localhost:5173',
    cors: true,
  },
});