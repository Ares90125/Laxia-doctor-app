<template>
	<div class="question-menu-modal-wrapper" :class="{ 'is-open': isShow }">
        <div class="form-modal-mask" @click="hide"></div>
		<div class="question-menu-modal-content">
            <div class="form-modal-header">
				<div class="form-modal-title">施術一覧</div>
				<span class="form-modal-close-btn" @click="hide">
					<img src="/img/img-modal-close-black.png" />
				</span>
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
	name: "QuestionMenuModal",

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