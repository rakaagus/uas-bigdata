<template>
  <tr class="hover:bg-gray-100 transition-colors group">
    <td class="flex gap-x-4 items-center py-4 pl-10">
      <img
        :src="book.image"
        alt=""
        class="
          w-40
          aspect-[3/2]
          rounded-lg
          object-cover object-top
          border border-gray-200
        "
      />
      <div>
        <router-link
          class="text-lg font-semibold text-gray-700"
          :to="'/dashboard/detailbuku/' + book._id"
          >{{ book.title }}</router-link
        >
      </div>
    </td>
    <td class="font-medium text-center">{{ book.pengarang }}</td>
    <td class="font-medium text-center">{{ book.penerbit }}</td>
    <td class="text-center">{{ book.tahun }}</td>
    <td class="text-center">
      <span v-for="jenis in book.jenis" :key="jenis"> {{ jenis }}, </span>
    </td>
    <td>
      <router-link
        :to="'/dashboard/updatebuku/' + book._id"
        class="
          inline-flex
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
        <font-awesome-icon icon="fa-solid fa-pencil" />
      </router-link>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["book"],
  data() {
    return {
      bookshelves: "",
    };
  },
  methods: {
    getNmaeBookshelf(id) {
      const config = {
        methods: "get",
        url: "/api/bookshelf/" + id,
      };
      axios(config)
        .then((response) => {
          let { data } = response.data;
          this.bookshelves = data.name;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
