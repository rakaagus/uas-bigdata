<template>
  <div class="flex flex-col px-8 pt-10 lg:px-14 xl:px-24">
    <div class="pt-36 pb-6">
      <h1
        class="text-3xl font-bold tracking-wide leading-loose whitespace-nowrap"
      >
        Hi There Confirm The Otp Code!
      </h1>
      <span class="font-light text-gray-500"> one last step for you </span>
      <form @submit.prevent="verificationAkun">
        <div class="pt-6">
          <label for="otp" class="font-light">Otp</label>
          <div
            class="
              flex
              overflow-hidden
              items-center
              mt-2
              w-full
              rounded-lg
              border border-gray-400
              transition-all
              focus-within:shadow-lg focus-within:border-orange-500
            "
          >
            <div class="flex justify-center items-center pl-6">
              <font-awesome-icon icon="fa-solid fa-envelope" />
            </div>
            <input
              v-model="otp"
              type="number"
              name="otp"
              placeholder="Enter your Otp code"
              id="otp"
              class="
                px-4
                py-4
                w-full
                focus:outline-none
                font-light
                border-0
                focus:ring-0
              "
            />
          </div>
        </div>
        <div class="flex justify-center pt-4">
          <a
            href="#"
            class="text-teal-500 hover:text-teal-600"
            @click="generateOtpCode"
          >
            Send Otp Code Again</a
          >
        </div>
        <div class="pt-8">
          <button
            type="submit"
            class="
              py-4
              px-8
              w-full
              text-white
              bg-orange-500
              rounded-lg
              shadow-lg
              hover:bg-orange-600
              focus:ring-4 focus:ring-red-100 focus:outline-none
            "
          >
            Verification
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

  <script>
import { mapActions, mapWritableState } from "pinia";
import { useUserStore } from "@/store/user";
import axios from "axios";
export default {
  data() {
    return {
      otp: null,
    };
  },
  computed: {
    ...mapWritableState(useUserStore, ["user"]),
  },
  methods: {
    ...mapActions(useUserStore, ["verificationSuccess"]),
    async verificationAkun() {
      try {
        const verification = await axios.post("/api/auth/verifikasi-email", {
          otp: this.otp,
        });

        this.$router.push("/dasboard");
        this.verificationSuccess();
      } catch (error) {
        console.log(error);
      }
    },
    async generateOtpCode() {
      try {
        const generate = await axios.post("/api/auth/generate-otp-code", {
          email: this.user.email,
        });
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
