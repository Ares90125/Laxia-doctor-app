<template>
  <div class="main-in question-main-in">
    <div class="main-content">
      <div class="question-tab-con">
        <a href="#" :class="{'active': tab_status == 0}" @click="handleStatusChange(0)">{{ $t('最新の質問') }}</a>
        <a href="#" :class="{'active': tab_status == 1}" @click="handleStatusChange(1)">{{ $t('人気の質問') }}</a>
        <a href="#" :class="{'active': tab_status == 2}" @click="handleStatusChange(2)">{{ $t('自分の回答した質問') }}</a>
      </div>
      <div class="staff-header">
        <p>
          <select class="staff-sort form-control" :class="{ 'fulled-status' : category_top_id ? 'fulled-input': '' }" v-model="category_top_id" @click="handleSearchSelect(category_top_id, $event)">
            <option value="0">施術で絞り込む</option>
            <option v-for="item in treatCategories" :key="item.id" :value="item.id">{{ item.name }}</option>
          </select>
        </p>
      </div>
      <div class="row selected-category" v-if="isSelectedTreatSubCategory">
        <div class="selected-treat-subcategory" v-for="item in selectedTreatSubCategory" :key="item.childCate.id">
          <p class="selected-option" >{{item.subcate.name + ' / ' +  item.childCate.name}}</p>
          <a @click="handleCancelSelectedCondition(item.subcate.id, item.childCate.id)">
            <img src="/img/img-close-color.svg" class="close-img"/>
          </a>
        </div>
      </div>
      <div class="menu-list">
        <div v-for="item in questionArr" :key="item.id" class="row-menu-one">
          <div class="container-menu-one-in" @click="handleShowMenu(item.id)">
            <div class="menu-img">
              <img :src="item.owner.photo || '/img/menu-img.png'" class="rounded-circle owner-avatar-photo mr-1">
            </div>
            <div class="comment-info">
              <div class="comment-ttl">
                <p class="menu-ttl">{{ item.title }}</p>
                <p class="menu-time">{{ item.before_time }}</p>
              </div>
              <p class="comment-content">{{ item.content}}</p>
              <div class="row">
                <div class="col-10">
                  <div class="selected-treat-subcategory" v-for="(itemCategory, index) in item.categories" :key="index" >
                    <p class="selected-option" >{{itemCategory.parent_name + ' / ' +  itemCategory.name}}</p>
                  </div>
                </div>
                <div class="col-2 d-flex justify-content-end icon-grp">
                  <p class="like-cnt">
                    <svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M10.5007 18.875L10.1426 18.6146C9.7194 18.3216 0.0839844 11.6484 0.0839844 6.17969V5.82161C0.0839844 2.69661 2.6556 0.125 5.81315 0.125C7.73372 0.125 9.45898 1.06901 10.5007 2.59896C11.5423 1.06901 13.3001 0.125 15.1882 0.125C18.3457 0.125 20.9173 2.66406 20.9173 5.82161V6.17969C20.9173 11.6159 11.2819 18.3216 10.8587 18.6146L10.5007 18.875ZM5.81315 1.42708C3.37175 1.42708 1.38607 3.41276 1.38607 5.82161V6.17969C1.38607 8.13281 3.01367 10.6719 6.04102 13.6016C7.89648 15.3268 9.7194 16.7266 10.5007 17.2799C11.2819 16.7266 13.1048 15.3268 14.9603 13.6016C17.9876 10.6719 19.6152 8.13281 19.6152 6.17969V5.82161C19.6152 3.41276 17.6296 1.42708 15.1882 1.42708C13.3652 1.42708 11.7702 2.5013 11.0866 4.19401L10.5007 5.72396L9.88216 4.22656C9.23112 2.53385 7.60352 1.42708 5.81315 1.42708Z" fill="#8D909E"/>
                    </svg>
                    <span>{{item.likes_count}}</span>
                  </p>
                  <p class="comments-cnt">
                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M18.0612 0.166504H1.98047C0.959961 0.166504 0.125 1.00976 0.125 2.0404V12.6592C0.125 13.6898 0.959961 14.5331 1.98047 14.5331H3.52669V16.9379C3.52669 17.1877 3.61947 17.4376 3.80501 17.625C3.99056 17.7811 4.20703 17.8748 4.45443 17.8748C4.70182 17.8748 4.91829 17.7811 5.07292 17.625L8.41276 14.5331H18.0612C19.0817 14.5331 19.9167 13.6898 19.9167 12.6592V2.0404C19.9167 1.00976 19.0817 0.166504 18.0612 0.166504ZM18.6797 12.6592C18.6797 13.0027 18.4014 13.2838 18.0612 13.2838H7.91797L4.76367 16.2196V13.2838H1.98047C1.6403 13.2838 1.36198 13.0027 1.36198 12.6592V2.0404C1.36198 1.69685 1.6403 1.41577 1.98047 1.41577H18.0612C18.4014 1.41577 18.6797 1.69685 18.6797 2.0404V12.6592Z" fill="#8D909E"/>
                    </svg>
                    <span>{{item.comments_count}}</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <pagination
        v-if="pageInfo"
        :page="query.page"
        :page-count="pageInfo.last_page"
        :click-handler="handlePaginate" />
    </div>

    <question-menu-modal
      ref="modal"
      id="menu-modal"
      @cancel="handleClose"
    >
      <div v-if="optionContent" class="create-menu-content">
        <div class="operation-option row">
          <div class="option-category">
            <vue-custom-scrollbar class="scroll-area-doctor-menu"  :settings="settings" @ps-scroll-y="scrollHanle">
            <!-- <div class="scroll-modal-body scroll-area-doctor-menu"> -->
              <div class="list-group">
                <a href="#" v-for="(item, index) in treatCategories" @click="handleSpecChange(item.id)" :key="'treat_cat_'+index" class="list-category list-group-item-action">
                  <p v-if="item.id === category_top_id" class="list-category-p active">{{item.name}}</p>
                  <p v-else class="list-category-p">{{item.name}}</p>
                </a>
              </div>
            <!-- </div> -->
            </vue-custom-scrollbar>
          </div>
          <div class="option-content">
            <vue-custom-scrollbar class="scroll-area-doctor-menu"  :settings="settings" @ps-scroll-y="scrollHanle">
            <!-- <div class="scroll-modal-body scroll-area-doctor-menu"> -->
              <div class="row">
                <div class="col-6" v-for="subCategories in treatSubCategories.all_children" :key="'sub_cat_'+subCategories.id">
                  <div class="custom-control custom-radio">
                    <input type="checkbox" :id="'sub_cat_'+subCategories.id" class="custom-control-input" @change="onChangeTreatCubCategory(treatSubCategories, subCategories)" :value="treatSubCategories.id + '/' + subCategories.id">
                    <label class="custom-control-label" :for="'sub_cat_'+subCategories.id">{{ subCategories.name }}</label>
                  </div>
                </div>
              </div>
            <!-- </div> -->
            </vue-custom-scrollbar>
          </div>
        </div>
      </div>
      <template v-slot:footer>
        <button type="button" class="btn custom-btn-outline" @click="handleCancel">クリア</button>
        <button type="button" class="btn btn-primary" @click="handleSearchCondition">絞り込む</button>
      </template>
    </question-menu-modal>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import vueCustomScrollbar from 'vue-custom-scrollbar'
