<template>
  <aside class="py-6 px-10 w-64 border-r border-gray-200">
    <img src="/img/logo.png" alt="" class="w-28" />
    <ul class="flex flex-col gap-y-6 pt-20">
      <li>
        <router-link
          href="#"
          class="
            flex
            gap-x-4
            items-center
            py-2
            text-gray-500
            hover:text-indigo-600
            group
          "
          to="/dashboard/bookshelf"
        >
          <span
            class="
              absolute
              w-1.5
              h-8
              bg-indigo-600
              rounded-r-full
              left-0
              scale-y-0
              -translate-x-full
              group-hover:scale-y-100 group-hover:translate-x-0
              transition-transform
              ease-in-out
            "
          />
          <font-awesome-icon icon="fa-solid fa-bookmark" />
          <span class="w-6 h-6 fill-current">Bookshelf</span>
        </router-link>
      </li>
      <li>
        <router-link
          href="#"
          class="
            flex
            gap-x-4
            items-center
            py-2
            text-gray-500
            hover:text-indigo-600
            group
          "
          to="/dashboard"
        >
          <span
            class="
              absolute
              w-1.5
              h-8
              bg-indigo-600
              rounded-r-full
              left-0
              scale-y-0
              -translate-x-full
              group-hover:scale-y-100 group-hover:translate-x-0
              transition-transform
              ease-in-out
            "
          />
          <font-awesome-icon icon="fa-solid fa-book" />
          <span class="w-6 h-6 fill-current">Buku</span>
        </router-link>
      </li>
      <li>
        <router-link
          href="#"
          class="
            flex
            gap-x-4
            items-center
            py-2
            text-gray-500
            hover:text-indigo-600
            group
          "
          to="/dashboard"
        >
          <span
            class="
              absolute
              w-1.5
              h-8
              bg-indigo-600
              rounded-r-full
              left-0
              scale-y-0
              -translate-x-full
              group-hover:scale-y-100 group-hover:translate-x-0
              transition-transform
              ease-in-out
            "
          />
          <font-awesome-icon icon="fa-solid fa-user" />
          <span class="w-6 h-6 fill-current">Profile</span>
        </router-link>
      </li>
      <li>
        <button
          @click.prevent="logout()"
          class="
            flex
            gap-x-4
            items-center
            py-2
            text-gray-500
            hover:text-indigo-600
            group
          "
        >
          <span
            class="
              absolute
              w-1.5
              h-8
              bg-indigo-600
              rounded-r-full
              left-0
              scale-y-0
              -translate-x-full
              group-hover:scale-y-100 group-hover:translate-x-0
              transition-transform
              ease-in-out
            "
          />
          <font-awesome-icon icon="fa-solid fa-right-from-bracket" />
          <span class="w-6 h-6 fill-current">Logout</span>
        </button>
      </li>
    </ul>
  </aside>
</template>

<script>
import { useUserStore } from "@/store/user";
export default {
  setup() {
    const userStore = useUserStore();
    return { userStore };
  },
  data() {
    return {};
  },
  methods: {
    async logout() {
      await this.userStore.removeAuth();
      this.$router.push("/auth");
    },
  },
};
</script>
