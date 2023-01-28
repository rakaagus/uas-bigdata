<template>
  <tr class="hover:bg-gray-100 transition-colors group">
    <td class="flex gap-x-4 items-center py-4 pl-10">
      <div class="font-semibold text-gray-700">{{ bookshelf.name }}</div>
    </td>
    <td class="font-medium text-center">
      <router-link
        :to="'/dashboard/updatebookshelf/' + bookshelf._id"
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
      <delete-modal :bookshelfId="bookshelf._id"></delete-modal>
      <!-- <router-link
            to="/dashboard/addbookshelf"
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
            <font-awesome-icon icon="fa-solid fa-trash" />
          </router-link> -->
    </td>
  </tr>
</template>

<script>
import DeleteModal from "./DeleteModal.vue";
export default {
  props: ["bookshelf"],
  data() {
    return {};
  },
  components: {
    DeleteModal,
  },
};
</script>
