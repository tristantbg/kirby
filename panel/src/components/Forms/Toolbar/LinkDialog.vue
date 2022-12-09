<template>
	<k-dialog
		ref="dialog"
		:submit-button="$t('insert')"
		size="medium"
		@close="cancel"
		@submit="$refs.form.submit()"
	>
		<nav class="k-dialog-tabs" slot="header">
			<k-button @click="tab = 'link'" :current="tab === 'link'" icon="url"
				>Link</k-button
			>
			<k-button @click="tab = 'page'" :current="tab === 'page'" icon="page"
				>Page</k-button
			>
			<k-button @click="tab = 'email'" :current="tab === 'email'" icon="email"
				>Email</k-button
			>
			<k-button @click="tab = 'file'" :current="tab === 'file'" icon="file"
				>File</k-button
			>
		</nav>

		<k-form
			ref="form"
			:fields="fields"
			:value="value"
			@input="value = $event"
			@submit="submit"
		/>
	</k-dialog>
</template>

<script>
export default {
	data() {
		return {
			tab: "link",
			value: {
				url: null,
				text: null
			}
		};
	},
	computed: {
		fields() {
			const shared = {
				text: {
					label: this.$t("link.text"),
					type: "text"
				},
				target: {
					label: this.$t("open.newWindow"),
					type: "toggle",
					text: [this.$t("no"), this.$t("yes")]
				}
			};

			const fields = {
				link: {
					url: {
						label: this.$t("link"),
						type: "text",
						placeholder: this.$t("url.placeholder"),
						icon: "url"
					},
					...shared
				},
				page: {
					url: {
						label: "Page",
						type: "text",
						icon: "page"
					},
					...shared
				},
				email: {
					url: {
						label: this.$t("email"),
						type: "email"
					},
					...shared
				},
				file: {
					url: {
						label: "File",
						type: "text",
						icon: "file"
					},
					...shared
				}
			};

			return fields[this.tab];
		},
		kirbytext() {
			return this.$config.kirbytext;
		}
	},
	methods: {
		open(input, selection) {
			this.value.text = selection;
			this.$refs.dialog.open();
		},
		cancel() {
			this.$emit("cancel");
		},
		createKirbytext() {
			if (this.value.text.length > 0) {
				return `(link: ${this.value.url} text: ${this.value.text})`;
			} else {
				return `(link: ${this.value.url})`;
			}
		},
		createMarkdown() {
			if (this.value.text.length > 0) {
				return `[${this.value.text}](${this.value.url})`;
			} else {
				return `<${this.value.url}>`;
			}
		},
		submit() {
			// insert the link
			this.$emit(
				"submit",
				this.kirbytext ? this.createKirbytext() : this.createMarkdown()
			);

			// reset the form
			this.value = {
				url: null,
				text: null
			};

			// close the modal
			this.$refs.dialog.close();
		}
	}
};
</script>

<style>
.k-dialog-tabs {
	display: flex;
	align-items: center;
	background: var(--color-black);
	border-start-start-radius: var(--rounded-md);
	border-start-end-radius: var(--rounded-md);
	border-bottom: 1px solid var(--color-gray-300);
	color: white;
}
.k-dialog-tabs button {
	position: relative;
	display: flex;
	flex-grow: 1;
	padding: 0.75rem;
	line-height: 1.25;
	justify-content: center;
	align-items: center;
	border-radius: var(--rounded-sm);
}
.k-dialog-tabs button + button {
	border-left: 1px solid var(--color-dark);
}
.k-dialog-tabs .k-button[aria-current] * {
	z-index: 1;
}
.k-dialog-tabs .k-button[aria-current]:after {
	background: var(--color-dark);
	position: absolute;
	inset: 0.325rem;
	content: " ";
	border-radius: var(--rounded-sm);
}
</style>
