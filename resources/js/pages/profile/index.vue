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
            ???????????????????????????</button>
        </div>
      </div>

      <div class="avatar-img-con">
        <img v-if="user.photo" class="md-doctor-avatar-img" :src="user.photo" />
        <svg v-else width="145" height="145" viewBox="0 0 145 145" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="72.5" cy="72.5" r="72.5" fill="#F5F5F5"/>
          <path opacity="0.3" d="M99.1379 78.2378C97.3861 74.8907 95.3703 71.8751 93.3866 69.7364C95.8448 66.04 97.2862 61.6093 97.2862 56.8293C97.2826 43.9258 86.8113 33.464 73.896 33.4604C60.9808 33.464 50.5094 43.9258 50.5094 56.8293C50.5094 61.6022 51.9508 66.04 54.409 69.7364C52.4217 71.8751 50.4095 74.8943 48.6577 78.2378C46.8988 81.6276 45.4396 85.2598 44.8866 88.6782C44.7047 89.8153 44.619 90.9238 44.619 91.9968C44.6048 95.5684 45.6359 98.7943 47.4447 101.396C50.1562 105.324 54.3447 107.805 58.9685 109.352C63.6102 110.892 68.7906 111.534 73.896 111.537C80.7068 111.52 87.6426 110.422 93.2618 107.474C96.066 105.995 98.5527 104.013 100.351 101.396C102.153 98.7943 103.184 95.572 103.177 91.9968C103.177 90.9203 103.091 89.8153 102.905 88.6782C102.356 85.2598 100.897 81.6312 99.1379 78.2378ZM61.9048 44.849C64.9838 41.7729 69.2009 39.8837 73.896 39.8837C78.5876 39.8837 82.8118 41.7729 85.8872 44.849C88.9591 47.9252 90.8571 52.142 90.8571 56.8293C90.8535 61.5167 88.9626 65.7299 85.8872 68.8097C82.8083 71.8787 78.5876 73.7714 73.8924 73.7714C69.2009 73.7679 64.9802 71.8787 61.9012 68.8097C58.8258 65.7335 56.9314 61.5202 56.9314 56.8293C56.9349 52.142 58.8294 47.9252 61.9048 44.849ZM95.0492 97.7713C93.4509 100.113 90.5717 102.006 86.7863 103.264C83.0188 104.522 78.4556 105.121 73.8924 105.114C67.8166 105.132 61.7264 104.034 57.5307 101.796C55.4293 100.691 53.8167 99.3325 52.7428 97.7641C51.6725 96.1886 51.0553 94.3921 51.0446 92.0003C51.0446 91.2874 51.1052 90.5104 51.2337 89.6798C51.5869 87.3843 52.8106 84.1549 54.3554 81.2106C55.7362 78.5514 57.388 76.1062 58.7152 74.5842C62.8003 78.0774 68.0984 80.1982 73.896 80.1982C79.6972 80.1982 84.9917 78.0774 89.0804 74.5877C90.404 76.1098 92.0594 78.5514 93.4402 81.2141C94.985 84.1584 96.2087 87.3879 96.5584 89.6834C96.6904 90.5139 96.751 91.2839 96.751 92.0039C96.7368 94.3921 96.1231 96.1886 95.0492 97.7713Z" fill="#666E6E"/>
        </svg>
      </div>
      <div class="row ">
        <div class="col-12">
          <div class="images-group">
            <img class="photo-img" v-for="image in user.docimages" :src="image.photo" :key="image.id" />
          </div>
        </div>
      </div>

      <div class="profile-con">
        <div class="profile-con--left-con">
          <div class="profile-item">
            <label>ID???</label>
            <div class="profile-item--value">{{ user.name }}</div>
          </div>
          <div class="profile-item">
            <label>??????(??????)</label>
            <div class="profile-item--value">{{ user.hira_name }}</div>
          </div>
          <div class="profile-item">
            <label>??????(????????????)</label>
            <div class="profile-item--value">{{ user.kata_name }}</div>
          </div>
          <div class="profile-item">
            <label>??????</label>
            <div class="profile-item--value">{{ user.job_name }}</div>
          </div>
          <div class="profile-item">
            <label>?????????</label>
            <div class="profile-item--value">{{ user.experience_year }}???</div>
          </div>
          <div class="profile-item">
            <label>????????????</label>
            <div class="profile-item--value">{{ user.spec0_name }}</div>
            <div class="profile-item--value">{{ user.spec1_name }}</div>
            <div class="profile-item--value">{{ user.spec2_name }}</div>
          </div>
          <div class="profile-item">
            <label>?????????????????????</label>
            <div class="profile-item--value" v-for="item in user.clinics" :key="item.id" >{{ item.name }}</div>
          </div>
        </div>
        <div class="profile-con--right-con">
          <div class="profile-item">
            <label>??????</label>
            <div class="profile-item--value" v-html="user.profile"></div>
          </div>
          <div class="profile-item">
            <label>???????????????</label>
            <div class="profile-item--value" v-html="user.career"></div>
          </div>
          <div class="profile-item">
            <label>?????????????????????????????????</label>
            <div class="profile-item--value" v-for="item in user.linkclinics" :key="item.id" >{{ item.name }}</div>
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
      <!-- <vue-custom-scrollbar class="scroll-modal-body" :settings="settings" @ps-scroll-y="scrollHanle"> -->
      <div class="scroll-modal-body">
        <div v-if="isModal"  class="main-modal">
          <div class="profile-dialog-container">
            <div class="profile-item">
              <label class="caseinfo-title">??????</label>
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
                  ??????????????????
                </button>
              </div>
            </div>

             <!-- upload -->
             <div class="photo-con--sub-con before-con">
              <p class="caseinfo-maintitle">????????????????????????</p>
              <p class="caseinfo-title">???????????????????????????????????????????????????????????????????????????????????????????????????</p>
              <div class="file-upload-con">
                <file-uploaded
                  ref="UploadDocimage"
                  uploadUrl="/api/doctor/profile/photoupload"
                  :photo="afterPhoto"
                  @file-upload-success="handleUpdateImagesSaved"
                  :maxFiles="10"
                  :autoStatus="true"
                />
              </div>
              <div class="file-upload-btn-con" style="margin-top:20px; margin-bottom:20px">
                <button class="btn btn-sm non-bootstrap-btn d-flex" style="margin:auto"  @click="handleUpdateUploadBeforeImage">
                  <p class="">
                    <svg width="16" height="20" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.458008 22.8333H18.5413V20.25H0.458008V22.8333ZM0.458008 9.91667H5.62468V17.6667H13.3747V9.91667H18.5413L9.49968 0.875L0.458008 9.91667Z" fill="#5CA3F6"/>
                    </svg>
                  </p>
                  ???????????????????????????</button>
              </div>
              <!--<div v-if="updateErrors && updateErrors['before_photo']" class="error invalid-feedback without-is-invlid">{{ updateErrors['before_photo'][0] }}</div>-->
            </div>

             <!-- upload inages -->
            <div class="profile-item modal-id-item">
                <div v-if="user.docimages" class="">

                  <div class="row">
                    <div class="photo-container" v-for="(item, index) in form.user.docimages" :key="index">
                      <img :src="item.photo" class="case-img-list"/>
                      <a @click="handleUpdateRemoveBeforeImageClick(item.id)" class="remove-img-clicker">
                        <img src="/img/delete-icon.svg" class="remove-img-icon"/>
                      </a>
                    </div>
                  </div>
                </div>
              <label for="userId" class="caseinfo-title">ID???</label>
              <input type="text" @keyup="handleCheckId" :class="{ 'is-invalid': idValidation === 1, 'is-valid': idValidation=== 2, 'fulled-status' : form.user.name ? 'fulled-input': '' }" v-model="form.user.name" class="form-control" id="userId"/>
              <div v-if="idValidation === 1" class="error invalid-feedback-custom">??????ID???????????????????????????????????????</div>
              <p class="id-desc">
                ????????????????????????????????????????????????(a???z)?????????(0???9)???????????????(-)????????????????????????(_)????????????????????????(')???
                ????????????(.)???????????????????????????????????????4???40 ????????????????????????????????????
              </p>
            </div>

            <div class="row profile-item">
              <div class="col-6">
                <label for="hira_name" class="caseinfo-title">??????(??????)</label>
                <input type="text" id="hira_name" :class="{ 'fulled-status' : form.user.hira_name ? 'fulled-input': '' }" v-model="form.user.hira_name" class="form-control"/>
              </div>
              <div class="col-6">
                <label for="kata_name" class="caseinfo-title">??????(????????????)</label>
                <input type="text" id="kata_name" :class="{ 'fulled-status' : form.user.kata_name ? 'fulled-input': '' }" v-model="form.user.kata_name" class="form-control"/>
              </div>
            </div>

            <div class="row profile-item">
              <label for="clinic_id" class="caseinfo-title">?????????????????????</label>
              <Select2
                :options="clinics"
                :settings="{
                  'minimumInputLength': 1,
                  'placeholder': '',
                  'searchInputPlaceholder': '',
                  'language': {
                    'noResults': function () {
                      return '???????????????????????????????????????????????????????????????????????????????????????';
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
                @change="clinicChangeEvent($event)"
                @select="clinicSelectEvent($event)"
                @open="clinicSelectOpenEvent($event)"
                class="clinic-selecter select2-con" />

                <div class="selected-clinics-con" v-for="(item, index) in form.user.clinics" :key="item.id">
                  <p class="selected-clinic-option">{{ item.name }}</p>
                  <a @click="handleCancelSelectedClinic(item, index)">
                    <img src="/img/img-close-color.svg" class="close-img"/>
                  </a>
                </div>
            </div>

            <div class="row profile-item">
              <div class="col-6">
                <div class="form-group">
                  <label for="job_id" class="caseinfo-title">??????</label>
                  <select  id="job_id" v-model="form.user.job_id" :class="{ 'fulled-status' : form.user.job_id ? 'fulled-input': '' }" class="form-control" >
                    <option></option>
                    <option v-for="(name, id) in jobs" :key="id" :value="id">{{ name }}</option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="experience_year" class="caseinfo-title">??????</label>
                  <select id="experience_year" v-model="form.user.experience_year" :class="{ 'fulled-status' : form.user.experience_year ? 'fulled-input': '' }" class="form-control" >
                    <option></option>
                    <option v-for="n in 40" :key="n" :value="n">{{ n }}{{ $t('???') }}</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row profile-item">
              <div class="col-4">
                <div class="form-group">
                  <label for="spec0" class="caseinfo-title">???????????????</label>
                  <select id="spec0" v-model="form.user.spec0" :class="{ 'fulled-status' : form.user.spec0 ? 'fulled-input': '' }" class="form-control">
                    <option></option>
                    <option v-for="(item) in skill_categories" :key="'spec0-'+item.id" :value="item.id">{{ item.name }}</option>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="spec1" class="caseinfo-title">???????????????</label>
                  <select id="spec1" v-model="form.user.spec1" :class="{ 'fulled-status' : form.user.spec1 ? 'fulled-input': '' }" class="form-control">
                    <option></option>
                    <option v-for="(item) in skill_categories" :key="'spec1-'+item.id" :value="item.id">{{ item.name }}</option>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="spec2" class="caseinfo-title">???????????????</label>
                  <select id="spec2" v-model="form.user.spec2" :class="{ 'fulled-status' : form.user.spec2 ? 'fulled-input': '' }" class="form-control">
                    <option></option>
                    <option v-for="(item) in skill_categories" :key="'spec2-'+item.id" :value="item.id">{{ item.name }}</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="profile-item">
              <label for="user_profile" class="caseinfo-title">??????</label>
              <textarea rows="3" id="user_profile" :class="{ 'fulled-status' : form.user.profile ? 'fulled-input': '' }" v-model="form.user.profile" class="form-control"></textarea>
            </div>

            <div class="profile-item">
              <label for="user_career" class="caseinfo-title">???????????????</label>
              <textarea rows="3" id="user_career" :class="{ 'fulled-status' : form.user.career ? 'fulled-input': '' }" v-model="form.user.career" class="form-control"></textarea>
            </div>

          </div>
        </div>
      </div>
      <!-- </vue-custom-scrollbar> -->
      <template v-slot:footer>
        <div class="profile-item">
          <button class=" btn btn-primary"  @click="handleUpdateStuff">????????????????????????????????????</button>
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
      categories: 'data/categories',
    }),

    // skill_categories() {
    //   let tc = [];

    //   this.categories.map(el => {
    //     el.all_children.map(item => {
    //       tc.push({
    //         id: item.id,
    //         name: item.name,
    //         parent_name: el.name,
    //       });
    //     });
    //   });

    //   return tc;
    // },

    skill_categories() {
      let tc = [];

      $.each(this.categories, function (key, item){
        tc.push({
            id: item.id,
            name: item.name,
          });
      })
console.log(tc);
      return tc;
    },
  },

  data() {
    return {
      afterPhoto:'',
      autoStaticId: 0,
      isModal: false,
      modalInfo: {
        title: '',
        confirmBtnTitle: '',
      },
      errors: undefined,
      form: undefined,
      user: undefined,
      idValidation: 0,
      settings: {
        suppressScrollY: false,
        suppressScrollX: true,
        wheelPropagation: false
      },
      clinics: [],
      tmpClinics: [],
    }
  },

  methods: {
    //get user data from api
    getData() {
      this.$store.dispatch('state/setIsLoading')

      return Promise.all([
        axios.get(`/api/doctor/profile`),
        axios.get(`/api/doctor/clinics`)
      ]).then(([res1, res2]) => {
        this.user = res1.data.data;
        this.clinics = res2.data;
      }).finally(() => {
        this.$store.dispatch('state/removeIsLoading')
      });
    },

    handleEditProfile() {
      //console.log(this.user.docimages);
      this.modalInfo = {
        title: '?????????????????????????????????',
        confirmBtnTitle: '??????'
      }
      this.form = {
        imagesinfo:{
            add:[],
            delete:[]
        },
        user: { ...this.user},
        specialities: {...this.specialities}
      }

      let tp = [];
      this.tmpClinics = [];

      $.each(this.form.user.clinics, function (key, value){
        tp.push(value);
      });

      this.tmpClinics = tp;

      this.isModal = true
      this.$refs.modal.show();
    },

    handleUpdateStuff() {
      this.$store.dispatch('state/setIsLoading');

      if (this.form.fileChanged) {
        this.$refs.fileUploadComponent.processQueue();
      } else {
        this.handleSaveStuff();
      }
    },

    handleSaveStuff() {
      let url = '/api/doctor/profile';

      let added_clinics = [];
      let deleted_clinics = [];
      let clinics = this.form.user.clinics;
      let tmp_clinics = this.tmpClinics;

      $.each(this.tmpClinics, function(key, value){
        let exist = clinics.filter(function(el) {
          return el.id == value.id;
        });

        if(exist.length <= 0)
          deleted_clinics.push(value.user_id);
      });

      $.each(this.form.user.clinics, function(key, value) {
        let exist = tmp_clinics.filter(function(el) {
          return el.id == value.id;
        });

        if(exist.length <= 0)
          added_clinics.push(value.user_id);
      });

      this.form.user.added_clinics = added_clinics;
      this.form.user.deleted_clinics = deleted_clinics;
       this.form.user.imagesinfo = this.form.imagesinfo;
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
            title: '?????????????????????',
            icon: 'success',
          })
          this.query = {
            ...this.query,
            page: 1
          }
          this.$refs.fileUploadComponent.removeAllFiles();

          this.loadDbData();
          this.updateUser();
        })
        .catch(error => {
          this.errors = { ...error.response.data.errors }
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    async updateUser() {
      await this.$store.dispatch('auth/fetchUser');
    },

    loadDbData() {
      axios.get('/api/doctor/load/master')
        .then(res => {
          this.$store.dispatch('data/saveJobs', { jobs : res.data.jobs })
          this.$store.dispatch('data/saveRsvContents', { rsv_contents : res.data.rsvContents })
          this.$store.dispatch('data/saveSpecialities', { specialities : res.data.specialities })
          this.$store.dispatch('data/saveCategories', { categories : res.data.categories })
          this.$store.dispatch('data/savePrefs', { prefs : res.data.prefs })
          this.$store.dispatch('data/savetreatCategories', { treatCategories : res.data.treatCategories })
          this.$store.dispatch('data/saveMenus', { menus : res.data.menus })
          this.$store.dispatch('state/setIsMasterLoaded')
        })
    },

    handleFileSaved(fileUrl) {
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
    handleUpdateUploadBeforeImage(){
      this.$refs.UploadDocimage.processQueue();
      this.$refs.UploadDocimage.$el.click()
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
     handleUpdateImagesSaved(fileUrl){
      let id = "a" + this.autoStaticId++;
      let objImage = {
        id: id,
        photo: fileUrl
      }
      this.form.user.docimages.push(objImage);
      this.$refs.UploadDocimage.removeAllFiles();
      this.form.imagesinfo.add.push(fileUrl);
    },
      handleUpdateRemoveBeforeImageClick(id){
        if(id.toString().indexOf("a") !== -1){


          this.form.imagesinfo.add.filter(function (el){
            return el.id !== id;
          })
        }else{
          this.form.imagesinfo.delete.push(id);
        }
      this.form.user.docimages = this.form.user.docimages.filter(function (el){
        return el.id !== id;
      });
    },
    scrollHanle(evt) {
      // console.log(evt)
    },
    clinicChangeEvent(val){
        // console.log(val);
    },
    clinicSelectEvent({id, text}){
      let item = this.clinics.filter(function(el) {
        return el.id == id;
      });

      let exist = this.form.user.clinics.filter(function(el) {
        return el.id == id;
      });

      if(exist.length <= 0)
        this.form.user.clinics.push(item[0]['info']);
    },
    clinicSelectOpenEvent(data) {
      document.querySelector('input.select2-search__field').setAttribute('placeholder', '??????????????????????????????');
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
    },
    handleCancelSelectedClinic(item, index) {
      this.form.user.clinics.splice(index, 1);
    }
  }
}
</script>
<style scoped>
.images-group{
  margin:30px;
}
.photo-img{
  width: 200px;
  height: 133px;
  margin-right: 20px;
}
.remove-img-clicker{
  position: absolute;
  top: -10px;
  right: -10px;
  cursor: pointer;
}
.remove-img-icon{
  width: 18px;
  height: auto;
}
.caseinfo-maintitle{
  color: #7d7d7d;
  font-size: 15px;
  margin: 5px 0;
}
.case-img-list{
  height: 80px;
  width: 120px;
}
.photo-container{
  position: relative;
  margin-right: 12px;
  margin-bottom: 12px;
}
.upload_image_picker{
  margin-left: 150px;
  margin-right: 150px;

}

</style>
