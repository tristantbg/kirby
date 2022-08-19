import { props as Field } from "@/components/Forms/Field.vue";

export default {
	mixins: [Field],
	inheritAttrs: false,
	props: {
		multiple: Boolean,
		value: {
			type: Array,
			default() {
				return [];
			}
		}
	},
	data() {
		return {
			collection: null,
			isLoading: true
		};
	},
	computed: {
		btnIcon() {
			if (!this.multiple && this.value.length > 0) {
				return "refresh";
			}

			return "add";
		},
		btnLabel() {
			if (!this.multiple && this.value.length > 0) {
				return this.$t("change");
			}

			return this.$t("add");
		},
		more() {
			if (!this.max) {
				return true;
			}

			return this.max > this.value.length;
		},
		options() {
			return {
				options: [
					{ icon: "check", text: this.$t("select"), click: () => this.open() }
				]
			};
		}
	},
	watch: {
		value() {
			this.load();
		}
	},
	created() {
		this.load();
	},
	methods: {
		focus() {},
		item(item) {
			return item;
		},
		async load() {
			this.collection = await this.$api.get(this.endpoints.field);
			this.isLoading = false;
		},
		open() {
			if (this.disabled) {
				return false;
			}

			this.$dialog(this.endpoints.field);
		},
		async remove(item) {
			await this.$api.delete(this.endpoints.field + "/items/" + item.id);
			await this.load();
		},
		async sort() {}
	}
};
