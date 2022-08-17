<template>
	<k-dialog
		ref="dialog"
		class="k-picker-dialog"
		size="medium"
		v-bind="$props"
		@cancel="$emit('cancel')"
		@submit="submit"
	>
		<k-input
			v-if="options.search"
			:autofocus="true"
			:placeholder="$t('search') + ' …'"
			type="text"
			class="k-dialog-search"
			icon="search"
			@input="search"
		/>
		<k-collection v-bind="collection" @item="toggle" @paginate="paginate">
			<template #options="{ item: file }">
				<k-button v-bind="toggleBtn(file)" @click="toggle(file)" />
			</template>
		</k-collection>
	</k-dialog>
</template>

<script>
import dialog from "@/mixins/dialog.js";

export default {
	mixins: [dialog],
	props: {
		items: Array,
		options: Object,
		pagination: Object,
		path: String
	},
	data() {
		return {
			selected: []
		};
	},
	computed: {
		checkedIcon() {
			return this.multiple === true ? "check" : "circle-filled";
		},
		collection() {
			return {
				empty: this.empty,
				items: this.items,
				link: false,
				layout: this.options.layout,
				size: this.options.size,
				pagination: {
					details: true,
					dropdown: false,
					align: "center",
					...this.pagination
				},
				sortable: false
			};
		},
		empty() {
			return {
				icon: "image",
				text: this.options.empty
			};
		},
		multiple() {
			return this.options.multiple === true && this.options.max !== 1;
		}
	},
	created() {
		this.search = this.$helper.debounce(this.search, 200);
	},
	methods: {
		isSelected(item) {
			return this.selected.includes(item.id);
		},
		paginate(pagination) {
			this.$dialog(this.path, {
				query: {
					page: pagination.page
				}
			});
		},
		search(value) {
			this.$dialog(this.path, {
				query: {
					searchterm: value
				}
			});
		},
		submit() {
			this.$emit("submit", this.selected);
		},
		toggle(item) {
			if (this.options.multiple === false || this.options.max === 1) {
				this.selected = [];
			}

			if (this.isSelected(item) === true) {
				this.selected = this.selected.filter((id) => id !== item.id);
				return;
			}

			if (this.options.max && this.options.max <= this.selected.length) {
				return;
			}

			this.selected.push(item.id);
		},
		toggleBtn(item) {
			const isSelected = this.isSelected(item);

			return {
				icon: isSelected ? this.checkedIcon : "circle-outline",
				tooltip: isSelected ? this.$t("remove") : this.$t("select"),
				theme: isSelected ? "positive" : null
			};
		}
	}
};
</script>

<style>
.k-files-dialog .k-list-item {
	cursor: pointer;
}
</style>
