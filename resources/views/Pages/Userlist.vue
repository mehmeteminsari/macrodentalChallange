<template>
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">#id</th>
        <th scope="col">image</th>
        <th scope="col">isim</th>
        <th scope="col">soyisim</th>
        <th scope="col">bakiye</th>
        <th scope="col">telefon</th>
        <th scope="col">Dogum tarihi</th>
        <th scope="col">Sehir</th>
        <th scope="col">Ilce</th>
        <th scope="col">Bildirim izni</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(data,index) in data" :key="index">
        <th scope="row">{{ data.id }}</th>
        <td><img :src="'/storage/' + photoId[index]" alt="picture" id="pp" /></td>
        <td>{{ data.fname }}</td>
        <td>{{ data.lname }}</td>
        <td>{{ data.balance }}</td>
        <td>{{ data.phone }}</td>
        <td>{{ date }}</td>
        <td>{{ data.city_name }}</td>
        <td>{{ data.district_name }}</td>
        <td>{{ data.natification === 0 ? "yok" : "var" }}</td>
        <td>
          <inertia-link class="btn btn-sm btn-success" :href="`${data.id}`"
            ><span>Düzenle</span></inertia-link
          >
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "Userlist",
  props: ["data"],
  data(){
      return{
          photoId:[],
      }
  },
  created() {
    this.date = new Date(this.$props.data[0].birth_day).toLocaleDateString(
      "tr"
    );
    let photoInfo = this.$props.data.map(i=>i.p_image);

    let id=photoInfo.map(y=>y)
    if(id){
        this.photoId=id.map(i=>i.split("/")[1])
    }


  },
});
</script>

<style>
span {
  font-size: 13px;
}
table {
  box-shadow: -1px 0px 23px -1px rgba(0, 0, 0, 0.74);
  -webkit-box-shadow: -1px 0px 23px -1px rgba(0, 0, 0, 0.74);
  -moz-box-shadow: -1px 0px 23px -1px rgba(0, 0, 0, 0.74);
}
#pp{
    width: 60px;
    height: 60px;
    border-radius: 10%;
    object-fit: cover;
}
</style>
