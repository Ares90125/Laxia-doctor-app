 <template>
  <div class="main-in reset-password-main-in">
    <div class="main-content">
      <div class="page-title">
        <p>アカウント設定</p>
      </div>

      <div class="page-notice-msg">
        <p>アカウントID、メールアドレス、パスワードに関する情報はこちらで変更することができます。</p>
      </div>

      <div class="p-title">
        <p>アカウントID</p>
      </div>

      <div class="p-content">
        <p>{{ doctor.name }}</p>
      </div>

      <div class="p-title">
        <p>メールアドレス</p>
      </div>

      <div class="row input-item-con">
        <div class="col-4">
          <p class="p-content">{{ doctor.email }}</p>
        </div>
        <div class="col-6">
          <button class="bootstrap-btn btn btn-secondary"  @click="handleEmail">変更する</button>
        </div>
      </div>

      <div class="p-title">
        <p>パスワード</p>
      </div>

      <div class="row input-item-con">
        <div class="col-4">
          <p class="p-content">●●●●●●●●</p>
        </div>
        <div class="col-6">
          <button class="bootstrap-btn btn btn-secondary"  @click="handlePassword">変更する</button>
        </div>
      </div>
    </div>

    <form-modal
      ref="emailModal"
      id="email-modal"
      :title="modalInfo.title"
    >
      <div v-if="isEmailModal" class="main-modal">
        <div class="new-email-con">
          <label>{{ $t('新しいメールアドレス') }}</label>
          <input class="form-control" type="text" :class="{ 'fulled-status' : form.email ? 'fulled-input': '' }" v-model="form.email" @keyup="checkEmailFormStatus" />
        </div>
        <div class="btn-grp-con">
            <button class="btn btn-secondary btn-sm"  @click="handleCancelEmail">キャンセル</button>
            <button :class="'btn btn-primary btn-sm ' + activeEmailClass"  @click="handleUpdateEmail">メールアドレスを変更</button>
        </div>
      </div>
    </form-modal>

    <form-modal
      ref="passwordModal"
      id="password-modal"
      :title="modalInfo.title"
    >
      <div v-if="isPasswordModal" class="main-modal">
          <div class="password-item current-pass">
              <div class="label-con">
                <label>{{ $t('現在のパスワード') }}</label>
                <label class="sm-lab">{{ $t('パスワードを忘れた場合') }}</label>
              </div>
              <div class="input-group">
                <input :type="'text' === curPwType ? 'text' : 'password'" class="form-control" :class="{ 'fulled-status' : passwordForm.current_password }" v-model="passwordForm.current_password" @keyup="checkPassFormStatus" />
                <a @click="showCurPassword" class="icon-eye"></a>
              </div>
              <div v-if="errors && errors.current_password && show_current_password_error" class="error invalid-feedback-custom">{{ errors.current_password[0] }}</div>
          </div>
          <div class="password-item new-pass">
            <label>{{ $t('新しいメールアドレス') }}</label>
            <div class="input-group">
              <input  v-if="'text' === newPwType" type="text" class="form-control" :class="{ 'fulled-status' : passwordForm.new_password ? 'fulled-input': '' }" v-model="passwordForm.new_password" @keyup="checkPassFormStatus"/>
              <input v-else type="password" class="form-control" :class="{ 'fulled-status' : passwordForm.new_password ? 'fulled-input': '' }" v-model="passwordForm.new_password" @keyup="checkPassFormStatus" />
              <a @click="showNewPassword" class="icon-eye"></a>
            </div>
            <div v-if="errors && errors.new_password && show_new_password_error" class="error invalid-feedback-custom">{{ errors.new_password[0] }}</div>
          </div>
          <div class="password-item confirm-pass">
            <label>{{ $t('新しいパスワード(再入力)') }}</label>
            <input class="form-control" type="password" :class="{ 'fulled-status' : passwordForm.new_password_confirmation ? 'fulled-input': '' }" v-model="passwordForm.new_password_confirmation" @keyup="checkPassFormStatus" />
            <div v-if="errors && errors.new_password_confirmation && show_new_password_confirmation_error" class="error invalid-feedback-custom">{{ errors.new_password_confirmation[0] }}</div>
          </div>
          <div class="btn-grp-con">
            <button class="btn btn-secondary btn-sm"  @click="handleCancelPassword">キャンセル</button>
            <button :class="'btn btn-primary btn-sm ' + activePassClass"  @click="handleUpdatePassword">パスワードを変更</button>
          </div>
      </div>
    </form-modal>

  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',

  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },

  watch: {
    'passwordForm.current_password': function (newVal, oldVal) {
      if (newVal) {
        this.show_current_password_error = false;
      } else {
        this.show_current_password_error = true;
      }
    },
    'passwordForm.new_password': function (newVal, oldVal) {
      if (newVal) {
        this.show_new_password_error = false;
      } else {
        this.show_new_password_error = true;
      }
    },
    'passwordForm.new_password_confirmation': function (newVal, oldVal) {
      if (newVal) {
        this.show_new_password_confirmation_error = false;
      } else {
        this.show_new_password_confirmation_error = true;
      }
    },
  },

  mounted () {
    this.getData();
  },

  data() {
    return {
      isloadingPage: false,
      isEmailModal: false,
      isPasswordModal: false,
      doctor: undefined,
      modalInfo: {
        title: '',
        confirmBtnTitle: '',
      },
      pageInfo: undefined,
      form: undefined,
      errors: undefined,
      passwordForm: {
        current_password:'',
        new_password:'',
        new_password_confirmation: ''
      },

      curPwType: 'password',
      newPwType: 'password',
      confirmPwType: 'password',

      activeEmailClass: '',
      activePassClass: '',

      show_current_password_error: false,
      show_new_password_error: false,
      show_new_password_confirmation_error: false,
    }
  },


  methods: {
    getData(){
      this.$store.dispatch('state/setIsLoading')
      axios.get(`/api/doctor/profile`)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading')
          this.doctor = res.data.data
          this.isloadingPage = true
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    handleEmail() {
      this.modalInfo = {
        title: 'メールアドレスを変更',
        confirmBtnTitle: '検索'
      }
      this.form = {...this.doctor}

      this.isEmailModal = true
      this.$refs.emailModal.show();
    },

    handleCancelEmail(){
      this.$refs.emailModal.hide();
    },

    handleUpdateEmail(){
      this.$store.dispatch('state/setIsLoading')
      axios.post(`/api/doctor/update/email`, this.form)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading')
          this.doctor = res.data.data
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
      this.isEmailModal = false
      this.$refs.emailModal.hide();
    },

    handlePassword() {
      this.modalInfo = {
        title: 'パスワードを変更',
        confirmBtnTitle: '検索'
      }
      this.isPasswordModal = true
      this.$refs.passwordModal.show();
    },

    handleUpdatePassword(){
      this.$store.dispatch('state/setIsLoading')
      axios.post(`/api/doctor/update/password`, this.passwordForm)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading')
          this.$refs.passwordModal.hide();
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
          this.errors = {...error.response.data.errors}
          if (this.errors.current_password) this.show_current_password_error = true;
          if (this.errors.new_password) this.show_new_password_error = true;
          if (this.errors.new_password_confirmation) this.show_new_password_confirmation_error = true;
        })
    },

    handleCancelPassword(){
      this.$refs.passwordModal.hide()
    },

    showCurPassword(){
      if(this.curPwType === 'text'){
        this.curPwType = 'password'
      }else{
        this.curPwType = 'text'
      }
    },
    showNewPassword(){
      if(this.newPwType === 'text'){
        this.newPwType = 'password'
      }else{
        this.newPwType = 'text'
      }
    },

    checkEmailFormStatus() {
      if(this.form.email == '')
        this.activeEmailClass = '';
      else
        this.activeEmailClass = 'active-btn';
    },

    checkPassFormStatus() {
      if(this.passwordForm.current_password == '' || this.passwordForm.new_password == '' || this.passwordForm.new_password_confirmation == '')
        this.activePassClass = '';
      else
        this.activePassClass = 'active-btn';
      
    },

  }
}
</script>