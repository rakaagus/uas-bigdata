<template>
  <main class="flex-1 pb-8">
    <div class="flex items-center justify-between py-7 px-10">
      <div>
        <h1 class="text-2xl font-semibold leading-relaxed text-gray-800">
          Books
        </h1>
        <p class="text-sm font-medium text-gray-500">
          Let's grow to your business! Create your product and upload here
        </p>
      </div>
      <router-link
        to="/dashboard/addbuku"
        class="
          inline-flex
          gap-x-2
          items-center
          py-2.5
          px-6
          text-white
          bg-indigo-600
          rounded-xl
          hover:bg-indigo-700
          focus:outline-none
          focus:ring-2
          focus:ring-indigo-500
          focus:ring-offset-1
        "
      >
        <font-awesome-icon icon="fa-solid fa-plus" />
        <span class="text-sm font-semibold tracking-wide">Create Item</span>
      </router-link>
    </div>

    <table class="w-full border-b border-gray-200">
      <thead>
        <tr class="text-sm font-medium text-gray-700 border-b border-gray-200">
          <td class="pl-10">
            <div class="flex items-center">
              <span>Judul Buku</span>
            </div>
          </td>
          <td class="py-4 px-4 text-center">pengarang</td>
          <td class="py-4 px-4 text-center">penerbit</td>
          <td class="py-4 px-4 text-center">tahun</td>
          <td class="py-4 px-4 text-center">jenis</td>
          <td class="py-4 px-4 text-center">Action</td>
        </tr>
      </thead>
      <tbody v-for="book in books" :key="'book-' + book">
        <book-items :book="book"></book-items>
      </tbody>
    </table>

    <div class="flex gap-x-2 justify-center pt-8">
      <button class="flex justify-center items-center w-8 h-8">
        <font-awesome-icon
          icon="fa-solid fa-chevron-left"
          class="w-6 h-6 to-gray-800 stroke-current hover:text-indigo-600"
        />
      </button>
      <button
        v-for="jumlahPage in lengthPage"
        @click="getBookshelf"
        class="
          flex
          items-center
          justify-center
          w-8
          h-8
          font-medium
          rounded-full
        "
        :key="jumlahPage"
        :class="
          jumlahPage === 1
            ? 'bg-gray-800 text-white'
            : 'text-gray-400 hover:text-indigo-600'
        "
      >
        {{ jumlahPage }}
      </button>
      <button class="flex justify-center items-center w-8 h-8">
        <font-awesome-icon
          icon="fa-solid fa-chevron-right"
          class="w-6 h-6 to-gray-800 stroke-current hover:text-indigo-600"
        />
      </button>
    </div>
  </main>
</template>

<script>
import BookItems from "../../../components/Book/BookItems.vue";
export default {
  data() {
    return {
      page: 1,
      lengthPage: 0,
      books: [],
    };
  },
  components: {
    BookItems,
  },
  created() {
    this.getBook();
  },
  methods: {
    getNameBook() {
      for (let i = 0; i < this.books.length; i++) {
        const config = {
          methods: "get",
          url: "/api/bookshelf/" + this.books.bookshelves_id,
        };
        axios(config)
          .then((response) => {
            let { data } = response.data;
            this.books.bookshelves_id = data.name;
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getBook() {
      const config = {
        methods: "get",
        url: "/api/getallbooks?page=" + this.page,
      };
      axios(config)
        .then((response) => {
          let { data } = response.data;
          this.books = data.book.data;
          this.page = data.book.current_page;
          this.lengthPage = data.book.last_page;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
