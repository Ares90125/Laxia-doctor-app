<template>
  <div class="bg-gray auth-wrapper">
    <div class="auth--wrapper">
      <div class="auth-form">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <h2 class="auth-title">マイアカウントにログインする</h2>
          <!-- Email -->
          <div class="form-group">
            <label class="col-form-label text-md-right">{{ $t('メールアドレスもしくはID名') }}</label>
            <div>
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" v-bind:placeholder="$t('例：XXX@example.com or ID')" />
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Password -->
          <div class="form-group pass-form-grp">
            <label class="col-form-label text-md-right">{{ $t('パスワード') }}</label>
            <div>
              <input v-model="form.password" :class="{ 'custom-pw-is-invalid-invalid': form.errors.has('password') }" class="custom-pw-form-control form-control" type="password" name="password" v-bind:placeholder="$t('6文字以上で入力してください')" />
              <has-error :form="form" field="password" />
            </div>
          </div>

          <div class="row">
            <div class="col-12 d-flex justify-content-end">
              <router-link class="forgot-link" :to="{ name: 'forgetpassword' }">
                パスワードを忘れた場合
              </router-link>
            </div>
          </div>

          <div class="auth-btn--wrapper">
            <v-button :loading="form.busy">{{ $t('ログイン') }}</v-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'basic',

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/doctor/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push({ name: 'user_profile' })
    }
  }
}
</script>
