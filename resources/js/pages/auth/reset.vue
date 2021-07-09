<template>
  <div class="bg-gray auth-wrapper">
    <div class="auth--wrapper">
      <div class="auth-form">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <h2 class="auth-title">新しいパスワードを設定してください</h2>

          <!-- Password -->
          <div class="form-group pass-form-grp">
            <label class="col-form-label text-md-right">{{ $t('新しいパスワード') }}</label>
            <div class="pass-input-con">
              <input v-model="form.password" :class="{ 'custom-pw-is-invalid-invalid': form.errors.has('password'), 'fulled-status' : form.password ? 'fulled-input': '' }" class="custom-pw-form-control form-control" type="password" name="password" id="password" v-bind:placeholder="$t('6文字以上で入力してください')" />
              <span class="pass-input-con-mark" @click="handleTogglePassword">
                <svg v-if="passwordFlag" width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.5953 8.0002C15.5953 9.90801 13.9828 11.4502 11.9906 11.4502C9.99844 11.4502 8.39062 9.90332 8.39062 8.0002C8.39062 6.09238 10.0031 4.5502 11.9953 4.5502C13.9875 4.5502 15.5953 6.09238 15.5953 8.0002ZM12 0.80957C9.9375 0.818945 7.80469 1.32051 5.77969 2.28145C4.27969 3.02207 2.81719 4.07207 1.54688 5.36582C0.923437 6.02676 0.126563 6.97832 0 8.0002C0.0140625 8.88145 0.960938 9.97363 1.54688 10.6346C2.7375 11.8768 4.1625 12.8939 5.77969 13.7189C7.66406 14.633 9.75 15.1627 12 15.1908C14.0625 15.1814 16.2 14.6752 18.2156 13.7189C19.7156 12.9783 21.1828 11.9283 22.4484 10.6346C23.0719 9.97363 23.8687 9.01738 23.9953 8.0002C23.9812 7.11895 23.0344 6.02676 22.4484 5.36582C21.2578 4.12363 19.8328 3.10645 18.2156 2.28145C16.3313 1.36738 14.2406 0.842383 12 0.80957ZM12 2.59551C15.1219 2.59551 17.6531 5.01426 17.6531 8.0002C17.6531 10.9861 15.1219 13.4049 12 13.4049C8.87813 13.4049 6.34687 10.9861 6.34687 8.0002C6.34687 5.01426 8.87813 2.59551 12 2.59551Z" fill="#131340"/>
                </svg>
                <svg v-if="!passwordFlag" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="16" viewBox="0 0 24 16" version="1.1">
                  <g id="surface1">
                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 20.039062 11.238281 C 22.589844 9.71875 24 8 24 8 C 24 8 19.5 2.5 12 2.5 C 10.558594 2.503906 9.136719 2.703125 7.816406 3.089844 L 8.96875 3.859375 C 9.941406 3.625 10.964844 3.5 12 3.5 C 15.179688 3.5 17.820312 4.667969 19.753906 5.957031 C 20.683594 6.582031 21.515625 7.265625 22.242188 8 C 22.15625 8.085938 22.058594 8.183594 21.949219 8.289062 C 21.445312 8.769531 20.703125 9.40625 19.753906 10.042969 C 19.503906 10.207031 19.246094 10.371094 18.976562 10.527344 Z M 20.039062 11.238281 "/>
                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 16.945312 9.175781 C 17.628906 7.902344 17.148438 6.480469 15.714844 5.523438 C 14.277344 4.566406 12.144531 4.246094 10.234375 4.703125 L 11.46875 5.523438 C 12.636719 5.414062 13.816406 5.675781 14.652344 6.230469 C 15.488281 6.789062 15.878906 7.574219 15.710938 8.355469 Z M 12.53125 10.476562 L 13.765625 11.296875 C 11.851562 11.753906 9.71875 11.433594 8.285156 10.476562 C 6.847656 9.519531 6.371094 8.097656 7.054688 6.824219 L 8.289062 7.644531 C 8.121094 8.425781 8.511719 9.210938 9.347656 9.769531 C 10.183594 10.324219 11.363281 10.585938 12.53125 10.476562 Z M 12.53125 10.476562 "/>
                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 5.023438 5.46875 C 4.753906 5.628906 4.496094 5.792969 4.246094 5.957031 C 3.316406 6.582031 2.484375 7.265625 1.757812 8 L 2.050781 8.289062 C 2.554688 8.769531 3.296875 9.40625 4.246094 10.042969 C 6.179688 11.332031 8.820312 12.5 12 12.5 C 13.074219 12.5 14.085938 12.367188 15.03125 12.140625 L 16.183594 12.910156 C 14.863281 13.296875 13.441406 13.496094 12 13.5 C 4.5 13.5 0 8 0 8 C 0 8 1.410156 6.277344 3.960938 4.761719 L 5.023438 5.472656 Z M 20.46875 14.355469 L 2.46875 2.355469 L 3.53125 1.644531 L 21.53125 13.644531 Z M 20.46875 14.355469 "/>
                  </g>
                </svg>
              </span>
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Password confirm -->
          <div class="form-group pass-form-grp">
            <label class="col-form-label text-md-right">{{ $t('再入力してください') }}</label>
            <div class="pass-input-con">
              <input v-model="form.password_confirm" :class="{ 'custom-pw-is-invalid-invalid': form.errors.has('password'), 'fulled-status' : form.password_confirm ? 'fulled-input': '' }" class="custom-pw-form-control form-control" type="password" name="password_confirm" id="password_confirm" v-bind:placeholder="$t('6文字以上で入力してください')" />
              <span class="pass-input-con-mark" @click="handleTogglePasswordConfirm">
                <svg v-if="passwordConfirmFlag" width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.5953 8.0002C15.5953 9.90801 13.9828 11.4502 11.9906 11.4502C9.99844 11.4502 8.39062 9.90332 8.39062 8.0002C8.39062 6.09238 10.0031 4.5502 11.9953 4.5502C13.9875 4.5502 15.5953 6.09238 15.5953 8.0002ZM12 0.80957C9.9375 0.818945 7.80469 1.32051 5.77969 2.28145C4.27969 3.02207 2.81719 4.07207 1.54688 5.36582C0.923437 6.02676 0.126563 6.97832 0 8.0002C0.0140625 8.88145 0.960938 9.97363 1.54688 10.6346C2.7375 11.8768 4.1625 12.8939 5.77969 13.7189C7.66406 14.633 9.75 15.1627 12 15.1908C14.0625 15.1814 16.2 14.6752 18.2156 13.7189C19.7156 12.9783 21.1828 11.9283 22.4484 10.6346C23.0719 9.97363 23.8687 9.01738 23.9953 8.0002C23.9812 7.11895 23.0344 6.02676 22.4484 5.36582C21.2578 4.12363 19.8328 3.10645 18.2156 2.28145C16.3313 1.36738 14.2406 0.842383 12 0.80957ZM12 2.59551C15.1219 2.59551 17.6531 5.01426 17.6531 8.0002C17.6531 10.9861 15.1219 13.4049 12 13.4049C8.87813 13.4049 6.34687 10.9861 6.34687 8.0002C6.34687 5.01426 8.87813 2.59551 12 2.59551Z" fill="#131340"/>
                </svg>
                <svg v-if="!passwordConfirmFlag" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="16" viewBox="0 0 24 16" version="1.1">
                  <g id="surface1">
                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 20.039062 11.238281 C 22.589844 9.71875 24 8 24 8 C 24 8 19.5 2.5 12 2.5 C 10.558594 2.503906 9.136719 2.703125 7.816406 3.089844 L 8.96875 3.859375 C 9.941406 3.625 10.964844 3.5 12 3.5 C 15.179688 3.5 17.820312 4.667969 19.753906 5.957031 C 20.683594 6.582031 21.515625 7.265625 22.242188 8 C 22.15625 8.085938 22.058594 8.183594 21.949219 8.289062 C 21.445312 8.769531 20.703125 9.40625 19.753906 10.042969 C 19.503906 10.207031 19.246094 10.371094 18.976562 10.527344 Z M 20.039062 11.238281 "/>
                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 16.945312 9.175781 C 17.628906 7.902344 17.148438 6.480469 15.714844 5.523438 C 14.277344 4.566406 12.144531 4.246094 10.234375 4.703125 L 11.46875 5.523438 C 12.636719 5.414062 13.816406 5.675781 14.652344 6.230469 C 15.488281 6.789062 15.878906 7.574219 15.710938 8.355469 Z M 12.53125 10.476562 L 13.765625 11.296875 C 11.851562 11.753906 9.71875 11.433594 8.285156 10.476562 C 6.847656 9.519531 6.371094 8.097656 7.054688 6.824219 L 8.289062 7.644531 C 8.121094 8.425781 8.511719 9.210938 9.347656 9.769531 C 10.183594 10.324219 11.363281 10.585938 12.53125 10.476562 Z M 12.53125 10.476562 "/>
                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 5.023438 5.46875 C 4.753906 5.628906 4.496094 5.792969 4.246094 5.957031 C 3.316406 6.582031 2.484375 7.265625 1.757812 8 L 2.050781 8.289062 C 2.554688 8.769531 3.296875 9.40625 4.246094 10.042969 C 6.179688 11.332031 8.820312 12.5 12 12.5 C 13.074219 12.5 14.085938 12.367188 15.03125 12.140625 L 16.183594 12.910156 C 14.863281 13.296875 13.441406 13.496094 12 13.5 C 4.5 13.5 0 8 0 8 C 0 8 1.410156 6.277344 3.960938 4.761719 L 5.023438 5.472656 Z M 20.46875 14.355469 L 2.46875 2.355469 L 3.53125 1.644531 L 21.53125 13.644531 Z M 20.46875 14.355469 "/>
                  </g>
                </svg>
              </span>
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
    passwordFlag: true,
    passwordConfirmFlag: true
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
    },
    handleTogglePassword(){
      const password = document.querySelector('#password');
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';

      password.setAttribute('type', type);
      this.passwordFlag = !this.passwordFlag;
    },
    handleTogglePasswordConfirm(){
      const password = document.querySelector('#password_confirm');
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';

      password.setAttribute('type', type);
      this.passwordConfirmFlag = !this.passwordConfirmFlag;
    },
  }
}
</script>
