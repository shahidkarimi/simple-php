<template>
  <div style="font-family:system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;padding:2rem">
    <h1>{{ message }}</h1>
    <p><button @click="callApi">Call PHP API</button></p>
    <p v-if="apiMessage"><strong>API:</strong> {{ apiMessage }}</p>
    <p style="color:#666;font-size:0.9rem">Built with Vite + Vue 3</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: 'Hello World from Vue + Vite',
      apiMessage: null
    }
  },
  methods: {
    async callApi() {
      try {
        const res = await fetch('/api/hello');
        const json = await res.json();
        this.apiMessage = json.message;
      } catch (e) {
        this.apiMessage = 'Error calling API';
      }
    }
  }
}
</script>
