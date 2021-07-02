<template>

  <Navbar />

  <div class="container">
    <br />
    <Userlist :data="data" />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Navbar from "./Navbar.vue";
import Userlist from "./Userlist.vue";


export default defineComponent({
  name: "App",
  props: ["data"],

  components: {
    Navbar,
    Userlist,

  },
});

</script>
<style>

</style>
