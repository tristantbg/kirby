<template>
	<k-form
		class="k-blueprint-inspector-form"
		:fields="fieldset"
		:value="value"
		@input="$emit('input', $event)"
		@submit="$emit('submit', $event)"
	/>
</template>

<script>
export default {
	props: {
		fields: Object,
		value: Object
	},
	computed: {
		fieldset() {
			let fields = this.fields;

			Object.keys(fields).forEach((key) => {
				fields[key].name = key;
				fields[key].counter = false;
			});

			return fields;
		}
	}
};
</script>

<style>
.k-blueprint-inspector-form {
	padding: 1.5rem;
}

.k-blueprint-inspector-form .k-field {
	display: grid;
	align-items: baseline;
	grid-column-gap: 0.75rem;
	grid-template-columns: 6rem auto;
}
.k-blueprint-inspector-form .k-field-help {
	margin-bottom: 1.5rem;
}

.k-blueprint-inspector-form .k-field-footer {
	grid-column-start: 0;
	grid-column-end: -1;
}
.k-blueprint-inspector-form .k-fieldset .k-grid {
	grid-gap: 0.75rem;
}
.k-blueprint-inspector-form .k-field-label {
	font-weight: var(--font-normal);
	color: var(--color-gray-600);
}
.k-blueprint-inspector-form .k-field-counter {
	display: none;
}
.k-blueprint-inspector-form .k-input {
	font-size: var(--text-sm);
}
</style>
