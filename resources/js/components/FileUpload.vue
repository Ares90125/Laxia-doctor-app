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
    >
      <div class="dropzone-wrapper">
        <div class="dropzone-in">
          <div class="dropzone-title">
            <div><img src="/img/file.png"/></div>
            <p>写真をドラック<br>&ドロップ</p>
          </div>
      </div>
    </div>
  </vue-dropzone>
</template>

<script>
  import { mapGetters } from 'vuex'
  import vue2Dropzone from 'vue2-dropzone'

  export default {
    name: 'FileUpload',

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
      }
    },
    
    data() {
      return {
        dropzoneOptions: undefined,
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
        autoProcessQueue: false,
        headers: {
          "Authorization": `Bearer ${this.token}`
        },
        addRemoveLinks: true,
        dictMaxFilesExceeded: `最高${this.maxFiles}つまで選択してください。`,
        dictFileTooBig: 'ファイルサイズの上限は {{maxFilesize}} MB です\n(size: {{filesize}} MB)',
      }

      this.$nextTick(() => {
        this.setPhoto();
      });
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
        console.log('Multiple Complete')
      },

      handleUploadComplete(response) {
        console.log('Complete')
      },

      handleUploadError(file, message, xhr) {
        this.$swal({
          title: message,
          icon: 'warning',
        }).then((result) => {
          this.$refs.changePhotoDropzone.removeAllFiles()
        })
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
    }
  }
</script>

<style lang="scss" scoped>
</style>