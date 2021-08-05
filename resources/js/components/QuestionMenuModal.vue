<template>
	<div class="question-menu-modal-wrapper" :class="{ 'is-open': isShow }">
        <div class="form-modal-mask" @click="hide"></div>
		<div class="question-menu-modal-content">
            <div class="form-modal-header">
				<div class="form-modal-title">施術一覧</div>
				<span class="form-modal-close-btn" @click="hide">
					<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M20.5 1.5L1.5 20.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M1.5 1.5L20.5 20.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
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