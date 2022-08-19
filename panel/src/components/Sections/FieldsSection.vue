<template>
	<section class="k-fields-section">
		<k-form
			:endpoints="endpoints"
			:fields="fields"
			:validate="true"
			:value="model.content"
			:disabled="lock && lock.state === 'lock'"
			@input="input"
			@submit="onSubmit"
		/>
	</section>
</template>

<script>
import debounce from "@/helpers/debounce.js";

export default {
	inheritAttrs: false,
	props: {
		fields: Object,
		lock: [Array, Object, Boolean],
		model: Object,
		id: String,
		parent: String
	},
	computed: {
		endpoints() {
			return {
				model: this.parent,
				section: this.parent + "/sections/" + this.id
			};
		}
	},
	created() {
		this.input = debounce(this.input, 50);
	},
	methods: {
		input(values, field) {
			this.$emit("input", values, { field });
		},
		onSubmit($event) {
			this.$events.$emit("keydown.cmd.s", $event);
		}
	}
};
</script>

<style>
.k-fields-issue-headline {
	margin-bottom: 0.5rem;
}
.k-fields-section input[type="submit"] {
	display: none;
}

[data-locked="true"] .k-fields-section {
	opacity: 0.2;
	pointer-events: none;
}
</style>
