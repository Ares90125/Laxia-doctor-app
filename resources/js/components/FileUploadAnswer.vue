<template>
  <vue-dropzone
    v-if="dropzoneOptions"
    ref="changePhotoDropzone"
    :id="id"
    :class="{ 'sinlge-file-uploader' : maxFiles == 1, 'multi-files-uploader' : maxFiles > 1 }"
    :options="dropzoneOptions"
    :useCustomSlot="true"
    @vdropzone-file-added="handleFileAdded"
    @vdropzone-success="handleFileSaved"
    @vdropzone-removed-file="hanleFileRemove"
    @vdropzone-error="handleUploadError"
    @vdropzone-queue-complete="handleQueueComplete"
    @vdropzone-complete="handleUploadComplete"
    @vdropzone-complete-multiple="handleMultipleUploadComplete"
    @vdropzone-drag-enter="handleDragEnter"
    @vdropzone-drag-leave="handleDragLeave"
    @vdropzone-drop="handleDrop"
    >
      <div class="dropzone-wrapper">
        <div class="dropzone-in">
          <textarea class="form-control answer-sub-txt" v-model="answer" @change="handleAnswerChange($event)" v-bind:style="{ display: txtDisplay }" :placeholder="placeholder" @click="disablePass($event)"></textarea>
          <div class="dropzone-title answer-tit" v-bind:style="{ display: titDisplay }">
            <p>画像をアップロードする</p>
          </div>
      </div>
    </div>
  </vue-dropzone>
</template>

<script>
  import { mapGetters } from 'vuex'
  import vue2Dropzone from 'vue2-dropzone'

  export default {
    name: 'FileUploadAnswer',

    components: {
      vueDropzone: vue2Dropzone
    },

    props: {
      name: {
        type: String,
        default: undefined
      },
      id: {
        type: String,
        default: 'menu-detail-dropzone'
      },
      photo: {
        type: String,
        default: undefined
      },
      uploadUrl: {
        type: String,
        default: undefined
      },
      maxFiles: {
        type: Number,
        default: 1,
      },
      autoStatus: {
        type: Boolean,
        default: false,
      },
      placeholder: {
        type: String,
        default: undefined
      },
      textarea: {
        type: String,
        default: ''
      }
    },
    
    data() {
      return {
        dropzoneOptions: undefined,
        txtDisplay: 'block',
        titDisplay: 'none',
        answer: ''
      }
    },

    watch: {
      photo: function(newValue, oldValue) {
        this.setPhoto();
      }
    },

    computed: {
      ...mapGetters({
        token: 'auth/token',
      }),
    },

    mounted() {
      this.dropzoneOptions = {
        acceptedFiles: "image/*",
        url: this.uploadUrl,
        maxFilesize: 15,
        maxFiles: this.maxFiles,
        autoProcessQueue: this.autoStatus,
        headers: {
          "Authorization": `Bearer ${this.token}`
        },
        addRemoveLinks: true,
        dictMaxFilesExceeded: `最高${this.maxFiles}つまで選択してください。`,
        dictFileTooBig: 'ファイルサイズの上限は {{maxFilesize}} MB です\n(size: {{filesize}} MB)',
        clickable: '.dropzone-trigger'
      }

      this.$nextTick(() => {
        this.setPhoto();
      });

      this.answer = this.textarea;
    },

    methods: {
      setPhoto() {
        if (this.photo) {
          this.$refs.changePhotoDropzone.manuallyAddFile({
            size: 1,
            filename: 'menu.png',
            type: "image/png"
          }, this.photo);
        }
      },

      handleFileSaved(file, response) {
        this.$emit('file-upload-success', response.photo, this.name)
      },
      
      hanleFileRemove(file, error, xhr) {
        this.$emit('file-removed', this.name)
      },

      handleFileAdded(file) {
        this.$emit('file-added', !file.manuallyAdded, this.name)
      },

      handleQueueComplete() {
        this.$emit('queue-complete')
      },

      handleMultipleUploadComplete(response) {
        // console.log('Multiple Complete')
      },

      handleUploadComplete(response) {
        // console.log('Complete')
      },

      handleUploadError(file, message, xhr) {
        this.$swal({
          title: message,
          icon: 'warning',
        }).then((result) => {
          this.$refs.changePhotoDropzone.removeAllFiles()
        })
      },

      handleAnswerChange(event) {
        this.$emit('change-answer', event.target.value)
      },

      processQueue() {
        this.$refs.changePhotoDropzone.processQueue()
      },

      removeAllFiles() {
        this.$refs.changePhotoDropzone.removeAllFiles()
      }, 

      getQueuedFiles() {
        return this.$refs.changePhotoDropzone.getQueuedFiles().length
      },

      disablePass(e) {
        e.stopPropagation();
      },

      handleDragEnter() {
        this.txtDisplay = 'none';
        this.titDisplay = 'block';
      },

      handleDragLeave() {
        this.txtDisplay = 'block';
        this.titDisplay = 'none';
      },

      handleDrop() {
        this.txtDisplay = 'block';
        this.titDisplay = 'none';
      }
    }
  }
</script>

<style lang="scss" scoped>
</style>