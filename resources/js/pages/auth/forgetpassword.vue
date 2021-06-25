<template>
  <div class="bg-gray auth-wrapper">
    <div class="auth--wrapper">
      <div v-if="isSendingEmail" class="forgetpw-form ">
        <h2 class="auth-title">パスワードをリセット</h2>

        <div class="row">
          <div class="col-12">
            <p class="forget-desc">登録したメールアドレスを入力してください。</p>
          </div>
        </div>
        <!-- Email -->
        <div class="form-group">
          <label for="emailform" class="col-form-label caseinfo-title">{{ $t('メールアドレス') }}</label>
          <input v-model="form.email" class="form-control" type="email" name="email" id="emailform" placeholder="例：XXX@example.com">
        </div>

        <div class="row justify-content-center">
          <button class="btn btn-primary btn-sm"  @click="handleSendEmail">メールアドレスを変更</button>
        </div>
      </div>

      <div v-if="!isSendingEmail" class="forgetpw-form confirm-form">
        <h2 class="auth-title confirm-title">メールを送信しました</h2>
        <div class="row mt-4">
          <div class="col-12">
            <p>
              <b>xxx@example.com</b>にメールを送信しましたので、<br/>
              新しいパスワードを設定してください。<br/>
              メールが届かない場合は、入力したアドレスに間違いがあるか、登録したメールアドレスが違う可能性があります。
            </p>
          </div>
        </div>
        <div class="auth-btn--wrapper d-flex justify-content-center">
          <button class="btn btn-sm non-bootstrap-btn"  @click="handleSendEmail">もう一度試してみる</button>
          <router-link :to="{ name: 'resetpassword' }" class="btn btn-primary btn-sm">
            もう一度試してみる
          </router-link>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  layout: 'basic',

  data() {
    return {
      form: {
        email:'',
      },

      isSendingEmail: true,

    }
  },

  methods: {
    handleSendEmail(){

    }
  }

}

</script>