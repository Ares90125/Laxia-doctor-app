<template>
  <div class="header">
    <div class="hamburger" @click="onNavToggle"><span></span></div>
    <div class="header-left">

    </div>
    <div class="header-right">
      <div class="login-info">
        <a class="nav-link dropdown-toggle text-dark"
          href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        >
          <img v-if="user.photo" :src="user.photo" class="rounded-circle profile-photo">
          <svg v-else width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="20" fill="#F4F4F4"/>
            <path opacity="0.3" d="M27.3483 21.5828C26.8651 20.6595 26.309 19.8276 25.7618 19.2376C26.4399 18.2179 26.8375 16.9957 26.8375 15.6771C26.8365 12.1175 23.9479 9.23145 20.385 9.23047C16.8222 9.23145 13.9336 12.1175 13.9336 15.6771C13.9336 16.9937 14.3312 18.2179 15.0093 19.2376C14.4611 19.8276 13.906 20.6605 13.4228 21.5828C12.9376 22.518 12.535 23.52 12.3825 24.463C12.3323 24.7766 12.3086 25.0824 12.3086 25.3784C12.3047 26.3637 12.5891 27.2536 13.0881 27.9714C13.8361 29.055 14.9916 29.7394 16.2671 30.1662C17.5476 30.591 18.9766 30.768 20.385 30.7689C22.2639 30.764 24.1772 30.4612 25.7273 29.648C26.5009 29.2399 27.1869 28.6932 27.6829 27.9714C28.18 27.2536 28.4644 26.3647 28.4624 25.3784C28.4624 25.0815 28.4388 24.7766 28.3876 24.463C28.2361 23.52 27.8335 22.5189 27.3483 21.5828ZM17.0771 12.3722C17.9265 11.5236 19.0898 11.0024 20.385 11.0024C21.6793 11.0024 22.8446 11.5236 23.693 12.3722C24.5404 13.2207 25.064 14.384 25.064 15.6771C25.063 16.9701 24.5414 18.1324 23.693 18.982C22.8436 19.8286 21.6793 20.3507 20.3841 20.3507C19.0898 20.3498 17.9255 19.8286 17.0761 18.982C16.2278 18.1334 15.7051 16.9711 15.7051 15.6771C15.7061 14.384 16.2287 13.2207 17.0771 12.3722ZM26.2204 26.9714C25.7795 27.6174 24.9852 28.1396 23.941 28.4867C22.9017 28.8338 21.6429 28.999 20.3841 28.997C18.708 29.0019 17.0279 28.6991 15.8705 28.0815C15.2908 27.7767 14.8459 27.4021 14.5497 26.9694C14.2544 26.5348 14.0842 26.0392 14.0812 25.3794C14.0812 25.1827 14.0979 24.9684 14.1334 24.7393C14.2308 24.106 14.5684 23.2151 14.9945 22.4029C15.3754 21.6694 15.8311 20.9948 16.1972 20.5749C17.3242 21.5386 18.7857 22.1237 20.385 22.1237C21.9854 22.1237 23.4459 21.5386 24.5738 20.5759C24.939 20.9958 25.3956 21.6694 25.7765 22.4039C26.2027 23.2161 26.5403 24.107 26.6367 24.7402C26.6731 24.9694 26.6899 25.1818 26.6899 25.3804C26.6859 26.0392 26.5167 26.5348 26.2204 26.9714Z" fill="#666E6E"/>
          </svg>
          {{ user.hira_name }}
        </a>
        <div class="header-menu dropdown-menu">
          <router-link :to="{ name: 'resetpassword' }" active-class="active">
            アカウント設定
          </router-link>
          <a href="#" class="logout" @click.prevent="logout">ログアウト</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },
    onNavToggle () {
      this.$utils.toggleSidebar()
    },
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
