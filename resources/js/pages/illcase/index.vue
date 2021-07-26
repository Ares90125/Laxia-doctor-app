<template>
  <div class="main-in illcase-main-in">
    <div class="staff-header">
      <p>
        <select v-model="staff" :class="{ 'fulled-status' : staff ? 'fulled-input': '' }" class="staff-sort form-control" @change="handleCategoryChange">
          <option value="-1">{{ $t('施術で絞り込む') }}</option>
          <option v-for="item in search_categories" :key="item.id" :value="item.id">{{ item.name }}</option>
        </select>
      </p>
      <p>
        <button class="btn btn-primary" @click="handleNewCase"><img src="/img/plus.svg"> {{ $t('新規スタッフを追加') }}</button>
      </p>
    </div>

    <div class="main-content">
      <div class="case-list">
        <div v-for="(item, index) in caseList" :key="index" class="case-one">
          <div class="case-one-in" @click="handleShowCase(item.id)">
            <div class="case-img">
              <p class="before"><img :src=" item.before.length > 0 ? item.before[0].photo : '/img/menu-img.png' "></p>
              <p class="after"><img :src=" item.after.length > 0 ? item.after[0].photo : '/img/menu-img.png'"></p>
            </div>
            <div class="case-info">
              <p class="case-cat empty-cat" v-if="item.category.length === 0"></p>
              <p class="case-cat" v-for="item in item.category">{{item.category}}</p>
              <p class="case-ttl">{{ item.title }}</p>
              <p class="case-name">
                <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.1803 2.57675C12.07 2.31583 11.8864 2.09517 11.6553 1.93863C11.4241 1.78254 11.1426 1.69052 10.8432 1.69052H9.59349V1.47492H7.78212C7.79035 1.41633 7.79495 1.35589 7.79495 1.29501C7.79492 0.580898 7.21402 0 6.49991 0C5.7858 0 5.2049 0.580898 5.2049 1.29501C5.2049 1.35589 5.20947 1.41633 5.21773 1.47492H3.40637V1.69052H2.15665C1.95752 1.69052 1.76527 1.73127 1.59178 1.80495C1.33039 1.91528 1.10976 2.09883 0.953193 2.33001C0.7971 2.56163 0.705078 2.84271 0.705078 3.14209V13.5489C0.705078 13.748 0.74583 13.9398 0.819072 14.1138C0.929844 14.3747 1.11342 14.5954 1.3446 14.7519C1.57578 14.9084 1.85727 15 2.15665 15H10.8432C11.0423 15 11.2346 14.9597 11.4085 14.8856C11.6694 14.7757 11.8901 14.5917 12.0466 14.3605C12.2027 14.1293 12.2947 13.8478 12.2947 13.5489V3.14209C12.2947 2.94252 12.254 2.75071 12.1803 2.57675ZM6.49991 0.814365C6.76496 0.814365 6.98056 1.02996 6.98056 1.29501C6.98056 1.35864 6.96773 1.41905 6.94484 1.47492H6.05448C6.03204 1.41908 6.01924 1.35864 6.01924 1.29501C6.01927 1.02996 6.23533 0.814365 6.49991 0.814365ZM11.4314 13.5489C11.4314 13.6313 11.4149 13.7073 11.3852 13.7773C11.3412 13.8821 11.2657 13.9728 11.1719 14.0369C11.0775 14.1 10.9668 14.1367 10.8432 14.1367H2.15665C2.07424 14.1367 1.9978 14.1202 1.92775 14.0909C1.82293 14.0464 1.73229 13.9709 1.66865 13.8771C1.60502 13.7828 1.5684 13.672 1.5684 13.5489V3.14209C1.5684 3.05968 1.58489 2.98324 1.61463 2.91319C1.65904 2.8079 1.73366 2.71772 1.82794 2.65409C1.92225 2.59093 2.03302 2.55431 2.15662 2.55384H3.40631V2.73375C3.40631 3.07157 3.68006 3.34532 4.01835 3.34532H8.98142C9.31971 3.34532 9.59346 3.07157 9.59346 2.73375V2.55384H10.8431C10.9256 2.55384 11.002 2.57033 11.072 2.60007C11.1769 2.64448 11.2675 2.7191 11.3311 2.81338C11.3943 2.90812 11.4309 3.01846 11.4314 3.14206V13.5489Z" fill="#8D909E"/>
                  <path d="M9.62913 5.07227H3.37012V5.79142H9.62913V5.07227Z" fill="#8D909E"/>
                  <path d="M9.62913 7.05029H3.37012V7.76944H9.62913V7.05029Z" fill="#8D909E"/>
                  <path d="M9.62913 9.02881H3.37012V9.74796H9.62913V9.02881Z" fill="#8D909E"/>
                  <path d="M9.62929 11.5469H6.5V12.2665H9.62929V11.5469Z" fill="#8D909E"/>
                </svg>
                <span>{{ item.majordoctorComment }}</span>
              </p>
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
    
    <form-modal
      ref="illcaseModal"
      id="case-modal"
      class="illcase-modal"
      :title="modalInfo.title"
      @cancel="handleModalClose"
    >
      <!-- <vue-custom-scrollbar class="scroll-modal-body" :settings="settings" @ps-scroll-y="scrollHanle"> -->
      <div class="scroll-modal-body">
        <div v-if="isEditing"  class="modal-container">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="title" class="caseinfo-title">タイトル</label>
                <input type="text" v-model="form.cases.title" :class="{ 'is-invalid': errors && errors['title'], 'fulled-status' : form.cases.title ? 'fulled-input': ''}" class="form-control" id="title" placeholder="例：奥二重の方の二重切開" />
                <div v-if="errors && errors['title']" class="error invalid-feedback">{{ errors['title'][0] }}</div>
              </div>
            </div>
          </div>

          <div class="photo-con">
            <div class="photo-con--sub-con before-con">
              <p class="caseinfo-title t-c">Before画像</p>
              <div class="file-upload-con">
                <file-upload
                  ref="beforeFileUploadComponent"
                  uploadUrl="/api/doctor/cases/before/photoupload"
                  :maxFiles="10"
                  :autoStatus="true"
                  name="menu-images"
                  @file-upload-success="handleBeforeMultiFileSaved"
                  @file-removed="hanleBeforeMultiFileRemove"
                  @file-added="handleBeforeMultiFileAdded"
                  @queue-complete="handleBeforeMultiFilesQueueComplete"
                />
              </div>
              <div class="file-upload-btn-con">
                <button class="btn btn-sm non-bootstrap-btn d-flex" @click="handleUploadBeforeImage">
                  <p class="">
                    <svg width="16" height="20" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.458008 22.8333H18.5413V20.25H0.458008V22.8333ZM0.458008 9.91667H5.62468V17.6667H13.3747V9.91667H18.5413L9.49968 0.875L0.458008 9.91667Z" fill="#5CA3F6"/>
                  </svg>
                  </p>
                  写真をアップロード</button>
              </div>
              <div v-if="errors && errors['before_photo']" class="error invalid-feedback without-is-invlid">{{ errors['before_photo'][0] }}</div>
            </div>
            <div class="photo-con--sub-con after-con">
              <p class="caseinfo-title t-c">After画像</p>
              <div class="file-upload-con">
                <file-upload
                  ref="afterFileUploadComponent"
                  uploadUrl="/api/doctor/cases/after/photoupload"
                  :maxFiles="10"
                  :autoStatus="true"
                  name="menu-images"
                  @file-upload-success="handleAfterMultiFileSaved"
                  @file-removed="hanleAfterMultiFileRemove"
                  @file-added="handleAfterMultiFileAdded"
                  @queue-complete="handleAfterMultiFilesQueueComplete"
                />
              </div>
              <div class="file-upload-btn-con">
                <button class="btn btn-sm non-bootstrap-btn d-flex"  @click="handleUploadAfterImage">
                  <p class="">
                    <svg width="16" height="20" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.458008 22.8333H18.5413V20.25H0.458008V22.8333ZM0.458008 9.91667H5.62468V17.6667H13.3747V9.91667H18.5413L9.49968 0.875L0.458008 9.91667Z" fill="#5CA3F6"/>
                    </svg>
                  </p>
                  写真をアップロード</button>
              </div>
              <div v-if="errors && errors['after_photo']" class="error invalid-feedback without-is-invlid">{{ errors['after_photo'][0] }}</div>
            </div>
          </div>

          <div v-if="form.cases.before_photo.length" class="">
            <p class="caseinfo-title">Before画像</p>
            <div class="row">
              <div class="photo-container" v-for="(item, index) in form.cases.before_photo">
                <img :src="item" class="case-img-list"/>
                <a @click="handleRemoveBeforeImageClick(index)" class="remove-img-clicker">
                  <img src="/img/delete-icon.svg" class="remove-img-icon"/>
                </a>
              </div>
            </div>
          </div>

          <div v-if="form.cases.after_photo.length" class="">
            <p class="caseinfo-title">After画像</p>
            <div class="row">
              <div class="photo-container" v-for="(item, index) in form.cases.after_photo">
                <img :src="item" class="case-img-list"/>
                <a @click="handleRemoveAfterImageClick(index)" class="remove-img-clicker">
                  <img src="/img/delete-icon.svg" class="remove-img-icon"/>
                </a>
              </div>
            </div>
          </div>

          <div class="row name-price-row" v-for="item in form.cases.menuProperty">
            <div class="col-8">
              <div class="form-group">
                <label for="menuName_1" class="caseinfo-title">メニュー名</label>
                <input type="text" v-model="item.name" :class="{ 'fulled-status' : item.name ? 'fulled-input': '' }" class="form-control" id="menuName_1" placeholder="例：二重切開" />
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="cost_1" class="caseinfo-title">料金</label>
                <input type="text" v-model="item.cost" :class="{ 'fulled-status' : item.cost ? 'fulled-input': '' }" class="form-control" id="cost_1" placeholder="例：250000円" >
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center">
            <div class="col-3">
              <a class="add-stuff-btn d-flex justify-content-center" @click="handleAddMenuItem">
                <svg width="24" height="24" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 0.5C6.1 0.5 0.5 6.1 0.5 13C0.5 19.9 6.1 25.5 13 25.5C19.9 25.5 25.5 19.9 25.5 13C25.5 6.1 19.9 0.5 13 0.5ZM19.25 14.25H14.25V19.25H11.75V14.25H6.75V11.75H11.75V6.75H14.25V11.75H19.25V14.25Z" fill="#8D909E"/>
                </svg>
              </a>
              <p class="d-flex justify-content-center">メニューを追加</p>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="category_1" class="caseinfo-title">カテゴリー</label>
              <multiselect
                class="m-multiselect"
                :class="{'is-invalid' : errors && errors['category'] }"
                id="category_1"
                v-model="form.cases.category"
                :options="category_options"
                :multiple="true"
                group-values="children"
                group-label="group_name"
                :group-select="true"
                track-by="name"
                label="name"
                selectLabel=""
                selectGroupLabel=""
                placeholder=""
                selectedLabel="選択済み"
                deselectLabel="削除"
                deselectGroupLabel="削除"
                @select="handleCateChange"
              ></multiselect>
              <div v-if="errors && errors['category']" class="error invalid-feedback">{{ errors['category'][0] }}</div>
              <div class="view-cate-panel mt-2">
                <template v-for="(item, idx) in selected_categories" :value="id">
                  <p :key="idx">
                    {{item.group}} / {{item.name}}
                    <span class="remove-cat" @click="removeCategory(idx)">
                      <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 1L1 9" stroke="#5CA3F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1 1L9 9" stroke="#5CA3F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </span>
                  </p>
                </template>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-6">
              <div class="form-group">
                <label for="gender_1" class="caseinfo-title">年齢</label>
                <select id="gender_1" v-model="form.cases.age" :class="{ 'is-invalid rm-icon-is-invalid': errors && errors['age'], 'fulled-status' : form.cases.age ? 'fulled-input': ''}" class="form-control">
                  <option></option>
                  <option v-for="i in 7" :key="i" :value="i * 10">{{ i * 10 }}{{ $t('代') }}</option>
                </select>
                <div v-if="errors && errors['age']" class="error invalid-feedback">{{ errors['age'][0] }}</div>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="operation_1" class="caseinfo-title">性別</label>
                <select id="operation_1" v-model="form.cases.gender"  :class="{'is-invalid rm-icon-is-invalid' : errors && errors['gender'], 'fulled-status' : form.cases.gender ? 'fulled-input': '' }" class="form-control">
                  <option></option>
                  <option v-for="(name, id) in genders" :key="id" :value="id">{{ name }}</option>
                </select>
                <div v-if="errors && errors['gender']" class="error invalid-feedback">{{ errors['gender'][0] }}</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="doctor_comment_1" class="caseinfo-title">施術の解説</label>
                <textarea class="form-control" v-model="form.cases.operation" :class="{'is-invalid' : errors && errors['operation'], 'fulled-status' : form.cases.operation ? 'fulled-input': '' }" id="doctor_comment_1" rows="3" placeholder="例：この施術は目頭を切る施術になります。"></textarea>
                <div v-if="errors && errors['operation']" class="error invalid-feedback">{{ errors['operation'][0] }}</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="operation_risk_1" class="caseinfo-title">副作用・リスク</label>
                <textarea class="form-control" v-model="form.cases.operationRisk"  :class="{'is-invalid' : errors && errors['operationRisk'], 'fulled-status' : form.cases.operationRisk ? 'fulled-input': '' }" id="operation_risk_1" rows="3" placeholder="例：施術後一週間ほど腫れる場合があります。"></textarea>
                <div v-if="errors && errors['operationRisk']" class="error invalid-feedback">{{ errors['operationRisk'][0] }}</div>
              </div>
            </div>
          </div>

          <div class="row mb-0">
            <div class="col-12">
              <div class="form-group">
                <label for="major_doctor_comment_1" class="caseinfo-title">担当ドクターからのコメント(任意)</label>
                <textarea class="form-control" v-model="form.cases.majordoctorComment" :class="{ 'fulled-status' : form.cases.majordoctorComment ? 'fulled-input': '' }" id="major_doctor_comment_1" rows="3" placeholder="例：この施術は〇〇な方に向いているかと思います。"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- </vue-custom-scrollbar> -->
      <template v-slot:footer>
        <div class="row btn-row">
          <div class="col-12 d-flex justify-content-center">
            <button type="button" class="btn btn-primary" @click="handleSaveCases">{{ modalInfo.confirmBtnTitle }}</button>
          </div>
        </div>
      </template>
    </form-modal>

    <form-modal
      ref="illcaseInfo"
      id="illcaseInfo"
      class="illcase-modal"
      :title="modalInfo.title"
      @cancel="handleillcaseInfoClose"
    >
      <!-- <vue-custom-scrollbar class="scroll-modal-body" :settings="settings" @ps-scroll-y="scrollHanle"> -->
      <div class="scroll-modal-body">
        <div v-if="isIllcaseInfo" class="modal-container">
          <div class="row">
            <div class="col-12">
              <p class="caseinfo-title">タイトル</p>
              <p class="caseinfo-content">{{updateForm.cases.title}}</p>
            </div>
          </div>

          <div class="row ">
            <div class="col-12">
              <p class="caseinfo-title">Before画像</p>
              <div class="images-group">
                <img class="photo-img" v-for="photoItem in updateForm.cases.before" :src="photoItem.photo" />
              </div>
            </div>
          </div>

          <div class="row ">
            <div class="col-12">
              <p class="caseinfo-title">After画像</p>
              <div class="images-group">
                <img class="photo-img" v-for="photoItem in updateForm.cases.after" :src="photoItem.photo" />
              </div>
            </div>
          </div>

          <div class="row price-row">
            <div class="col-8">
              <p class="caseinfo-title">メニュー名</p>
            </div>
            <div class="col-4">
              <p class="caseinfo-title">料金</p>
            </div>
          </div>

          <div class="row price-row" v-for="(item, id) in updateForm.cases.menuProperty">
            <div class="col-8">
              <p class="caseinfo-content">{{item.name}}</p>
            </div>
            <div class="col-4">
              <p class="caseinfo-content">{{formatPrice(item.cost)}}</p>
            </div>
          </div>

          <div class="row year-row">
            <div class="col-12">
              <p class="caseinfo-title">カテゴリー</p>
              <div class="view-cate-panel">
                <template v-for="(item, idx) in selected_categories" :value="id">
                  <p :key="idx">{{item.name}}</p>
                </template>
              </div>
            </div>
          </div>

          <div class="row year-row">
            <div class="col-6">
              <p class="caseinfo-title">年齢</p>
              <p class="caseinfo-content">{{updateForm.cases.age}}代</p>
            </div>
            <div class="col-6">
              <p class="caseinfo-title">性別</p>
              <p class="caseinfo-content" v-if="updateForm.cases.gender ==='male'">男性</p>
              <p class="caseinfo-content" v-else >女性</p>
            </div>
          </div>

          <div class="row ">
            <div class="col-12">
              <p class="caseinfo-title">施術の解説</p>
              <p class="caseinfo-content m-pre-wrap">{{updateForm.cases.operation}}</p>
            </div>
          </div>

          <div class="row ">
            <div class="col-12">
              <p class="caseinfo-title">副作用・リスク</p>
              <p class="caseinfo-content m-pre-wrap">{{updateForm.cases.operationRisk}}</p>
            </div>
          </div>

          <div class="row ">
            <div class="col-12">
              <p class="caseinfo-title">担当ドクターからのコメント</p>
              <p class="caseinfo-content m-pre-wrap">{{updateForm.cases.majordoctorComment}}</p>
            </div>
          </div>
        </div>

  <!--====================================================================================================================update info-->
        <div v-if="isUpdateIllcaseInfo"  class="modal-container">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="title" class="caseinfo-title">タイトル</label>
                <input type="text" v-model="updateForm.cases.title" :class="{ 'is-invalid': updateErrors && updateErrors['title'], 'fulled-status' : updateForm.cases.title ? 'fulled-input': ''}" class="form-control" id="title" >
                <div v-if="updateErrors && updateErrors['title']" class="error invalid-feedback">{{ updateErrors['title'][0] }}</div>
              </div>
            </div>
          </div>

          <div class="photo-con">
            <div class="photo-con--sub-con before-con">
              <p class="caseinfo-title t-c">Before画像</p>
              <div class="file-upload-con">
                <file-upload
                  ref="UpdatebeforeFileUploadComponent"
                  uploadUrl="/api/doctor/cases/uploadPhoto"
                  :photo="beforePhoto"
                  @file-upload-success="handleUpdateBeforeImageSaved"
                  :maxFiles="10"
                  :autoStatus="true"
                />
              </div>
              <div class="file-upload-btn-con">
                <button class="btn btn-sm non-bootstrap-btn d-flex"  @click="handleUpdateUploadBeforeImage">
                  <p class="">
                    <svg width="16" height="20" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.458008 22.8333H18.5413V20.25H0.458008V22.8333ZM0.458008 9.91667H5.62468V17.6667H13.3747V9.91667H18.5413L9.49968 0.875L0.458008 9.91667Z" fill="#5CA3F6"/>
                    </svg>
                  </p>
                  写真をアップロード</button>
              </div>
              <div v-if="updateErrors && updateErrors['before_photo']" class="error invalid-feedback without-is-invlid">{{ updateErrors['before_photo'][0] }}</div>
            </div>
            <div class="photo-con--sub-con after-con">
              <p class="caseinfo-title t-c">After画像</p>
              <div class="file-upload-con">
                <file-upload
                  ref="UpdateafterFileUploadComponent"
                  uploadUrl="/api/doctor/cases/uploadPhoto"
                  :photo="afterPhoto"
                  @file-upload-success="handleUpdateAfterImageSaved"
                  :maxFiles="10"
                  :autoStatus="true"
                />
              </div>
              <div class="file-upload-btn-con">
                <button class="btn btn-sm non-bootstrap-btn d-flex"  @click="handleUpdateUploadAfterImage">
                  <p class="">
                    <svg width="16" height="20" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.458008 22.8333H18.5413V20.25H0.458008V22.8333ZM0.458008 9.91667H5.62468V17.6667H13.3747V9.91667H18.5413L9.49968 0.875L0.458008 9.91667Z" fill="#5CA3F6"/>
                    </svg>
                  </p>
                  写真をアップロード</button>
              </div>
              <div v-if="updateErrors && updateErrors['after_photo']" class="error invalid-feedback without-is-invlid">{{ updateErrors['after_photo'][0] }}</div>
            </div>
          </div>

          <div v-if="updateForm.cases.before.length" class="">
            <p class="caseinfo-title">Before画像</p>
            <div class="row">
              <div class="photo-container" v-for="(item, index) in updateForm.cases.before">
                <img :src="item.photo" class="case-img-list"/>
                <a @click="handleUpdateRemoveBeforeImageClick(item.id)" class="remove-img-clicker">
                  <img src="/img/delete-icon.svg" class="remove-img-icon"/>
                </a>
              </div>
            </div>
          </div>

          <div v-if="updateForm.cases.after.length" class="">
            <p class="caseinfo-title">After画像</p>
            <div class="row">
              <div class="photo-container" v-for="(item, index) in updateForm.cases.after">
                <img :src="item.photo" class="case-img-list"/>
                <a @click="handleUpdateRemoveAfterImageClick(item.id)" class="remove-img-clicker">
                  <img src="/img/delete-icon.svg" class="remove-img-icon"/>
                </a>
              </div>
            </div>
          </div>

          <div class="row" v-for="item in updateForm.cases.menuProperty">
            <div class="col-8">
              <div class="form-group">
                <label for="menuName" class="caseinfo-title">メニュー名</label>
                <input type="text" v-model="item.name" :class="{ 'fulled-status' : item.name ? 'fulled-input': '' }" class="form-control" id="menuName" placeholder="例：二重切開" />
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="cost" class="caseinfo-title">料金</label>
                <input type="text" v-model="item.cost" :class="{ 'fulled-status' : item.cost ? 'fulled-input': '' }" class="form-control" id="cost" placeholder="例：250000円" >
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center">
            <div class="col-3">
              <a class="add-stuff-btn d-flex justify-content-center" @click="handleAddMenuItem">
                <svg width="24" height="24" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 0.5C6.1 0.5 0.5 6.1 0.5 13C0.5 19.9 6.1 25.5 13 25.5C19.9 25.5 25.5 19.9 25.5 13C25.5 6.1 19.9 0.5 13 0.5ZM19.25 14.25H14.25V19.25H11.75V14.25H6.75V11.75H11.75V6.75H14.25V11.75H19.25V14.25Z" fill="#8D909E"/>
                </svg>
              </a>
              <p class="d-flex justify-content-center">メニューを追加</p>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="category" class="caseinfo-title">カテゴリー</label>
              <multiselect
                class="m-multiselect"
                :class="{'is-invalid' : updateErrors && updateErrors['category'] }"
                id="category"
                v-model="updateForm.cases.category"
                :options="category_options"
                :multiple="true"
                group-values="children"
                group-label="group_name"
                :group-select="true"
                track-by="name"
                label="name"
                selectLabel=""
                selectGroupLabel=""
                placeholder=""
                selectedLabel="選択済み"
                deselectLabel="削除"
                deselectGroupLabel="削除"
                @select="handleCateChange"
              ></multiselect>
              <div v-if="updateErrors && updateErrors['category']" class="error invalid-feedback">{{ updateErrors['category'][0] }}</div>
              <div class="view-cate-panel mt-2">
                <template v-for="(item, idx) in selected_categories" :value="id">
                  <p :key="idx">
                    {{item.group}} / {{item.name}}
                    <span class="remove-cat" @click="removeUpdateCategory(idx)">
                      <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 1L1 9" stroke="#5CA3F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1 1L9 9" stroke="#5CA3F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </span>
                  </p>
                </template>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-6">
              <div class="form-group">
                <label for="gender" class="caseinfo-title">年齢</label>
                <select id="gender" v-model="updateForm.cases.age" :class="{ 'is-invalid rm-icon-is-invalid': updateErrors && updateErrors['age'], 'fulled-status' : updateForm.cases.age ? 'fulled-input': ''}" class="form-control">
                  <option></option>
                  <option v-for="i in 7" :key="i" :value="i * 10">{{ i * 10 }}{{ $t('代') }}</option>
                </select>
                <div v-if="updateErrors && updateErrors['age']" class="error invalid-feedback">{{ updateErrors['age'][0] }}</div>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="operation" class="caseinfo-title">性別</label>
                <select id="operation" v-model="updateForm.cases.gender"  :class="{'is-invalid rm-icon-is-invalid' : updateErrors && updateErrors['gender'], 'fulled-status' : updateForm.cases.gender ? 'fulled-input': '' }" class="form-control">
                  <option></option>
                  <option v-for="(name, id) in genders" :key="id" :value="id">{{ name }}</option>
                </select>
                <div v-if="updateErrors && updateErrors['gender']" class="error invalid-feedback">{{ updateErrors['gender'][0] }}</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="doctor_comment" class="caseinfo-title">施術の解説</label>
                <textarea class="form-control" v-model="updateForm.cases.operation" :class="{'is-invalid' : updateErrors && updateErrors['operation'], 'fulled-status' : updateForm.cases.operation ? 'fulled-input': '' }" id="doctor_comment" rows="3" placeholder="例：この施術は目頭を切る施術になります。"></textarea>
                <div v-if="updateErrors && updateErrors['operation']" class="error invalid-feedback">{{ errors['operation'][0] }}</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="operation_risk" class="caseinfo-title">副作用・リスク</label>
                <textarea class="form-control" v-model="updateForm.cases.operationRisk"  :class="{'is-invalid' : updateErrors && updateErrors['operationRisk'], 'fulled-status' : updateForm.cases.operationRisk ? 'fulled-input': '' }" id="operation_risk" rows="3" placeholder="例：施術後一週間ほど腫れる場合があります。"></textarea>
                <div v-if="updateErrors && updateErrors['operationRisk']" class="error invalid-feedback">{{ updateErrors['operationRisk'][0] }}</div>
              </div>
            </div>
          </div>

          <div class="row mb-0">
            <div class="col-12">
              <div class="form-group">
                <label for="major_doctor_comment" class="caseinfo-title">担当ドクターからのコメント(任意)</label>
                <textarea class="form-control" :class="{ 'fulled-status' : updateForm.cases.majordoctorComment ? 'fulled-input': '' }" v-model="updateForm.cases.majordoctorComment" id="major_doctor_comment" rows="3" placeholder="例：この施術は〇〇な方に向いているかと思います。"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- </vue-custom-scrollbar> -->
