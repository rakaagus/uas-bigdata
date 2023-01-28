<template>
  <section class="text-gray-700 body-font overflow-hidden bg-white">
    <div class="flex items-center justify-between py-3 px-10">
      <div>
        <h1 class="text-2xl font-semibold leading-relaxed text-gray-800">
          Detail buku
        </h1>
        <p class="text-sm font-medium text-gray-500">
          Let's grow to your business! Create your product and upload here
        </p>
      </div>
    </div>
    <div class="py-7">
      <div class="lg:w-4/5 mx-10 flex flex-wrap">
        <img
          class="
            lg:w-1/2
            object-cover object-center
            rounded
            border border-gray-200
          "
          :src="book.image"
        />
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
          <h2 class="text-sm title-font text-gray-500 tracking-widest">
            Title Book
          </h2>
          <h1 class="text-gray-900 text-2xl title-font font-medium mb-1">
            {{ book.title }} by {{ book.pengarang }}
          </h1>
          <div class="flex mb-4">
            <span class="flex items-center font-bold uppercase">{{
              book.bookshelves.name
            }}</span>
            <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
              <span
                v-for="jenis in book.jenis"
                :key="jenis"
                class="font-bold uppercase"
              >
                {{ jenis }} ,
              </span>
            </span>
          </div>
          <p class="leading-relaxed">
            {{ book.sipnosis }}
          </p>
          <p class="text-sm font-semibold mt-2">
            PT.{{ book.penerbit }}, at {{ book.tahun }}
          </p>
          <div class="flex mt-4">
            <button
              class="
                flex
                ml-auto
                text-white
                bg-red-500
                border-0
                py-2
                px-6
                focus:outline-none
                hover:bg-red-600
                rounded
              "
            >
              Button
            </button>
            <button
              class="
                rounded-full
                w-10
                h-10
                bg-gray-200
                p-0
                border-0
                inline-flex
                items-center
                justify-center
                text-gray-500
                ml-4
              "
            >
              <svg
                fill="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="w-5 h-5"
                viewBox="0 0 24 24"
              >
                <path
                  d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"
                ></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      book: {},
    };
  },
  created() {
    this.getDetailBook();
  },
  methods: {
    getDetailBook() {
      let { id } = this.$route.params;
      const config = {
        method: "get",
        url: "/api/book/" + id,
      };
      axios(config)
        .then((response) => {
          let { data } = response;
          this.book = data.data;
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
