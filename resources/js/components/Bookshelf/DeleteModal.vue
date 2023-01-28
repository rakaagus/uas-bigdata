<template>
  <div>
    <button
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
        focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1
      "
      type="button"
      v-on:click="toggleModal()"
    >
      <font-awesome-icon icon="fa-solid fa-trash" />
    </button>
    <div
      v-if="showModal"
      class="
        overflow-x-hidden overflow-y-auto
        fixed
        inset-0
        z-50
        outline-none
        focus:outline-none
        justify-center
        items-center
        flex
      "
    >
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div
          class="
            border-0
            rounded-lg
            shadow-lg
            relative
            flex flex-col
            w-full
            bg-white
            outline-none
            focus:outline-none
          "
        >
          <!--header-->
          <div
            class="
              flex
              items-start
              justify-between
              p-5
              border-b border-solid border-slate-200
              rounded-t
            "
          >
            <h3 class="text-3xl font-semibold">Delete Bookshelf</h3>
            <button
              class="
                p-1
                ml-auto
                bg-transparent
                border-0
                text-black
                opacity-5
                float-right
                text-3xl
                leading-none
                font-semibold
                outline-none
                focus:outline-none
              "
              v-on:click="toggleModal()"
            >
              <span
                class="
                  bg-transparent
                  text-black
                  opacity-5
                  h-6
                  w-6
                  text-2xl
                  block
                  outline-none
                  focus:outline-none
                "
              >
                ×
              </span>
            </button>
          </div>
          <!--body-->
          <div class="relative p-6 flex-auto">
            <p class="my-4 text-slate-500 text-lg leading-relaxed">
              Are You Really want Delete this item?
            </p>
          </div>
          <!--footer-->
          <div
            class="
              flex
              items-center
              justify-end
              p-6
              border-t border-solid border-slate-200
              rounded-b
            "
          >
            <button
              class="
                text-sky-500
                bg-transparent
                border border-solid border-sky-500
                active:bg-sky-600
                font-bold
                uppercase
                text-sm
                px-6
                py-3
                rounded
                outline-none
                focus:outline-none
                mr-1
                mb-1
                ease-linear
                transition-all
                duration-150
              "
              type="button"
              v-on:click="toggleModal()"
            >
              Close
            </button>
            <button
              class="
                text-red-500
                background-transparent
                font-bold
                uppercase
                px-6
                py-2
                text-sm
                outline-none
                focus:outline-none
                mr-1
                mb-1
                ease-linear
                transition-all
                duration-150
              "
              type="button"
              v-on:click="deleteBookshelf()"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

  <script>
export default {
  props: ["bookshelfId"],
  name: "delete-modal",
  data() {
    return {
      showModal: false,
    };
  },
  methods: {
    toggleModal() {
      this.showModal = !this.showModal;
    },
    deleteBookshelf() {
      const config = {
        method: "post",
        url: "/api/bookshelf/" + this.bookshelfId,
        params: { _method: "DELETE" },
      };
      axios(config)
        .then((response) => {
          this.toggleModal();
          this.$router.push("/dashboard/bookshelf");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