<!--====================================================================================================================update info-->
      <template v-slot:footer>
        <div class="row btn-row" v-if="isIllcaseInfo">
          <div class="col-12 d-flex justify-content-center">
            <button type="button" class="btn btn-primary" @click="handleConfirmCases">{{ modalInfo.confirmBtnTitle }}</button>
          </div>
        </div>
        <div class="row btn-row" v-if="isUpdateIllcaseInfo">
          <div class="col-12 d-flex justify-content-center">
            <button type="button" class="btn btn-primary" @click="handleUpdateCases(updateForm.cases.id)">{{ modalInfo.confirmBtnTitle }}</button>
          </div>
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

export default {
  middleware: 'auth',

  components: {
    vueCustomScrollbar
  },

  data() {
    return {
      autoStaticId: 0,
      caseList:[],
      isEditing: false,
      isInviteDoctor: false,
      isIllcaseInfo: false,
      isUpdateIllcaseInfo: false,
      findDoctor: true,
      successFindDoctor: true,
      form: undefined,
      updateForm: undefined,
      errors: undefined,
      updateErrors: undefined,
      cases: {
        id: '',
        title: '',
        category: [],
        age: '',
        gender: '',
        operation: '',
        operationRisk: '',
        doctorComment: '',
        majordoctorComment: '',
        before_photo: [],
        after_photo: [],
        menuProperty:[{
          name:'',
          cost:''
        }]
      },
      beforePhoto:'',
      afterPhoto:'',
      menuItem:{
        name:'',
        cost:''
      },
      menuProperty:[],
      tmp: {
        beforeFileChanged: false,
        afterFileChanged: false,
      },
      query: {
        per_page: 12,
        page: 1,
      },
      modalInfo: {
        title: '',
        confirmBtnTitle: '',
      },
      pageInfo: undefined,
      selected_categories: [],
      tempImageForm: {
       before_photo : {
         add:[],
         delete: []
       },
       after_photo : {
         add:[],
         delete: []
       }
      },
      staff: -1,
      settings: {
        suppressScrollY: false,
        suppressScrollX: true,
        wheelPropagation: false
      },
    }
  },

  computed: {
    ...mapGetters({
      is_master_loaded: 'state/is_master_loaded',
      specialities: 'data/specialities',
      categories: 'data/categories',
      stuffs: 'data/stuffs',
      menus: 'data/menus',
      genders: 'constant/gender_types'
    }),

    category_options() {
      return this.categories.map(el => {
        return {
          group_name: el.name,
          children: el.all_children.map(item => {
            return {
              id: item.id,
              name: item.name,
            };
          }),
        };
      });
    },

    search_categories() {
      let tc = [];
      
      this.categories.map(el => {
        el.all_children.map(item => {
          tc.push({
            id: item.id,
            name: item.name,
          });
        });
      });

      return tc;
    },
  },

  mounted() {
    this.getData()
  },

  methods: {
    getData() {
      this.$store.dispatch('state/setIsLoading')
      const qs = this.$utils.getQueryString(this.query)
      axios.get(`/api/doctor/cases?${qs}`)
        .then(res => {
          this.caseList = res.data.cases.data;

          this.pageInfo = {
            last_page: res.data.cases.last_page,
          }
          this.$store.dispatch('state/removeIsLoading')
        })
        .catch(error => {
          console.log(error);
          this.$store.dispatch('state/removeIsLoading')
        })
    },
    
    handlePaginate(pageNum) {
      this.query = {
        ...this.query,
        page: pageNum,
      }
      this.getData()
    },

    handleNewCase() {
      this.form = {
        cases: {...this.cases}
      }
      this.modalInfo = {
        title: '新規スタッフを追加',
        confirmBtnTitle: '症例を追加する'
      }
      this.isEditing = true
      this.form.cases.before_photo = [];
      this.form.cases.after_photo = [];
      this.selected_categories = [];
      this.$refs.illcaseModal.show();
    },

    handleShowCase(id) {
      this.isIllcaseInfo = true;
      this.modalInfo = {
        title: '症例の詳細',
        confirmBtnTitle: '症例内容を編集する'
      }
      let selected = this.caseList.find(el => el.id == id);

      this.updateForm = {
        cases: { ...selected }
      }
      this.selected_categories = []
      
      let opt_groud_name = "";
      this.category_options.forEach(item => {
        opt_groud_name = item.group_name;

        item.children.forEach(child => {
          if (selected.category.map(item => item.category_id).includes(child.id)) {
            this.selected_categories.push({
              id: child.id,
              name: child.name,
              group: opt_groud_name
            })
          }
        })
      })

      this.$refs.illcaseInfo.show();
    },

    handleAddMenuItem(){
      this.form.cases.menuProperty.push({...this.menuItem})
    },
    handleSaveCases(){
      let url = '/api/doctor/cases';
      axios.post(url, this.form.cases)
        .then(res => {
          this.$store.dispatch('state/removeIsLoading')
          this.errors = undefined
          this.$refs.illcaseModal.hide();
          this.$swal({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            title: '登録しました。',
            icon: 'success',
          })
          this.getData();
        })
        .catch(error => {
          this.errors = { ...error.response.data.errors }
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    handleUpdateCases(id){

      //update image===================================================== <
      let before_add = undefined;
      let before_arr = [];
      let after_add = undefined;
      let after_arr = [];
      // this.updateImage.before_photo.add
      before_add = this.updateForm.cases.before.filter(function (el){
        return isNaN(el.id);
      });
      $.each(before_add, function (key, value){
        before_arr.push(value.photo);
      })

      this.tempImageForm.before_photo.add = before_arr;

      //
      after_add = this.updateForm.cases.after.filter(function (el){
        return isNaN(el.id);
      });
      $.each(after_add, function (key, value){
        after_arr.push(value.photo);
      })
      this.tempImageForm.after_photo.add = after_arr;


      this.tempImageForm.before_photo.delete = this.tempImageForm.before_photo.delete.filter(function(el){
        return !isNaN(el);
      });

      this.tempImageForm.after_photo.delete = this.tempImageForm.after_photo.delete.filter(function(el){
        return !isNaN(el);
      });
      //update image===================================================== >

      let tempCategory = {
        delete: [],
        add:[]
      }
      this.selected_categories.forEach(selectedItem => {
        if(!(this.updateForm.cases.category.map(item => item.category_id).includes(selectedItem.id))){
          tempCategory.add.push({'id' : selectedItem.id});
        }
      })

      this.updateForm.cases.category.forEach(item => {
        if(!(this.selected_categories.map(selectedItem => selectedItem.id).includes(item.category_id))){
          tempCategory.delete.push({'id' : item.category_id});
        }
      })

      this.updateForm.cases = {
        ...this.updateForm.cases,
        ...this.tempImageForm,
        category: {...tempCategory}
      }

      let url = '/api/doctor/cases/' + id;

      axios.put(url, this.updateForm.cases)
        .then(res => {
          this.updateErrors = undefined
          this.$refs.illcaseInfo.hide();
          this.isIllcaseInfo = false;
          this.isUpdateIllcaseInfo = false;
          this.$swal({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            title: '登録しました。',
            icon: 'success',
          })
          this.getData();
        })
        .catch(error => {
          this.updateErrors = { ...error.response.data.errors }
          this.$store.dispatch('state/removeIsLoading')
        })
    },

    handleConfirmCases(){
      this.isIllcaseInfo = false;
      this.isUpdateIllcaseInfo = true;
      this.modalInfo = {
        title: '症例内容を編集',
        confirmBtnTitle: '症例内容を編集を完了'
      }
    },

    handleModalClose() {
      this.errors = undefined;
      this.isEditing = false;
    },

    handleillcaseInfoClose(){
      this.isIllcaseInfo = false;
      this.isUpdateIllcaseInfo = false;
    },

    hanleBeforeMultiFileRemove(id) {
      let length = this.$refs.beforeFileUploadComponent.getQueuedFiles();

      if (!length) {
        this.form.beforeFileChanged = false;
      }
    },

    hanleAfterMultiFileRemove(id) {
      let length = this.$refs.afterFileUploadComponent.getQueuedFiles();

      if (!length) {
        this.form.afterFileChanged = false;
      }
    },

    handleBeforeMultiFileAdded(flg) {
      this.form.beforeFileChanged = flg;
    },

    handleAfterMultiFileAdded(flg) {
      this.form.afterFileChanged = flg;
    },

    handleBeforeMultiFilesQueueComplete() {
      this.form.beforeFileChanged = false
    },
    
    handleAfterMultiFilesQueueComplete() {
      this.form.afterFileChanged = false
    },

    handleUploadBeforeImage(){
      this.$refs.beforeFileUploadComponent.processQueue();
      this.$refs.beforeFileUploadComponent.$el.click()
    },

    handleUploadAfterImage(){
      this.$refs.afterFileUploadComponent.processQueue();
      this.$refs.afterFileUploadComponent.$el.click()
    },

    handleBeforeMultiFileSaved(fileUrl) {
      this.form.cases.before_photo.push(fileUrl)
    },

    handleAfterMultiFileSaved(fileUrl) {
      this.form.cases.after_photo.push(fileUrl)
    },

    handleafterImageSaved(fileUrl){
      this.form.cases.after_photo.push(fileUrl);
      this.$refs.afterFileUploadComponent.removeAllFiles();
    },

    handleRemoveBeforeImageClick(index){
      this.form.cases.before_photo.splice(index,1);
    },

    handleRemoveAfterImageClick(index){
      this.form.cases.after_photo.splice(index,1);
    },

    handleUpdateBeforeImageSaved(fileUrl){
      let id = "b" + this.autoStaticId++;
      let objImage = {
        id: id,
        photo: fileUrl
      }
      this.updateForm.cases.before.push(objImage);
      this.$refs.UpdatebeforeFileUploadComponent.removeAllFiles();
    },

    handleUpdateAfterImageSaved(fileUrl){
      let id = "a" + this.autoStaticId++;
      let objImage = {
        id: id,
        photo: fileUrl
      }
      this.updateForm.cases.after.push(objImage);
      this.$refs.UpdateafterFileUploadComponent.removeAllFiles();
    },

    handleUpdateUploadBeforeImage(){
      this.$refs.UpdatebeforeFileUploadComponent.processQueue();
      this.$refs.UpdatebeforeFileUploadComponent.$el.click()
    },

    handleUpdateUploadAfterImage(){
      this.$refs.UpdateafterFileUploadComponent.processQueue();
      this.$refs.UpdateafterFileUploadComponent.$el.click()
    },

    handleUpdateRemoveBeforeImageClick(id){
      this.updateForm.cases.before = this.updateForm.cases.before.filter(function (el){
        return el.id !== id;
      });
      this.tempImageForm.before_photo.delete.push(id);
    },

    handleUpdateRemoveAfterImageClick(id){
      this.updateForm.cases.after = this.updateForm.cases.after.filter(function (el){
        return el.id !== id;
      })
      this.tempImageForm.after_photo.delete.push(id);
    },

    handleCategoryChange(e) {
      e.preventDefault();
      this.query.category_id = e.target.value
      this.getData()
    },
    handleCateChange(option){
      let opt_groud_name = "";
      this.category_options.forEach(item => {
        opt_groud_name = item.group_name;
          item.children.forEach(child => {
            if (option.id == child.id) {
              if (!this.selected_categories.map(item => item.id).includes(child.id)) {
                this.selected_categories.push({
                  id: child.id,
                  name: child.name,
                  group:opt_groud_name
                })
              }
            }
          })
        })
    },
    scrollHanle(evt) {
      // console.log(evt)
    },
    removeCategory(idx) {
      this.selected_categories.splice(idx, 1);
      this.form.cases.category.splice(idx, 1);
    },
    removeUpdateCategory(idx) {
      this.selected_categories.splice(idx, 1);
      // this.updateForm.cases.category.splice(idx, 1);
      // console.log(this.updateForm.cases.category);
    },
    formatPrice(value) {
      let val = (value/1).toFixed(0);
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    },
  }
}
</script>

<style scoped>
.find-doctor-warning-msg{
  color: red;
}

.modal-container{
  padding: 0px 80px;
}

.case-img-list{
  height: 80px;
  width: auto;
}
.photo-container{
  position: relative;
  margin-right: 12px;
  margin-bottom: 12px;
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

.photo-img{
  width: auto;
  height: 90px;
  margin-right: 20px;
}

.ft-2{
  font-size: 12px;
}

.without-is-invlid{
  display: block;
}

.multiselect.is-invalid{
  border: 1px solid #dc3545;
}
</style>
