<template>
	<div class="question-delete-modal-wrapper" :class="{ 'is-open': isShow }">
        <div class="form-modal-mask" @click="hide"></div>
		<div class="question-delete-modal-content">
            <div class="form-modal-header">
				<div class="form-modal-title">コメントを削除しますか？</div>
			</div>
			<div class="form-modal-body">
				<slot></slot>
			</div>
			<div v-if="$slots.footer" class="form-modal-footer">
				<slot name="footer"></slot>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "QuestionDeleteModal",

	props: {
        
	},

	data: () => ({
		isShow: false,
		payload: undefined,
	}),

	mounted() {
	},

	methods: {
		show(payload = null) {
			this.payload = payload
			this.isShow = true
		},

		hide() {
			this.payload = undefined
			this.isShow = false
			this.$emit('cancel')
		},

		confirm() {
			this.$emit('confirm', this.payload)
		}
	}
}
</script>