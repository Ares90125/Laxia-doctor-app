<template>
  <div class="bg-gray auth-wrapper">
    <div class="auth--wrapper">
      <div class="auth-form">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <h2 class="auth-title">新規ドクターアカウントの作成</h2>

          <!-- Email -->
          <div class="form-group">
            <label class="col-form-label text-md-right">{{ $t('メールアドレス') }}</label>
            <div>
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email'), 'fulled-status' : form.email ? 'fulled-input': '' }" class="form-control" type="email" name="email" v-bind:placeholder="$t('例：XXX@example.com')" />
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Password -->
          <div class="form-group">
            <label class="col-form-label text-md-right">{{ $t('パスワード') }}</label>
            <div>
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password'), 'fulled-status' : form.password ? 'fulled-input': '' }" class="form-control" type="password" name="password" v-bind:placeholder="$t('6文字以上で入力してください')" />
              <has-error :form="form" field="password" />
            </div>
          </div>

          <div class="auth-btn--wrapper register-btn--wrapper">
            <v-button :loading="form.busy">{{ $t('アカウントを作成') }}</v-button>
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
    return {

    }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: '',
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/doctor/register')

      // Must verify email fist.
      // if (data.status) {
      //   console.log(data.status)
      //
      //   this.mustVerifyEmail = true
      // } else {
        console.log(data.status)
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/doctor/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'user_profile' })
      // }
    }
  }
}
</script>
