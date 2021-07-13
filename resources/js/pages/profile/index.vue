<template>
  <div class="main-in profile-main-in">
    <div v-if="this.user" class="main-content">
      <div class="row">
        <div class="col-12 d-flex justify-content-end">
          <button class="bootstrap-btn btn btn-primary d-flex profile-edit-btn"  @click="handleEditProfile">
            <p>
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.8254 1.02198L18.8257 1.02227L18.8496 1.04393C19.6641 1.78476 19.7211 3.04667 18.9778 3.85687L18.9778 3.85689L10.0333 13.6067L10.0332 13.6068C9.99911 13.644 9.95739 13.6738 9.9106 13.6942L9.91055 13.6942L6.86536 15.0206L6.86531 15.0207C6.77396 15.0605 6.67987 15.0799 6.58358 15.0799H6.58353C6.36153 15.0799 6.14844 14.9714 6.0164 14.789C5.88743 14.6107 5.85167 14.3777 5.92217 14.1672L5.92217 14.1672L6.97391 11.0279L6.97392 11.0279C6.98985 10.9803 7.01565 10.9365 7.04982 10.8993L7.04985 10.8993L15.9943 1.14936C15.9943 1.14936 15.9943 1.14935 15.9943 1.14934C16.3724 0.737289 16.9123 0.5 17.4743 0.5C17.976 0.5 18.4553 0.68534 18.8254 1.02198ZM6.98907 13.2696L6.63181 14.336L7.66285 13.8869L9.44971 13.1085L9.54689 13.0662L9.61853 12.9881L9.67058 12.9313L10.01 12.5613L9.63848 12.2234L8.46877 11.1597L8.10041 10.8247L7.76387 11.1917L7.71182 11.2484L7.63999 11.3267L7.60622 11.4275L6.98907 13.2696ZM18.4394 3.37303L18.4394 3.37302C18.9151 2.85446 18.8783 2.04773 18.3579 1.57431C18.3579 1.57427 18.3578 1.57423 18.3578 1.57419L18.3338 1.55236L18.3336 1.55224C18.0981 1.33803 17.7926 1.21978 17.4743 1.21978C17.114 1.21978 16.7766 1.36745 16.5328 1.63322L8.92886 9.92188L8.58938 10.2919L8.9609 10.6298L10.1306 11.6935L10.4989 12.0285L10.8355 11.6616L18.4394 3.37303Z" fill="#FFF" stroke="white"/>
                <path d="M17.8144 8.79301V8.79307V16.0933C17.8144 17.9692 16.2802 19.4999 14.3908 19.4999H3.92362C2.03424 19.4999 0.5 17.9692 0.5 16.0933V5.75621C0.5 3.88031 2.03419 2.34961 3.92362 2.34961H11.4998C11.7027 2.34961 11.8635 2.5128 11.8635 2.7095C11.8635 2.9062 11.7027 3.06939 11.4998 3.06939H3.92362C2.43848 3.06939 1.22727 4.27223 1.22727 5.75621V16.0934C1.22727 17.5774 2.43841 18.7802 3.92362 18.7802H14.3908C15.876 18.7802 17.0872 17.5774 17.0872 16.0934V8.79307C17.0872 8.59636 17.248 8.43317 17.4508 8.43317C17.6537 8.43317 17.8144 8.59636 17.8144 8.79301Z" fill="#FFF" stroke="white"/>
              </svg>
            </p>
            プロフィールを編集</button>
        </div>
      </div>

      <div class="avatar-img-con">
        <img class="md-doctor-avatar-img" :src="user.photo || '/img/avatar-img.png'" />
      </div>
      <div class="profile-con">
        <div class="profile-con--left-con">
          <div class="profile-item">
            <label>ID名</label>
            <div class="profile-item--value">{{ user.name }}</div>
          </div>
          <div class="profile-item">
            <label>名前(漢字)</label>
            <div class="profile-item--value">{{ user.hira_name }}</div>
          </div>
          <div class="profile-item">
            <label>名前(カタカナ)</label>
            <div class="profile-item--value">{{ user.kata_name }}</div>
          </div>
          <div class="profile-item">
            <label>役職</label>
            <div class="profile-item--value">{{ user.job_name }}</div>
          </div>
          <div class="profile-item">
            <label>役職歴</label>
            <div class="profile-item--value">{{ user.experience_year }}年</div>
          </div>
          <div class="profile-item">
            <label>得意分野</label>
            <div class="profile-item--value">{{ user.spec0_name }}</div>
            <div class="profile-item--value">{{ user.spec1_name }}</div>
            <div class="profile-item--value">{{ user.spec2_name }}</div>
          </div>
          <div class="profile-item">
            <label>所属クリニック</label>
            <div class="profile-item--value">湘南美容クリニック 新宿院</div>
          </div>
        </div>
        <div class="profile-con--right-con">
          <div class="profile-item">
            <label>経歴</label>
            <div class="profile-item--value" v-html="user.profile"></div>
          </div>
          <div class="profile-item">
            <label>資格・実績</label>
            <div class="profile-item--value" v-html="user.career"></div>
          </div>
          <div class="profile-item">
            <label>紐づいているクリニック</label>
            <div class="profile-item--value">湘南美容クリニック 新宿院</div>
          </div>
        </div>
      </div>
      
    </div>

    <form-modal
      ref="modal"
      id="modal"
      class="profile-modal"
      :title="modalInfo.title"
    >
      <vue-custom-scrollbar class="scroll-modal-body" :settings="settings" @ps-scroll-y="scrollHanle">
        <div v-if="isModal"  class="main-modal">
          <div class="profile-dialog-container">
            <div class="profile-item">
              <label class="caseinfo-title">写真</label>
              <div class="profile-photo">
                <file-upload-single
                  ref="fileUploadComponent"
                  uploadUrl="/api/doctor/profile/photoupload"
                  name="photo"
                  :photo="form.user.photo"
                  @file-upload-success="handleFileSaved"
                  @file-removed="hanleFileRemove"
                  @file-added="handleFileAdded"
                />
              </div>
              <div class="upload-btn">
                <button class="btn btn-sm non-bootstrap-btn d-flex"  @click="handleUploadImage">
                  <p class="">
                    <svg width="16" height="20" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M17.7067 4.66616L13.8363 1.03839C13.4211 0.649232 12.8583 0.428711 12.2724 0.428711H2.85711C1.63464 0.433035 0.642822 1.36268 0.642822 2.50852V20.4961C0.642822 21.6419 1.63464 22.5716 2.85711 22.5716H16.1428C17.3653 22.5716 18.3571 21.6419 18.3571 20.4961V6.1363C18.3571 5.58716 18.1218 5.05532 17.7067 4.66616ZM15.9629 5.96767H12.4523V2.67716L15.9629 5.96767ZM2.85711 20.4961V2.50852H10.2381V7.00541C10.2381 7.5805 10.7317 8.04316 11.3452 8.04316H16.1428V20.4961H2.85711ZM4.3333 18.4206H14.6666V12.886L13.5826 11.8698C13.3657 11.6666 13.0151 11.6666 12.7983 11.8698L8.76187 15.6533L6.9397 13.9453C6.72288 13.7421 6.37229 13.7421 6.15547 13.9453L4.3333 15.6533V18.4206ZM6.54758 8.04316C5.32511 8.04316 4.3333 8.9728 4.3333 10.1186C4.3333 11.2645 5.32511 12.1941 6.54758 12.1941C7.77005 12.1941 8.76187 11.2645 8.76187 10.1186C8.76187 8.9728 7.77005 8.04316 6.54758 8.04316Z" fill="#5CA3F6"/>
                    </svg>
                  </p>
                  アップロード
                </button>
              </div>
            </div>

            <div class="profile-item modal-id-item">
              <label for="userId" class="caseinfo-title">ID名</label>
              <input type="text" @keyup="handleCheckId" :class="{ 'is-invalid': idValidation === 1, 'is-valid': idValidation=== 2, 'fulled-status' : form.user.name ? 'fulled-input': '' }" v-model="form.user.name" class="form-control" id="userId"/>
              <div v-if="idValidation === 1" class="error invalid-feedback-custom">このID名はすでに利用されています</div>
              <p class="id-desc">
                ※ユーザー名には、アルファベット(a～z)、数字(0～9)、ダッシュ(-)、アンダースコア(_)、アポストロフィ(')、
                ピリオド(.)を使用できます。文字数は、4～40 文字以内にしてください。
              </p>
            </div>

            <div class="row profile-item">
              <div class="col-6">
                <label for="hira_name" class="caseinfo-title">名前(漢字)</label>
                <input type="text" id="hira_name" :class="{ 'fulled-status' : form.user.hira_name ? 'fulled-input': '' }" v-model="form.user.hira_name" class="form-control"/>
              </div>
              <div class="col-6">
                <label for="kata_name" class="caseinfo-title">名前(カタカナ)</label>
                <input type="text" id="kata_name" :class="{ 'fulled-status' : form.user.kata_name ? 'fulled-input': '' }" v-model="form.user.kata_name" class="form-control"/>
              </div>
            </div>

            <div class="row profile-item">
              <label for="clinic_id" class="caseinfo-title">所属クリニック</label>
              <!-- <select id="clinic_id" :class="{ 'fulled-status' : form.user.job_id ? 'fulled-input': '' }" class="form-control" >
                <option>湘南美容クリニック 新宿院</option>
              </select> -->
              <Select2 
                v-model="myValue" 
                :options="myOptions" 
                :settings="{
                  'minimumInputLength': 1,
                  'placeholder': '',
                  'searchInputPlaceholder': 'My custom placeholder...',
                  'language': {
                    'noResults': function () {
                      return '一致する結果は見つかりませんでした。再度検索してください。';
                    },
                    'inputTooShort': function () {
                      return '';
                    }
                  },
                  'templateResult' : formatOutput,
                  'escapeMarkup': function(m) {
                      return m;
                  }
                }" 
                @change="myChangeEvent($event)"
                @select="mySelectEvent($event)"
                @open="mySelectOpenEvent($event)"
                class="clinic-selecter select2-con" />
            </div>

            <div class="row profile-item">
              <div class="col-6">
                <div class="form-group">
                  <label for="job_id" class="caseinfo-title">役職</label>
                  <select  id="job_id" v-model="form.user.job_id" :class="{ 'fulled-status' : form.user.job_id ? 'fulled-input': '' }" class="form-control" >
                    <option></option>
                    <option v-for="(name, id) in jobs" :key="id" :value="id">{{ name }}</option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="experience_year" class="caseinfo-title">職歴</label>
                  <select id="experience_year" v-model="form.user.experience_year" :class="{ 'fulled-status' : form.user.experience_year ? 'fulled-input': '' }" class="form-control" >
                    <option></option>
                    <option v-for="n in 40" :key="n" :value="n">{{ n }}{{ $t('年') }}</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row profile-item">
              <div class="col-4">
                <div class="form-group">
                  <label for="spec0" class="caseinfo-title">得意分野①</label>
                  <select id="spec0" v-model="form.user.spec0" :class="{ 'fulled-status' : form.user.spec0 ? 'fulled-input': '' }" class="form-control">
                    <option></option>
                    <option v-for="(name, id) in specialities" :key="id" :value="id">{{ name }}</option>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="spec1" class="caseinfo-title">得意分野②</label>
                  <select id="spec1" v-model="form.user.spec1" :class="{ 'fulled-status' : form.user.spec1 ? 'fulled-input': '' }" class="form-control">
                    <option></option>
                    <option v-for="(name, id) in specialities" :key="id" :value="id">{{ name }}</option>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="spec2" class="caseinfo-title">得意分野③</label>
                  <select id="spec2" v-model="form.user.spec2" :class="{ 'fulled-status' : form.user.spec2 ? 'fulled-input': '' }" class="form-control">
                    <option></option>
                    <option v-for="(name, id) in specialities" :key="id" :value="id">{{ name }}</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="profile-item">
              <label for="user_profile" class="caseinfo-title">経歴</label>
              <textarea rows="3" id="user_profile" :class="{ 'fulled-status' : form.user.profile ? 'fulled-input': '' }" v-model="form.user.profile" class="form-control"></textarea>
            </div>

            <div class="profile-item">
              <label for="user_career" class="caseinfo-title">資格・実績</label>
              <textarea rows="3" id="user_career" :class="{ 'fulled-status' : form.user.career ? 'fulled-input': '' }" v-model="form.user.career" class="form-control"></textarea>
            </div>

          </div>
        </div>
      </vue-custom-scrollbar>
      <template v-slot:footer>
        <div class="profile-item">
          <button class=" btn btn-primary"  @click="handleUpdateStuff">プロフィールの編集を完了</button>
        </div>
      </template>
    </form-modal>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

