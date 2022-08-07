<template>
  <div class="bg-blue-gray auth-wrapper login-wrapper auth">
    <div class="auth--wrapper">
      <div class="auth--form">
        <form @submit.prevent="send" @keydown="form.onKeydown($event)">
          <h2 class="auth--title reset-title" >パスワードをリセット</h2>
          <!-- Email -->
          <span class="auth--title__tip">登録したメールアドレスを入力してください。</span>
          <div class="form-group">
            <label class="col-form-label text-md-right">{{ $t('メールアドレス') }}</label>
            <div>
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control mb-0" type="text" name="email" placeholder="例：XXX@example.com">
              <has-error :form="form" field="email" />
            </div>
          </div>

          <div class="auth--btnwrap reset-btn">
            <v-button :loading="form.busy">{{ $t('パスワードリセットのメールを送信') }}</v-button>
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
    return { title: this.$t('パスワード再設定') }
  },

  data: () => ({
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/api/doctor/password/email');
      console.log('data=>', data);
      // this.status = data.status
      // this.form.reset()

      if(data.send_flag == 'successed')
		    this.$router.push({name: 'password.sent', params: { mail: this.form.email }});
    }
  }
}
</script>
