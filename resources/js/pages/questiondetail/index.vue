<template>
  <div class="main-in question-detail-main-in">
    <div v-if="questionDetail" class="main-content">
      <a class="link-list-btn" @click="backListPage()">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 7.00027L3.83 7.00027L8.71 2.12027C9.1 1.73027 9.1 1.09027 8.71 0.700274C8.32 0.310274 7.69 0.310274 7.3 0.700274L0.709999 7.29027C0.319999 7.68027 0.319999 8.31027 0.709999 8.70027L7.29 15.3003C7.68 15.6903 8.31 15.6903 8.7 15.3003C9.09 14.9103 9.09 14.2803 8.7 13.8903L3.83 9.00027L15 9.00027C15.55 9.00027 16 8.55027 16 8.00027C16 7.45027 15.55 7.00027 15 7.00027Z" fill="#5F6377"/>
        </svg>
      </a>
      <div class="row">
        <div class="col-12">
          <p class="page-title">{{questionDetail.title}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-10">
          <div class="avatar-container">
            <img class="avatar-img" :src="'/'+questionDetail.owner.photo || '/img/menu-img.png'">
            <div class="avatar-detail">
              <div class="user-name">{{questionDetail.owner.name}}</div>
              <div class="user-birthday">{{ questionDetail.before_time }}</div>
            </div>
          </div>
        </div>
        <div class="col-2 d-flex justify-content-end icon-grp">
          <p class="like-cnt">
            <svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.5007 18.875L10.1426 18.6146C9.7194 18.3216 0.0839844 11.6484 0.0839844 6.17969V5.82161C0.0839844 2.69661 2.6556 0.125 5.81315 0.125C7.73372 0.125 9.45898 1.06901 10.5007 2.59896C11.5423 1.06901 13.3001 0.125 15.1882 0.125C18.3457 0.125 20.9173 2.66406 20.9173 5.82161V6.17969C20.9173 11.6159 11.2819 18.3216 10.8587 18.6146L10.5007 18.875ZM5.81315 1.42708C3.37175 1.42708 1.38607 3.41276 1.38607 5.82161V6.17969C1.38607 8.13281 3.01367 10.6719 6.04102 13.6016C7.89648 15.3268 9.7194 16.7266 10.5007 17.2799C11.2819 16.7266 13.1048 15.3268 14.9603 13.6016C17.9876 10.6719 19.6152 8.13281 19.6152 6.17969V5.82161C19.6152 3.41276 17.6296 1.42708 15.1882 1.42708C13.3652 1.42708 11.7702 2.5013 11.0866 4.19401L10.5007 5.72396L9.88216 4.22656C9.23112 2.53385 7.60352 1.42708 5.81315 1.42708Z" fill="#8D909E"/>
            </svg>
            <span>{{ questionDetail.likes_count }}</span>
          </p>
          <p class="comments-cnt">
            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18.0612 0.166504H1.98047C0.959961 0.166504 0.125 1.00976 0.125 2.0404V12.6592C0.125 13.6898 0.959961 14.5331 1.98047 14.5331H3.52669V16.9379C3.52669 17.1877 3.61947 17.4376 3.80501 17.625C3.99056 17.7811 4.20703 17.8748 4.45443 17.8748C4.70182 17.8748 4.91829 17.7811 5.07292 17.625L8.41276 14.5331H18.0612C19.0817 14.5331 19.9167 13.6898 19.9167 12.6592V2.0404C19.9167 1.00976 19.0817 0.166504 18.0612 0.166504ZM18.6797 12.6592C18.6797 13.0027 18.4014 13.2838 18.0612 13.2838H7.91797L4.76367 16.2196V13.2838H1.98047C1.6403 13.2838 1.36198 13.0027 1.36198 12.6592V2.0404C1.36198 1.69685 1.6403 1.41577 1.98047 1.41577H18.0612C18.4014 1.41577 18.6797 1.69685 18.6797 2.0404V12.6592Z" fill="#8D909E"/>
            </svg>
            <span>{{ questionDetail.comments_count }}</span>
          </p>
        </div>
      </div>

      <div class="question-con">
        <p>{{questionDetail.content}}</p>
      </div>

      <div class="category-grp" v-for="(itemCategory, index) in questionDetail.categories" :key="'category'+index">
        <div class="selected-treat-subcategory">
          <p class="selected-option">{{itemCategory.parent_name + ' / ' +  itemCategory.name}}</p>
        </div>
      </div>

      <div class="row"> 
        <div class="col-12">
          <div class="more-add-image-container">
            <textarea rows="5" id="user_profile" class="form-control comment-area" :class="{ 'fulled-status' : doctorAnswer ? 'fulled-input': '' }" v-model="doctorAnswer" placeholder="コメントやアドバイスをする"></textarea>
            <a @click="handleMoreAddImageClick()" class="more-add-image-clicker">
              <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.56015 0H2.04016C1.00616 0 0.169556 0.9 0.169556 2L0.160156 18C0.160156 19.1 0.996756 20 2.03076 20H13.3202C14.3542 20 15.2002 19.1 15.2002 18V6L9.56015 0ZM13.3202 18H2.04016V2H8.62015V7H13.3202V18ZM3.92016 13.01L5.24555 14.42L6.74016 12.84V17H8.62015V12.84L10.1148 14.43L11.4402 13.01L7.68956 9L3.92016 13.01Z" fill="#5F6377"/>
              </svg>
            </a>
          </div>
          <div class="answer-photo-row">
            <div class="photo-container" v-for="(item, index) in photos" :key="'photo-'+index">
              <img :src="item" class="img-item"/>
              <a @click="handleRemoveAnswerImageClick(index)" class="remove-img-clicker">
                <img src="/img/delete-icon.svg" class="remove-img-icon"/>
              </a>
            </div>
          </div>
          <div class="file-upload-answer-con" v-if="isuploadfileBlock">
            <file-upload-answer
              ref="answerImageUploadComponent"
              uploadUrl="/api/doctor/questions/uploadAnswerPhoto"
              :maxFiles="10"
              :autoStatus="true"
              name="menu-images"
              @file-upload-success="handleAnswerMultiFileSaved"
              @file-removed="hanleAnswerMultiFileRemove"
              @file-added="handleAnswerMultiFileAdded"
              @queue-complete="handleAnswerMultiFilesQueueComplete"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 d-flex justify-content-end">
          <button type="button" class="bootstrap-btn btn btn-primary add-answer-btn" @click="handleAddAnswer">コメントする</button>
        </div>
      </div>

      <div class="answer-cnt-con">{{ questionDetail.comments_count }}コメント</div>

      <div class="answer-item" v-for="(item, index) in answers" :key="index">
        <div class="row">
          <div class="avatar-container col-10">
            <img class="avatar-img" :src="item.doctor.photo || '/img/menu-img.png'">
            <div class="avatar-detail">
              <div class="user-name">{{item.doctor.kata_name}}</div>
              <div class="user-birthday">{{ item.update_time }}</div>
            </div>
          </div>
          <div class="col-2 d-flex justify-content-end">
            <v-popover
              offset="16"
            >
              <a class="more-detail-clicker tooltip-target">
                <svg width="21" height="5" viewBox="0 0 21 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <ellipse cx="2.53448" cy="2.5" rx="2.5" ry="2.53448" transform="rotate(-90 2.53448 2.5)" fill="#131340"/>
                  <ellipse cx="10.4993" cy="2.5" rx="2.5" ry="2.53448" transform="rotate(-90 10.4993 2.5)" fill="#131340"/>
                  <ellipse cx="18.4661" cy="2.5" rx="2.5" ry="2.53448" transform="rotate(-90 18.4661 2.5)" fill="#131340"/>
                </svg>
              </a>
              <template slot="popover">
                <div class="more-btn-grp">
                  <div class="question-edit-btn question-btn-item" @click="handleEditQuestion(item)" v-close-popover>編集</div>
                  <div class="question-delete-btn question-btn-item" @click="handleDeleteQuestion(item)" v-close-popover>削除</div>
                </div>
              </template>
            </v-popover>
          </div>
        </div>
        <div class="detaildescription" v-if="!item.edit_flag">
          <p>{{item.answer}}</p>
        </div>
        <div class="detail-edit-con" v-if="item.edit_flag">
          <div class="row"> 
            <div class="col-12">
              <div class="more-add-image-container">
                <textarea rows="5" class="form-control comment-area" :class="{ 'fulled-status' : item.answer ? 'fulled-input': '' }" v-model="item.answer"></textarea>
                <a @click="handleMoreEditImageClick(item)" class="more-add-image-clicker">
                  <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.56015 0H2.04016C1.00616 0 0.169556 0.9 0.169556 2L0.160156 18C0.160156 19.1 0.996756 20 2.03076 20H13.3202C14.3542 20 15.2002 19.1 15.2002 18V6L9.56015 0ZM13.3202 18H2.04016V2H8.62015V7H13.3202V18ZM3.92016 13.01L5.24555 14.42L6.74016 12.84V17H8.62015V12.84L10.1148 14.43L11.4402 13.01L7.68956 9L3.92016 13.01Z" fill="#5F6377"/>
                  </svg>
                </a>
              </div>
              <div class="answer-photo-row">
                <div class="photo-container" v-for="(img_item, index) in item.photos" :key="'update-'+index">
                  <img :src="img_item.photo" class="img-item"/>
                  <a @click="handleRemoveAnswerEditImageClick(item, index)" class="remove-img-clicker">
                    <img src="/img/delete-icon.svg" class="remove-img-icon"/>
                  </a>
                </div>
              </div>
              <div class="file-upload-answer-con" v-if="item.upload_flag">
                <file-upload-answer
                  ref="answerEditImageUploadComponent"
                  uploadUrl="/api/doctor/questions/uploadAnswerPhoto"
                  :maxFiles="10"
                  :autoStatus="true"
                  name="menu-images"
                  @file-upload-success="handleAnswerEditMultiFileSaved"
                  @file-removed="hanleAnswerEditMultiFileRemove"
                  @file-added="handleAnswerEditMultiFileAdded"
                  @queue-complete="handleAnswerEditMultiFilesQueueComplete"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 d-flex justify-content-end">
              <button type="button" class="bootstrap-btn btn btn-primary add-answer-btn" @click="handleEditAnswer(item)">修正を完了</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <question-delete-modal
      ref="modal"
      id="question-delete_modal"
    >
      <p class="content">
        あなたのコメントを削除しますか？ <br/>
        削除すると復元することはできません。
      </p>
      <template v-slot:footer>
        <button type="button" class="btn custom-btn-outline cancel-btn" @click="closeDelModal">キャンセル</button>
        <button type="button" class="btn btn-primary" @click="deleteAnswer">削除する</button>
      </template>
    </question-delete-modal>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import moment from 'moment';

import { VTooltip, VPopover, VClosePopover } from 'v-tooltip'

VTooltip.options.popover.defaultPlacement = 'top'
VTooltip.options.popover.defaultClass = 'question-control-tooltip'

Vue.directive('tooltip', VTooltip)
Vue.directive('close-popover', VClosePopover)
Vue.component('v-popover', VPopover)

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
      photos: [],
      modalInfo: {
        title: '',
        confirmBtnTitle: '',
      },
      delAnswerId: 0,
      updateId: 0,
    }
  },

  computed: {
    ...mapGetters({
      user: 'auth/user',
      prefs: 'data/prefs',
      treatCategories: 'data/treatCategories',
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
      this.$store.dispatch('state/setIsLoading')

      let url = '/api/doctor/questions/' + this.detailid;
      axios.get(url)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading')
          this.questionDetail = this.setParentCategory(res.data.data.question);

          res.data.data.question.answers.forEach((item) => {
            item.edit_flag = false;
            item.upload_flag = false;
          });

          this.answers = res.data.data.question.answers;
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    setParentCategory(response) {
      let treatCategories = this.treatCategories;
      let parent_name = '';

      $.each(response.categories, function(sub_key, sub_value) {
        parent_name = '';
        
        treatCategories.map(item => {
          if(item.id == sub_value.parent_id) parent_name = item.name;
        })
        
        sub_value.parent_name = parent_name;
      })

      return response;
    },
    handleAddAnswer(){
      this.$store.dispatch('state/setIsLoading');
      let url = '/api/doctor/questions/' + this.detailid + '/answers'
      let formData = {
        answer: this.doctorAnswer,
        photo: this.photos
      }
      axios.post(url, formData)
        .then(res => {
          this.doctorAnswer = '';
          this.photos = [];
          this.answers.push(
            {...res.data.data}
          )
          this.questionDetail.comments_count = this.questionDetail.comments_count + 1;
          
          // this.query = {
          //   ...this.query,
          //   per_page: res.data.menus.per_page
          // }
          // this.pageInfo = {
          //   last_page: res.data.menus.last_page,
          // }

          this.$refs.answerImageUploadComponent.removeAllFiles();
          this.isuploadfileBlock = false;
          this.$store.dispatch('state/removeIsLoading');
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
    },
    handleCancel(){

    },

    handleEditAnswer(item){      
      let img_add = undefined;
      let add_arr = [];

      img_add = item.photos.filter(function (el){
        return isNaN(el.id);
      });

      $.each(img_add, function (key, value){
        add_arr.push(value.photo);
      });

      const question_id = this.$route.params.id

      this.$store.dispatch('state/setIsLoading');
      let url = '/api/doctor/questions/'+question_id+'/answers/'+item.id;

      item.added_photo = add_arr;

      axios.put(url, item)
        .then(res => {
          this.getData();

          this.$store.dispatch('state/removeIsLoading');
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
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
    },
    handleEditQuestion(item) {
      this.answers.forEach((answer) => {
        if(answer.id == item.id) {
          answer.edit_flag = true;
          answer.deleted_photo = [];
          this.updateId = item.id;
        }
      });

      this.$forceUpdate();
    },
    handleDeleteQuestion(item) {
      this.delAnswerId = item.id;

      this.$refs.modal.show();
    },
    closeDelModal() {
      this.$refs.modal.hide();
    },
    deleteAnswer() {
      this.$refs.modal.hide();

      let url = '/api/doctor/questions/' + this.detailid + '/answers/' + this.delAnswerId;
      let delId = this.delAnswerId;

      this.$store.dispatch('state/setIsLoading');

      axios.delete(url)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading');

          this.answers = this.answers.filter(function (el){
            return el.id !== delId;
          });

          this.questionDetail.comments_count = this.questionDetail.comments_count - 1;
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        });
    },
    handleMoreEditImageClick(item) {
      this.answers.forEach((answer) => {
        if(answer.id == item.id) answer.upload_flag = !answer.upload_flag;
      });

      this.$forceUpdate();
    },
    handleRemoveAnswerEditImageClick(item, index) {
      item.deleted_photo.push(item.photos[index].id);
      item.photos.splice(index, 1);
    },
    backListPage() {
      this.$router.push({ name: 'user_question'});
    },
    
    handleAnswerMultiFileSaved(fileUrl) {
      this.photos.push(fileUrl);
    },
    hanleAnswerMultiFileRemove(id) {
      // let length = this.$refs.beforeFileUploadComponent.getQueuedFiles();

      // if (!length) {
      //   this.form.beforeFileChanged = false;
      // }
    },
    handleAnswerMultiFileAdded(flg) {
      // this.form.beforeFileChanged = flg;
    },
    handleAnswerMultiFilesQueueComplete() {
      // this.form.beforeFileChanged = false
    },
    handleRemoveAnswerImageClick(index) {
      this.photos.splice(index, 1);
    },
    handleAnswerEditMultiFileSaved(fileUrl) {
      this.answers.forEach((answer) => {
        if(this.updateId == answer.id) {
          let objImage = {
            photo: fileUrl
          }

          answer.photos.push(objImage);
        }
      });
    },
    hanleAnswerEditMultiFileRemove(id) {
      // let length = this.$refs.beforeFileUploadComponent.getQueuedFiles();

      // if (!length) {
      //   this.form.beforeFileChanged = false;
      // }
    },
    handleAnswerEditMultiFileAdded(flg) {
      // this.form.beforeFileChanged = flg;
    },
    handleAnswerEditMultiFilesQueueComplete() {
      // this.form.beforeFileChanged = false
    },
  }
}
</script>

<style scoped>

</style>