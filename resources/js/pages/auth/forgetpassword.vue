<template>
  <div class="bg-gray auth-wrapper">
    <div class="auth--wrapper">
      <div v-if="isSendingEmail" class="forgetpw-form ">
        <h2 class="auth-title">パスワードをリセット</h2>

        <div class="row mb-2">
          <div class="col-12">
            <p>登録したメールアドレスを入力してください。</p>
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

      <div v-if="!isSendingEmail" class="forgetpw-form ">
        <h2 class="auth-title">メールを送信しました</h2>
        <div class="row mt-4">
          <div class="col-12">
            <p style="line-height: 2">xxx@example.com にメールを送信しましたので、新しいパスワードを設定してください。<br>
              メールが届かない場合は、入力したアドレスに間違いがあるか、登録したメールアドレスが違う可能性があります。</p>
          </div>
        </div>
        <div class="auth-btn--wrapper d-flex justify-content-center mt-5">
          <button class="btn btn-sm non-bootstrap-btn mr-2"  @click="handleSendEmail">もう一度試してみる</button>
          <router-link :to="{ name: 'resetpassword' }" class="btn btn-primary btn-sm ml-2">
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

<style>
.forgetpw-form{
  max-width: 430px;
  padding: 100px 0;
  margin: auto;
}

.auth--wrapper .forgetpw-form .auth-title{
  font-size: 18px;
  text-align: center;
  margin-bottom: 50px;
  font-weight: 600;
}
</style>
