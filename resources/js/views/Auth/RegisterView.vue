<template>
  <div class="flex flex-col px-8 pt-10 lg:px-14 xl:px-24">
    <div class="pt-20 pb-6">
      <h1
        class="text-3xl font-bold tracking-wide leading-loose whitespace-nowrap"
      >
        Hi, Do you want to join?
      </h1>
      <span class="font-light text-gray-500">
        Register now to borrow book
      </span>
      <form @submit.prevent="registerSubmit">
        <div class="pt-6">
          <label for="email" class="font-light">Full Name</label>
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
              <font-awesome-icon icon="fa-solid fa-user" />
            </div>
            <input
              v-model="user.name"
              type="text"
              name="email"
              placeholder="Enter Name"
              id="email"
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
        <div class="pt-6">
          <label for="email" class="font-light">Email address</label>
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
              type="text"
              v-model="user.email"
              name="email"
              placeholder="Enter your email address"
              id="email"
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
        <div class="pt-6">
          <label for="password" class="font-light">Password</label>
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
              <font-awesome-icon icon="fa-solid fa-unlock-keyhole" />
            </div>
            <input
              v-model="user.password"
              type="password"
              name="password"
              id="password"
              placeholder="Enter your password"
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
        <div class="pt-6">
          <label for="password" class="font-light">Conform Password</label>
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
              <font-awesome-icon icon="fa-solid fa-unlock-keyhole" />
            </div>
            <input
              v-model="user.password_confirmation"
              type="password"
              name="password"
              id="password"
              placeholder="Enter your password Again"
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
            Sign Up
          </button>
        </div>
      </form>
      <div class="pt-4">
        <div class="font-light text-center text-gray-500">
          Already Have Account?
          <router-link
            to="/auth"
            class="font-normal text-teal-500 hover:text-teal-600"
            >Login Here</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { useUserStore } from "@/store/user";
import { useVuelidate } from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";
export default {
  setup() {
    const userStore = useUserStore();
    return { userStore };
  },
  data() {
    return {
      v$: useVuelidate(),
      user: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  validations() {
    return {
      user: {
        name: { required },
        email: { required, email },
        password: { required },
      },
    };
  },
  methods: {
    async registerSubmit() {
      try {
        const authRegister = await axios.post("/api/auth/register", this.user);
        const dataUser = authRegister.data.data.user;
        const token = authRegister.data.token;
        await this.userStore.setVerification(dataUser, token);

        this.$router.push("/dashboard");
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
