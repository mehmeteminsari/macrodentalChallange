<template>
  <Navbar />
  <div class="container mt-5">
    <form @submit.prevent="updateUser">
      <div class="row">
        <div class="col-md-6">
          <img :src="'/storage/' + photoId" alt="picture" id="dd" />
          <div class="form-group">
            <label for="image">Profil Fotoğrafı </label>
            <input type="file" ref="myfile" @change="fileUpload" multiple />
          </div>
          <br />
          <div class="form-group">
            <label for="fname">Ad</label>
            <input
              type="text"
              class="form-control"
              id="fname"
              placeholder="isminizi giriniz"
              v-model="form.fname"
              required
            />
          </div>
          <br />
          <div class="form-group">
            <label for="lname">Soyad</label>
            <input
              type="text"
              class="form-control"
              id="lname"
              placeholder="Soyadinizi giriniz"
              v-model="form.lname"
            />
          </div>
          <br />

          <div class="form-group">
            <label for="balance">Bakiye</label>
            <input
              type="number"
              class="form-control"
              id="balance"
              placeholder="Bakiyenizi giriniz"
              v-model="form.balance"
              min="10"
              max="1000"
            />
          </div>
          <br />
          <div class="form-group">
            <label for="password">Şifre</label>
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder="Parolanızı giriniz"
              v-model="form.password"
            />
          </div>
          <br />
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone">Telefon</label>
            <InputMask
              v-model="form.phone"
              class="form-control"
              mask="+99 (999) 99 99"
            />
          </div>

          <br />
          <div class="form-group">
            <label for="birthday">Tarih</label>
            <input
              type="date"
              class="form-control"
              id="birth_day"
              placeholder="Cep Telefon Numarınızı giriniz"
              v-model="form.birth_day"
            />
          </div>
          <br />

          <div class="form-group">
            <label for="city">Şehir Seçiniz</label>
            <select
              class="form-control"
              id="city"
              v-model="form.city"
              @change="handleChange($event)"
            >
              <option v-for="city in city" :key="city.id">
                {{ city.name }}
              </option>
            </select>
          </div>
          <br />

          <div class="form-group">
            <label for="district">İlçe Seçiniz</label>
            <select class="form-control" id="district" v-model="form.district">
              <option disabled hidden selected>{{ form.district }}</option>
              <option v-for="dist in dists" :key="dist.id">
                {{ dist.name }}
              </option>
            </select>
          </div>

          <br />

          <div class="form-group">
            <label class="form-check-label" for="notification">
              Bildirimlere izin ver

            </label>
            <div class="col-1">
              <SelectButton
                class="d-flex"
                v-model="form.natification"
                :options="options"
              />
            </div>
          </div>
          <br />
        </div>

        <button id="gonder" type="submit" class="btn btn-dark">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
import { ref, defineComponent } from "vue";
import Navbar from "./Navbar.vue";
import axios from "axios";
import InputMask from "primevue/inputmask";
import SelectButton from "primevue/selectbutton";
import "primevue/resources/themes/saga-blue/theme.css";
import InputNumber from "primevue/inputnumber";

export default defineComponent({
  name: "Form",
  props: ["user"],
  components: {
    Navbar,
    InputMask,
    SelectButton,
    InputNumber,
  },
  data() {
    return {
      city: [],
      dists: [],
      options: ["hayir", "evet"],
      form: {
        fname: "",
        lname: "",
        balance: "",
        password: "",
        phone: "",
        birth_day: "",
        city: "",
        district: "",
        natification: "",
        file: [],
        image: "",
      },
    };
  },
  created() {
    this.form.fname = this.$props.user.fname;
    this.form.lname = this.$props.user.lname;
    this.form.balance = this.$props.user.balance;
    this.form.phone = this.$props.user.phone;
    this.form.password = this.$props.user.password;
    this.form.birth_day = this.$props.user.birth_day;
    this.form.district = this.$props.user.district_name;
    this.form.city = this.$props.user.city_name;
    this.form.image = this.$props.user.p_image;
    if (this.$props.user.natification === 1) {
      this.form.natification = "evet";
    } else {
      this.form.natification = "hayir";
    }

    let photoInfo = this.form.image;
    if (photoInfo) {
      this.photoId = photoInfo.split("/")[1];
    }

    fetch("/citylist")
      .then((res) => res.json())
      .then((res) => (this.city = res));
  },

  methods: {
    fileUpload() {
      this.form.file = this.$refs.myfile.files[0];
    },
    distselect() {
      fetch("/distlist")
        .then((res) => res.json())
        .then((res) => (this.dist = res));
    },
    async handleChange(event) {
      let citiest = event.target.value;
      let filterCity = this.city.filter((item) => item.name === citiest);
      let cityId = filterCity.map((item) => item.id);
      await fetch(`/${cityId[0]}/distlist`)
        .then((res) => res.json())
        .then((res) => (this.dists = res));
    },
    async updateUser() {
      let data = {
        fname: this.form.fname,
        lname: this.form.lname,
        balance: this.form.balance,
        phone: this.form.phone,
        password: this.form.password,
        birth_day: this.form.birth_day,
        district_name: this.form.district,
        city_name: this.form.city,
      };
      if (this.form.natification === "hayir") {
        data.natification = 0;
      } else {
        data.natification = 1;
      }
      let fd = new FormData();
      fd.append("p_image", this.form.file);

      if (this.form.file) {
        await axios
          .post(`/photo/${this.$props.user.id}`, fd, {
            headers: {
              "Content-type": "application/json",
              "Content-Type": "multipart/form-data",
            },
          })
          .then((res) => console.log(res));
      }

      this.$inertia.visit(`/${this.$props.user.id}`, {
        method: "post",
        data: data,
        replace: false,
        preserveState: false,
        preserveScroll: false,
        only: [],
        headers: {},
        errorBag: null,
        forceFormData: false,
        onSuccess: () => alertify.success("GUNCELLENDI"),
        onError: () => {
          alert("Basarisiz");
        },
      });
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
    },
  },
});
</script>



<style>
label {
  font-size: 18px;
  font-weight: bold;
  font-family: "Courier New";
}
#gonder {
  width: 13%;
}
form {
  padding: 30px;
  border-radius: 16px;
  box-shadow: -1px 0px 23px -1px rgba(0, 0, 0, 0.74);
  -webkit-box-shadow: -1px 0px 23px -1px rgba(0, 0, 0, 0.74);
  -moz-box-shadow: -1px 0px 23px -1px rgba(0, 0, 0, 0.74);
}
#dd {
  width: 100px;
  height: 75px;
  object-fit: cover;
  margin-bottom: 2px;
}
</style>
