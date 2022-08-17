<template>
	<k-dialog
		ref="dialog"
		:cancel-button="false"
		:submit-button="false"
		class="k-block-selector"
		size="medium"
		v-bind="$props"
		v-on="$listeners"
	>
		<k-headline v-if="headline">
			{{ headline }}
		</k-headline>

		<details v-for="group in groups" :key="group.id" :open="group.open">
			<summary>{{ group.label }}</summary>
			<div class="k-block-types">
				<k-button
					v-for="(type, typeId, index) in group.types"
					:ref="'type-' + index"
					:key="type.id"
					:disabled="disabled?.includes(type.id)"
					:icon="type.icon || 'box'"
					:text="type.label"
					@keydown.up="navigate(index - 1)"
					@keydown.down="navigate(index + 1)"
					@click="add(type.id)"
				/>
			</div>
		</details>
		<!-- eslint-disable vue/no-v-html -->
		<p
			class="k-clipboard-hint"
			v-html="$t('field.blocks.fieldsets.paste', { shortcut })"
		/>
		<!-- eslint-enable -->
	</k-dialog>
</template>

<script>
import DialogMixin from "@/mixins/dialog.js";

/**
 * @internal
 */
export default {
	mixins: [DialogMixin],
	inheritAttrs: false,
	props: {
		groups: Object,
		disabled: Array,
		headline: String
	},
	computed: {
		shortcut() {
			return this.$helper.keyboard.metaKey() + "+v";
		}
	},
	created() {
		this.$events.$on("paste", this.close);
	},
	destroyed() {
		this.$events.$off("paste", this.close);
	},
	methods: {
		add(type) {
			this.$emit("submit", type);
			this.$refs.dialog.close();
		},
		navigate(index) {
			this.$refs["type-" + index]?.[0]?.focus();
		}
	}
};
</script>

<style>
.k-block-selector.k-dialog {
	background: var(--color-dark);
	color: var(--color-white);
}
.k-block-selector .k-headline {
	margin-bottom: 1rem;
}
.k-block-selector details:not(:last-of-type) {
	margin-bottom: 1.5rem;
}
.k-block-selector summary {
	font-size: var(--text-xs);
	cursor: pointer;
	color: var(--color-gray-400);
}
.k-block-selector details:only-of-type summary {
	pointer-events: none;
}
.k-block-selector summary:focus {
	outline: 0;
}
.k-block-selector summary:focus-visible {
	color: var(--color-green-400);
}
.k-block-types {
	display: grid;
	grid-gap: 2px;
	margin-top: 0.75rem;
	grid-template-columns: repeat(1, 1fr);
}
.k-block-types .k-button {
	display: flex;
	align-items: flex-start;
	border-radius: var(--rounded);
	background: rgba(0, 0, 0, 0.5);
	width: 100%;
	text-align: start;
	padding: 0 0.75rem 0 0;
	line-height: 1.5em;
}
.k-block-types .k-button:focus {
	outline: 2px solid var(--color-green-300);
}
.k-block-types .k-button .k-button-text {
	padding: 0.5rem 0 0.5rem 0.5rem;
}
.k-block-types .k-button .k-icon {
	width: 38px;
	height: 38px;
}
.k-clipboard-hint {
	padding-top: 1.5rem;
	font-size: var(--text-xs);
	color: var(--color-gray-400);
}
.k-clipboard-hint kbd {
	background: rgba(0, 0, 0, 0.5);
	font-family: var(--font-mono);
	letter-spacing: 0.1em;
	padding: 0.25rem;
	border-radius: var(--rounded);
	margin: 0 0.25rem;
}
</style>
