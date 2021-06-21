<template>
  <div class="main-in">
    <div v-if="questionDetail" class="main-content">
      <div class="row my-3">
        <div class="col-12">
          <p class="page-title">{{questionDetail.title}}</p>
        </div>
      </div>

      <div class="row my-3">
        <div class="col-12">
          <div class="avatar-container">
            <img class="avatar-img" :src="'/img/menu-img.png'">
            <div class="avatar-detail">
              <div class="user-name">{{this.user.name}}</div>
              <div class="user-birthday">23時間前</div>
            </div>
          </div>
        </div>
      </div>


      <div class="row mb-3">
        <div class="col-12">
          <p class="page-content">{{questionDetail.content}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="more-add-image-container">
            <textarea rows="5" id="user_profile" class="form-control pb-4" v-model="doctorAnswer"></textarea>
            <a @click="handleMoreAddImageClick()" class="more-add-image-clicker">
              <img src="/img/file.png" class="more-add-image"/>
            </a>
          </div>

          <div class="row" v-if="isuploadfileBlock">
              <div class="col-12">
                  <file-upload
                    ref="beforeImageUploadComponent"
                    uploadUrl="/api/doctor/cases/uploadPhoto"
                    :maxFiles="10"
                  />
              </div>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-12 d-flex justify-content-end">
          <button type="button" class="bootstrap-btn btn btn-primary" @click="handleAddAnswer">コメントする</button>
        </div>
      </div>


      <div class="row my-3" v-for="item in answers">
        <div class="col-12">
          <div class="avatar-container">
            <img class="avatar-img" :src="item.photo || '/img/menu-img.png'">
            <div class="avatar-detail">
              <div class="user-name">{{item.doctor.kata_name}}</div>
              <div class="user-birthday">{{ item.created_at | formatDate }}</div>
            </div>
            <a @click.prevent.stop="handleMordetailClick($event, item)" class="more-detail-clicker">
              <img src="/img/detail-icon.svg" class="detail-img-icon"/>
            </a>
          </div>
          <div class="detaildescription">
            <p>{{item.answer}}</p>
          </div>
        </div>
      </div>
      <vue-simple-context-menu
        :elementId="'myFirstMenu'"
        :options="optionsArray"
        :ref="'vueSimpleContextMenu1'"
        @option-clicked="optionClicked1"
      >
      </vue-simple-context-menu>

    </div>


    <form-modal
      ref="modal"
      id="menu-modal"
      :title="modalInfo.title"
      @cancel="handleModalClose"
    >
      <div v-if="editForm" class="create-menu-content">
        <div class="operation-option row">
          <div class="option-content">
            <div class="row">

            </div>
          </div>
        </div>
      </div>
      <template v-slot:footer>
        <button type="button" class="btn custom-btn-outline" @click="handleCancel">クリア</button>
        <button type="button" class="btn btn-primary" @click="handleEditAnswer">{{ modalInfo.confirmBtnTitle }}</button>
      </template>
    </form-modal>

  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import moment from 'moment';

import VueSimpleContextMenu from 'vue-simple-context-menu'
Vue.component('vue-simple-context-menu', VueSimpleContextMenu)
import 'vue-simple-context-menu/dist/vue-simple-context-menu.css'

export default {
  middleware: 'auth',

  data() {
    return {
      detailid: '',
      isuploadfileBlock: false,
      isEditing: false,
      errors: undefined,
      questionDetail: undefined,
      editForm: undefined,
      answers: [],
      doctorAnswer:'',
      optionsArray: [
        {
          name: 'Edit',
          slug: '編集'
        },
        {
          name: 'Delete',
          slug: '削除'
        }
      ],

      modalInfo: {
        title: '',
        confirmBtnTitle: '',
      },
    }
  },

  computed: {
    ...mapGetters({
      user: 'auth/user',
      prefs: 'data/prefs',
    }),
  },

  filters: {
    formatDate(value) {
      if (value) {
        return moment(String(value)).format('MM月 DD日')
      }
    }
  },

  mounted() {
    this.getData()
  },

  methods: {

    getData() {
      this.detailid = this.$route.params.id
      // this.$store.dispatch('state/setIsLoading')
      let url = '/api/doctor/questions/' + this.detailid;
      axios.get(url)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading')
          this.questionDetail = res.data.data.question;
          this.answers = res.data.data.question.answers;
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    handleMordetailClick (event, item) {
      this.$refs.vueSimpleContextMenu1.showMenu(event, item)
    },

    optionClicked1 (event) {
      // window.alert(JSON.stringify(event))


      let answerId = event.item.id;

      if(event.option.name === 'Delete'){
        let url = '/api/doctor/questions/' + this.detailid + '/answers/' + answerId;
        axios.delete(url)
          .then(res => {
            this.$store.dispatch('state/removeIsLoading')
            this.answers = this.answers.filter(function (el){
              return el.id !== answerId;
            })
          })
          .catch(error => {
            this.$store.dispatch('state/removeIsLoading')
          })
      }
      else{
        this.editForm = {
          answer: event.item.answer
        }

        this.modalInfo = {
          title: 'Edit',
          confirmBtnTitle: 'メニューを変更'
        }

        this.$refs.modal.show();
      }
    },

    handleAddAnswer(){

      this.$store.dispatch('state/setIsLoading')
      let url = '/api/doctor/questions/' + this.detailid + '/answers'
      let formData = {
        answer: this.doctorAnswer,
        photo: []
      }
      axios.post(url, formData)
        .then(res => {
          this.doctorAnswer = '';
          this.answers.push(
            {...res.data.data}
          )
          // this.query = {
          //   ...this.query,
          //   per_page: res.data.menus.per_page
          // }
          // this.pageInfo = {
          //   last_page: res.data.menus.last_page,
          // }

          this.$refs.beforeImageUploadComponent.removeAllFiles();
          this.isuploadfileBlock = false
          this.$store.dispatch('state/removeIsLoading')
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
    },
    handleCancel(){

    },

    handleEditAnswer(){

    },
    handleModalClose(){

    },
    handleMoreAddImageClick(){
      if(this.isuploadfileBlock){
        this.isuploadfileBlock = false;
      }
      else{
        this.isuploadfileBlock = true;
      }
    }
  }
}
</script>

<style scoped>

.page-title{
  font-size: 20px;
  font-weight: 600;
  letter-spacing: 4px;
}
.page-content{
  line-height: 30px;
}

.avatar-img{
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 10px;
}
.avatar-container{
  display: flex;
  margin: 10px 0;
  position: relative;
}

.more-detail-clicker{
  position: absolute;
  right: 20px;


  padding: 5px;
  height: 35px;
  border-radius: 50%;
  width: 35px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.more-detail-clicker:hover{
  background-color: aliceblue;
}

.more-add-image-container{
  position: relative;
}

.more-add-image-clicker{
  position: absolute;
  bottom: 5px;
  left: 5px;
  cursor: pointer;
  width: 15px;
}
</style>
