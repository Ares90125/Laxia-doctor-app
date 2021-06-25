<template>
  <div class="bg-gray auth-wrapper">
    <div class="auth--wrapper">
      <div class="auth-form">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <h2 class="auth-title">新しいパスワードを設定してください</h2>

          <!-- Password -->
          <div class="form-group pass-form-grp">
            <label class="col-form-label text-md-right">{{ $t('新しいパスワード') }}</label>
            <div>
              <input v-model="form.password" :class="{ 'custom-pw-is-invalid-invalid': form.errors.has('password') }" class="custom-pw-form-control" type="password" name="password" v-bind:placeholder="$t('6文字以上で入力してください')" />
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Password confirm -->
          <div class="form-group pass-form-grp">
            <label class="col-form-label text-md-right">{{ $t('再入力してください') }}</label>
            <div>
              <input v-model="form.password_confirm" :class="{ 'custom-pw-is-invalid-invalid': form.errors.has('password') }" class="custom-pw-form-control" type="password" name="password_confirm" v-bind:placeholder="$t('6文字以上で入力してください')" />
              <has-error :form="form" field="password_confirm" />
            </div>
          </div>

          <div class="auth-btn--wrapper">
            <v-button :loading="form.busy">{{ $t('パスワードを変更') }}</v-button>
          </div>
        </form>
      </div>
    </div>
    
    <reset-confirm-modal
      ref="modal"
      id="modal"
    >
      
    </reset-confirm-modal>
    
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
      password: '',
      password_confirm: ''
    }),
    remember: false,
  }),

  methods: {
    // async login () {
    login () {
    //   // Submit the form.
    //   const { data } = await this.form.post('/api/doctor/login')

    //   // Save the token.
    //   this.$store.dispatch('auth/saveToken', {
    //     token: data.token,
    //     remember: this.remember
    //   })

    //   // Fetch the user.
    //   await this.$store.dispatch('auth/fetchUser')

    //   // Redirect home.
    //   this.$router.push({ name: 'user_profile' })
        console.log('test');
        this.modalInfo = {
            title: 'プロフィールを作成する',
            confirmBtnTitle: '検索'
        }
        
        this.$refs.modal.show();
    }
  }
}
</script>
