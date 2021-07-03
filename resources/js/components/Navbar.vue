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
          <img v-if="user.photo" :src="'/'+user.photo" class="rounded-circle profile-photo">
          <img v-if="!user.photo" :src="'/img/avatar-img.png'" class="rounded-circle profile-photo">
          {{ user.name }}
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
