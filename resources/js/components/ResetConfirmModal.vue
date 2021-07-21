<template>
	<div class="reset-confirm-modal-wrapper" :class="{ 'is-open': isShow }">
		<div class="reset-confirm-modal-content">
			<div class="reset-confirm-modal-title">
				パスワードを更新しました！
			</div>
			<div class="reset-confirm-modal-body">
				正常にあなたのパスワードが更新されました。<br/>
				下のボタンからログイン画面に移動してログインしてください。
			</div>
			<div class="reset-confirm-modal-footer">
				<router-link :to="{ name: 'login' }" class="btn btn-primary">
					ログイン画面からログインする
				</router-link>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "ResetConfirmModal",

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

<style lang="scss" scoped>
.reset-confirm-modal-wrapper {
	transition-duration: .2s;
	z-index: 1000;
	position: fixed;
	top: 0;
	left: 0;
	width: 100vw;
	height: 100vh;
	display: flex;
	justify-content: center;
	align-items: flex-start;
	opacity: 0;
	pointer-events: none;

	&.is-open {
		opacity: 1;
		background: rgba(0, 0, 0, .5);
		pointer-events: all;
	}
	.reset-confirm-modal-content {
		position: relative;
		background-color: #fff;
		top: calc(50vh - 202px);
		max-width: 800px;
		max-height: 404px;
		width: 100%;
		height: 100%;
		z-index: 10;
		background-color: #fff;
		border-radius: 20px;
		overflow: hidden;
		transform: translateY(20px);
		transition: .4s;
		box-shadow: 0 5px 15px rgba(0, 0, 0, .5);

		.reset-confirm-modal-title {
			font-size: 24px;
			font-weight: bold;
			text-align: center;
			padding: 67px 0 56px;
			line-height: 1.75;
		}

		.reset-confirm-modal-body {
			font-size: 18px;
			max-width: 477px;
			margin: 0 auto 57px;
			line-height: 1.75;
		}

		.reset-confirm-modal-footer {
			text-align: center;
		}
	}
}
</style>
