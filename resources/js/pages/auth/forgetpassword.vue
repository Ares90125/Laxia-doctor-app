<template>
  <div class="bg-gray auth-wrapper">
    <div class="auth--wrapper">
      <div v-if="isSendingEmail" class="forgetpw-form">
        <form @submit.prevent="send" @keydown="form.onKeydown($event)">
          <h2 class="auth-title">パスワードをリセット</h2>

          <p class="forget-desc">登録したメールアドレスを入力してください。</p>
          <!-- Email -->
          <div class="form-group">
            <label for="emailform" class="col-form-label caseinfo-title">{{ $t('メールアドレス') }}</label>
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email'), 'fulled-status' : form.email ? 'fulled-input': '' }" class="form-control" type="text" name="email" id="emailform" placeholder="例：XXX@example.com">
            <has-error :form="form" field="email" />
          </div>

          <div class="row justify-content-center">
            <!-- <button class="btn btn-primary btn-sm"  @click="handleSendEmail">メールアドレスを変更</button> -->
            <v-button :loading="form.busy">{{ $t('パスワードリセットのメールを送信') }}</v-button>
          </div>
        </form>
      </div>

      <div v-if="!isSendingEmail" class="forgetpw-form confirm-form">
        <h2 class="auth-title confirm-title">メールを送信しました</h2>
        <div class="row mt-4">
          <div class="col-12">
            <p>
              <b>{{form.email}}</b>にメールを送信しましたので、<br/>
              新しいパスワードを設定してください。<br/>
              メールが届かない場合は、入力したアドレスに間違いがあるか、登録したメールアドレスが違う可能性があります。
            </p>
          </div>
        </div>
        <div class="auth-btn--wrapper d-flex justify-content-center">
          <button class="btn btn-sm non-bootstrap-btn"  @click="reSendEmail">もう一度試してみる</button>
          <router-link :to="{ name: 'login' }" class="btn btn-primary btn-sm">
            ログイン画面に戻る
          </router-link>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'basic',

  data() {
    return {
      form: new Form({
        email: ''
      }),
      isSendingEmail: true,
    }
  },

  methods: {
    reSendEmail(){
      this.isSendingEmail = true;
    },
    
    async send () {
      // const { data } = await this.form.post('/api/user/password/email');
      // console.log('data=>', data);

      // if(data.send_flag == 'successed') this.isSendingEmail = false;
      this.isSendingEmail = false;
    }
  }

}

</script>