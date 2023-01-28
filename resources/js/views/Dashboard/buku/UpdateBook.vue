<template>
  <main class="flex-1 pb-8">
    <div class="flex items-center justify-between py-7 px-10">
      <div>
        <h1 class="text-2xl font-semibold leading-relaxed text-gray-800">
          Products
        </h1>
        <p class="text-sm font-medium text-gray-500">
          Let's grow to your business! Create your product and upload here
        </p>
      </div>
    </div>
    <form class="py-6 px-9" v-on:submit.prevent="updateBook">
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
          for="title"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Book Title:
        </label>
        <input
          v-model="book.title"
          type="text"
          name="title"
          id="title"
          placeholder="Please Enter Book Title"
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

      <div class="mb-5">
        <label
          for="title"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Pengarang Buku:
        </label>
        <input
          v-model="book.pengarang"
          type="text"
          name="title"
          id="title"
          placeholder="Please Enter Pengarang Buku"
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

      <div class="mb-5">
        <label
          for="penerbit"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Penerbit Buku:
        </label>
        <input
          v-model="book.penerbit"
          type="text"
          name="penerbit"
          id="penerbit"
          placeholder="Please Enter Penerbit Buku"
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

      <div class="mb-5">
        <label
          for="tahun"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          tahun Buku:
        </label>
        <input
          v-model="book.tahun"
          type="number"
          name="tahun"
          id="tahun"
          placeholder="Please Enter tahun Buku"
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

      <div class="mb-5">
        <label
          for="tahun"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Bookshelf:
        </label>
        <select
          v-model="bookshelves_id"
          name="Bookshelf"
          id="Bookshelf"
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
        >
          <option :value="book.bookshelves._id" selected>
            {{ book.bookshelves.name }}
          </option>
          <option
            v-for="bookshelf in bookshelfs"
            :key="bookshelf"
            :value="bookshelf._id"
          >
            {{ bookshelf.name }}
          </option>
        </select>
      </div>

      <div class="mb-2">
        <label
          for="Jenis Buku"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          jenis Buku:
        </label>
        <div class="mb-2" v-for="(li, index) in loopingInput" :key="li">
          <input
            v-model="form.jenis[index]"
            type="text"
            name="Jenis Buku"
            id="Jenis Buku"
            placeholder="Please Enter Jenis Buku"
            class="
              max-w-4xl
              rounded-md
              border border-[#e0e0e0]
              bg-white
              py-3
              px-6
              text-base
              font-medium
              text-[#6B7280]
              outline-none
              mr-5
              focus:border-[#6A64F1] focus:shadow-md
            "
          />
          <a
            @click="addRowJenis"
            class="
              inline-flex
              mr-5
              gap-x-2
              items-center
              py-3
              px-3
              text-white
              bg-green-600
              rounded-md
              hover:bg-green-700
              focus:outline-none
              focus:ring-2
              focus:ring-green-500
              focus:ring-offset-1
            "
          >
            <font-awesome-icon icon="fa-solid fa-plus" />
          </a>

          <a
            @click="removeRow(index)"
            class="
              inline-flex
              gap-x-2
              items-center
              py-3
              px-3
              text-white
              bg-red-600
              rounded-md
              hover:bg-red-700
              focus:outline-none
              focus:ring-2
              focus:ring-red-500
              focus:ring-offset-1
            "
          >
            <font-awesome-icon icon="fa-solid fa-x" />
          </a>
        </div>
      </div>

      <div class="my-5">
        <label
          for="tahun"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Sipnosis Buku:
        </label>
        <textarea
          v-model="book.sipnosis"
          placeholder="please enter book sinpnosis"
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
          name=""
          id=""
          cols="30"
          rows="10"
        ></textarea>
      </div>

      <div class="mb-6 pt-4">
        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
          Upload File
        </label>

        <div class="mb-8">
          <input
            type="file"
            name="cover"
            id="file"
            class="sr-only"
            ref="cover"
          />
          <label
            for="file"
            class="
              relative
              flex
              min-h-[200px]
              items-center
              justify-center
              rounded-md
              border border-dashed border-[#e0e0e0]
              p-12
              text-center
            "
          >
            <div>
              <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                Drop files here
              </span>
              <span class="mb-2 block text-base font-medium text-[#6B7280]">
                Or
              </span>
              <span
                class="
                  inline-flex
                  rounded
                  border border-[#e0e0e0]
                  py-2
                  px-7
                  text-base
                  font-medium
                  text-[#07074D]
                "
              >
                Browse
              </span>
            </div>
          </label>
        </div>
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
      </div>
    </form>
  </main>
</template>

  <script>
import { ref, reactive } from "vue";
export default {
  setup() {
    const form = reactive({ jenis: [] });

    const loopingInput = ref([
      {
        jenis: "",
      },
    ]);

    const addRowJenis = () => {
      loopingInput.value.push({ jenis: "" });
    };
    const removeRow = (index) => {
      if (loopingInput.value.length > 1) {
        loopingInput.value.splice(index, 1);
      }
    };
    return {
      form,
      loopingInput,
      addRowJenis,
      removeRow,
    };
  },
  data() {
    return {
      errors: [],
      book: {
        title: "",
        pengarang: "",
        penerbit: "",
        tahun: null,
        bookshelves: {},
        sipnosis: "",
        _id: "",
        image: "",
        isBooked: "",
      },
      bookshelves_id: "",
      bookshelfs: [],
    };
  },
  created() {
    this.getDataBookshelf();
    this.getDetailBook();
  },
  methods: {
    validationForm() {
      this.errors = [];

      if (this.book.title.length < 5) {
        this.errors.push("nama Bookshalf Harus lebih besar dari 5 karakter");
      }

      if (this.book.title.length === 0) {
        this.errors.push("nama Bookshalf Harus di isi");
      }
    },
    getDataBookshelf() {
      const config = {
        method: "get",
        url: "/api/bookshelf",
      };
      axios(config)
        .then((response) => {
          this.bookshelfs = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getDetailBook() {
      let { id } = this.$route.params;
      const config = {
        method: "get",
        url: "/api/book/" + id,
      };
      axios(config)
        .then((response) => {
          const data = response.data.data;
          this.book.title = data.title;
          this.book._id = data._id;
          this.book.bookshelves = data.bookshelves;
          this.book.sipnosis = data.sipnosis;
          this.book.isBooked = data.isBooked;
          this.book.image = data.image;
          this.form.jenis = data.jenis;
          this.book.tahun = data.tahun;
          this.book.penerbit = data.penerbit;
          this.book.pengarang = data.pengarang;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateBook() {
      this.validationForm();

      let cover = this.$refs.cover.files[0];

      let formData = new FormData();
      formData.append("title", this.book.title);
      formData.append("pengarang", this.book.pengarang);
      formData.append("penerbit", this.book.penerbit);
      formData.append("tahun", this.book.tahun);
      formData.append("bookshelves_id", this.bookshelves_id);
      formData.append("isBooked", false);
      formData.append("sipnosis", this.book.sipnosis);

      for (let i = 0; i < this.form.jenis.length; i++) {
        formData.append(`jenis[${i}]`, this.form.jenis[i]);
      }

      if (cover != undefined) {
        formData.append("cover", cover);
      }

      if (this.errors.length === 0) {
        const config = {
          method: "post",
          url: "/api/book/" + this.book._id,
          data: formData,
          params: { _method: "PUT" },
        };
        axios(config)
          .then((response) => {
            alert(response.data.response_message);
            this.$router.push("/dashboard/buku");
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.show_error = true;
      }
    },
  },
};
</script>
