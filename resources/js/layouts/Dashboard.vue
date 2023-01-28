<template>
  <div class="w-full min-h-screen font-sans text-gray-900 bg-gray-50 flex">
    <sidebar></sidebar>
    <router-view></router-view>
  </div>
</template>

  <script>
import Sidebar from "../components/Sidebar.vue";
export default {
  name: "dashboard-layout",
  components: {
    Sidebar,
  },
};
</script>