import vueCustomScrollbar from 'vue-custom-scrollbar'
import "vue-custom-scrollbar/dist/vueScrollbar.css"

import Select2 from 'v-select2-component';

export default {
  middleware: 'auth',

  components: {
    vueCustomScrollbar,
    Select2
  },

  mounted () {
    this.getData();
  },

  computed:{
    ...mapGetters({
      jobs: 'data/jobs',
      specialities: 'data/specialities',
    })
  },

  data() {
    return {
      isModal: false,
      modalInfo: {
        title: '',
        confirmBtnTitle: '',
      },
      form: undefined,
      user: undefined,
      idValidation: 0,
      settings: {
        suppressScrollY: false,
        suppressScrollX: true,
        wheelPropagation: false
      },
      myValue: '',
      myOptions: [
        '湘南美容クリニック 新宿院1',
        '湘南美容クリニック 新宿院2',
        '湘南美容クリニック 新宿院3'
      ]
    }
  },

  methods: {

    //get user data from api
    getData() {
      this.$store.dispatch('state/setIsLoading')
      axios.get(`/api/doctor/profile`)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading');
          this.user = res.data.data;
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    handleEditProfile() {
      this.modalInfo = {
        title: 'プロフィールを編集する',
        confirmBtnTitle: '検索'
      }
      this.form = {
        user: { ...this.user},
        specialities: {...this.specialities}
      }
      this.isModal = true
      this.$refs.modal.show();
    },

    handleUpdateStuff() {
      this.$store.dispatch('state/setIsLoading')
      if (this.form.fileChanged) {
        this.$refs.fileUploadComponent.processQueue();
      } else {
        this.handleSaveStuff();
      }
    },

    handleSaveStuff() {
      let url = '/api/doctor/profile';
      // if (this.form.user.id) {
      //   url += `/${this.form.user.id}`
      // }
      axios.put(url, this.form.user)
        .then(res => {
          this.user = res.data.data;
          this.$store.dispatch('state/removeIsLoading')
          this.errors = undefined
          this.$refs.modal.hide()
          this.$swal({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            title: '登録しました。',
            icon: 'success',
          })
          this.query = {
            ...this.query,
            page: 1
          }
          this.$refs.fileUploadComponent.removeAllFiles();
          this.getData()
        })
        .catch(error => {
          this.errors = { ...error.response.data.errors }
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    handleFileSaved(fileUrl) {
      console.log(fileUrl);
      this.form.user.photo = fileUrl

      this.form.fileChanged = false
      this.handleSaveStuff()
    },

    hanleFileRemove() {
      this.form.fileChanged = false;
      this.form.user.photo = '';
    },

    handleFileAdded(flg) {
      this.form.fileChanged = flg;
    },

    handleUploadImage(){
      // this.$refs.fileUploadComponent.removeAllFiles();
      document.getElementsByClassName("dropzone")[0].click();
    },

    handleCheckId(){

      let url = '/api/doctor/id_checker';
      let idCheckForm = {
        id: this.form.user.name
      }
      axios.post(url, idCheckForm)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading')
          if(res.data.data){
            this.idValidation = 2;
          }
          else{
            this.idValidation = 1;
          }
        })
    },
    scrollHanle(evt) {
      // console.log(evt)
    },
    myChangeEvent(val){
        console.log(val);
    },
    mySelectEvent({id, text}){
        console.log({id, text})
    },
    mySelectOpenEvent(data) {
      document.querySelector('input.select2-search__field').setAttribute('placeholder', '所属クリニックを検索');
    },
    formatOutput(optionElement) {
      let input_obj = document.querySelector('input.select2-search__field');
      let result = optionElement.text;

      if(!input_obj) return result;

      let typed = input_obj.value;
      let typed_len = typed.length;

      let pos = result.search(typed);

      if(pos < 0) return result;

      let pos_1 = pos + typed_len;
      let len_1 = result.length - pos + typed_len;

      let t_result = result.substr(0, pos) + '<b>' + typed + '</b>' + result.substr(pos_1, len_1);

      return t_result; 
    }
  }
}
</script>