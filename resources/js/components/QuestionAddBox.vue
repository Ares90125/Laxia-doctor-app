<template>
    <div>
        <div class="row"> 
            <div class="col-12">
            <div class="more-add-image-container">
                <textarea rows="5" id="user_profile" class="form-control" :class="{ 'fulled-status' : doctorAnswer ? 'fulled-input': '' }" v-model="doctorAnswer"></textarea>
                <a @click="handleMoreAddImageClick()" class="more-add-image-clicker">
                <img src="/img/file-upload.png" class="more-add-image"/>
                </a>
            </div>

            <div class="row file-upload-answer-con" v-if="isuploadfileBlock">
                <div class="col-12">
                    <file-upload-answer
                        ref="beforeImageUploadComponent"
                        uploadUrl="/api/doctor/cases/uploadPhoto"
                        :maxFiles="10"
                    />
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-end">
            <button type="button" class="bootstrap-btn btn btn-primary add-answer-btn" @click="handleAddAnswer">{{ btnTxt }}</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'QuestionAddBox',

  props: {
    btnTxt: {
        type: String,
        default: "修正を完了"
    },
  },

  data: () => ({
    isuploadfileBlock : false,
    doctorAnswer : '',
  }),

  methods: {
      handleMoreAddImageClick() {
          this.isuploadfileBlock = !this.isuploadfileBlock
      },
      handleAddAnswer() {
          this.$emit('add-answer', this.doctorAnswer)
      }
  },
}
</script>