import "vue-custom-scrollbar/dist/vueScrollbar.css"

export default {
  middleware: 'auth',
  
  components: {
    vueCustomScrollbar
  },

  data() {
    return {
      questionArr: [],
      optionContentArr: [],
      form: undefined,
      errors: undefined,
      optionContent: '',
      pageInfo: undefined,
      category_top_id: 0,
      spec_detail_list:undefined,
      treatSubCategories:undefined,
      selectedTreatSubCategory:[],
      tmpSelectedTreatSubCategory:[],
      formCategories: [],
      tmpFormCategories: [],
      isSelectedTreatSubCategory:false,
      settings: {
        suppressScrollY: false,
        suppressScrollX: true,
        wheelPropagation: false
      },
      tab_status: 0,
      query: {
        per_page: 10,
        page: 1,
        orderby: 'updated_at',
        status: 0
      },
    }
  },

  computed: {
    ...mapGetters({
      token: 'auth/token',
      is_master_loaded: 'state/is_master_loaded',
      specialities: 'data/specialities',
      categories: 'data/categories',
      treatCategories: 'data/treatCategories',
      masui: 'constant/masui',
      bleeding: 'constant/bleeding',
      hospital_need: 'constant/hospital_need',
      hospital_visit: 'constant/hospital_visit',
      makeup: 'constant/makeup',
      massage: 'constant/massage',
      pain: 'constant/pain',
      shower: 'constant/shower',
      sport_impossible: 'constant/sport_impossible',
      basshi: 'constant/basshi',
      hare: 'constant/hare',
      treat_time: 'constant/treat_time',
    }),
  },

  mounted() {
    this.getData()
  },

  methods: {
    scrollHanle(evt) {
      // console.log(evt)
    },

    getData() {
      this.$store.dispatch('state/setIsLoading');

      axios.post(`/api/doctor/questions/search`, this.query)
        .then(res => {
          this.questionArr = this.setParentCategory(res.data.data.questions.data);
          this.query = {
            ...this.query,
            per_page: res.data.data.questions.per_page
          }
          this.pageInfo = {
            last_page: res.data.data.questions.last_page,
          }
          console.log(this.pageInfo);
          this.$store.dispatch('state/removeIsLoading')
        })
        .catch(error => {
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    setParentCategory(response) {
      let treatCategories = this.treatCategories;
      let parent_name = '';

      $.each(response, function(key, value) {
        $.each(value.categories, function(sub_key, sub_value) {
          parent_name = '';
          
          treatCategories.map(item => {
            if(item.id == sub_value.parent_id) parent_name = item.name;
          })
          
          sub_value.parent_name = parent_name;
        })
      })

      return response;
    },

    handleStatusChange(status) {
      this.tab_status = status;

      this.query = {
        ...this.query,
        page: 1,
        status: status // 0: 最新の質問, 1: 人気の質問, 2: 自分の回答した質問
      };

      this.getData();
    },

    handleShowMenu(id){
      this.$router.push({ name: 'user_questiondetail', params: {id: id}})
    },

    handleSearchSelect(id, $event){

      $event.target.blur();
      
      let tmp = [];
      $.each(this.formCategories, (key, item) => tmp.push(item));
      this.tmpFormCategories = tmp;

      this.tmpSelectedTreatSubCategory = [];
      this.optionContent = '100';
      
      this.$refs.modal.show();
      
      this.selectTreatCategory(id);
    },

    selectTreatCategory(id){
      let selected = this.treatCategories.find(el => el.id == id);
      this.treatSubCategories = {...selected}
    },

    handleSearchCondition(){
      this.formCategories = 
        this.tmpFormCategories.length > 0 ? 
        this.tmpFormCategories: 
          (this.formCategories.length > 0 ? this.formCategories : undefined);

      this.selectedTreatSubCategory = 
        this.tmpSelectedTreatSubCategory.length > 0 ? 
        this.tmpSelectedTreatSubCategory: 
          (this.selectedTreatSubCategory.length > 0 ? this.selectedTreatSubCategory : undefined);

      this.query = {
        ...this.query,
        page: 1,
        category_id: this.formCategories
      };

      this.getData();

      this.isSelectedTreatSubCategory = true;
      this.category_top_id = 0;

      this.$refs.modal.hide();
    },

    handleCancel(){
      this.category_top_id = 0;
      this.$refs.modal.hide();
    },

    handleClose() {
      this.category_top_id = 0;
    },

    handleSpecChange(category_selected_id){
      this.category_top_id = category_selected_id
      this.selectTreatCategory(category_selected_id)
    },

    onChangeTreatCubCategory(treatCategory, sub){
      let selectedSub = {
        subcate:treatCategory,
        childCate:sub
      }

      if(!this.tmpFormCategories.some(data => data === sub.id)) {
        this.selectedTreatSubCategory.push(selectedSub);
        this.tmpFormCategories.push(sub.id);
      }
    },

    handleCancelSelectedCondition(treatCategoryId, subId){
      this.selectedTreatSubCategory = this.selectedTreatSubCategory.filter(function (el){
        return el.childCate.id !== subId;
      })

      let tempArr = []
      $.each(this.selectedTreatSubCategory, function (key, value){
        tempArr.push(value.childCate.id);
      })
      this.formCategories = tempArr

      this.query = {
        ...this.query,
        page: 1,
        category_id: this.formCategories
      };

      this.getData();

      this.isSelectedTreatSubCategory = true;
    },

    handlePaginate(pageNum) {
      this.query = {
        ...this.query,
        page: pageNum,
      }
      this.getData()
    },

    handleSaveMenu() {
      let url = '/api/clinic/menus';
      if (this.form.menus.id) {
        url += `/${this.form.menus.id}`
      }
      axios.post(url, this.form)
        .then(res => {
          let menu = res.data.menu
          this.$store.dispatch('state/removeIsLoading')
          // if (menu.status == 1) {
          this.$store.dispatch('data/addMenu', { menu: menu })
          // }
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
          this.getData()
        })
        .catch(error => {
          this.$swal({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            title: '登録できません。',
            icon: 'error',
          })
          this.errors = { ...error.response.data.errors }
          this.$store.dispatch('state/removeIsLoading')
        })
    },
  }
}
</script>

<style scoped>
.container-menu-one-in{
  background: #FFFFFF;
  border: 1px solid #FFFFFF;
  box-sizing: border-box;
  box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  width: 100%;
}
.row-menu-one{
  width: 100%;
  margin-right: 4%;
  margin-bottom: 30px;
  cursor: pointer;
}

.option-category{
  width: 30%;
  height: 460px;
  overflow-y: scroll;
}

.option-content{
  width: 70%;
  background-color: #f2f5f9;
  padding: 0 15px;
}
.list-category{
  border: initial;
}

.list-category.active{
  background-color: #f2f5f9;
}

.custom-btn-outline{
  color: #6c757d;
  border: 1px solid #6c757d;
}

.selected-option{
  padding: 10px;
  margin: 0 5px;
  color: #5CA3F6;
}

.list-category-p.active{
  background-color: #f2f5f9;
}

.selected-treat-subcategory{
  display: flex;
  background-color: aliceblue;
  align-items: center;
  margin: 0 10px;
}
.close-img{
  padding: 10px;
}

.owner-avatar-photo{
  width: 70px;
  height: 70px;
}

.comment-content{
  font-size: 20px;
  line-height: 29px;
  color: #000;
}

.comment-info{
  width: 100%;
  padding: 10px 24px 10px 10px;
}
</style>