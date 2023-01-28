<template>
  <main class="flex-1 pb-8">
    <div class="flex items-center justify-between py-7 px-10">
      <div>
        <h1 class="text-2xl font-semibold leading-relaxed text-gray-800">
          Bookshelf
        </h1>
        <p class="text-sm font-medium text-gray-500">
          Let's grow to your business! Create your product and upload here
        </p>
      </div>
    </div>
    <form class="py-6 px-9" @submit.prevent="addBookshelf">
      <div class="mb-5 rounded-md bg-[#F5F7FB] py-4 px-8" v-if="show_error">
        <div class="flex items-center justify-between">
          <span class="truncate pr-3 text-base font-medium text-[#07074D]">
            <ul>
              <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>
          </span>
          <button class="text-[#07074D]" @click="closeError">
            <font-awesome-icon icon="fa-solid fa-x" />
          </button>
        </div>
      </div>
      <div class="mb-5">
        <label
          for="name"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Bookshelf name:
        </label>
        <input
          v-model="bookshelf.name"
          type="text"
          name="name"
          id="name"
          placeholder="Please Enter Bookshelf"
          class="
            w-full
            rounded-md
            border border-[#e0e0e0]
            bg-white
            py-3
            px-6
            text-base
            font-medium
            text-[#6B7280]
            outline-none
            focus:border-[#6A64F1] focus:shadow-md
          "
        />
      </div>

      <div>
        <button
          type="submit"
          class="
            hover:shadow-form
            w-full
            rounded-md
            bg-[#6A64F1]
            py-3
            px-8
            text-center text-base
            font-semibold
            text-white
            outline-none
          "
        >
          Add
        </button>
        <button
          class="
            mt-2
            hover:shadow-form
            w-full
            rounded-md
            bg-green-800
            py-3
            px-8
            text-center text-base
            font-semibold
            text-white
            outline-none
          "
        >
          Reset
        </button>
      </div>
    </form>
  </main>
</template>

<script>
export default {
  data() {
    return {
      errors: [],
      show_error: false,
      bookshelf: {
        name: "",
      },
    };
  },
  methods: {
    validationForm() {
      this.errors = [];

      if (this.bookshelf.name.length < 5) {
        this.errors.push("nama Bookshalf Harus lebih besar dari 5 karakter");
      }

      if (this.bookshelf.name.length === 0) {
        this.errors.push("nama Bookshalf Harus di isi");
      }
    },
    addBookshelf() {
      this.validationForm();

      let formData = new FormData();
      formData.append("name", this.bookshelf.name);

      if (this.errors.length === 0) {
        const config = {
          method: "post",
          url: "/api/bookshelf",
          data: formData,
        };
        axios(config)
          .then((response) => {
            alert(response.data.response_message);
            this.$router.push("/dashboard/bookshelf");
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.show_error = true;
      }
    },
    closeError() {
      this.show_error = false;
    },
  },
};
</script>
