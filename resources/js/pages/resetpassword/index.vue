 <template>
  <div class="main-in">
    <div class="main-content">
      <div class="row my-4">
        <div class="col-12">
          <p class="page-title">アカウント設定</p>
        </div>
      </div>

      <div class="row my-4">
        <div class="col-12">
          <p class="page-notice-msg">アカウントID、メールアドレス、パスワードに関する情報はこちらで変更することができます。</p>
        </div>
      </div>

      <div class="divider"></div>

      <div class="row my-3">
        <div class="col-12">
          <p class="p-title">アカウントID</p>
        </div>
      </div>

      <div class="row mt-3 mb-4">
        <div class="col-12">
          <p class="p-content">{{ doctor.name }}</p>
        </div>
      </div>

      <div class="row my-3">
        <div class="col-12">
          <p class="p-title">メールアドレス</p>
        </div>
      </div>

      <div class="row my-3">
        <div class="col-4">
          <p class="p-content">{{ doctor.email }}</p>
        </div>
        <div class="col-6">
          <button class="bootstrap-btn btn btn-secondary"  @click="handleEmail">変更する</button>
        </div>
      </div>

      <div class="row mt-3 mb-4">
        <div class="col-6">
          <p class="p-title">パスワード</p>
        </div>
      </div>

      <div class="row my-3">
        <div class="col-4">
          <p class="p-content">●●●●●●●</p>
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
        <div class="profile-dialog-container">
          <div class="row  my-3">
            <div class="col-12">
              <span >{{ $t('新しいメールアドレス') }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-11">
              <input class="form-control" type="text" v-model="form.email" />
            </div>
          </div>
          <div class="row my-5">
            <div class="col-6">
              <button class="btn btn-secondary btn-sm"  @click="handleCancelEmail">キャンセル</button>
            </div>
            <div class="col-6">
              <button class="btn btn-primary btn-sm"  @click="handleUpdateEmail">メールアドレスを変更</button>
            </div>
          </div>
        </div>
      </div>
    </form-modal>

    <form-modal
      ref="passwordModal"
      id="password-modal"
      :title="modalInfo.title"
    >
      <div v-if="isPasswordModal" class="main-modal">
        <div class="profile-dialog-container">
          <div class="row  my-3">
            <div class="col-12">
              <span >{{ $t('新しいメールアドレス') }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-11">
              <div class="input-group">
                <input  v-if="'text' === curPwType" type="text" class="form-control" v-model="passwordForm.current_password"/>
                <input v-else type="password" class="form-control" v-model="passwordForm.current_password" />
                <a @click="showCurPassword" class="icon-eye"></a>
              </div>
              <div v-if="errors && errors.current_password" class="error invalid-feedback-custom">{{ errors.current_password[0] }}</div>
            </div>
          </div>

          <div class="row  my-3">
            <div class="col-12">
              <span >{{ $t('新しいメールアドレス') }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-11">
              <div class="input-group">
                <input  v-if="'text' === newPwType" type="text" class="form-control" v-model="passwordForm.new_password"/>
                <input v-else type="password" class="form-control" v-model="passwordForm.new_password" />
                <a @click="showNewPassword" class="icon-eye"></a>
              </div>
              <div v-if="errors && errors.new_password" class="error invalid-feedback-custom">{{ errors.new_password[0] }}</div>
            </div>
          </div>

          <div class="row  my-3">
            <div class="col-12">
              <span >{{ $t('新しいパスワード(再入力)') }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-11">
              <input class="form-control" type="password" v-model="passwordForm.new_password_confirmation" />
<!--              <div v-if="errors && errors.menus.price" class="error invalid-feedback">{{ errors.menus.price[0] }}</div>-->
            </div>
          </div>

          <div class="row my-5">
            <div class="col-6">
              <button class="btn btn-secondary btn-sm"  @click="handleCancelPassword">キャンセル</button>
            </div>
            <div class="col-6">
              <button class="btn btn-primary btn-sm"  @click="handleUpdatePassword">メールアドレスを変更</button>
            </div>
          </div>
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
      console.log(this.form);

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
    }
  }
}
</script>

<style scoped>

  .page-title{
    font-size: 24px;
    font-weight: 800;
    letter-spacing: 6px;
  }
  .page-notice-msg{
    font-size: 14px;
    letter-spacing: 2px;
    font-weight: 600;
  }

  .divider{
    height: 50px;
  }
  .p-title{
    letter-spacing: 5px;
  }
  .p-content{
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 1px;
  }

  .profile-dialog-container{
    padding: 0 30px;
  }

</style>
