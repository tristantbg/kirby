<template>
	<section class="k-fields-section">
		<k-form
			:fields="fieldsWithEndpoints"
			:validate="true"
			:value="values"
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
		id: String,
		parent: String
	},
	computed: {
		fieldsWithEndpoints() {
			return Object.values(this.fields).map((field) => {
				field.endpoints = {
					field: this.parent + "/fields/" + field.id,
					section: this.parent + "/sections/" + this.id,
					model: this.parent
				};

				return field;
			});
		},
		values() {
			return this.$store.getters["content/values"]();
		}
	},
	created() {
		this.input = debounce(this.input, 50);
	},
	methods: {
		input(values, field, fieldName) {
			this.$store.dispatch("content/update", [fieldName, values[fieldName]]);
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
