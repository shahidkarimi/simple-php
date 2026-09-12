import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  root: 'frontend',
  plugins: [vue()],
  build: {
    outDir: 'frontend/dist',
    emptyOutDir: true
  },
  server: {
    port: 5173
  }
})
