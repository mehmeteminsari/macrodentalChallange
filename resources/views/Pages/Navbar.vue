<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Anasayfa</a>

    <span>
      <select>
        <option selected="1">TR</option>
        <option value="2">ENG</option>
      </select>
    </span>
  </nav>
</template>


<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "Navbar",
});
</script>


<style scoped>
.navbar{
    display: flex ;
    justify-content: space-between;
    padding: 10px 30px;
}
select{
    background: none;
    color: white;
    border: none;
}
select option{
    color: black;
    margin-top: 5px;
    border: none;

}
select:focus{
    border: none;
    outline: none;
}
</style>

